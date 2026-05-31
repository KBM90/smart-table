import './bootstrap';

import Alpine from 'alpinejs';
import {
    onRequestChange,
    onSessionChange,
    shouldRefreshWaiterList,
    unsubscribe,
} from './realtime';

window.Alpine = Alpine;
window.AppRealtime = {
    onRequestChange,
    onSessionChange,
    unsubscribe,
};
window.AppRealtimeFilters = {
    shouldRefreshWaiterList,
};

Alpine.start();
