import './bootstrap';
import './loader';

import {
    onRequestChange,
    onSessionChange,
    shouldRefreshWaiterList,
    unsubscribe,
} from './realtime';


window.AppRealtime = {
    onRequestChange,
    onSessionChange,
    unsubscribe,
};
window.AppRealtimeFilters = {
    shouldRefreshWaiterList,
};





