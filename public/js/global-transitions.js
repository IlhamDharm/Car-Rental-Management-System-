// Global Page Transitions - Adam Rental

document.addEventListener('DOMContentLoaded', () => {
    // 1. Create and inject progress bar
    const progressBar = document.createElement('div');
    progressBar.id = 'top-progress-bar';
    document.body.appendChild(progressBar);

    // 2. Animate progress bar on load completion
    setTimeout(() => {
        progressBar.style.width = '100%';
        setTimeout(() => {
            progressBar.style.opacity = '0';
            setTimeout(() => {
                progressBar.remove();
            }, 400);
        }, 300);
    }, 100);

    // 3. Intercept link clicks for page exit transition
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        
        if (!link) return;

        const href = link.getAttribute('href');
        const target = link.getAttribute('target');

        // Check if the link is an internal navigation link
        if (
            href &&
            !href.startsWith('#') &&
            !href.startsWith('javascript:') &&
            !href.startsWith('mailto:') &&
            !href.startsWith('tel:') &&
            target !== '_blank' &&
            !e.metaKey &&
            !e.ctrlKey &&
            !e.shiftKey &&
            !e.altKey
        ) {
            // Check if it's the same domain
            const url = new URL(link.href, window.location.href);
            if (url.origin === window.location.origin) {
                e.preventDefault();
                
                // Re-inject progress bar if deleted
                let currentBar = document.getElementById('top-progress-bar');
                if (!currentBar) {
                    currentBar = document.createElement('div');
                    currentBar.id = 'top-progress-bar';
                    document.body.appendChild(currentBar);
                }
                
                // Animate exit
                currentBar.style.width = '70%';
                document.body.style.opacity = '0';
                
                setTimeout(() => {
                    currentBar.style.width = '100%';
                    window.location.href = href;
                }, 300);
            }
        }
    });
});
