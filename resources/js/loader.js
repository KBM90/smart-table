// Record exact initiation timestamp
const loaderStartTime = Date.now();
const minDisplayTime = 1200; // Minimum time in ms to display the loader
const manualMinDisplayTime = 700;
let manualLoaderActive = false;
let manualLoaderStartTime = 0;

function hidePageLoader(delay = 500) {
    const loader = document.getElementById('page-loader');

    document.documentElement.classList.remove('loading');

    if (loader) {
        loader.classList.add('opacity-0');

        setTimeout(() => {
            if (! manualLoaderActive) {
                loader.style.display = 'none';
            }
        }, delay);
    }
}

window.showPageLoader = function () {
    const loader = document.getElementById('page-loader');

    manualLoaderActive = true;
    manualLoaderStartTime = Date.now();
    document.documentElement.classList.add('loading');

    if (loader) {
        loader.style.display = 'flex';
        loader.classList.remove('opacity-0');
    }
};

window.hidePageLoader = function () {
    const elapsedTime = Date.now() - manualLoaderStartTime;
    const timeToWait = Math.max(0, manualMinDisplayTime - elapsedTime);

    setTimeout(() => {
        manualLoaderActive = false;
        hidePageLoader();
    }, timeToWait);
};

// Handle page fade out when fully loaded
window.addEventListener('load', function () {
    const elapsedTime = Date.now() - loaderStartTime;
    const timeToWait = Math.max(0, minDisplayTime - elapsedTime);

    setTimeout(() => {
        manualLoaderActive = false;
        hidePageLoader();
    }, timeToWait);
});

document.addEventListener('click', function (event) {
    if (event.target.closest('[data-show-page-loader]')) {
        window.showPageLoader();
    }
});

document.addEventListener('livewire:init', function () {
    Livewire.hook('request', ({ respond, succeed, fail }) => {
        respond(() => {
            if (manualLoaderActive) {
                window.hidePageLoader();
            }
        });

        succeed(() => {
            if (manualLoaderActive) {
                window.hidePageLoader();
            }
        });

        fail(() => {
            if (manualLoaderActive) {
                window.hidePageLoader();
            }
        });
    });
});
