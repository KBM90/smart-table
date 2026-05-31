import { createClient } from '@supabase/supabase-js';

const noopHandle = {
    channel: null,
};

let cachedClient;
let warnedAboutRealtime = false;

const requestStatusSet = new Set(['pending', 'accepted']);

function warnOnce(message, details = null) {
    if (warnedAboutRealtime || typeof window === 'undefined') {
        return;
    }

    warnedAboutRealtime = true;

    if (details) {
        console.warn(message, details);

        return;
    }

    console.warn(message);
}

function resolveWindowConfig() {
    if (typeof window === 'undefined') {
        return {
            anonKey: null,
            anonRealtimeEnabled: false,
            url: null,
        };
    }

    return {
        anonKey: window.SUPABASE_ANON_KEY ?? null,
        anonRealtimeEnabled: window.REALTIME_ANON_ENABLED ?? false,
        url: window.SUPABASE_URL ?? null,
    };
}

function getRealtimeClient() {
    if (cachedClient !== undefined) {
        return cachedClient;
    }

    const { anonKey, anonRealtimeEnabled, url } = resolveWindowConfig();

    if (!anonRealtimeEnabled) {
        warnOnce('Supabase anon realtime disabled; Livewire polling fallback will stay active.');
        cachedClient = null;

        return cachedClient;
    }

    if (!url || !anonKey) {
        if (url || anonKey) {
            warnOnce('Supabase Realtime is partially configured; Livewire polling fallback will stay active.');
        }

        cachedClient = null;

        return cachedClient;
    }

    try {
        cachedClient = createClient(url, anonKey, {
            realtime: {
                params: {
                    eventsPerSecond: 5,
                },
            },
        });
    } catch (error) {
        warnOnce('Supabase Realtime client initialization failed; Livewire polling fallback will stay active.', error);
        cachedClient = null;
    }

    return cachedClient;
}

function buildChannelName(table, filter) {
    const suffix = Math.random().toString(36).slice(2, 10);

    return `smart-table:${table}:${filter ?? 'all'}:${suffix}`;
}

function subscribeToTable(table, filter, callback) {
    const client = getRealtimeClient();

    if (!client) {
        return noopHandle;
    }

    try {
        const channel = client.channel(buildChannelName(table, filter));

        channel
            .on(
                'postgres_changes',
                {
                    event: '*',
                    schema: 'public',
                    table,
                    ...(filter ? { filter } : {}),
                },
                callback
            )
            .subscribe((status, error) => {
                if (status === 'CHANNEL_ERROR' || status === 'TIMED_OUT') {
                    warnOnce(`Supabase Realtime subscription failed for ${table}; Livewire polling fallback remains active.`, error);
                }
            });

        return { channel };
    } catch (error) {
        warnOnce(`Supabase Realtime subscription setup failed for ${table}; Livewire polling fallback remains active.`, error);

        return noopHandle;
    }
}

function buildRequestFilter(filter = {}) {
    if (filter.filter) {
        return filter.filter;
    }

    if (filter.tenantId !== undefined && filter.tenantId !== null) {
        return `tenant_id=eq.${filter.tenantId}`;
    }

    if (filter.tableSessionId !== undefined && filter.tableSessionId !== null) {
        return `table_session_id=eq.${filter.tableSessionId}`;
    }

    return null;
}

function buildSessionFilter(filter = {}) {
    if (filter.filter) {
        return filter.filter;
    }

    if (filter.tenantId !== undefined && filter.tenantId !== null) {
        return `tenant_id=eq.${filter.tenantId}`;
    }

    if (filter.id !== undefined && filter.id !== null) {
        return `id=eq.${filter.id}`;
    }

    return null;
}

export function onRequestChange(filter = {}, callback) {
    return subscribeToTable('requests', buildRequestFilter(filter), (payload) => {
        if (typeof callback === 'function') {
            callback(payload);
        }
    });
}

export function onSessionChange(filter = {}, callback) {
    return subscribeToTable('table_sessions', buildSessionFilter(filter), (payload) => {
        if (typeof callback === 'function') {
            callback(payload);
        }
    });
}

export function unsubscribe(handle) {
    if (!handle?.channel) {
        return;
    }

    const client = getRealtimeClient();

    if (!client) {
        return;
    }

    client.removeChannel(handle.channel);
}

export function shouldRefreshWaiterList(payload) {
    const oldStatus = payload.old?.status ?? null;
    const newStatus = payload.new?.status ?? null;

    return requestStatusSet.has(oldStatus) || requestStatusSet.has(newStatus);
}

export const realtimeClient = {
    onRequestChange,
    onSessionChange,
    unsubscribe,
};