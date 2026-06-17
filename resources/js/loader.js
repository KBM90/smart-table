// Record exact initiation timestamp
const loaderStartTime = Date.now();
const minDisplayTime = 1200; // Minimum time in ms to display the loader

// Handle page fade out when fully loaded
window.addEventListener('load', function () {
    const loader = document.getElementById('page-loader');
    const elapsedTime = Date.now() - loaderStartTime;
    const timeToWait = Math.max(0, minDisplayTime - elapsedTime);

    setTimeout(() => {
        // Unlock body scrolling
        document.documentElement.classList.remove('loading');

        if (loader) {
            loader.classList.add('opacity-0');
            // Remove from view layout after Tailwind transition duration (500ms)
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }
    }, timeToWait);
});