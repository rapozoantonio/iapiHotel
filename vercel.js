import { inject } from '@vercel/analytics';
import { injectSpeedInsights } from '@vercel/speed-insights';

document.addEventListener('DOMContentLoaded', () => {
    inject();
    injectSpeedInsights();
});
