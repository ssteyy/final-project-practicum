/**
 * Auto-refresh functionality for detecting page updates
 * This module uses multiple strategies to detect changes and refresh pages
 */

class AutoRefresh {
    constructor(options = {}) {
        // Configuration
        this.interval = options.interval || 5000; // Check every 5 seconds (more frequent)
        this.enabled = options.enabled !== false;
        this.checkUrl = window.location.href;
        this.timerId = null;
        this.isChecking = false;
        this.lastChecksum = null;
        this.failCount = 0;
        this.maxFails = 3;

        // Detect if we're on a chat page
        this.isChatPage = window.location.pathname.includes('/chat/');

        if (this.enabled) {
            this.start();
        }
    }

    /**
     * Start the auto-refresh polling
     */
    start() {
        if (this.timerId) {
            return; // Already running
        }

        console.log('Auto-refresh started (checking every ' + (this.interval / 1000) + ' seconds)');

        // Get initial checksum
        this.getPageChecksum().then(() => {
            // Start polling
            this.timerId = setInterval(() => {
                this.checkForUpdates();
            }, this.interval);
        });
    }

    /**
     * Stop the auto-refresh polling
     */
    stop() {
        if (this.timerId) {
            clearInterval(this.timerId);
            this.timerId = null;
            console.log('Auto-refresh stopped');
        }
    }

    /**
     * Get a checksum of the current page content
     */
    async getPageChecksum() {
        try {
            const response = await fetch(this.checkUrl, {
                method: 'GET',
                cache: 'no-cache',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Auto-Refresh': 'true'
                }
            });

            const html = await response.text();
            // Create a simple checksum from content length and a hash
            this.lastChecksum = this.simpleHash(html);
            this.failCount = 0;
        } catch (error) {
            console.error('Error getting page checksum:', error);
            this.failCount++;
        }
    }

    /**
     * Simple hash function for content comparison
     */
    simpleHash(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            const char = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash; // Convert to 32bit integer
        }
        return hash + '_' + str.length;
    }

    /**
     * Check if the page has been updated
     */
    async checkForUpdates() {
        if (this.isChecking) {
            return; // Prevent concurrent checks
        }

        // Stop checking if too many failures
        if (this.failCount >= this.maxFails) {
            console.warn('Auto-refresh: Too many failures, stopping...');
            this.stop();
            return;
        }

        this.isChecking = true;

        try {
            const response = await fetch(this.checkUrl, {
                method: 'GET',
                cache: 'no-cache',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Auto-Refresh': 'true'
                }
            });

            const html = await response.text();
            const newChecksum = this.simpleHash(html);

            if (this.lastChecksum && newChecksum !== this.lastChecksum) {
                console.log('Page update detected, refreshing...');
                this.refresh();
            }

            this.lastChecksum = newChecksum;
            this.failCount = 0;
        } catch (error) {
            console.error('Error checking for updates:', error);
            this.failCount++;
        } finally {
            this.isChecking = false;
        }
    }

    /**
     * Refresh the page
     */
    refresh() {
        // Stop polling before refresh
        this.stop();

        // Show a subtle notification (optional)
        this.showRefreshNotification();

        // Refresh after a short delay
        setTimeout(() => {
            window.location.reload();
        }, 500);
    }

    /**
     * Show a subtle notification before refresh
     */
    showRefreshNotification() {
        // Check if notification already exists
        if (document.getElementById('auto-refresh-notification')) {
            return;
        }

        const notification = document.createElement('div');
        notification.id = 'auto-refresh-notification';
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 9999;
                font-family: system-ui, -apple-system, sans-serif;
                font-size: 14px;
                animation: slideIn 0.3s ease-out;
                display: flex;
                align-items: center;
                gap: 8px;
            ">
                <svg style="width: 16px; height: 16px; animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>New updates available, refreshing...</span>
            </div>
        `;

        // Add animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes spin {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }
        `;
        document.head.appendChild(style);
        document.body.appendChild(notification);
    }

    /**
     * Change the polling interval
     */
    setInterval(newInterval) {
        this.interval = newInterval;
        if (this.timerId) {
            this.stop();
            this.start();
        }
    }
}

// Initialize auto-refresh when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Determine interval based on page type
    const isChatPage = window.location.pathname.includes('/chat/');
    const isMessagesPage = window.location.pathname.includes('/messages');
    const isOrdersPage = window.location.pathname.includes('/orders');

    let interval = 10000; // Default: 10 seconds

    if (isChatPage) {
        interval = 3000; // Chat: 3 seconds (more frequent)
    } else if (isMessagesPage || isOrdersPage) {
        interval = 5000; // Messages/Orders: 5 seconds
    }

    // Create global instance
    window.autoRefresh = new AutoRefresh({
        interval: interval,
        enabled: true
    });

    // Allow manual control via console
    console.log('Auto-refresh initialized with ' + (interval / 1000) + 's interval.');
    console.log('Use window.autoRefresh.stop() to disable or window.autoRefresh.start() to enable.');
    console.log('Use window.autoRefresh.setInterval(ms) to change interval.');
});

export default AutoRefresh;
