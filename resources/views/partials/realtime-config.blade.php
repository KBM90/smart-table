<script>
    window.SUPABASE_URL = @json(config('services.supabase.url'));
    window.SUPABASE_ANON_KEY = @json(config('services.supabase.anon_key'));
    window.REALTIME_ENABLED = {{ config('services.supabase.url') ? 'true' : 'false' }};
    window.REALTIME_ANON_ENABLED = {{ config('services.supabase.realtime_anon_enabled') ? 'true' : 'false' }};
</script>