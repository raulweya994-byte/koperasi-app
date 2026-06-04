/**
 * Auto Refresh System
 * Automatically refresh data without page reload
 */

(function() {
    'use strict';

    // Configuration
    const CONFIG = {
        refreshInterval: 30000, // 30 seconds
        enabledPages: [
            '/pengumuman',
            '/berita',
            '/jadwal',
            '/koperasi',
            '/galeri',
            '/'
        ],
        contentSelector: '#main-content',
        showNotification: true
    };

    // Check if current page should auto-refresh
    function shouldAutoRefresh() {
        const currentPath = window.location.pathname;
        return CONFIG.enabledPages.some(page => currentPath.includes(page) || currentPath === page);
    }

    // Show update notification
    function showUpdateNotification() {
        if (!CONFIG.showNotification) return;

        const notification = document.createElement('div');
        notification.className = 'auto-refresh-notification';
        notification.innerHTML = `
            <i class="fas fa-sync-alt"></i>
            <span>Data diperbarui</span>
        `;
        notification.style.cssText = `
            position: fixed;
            top: 80px;
            right: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            animation: slideInRight 0.3s ease-out;
        `;

        document.body.appendChild(notification);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Refresh content
    function refreshContent() {
        const contentArea = document.querySelector(CONFIG.contentSelector);
        if (!contentArea) return;

        // Save scroll position
        const scrollPosition = window.scrollY;

        // Fetch new content
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.querySelector(CONFIG.contentSelector);

            if (newContent && newContent.innerHTML !== contentArea.innerHTML) {
                // Update content
                contentArea.innerHTML = newContent.innerHTML;
                
                // Restore scroll position
                window.scrollTo(0, scrollPosition);
                
                // Show notification
                showUpdateNotification();
                
                console.log('[Auto Refresh] Content updated at', new Date().toLocaleTimeString());
            }
        })
        .catch(error => {
            console.error('[Auto Refresh] Error:', error);
        });
    }

    // Initialize auto refresh
    function init() {
        if (!shouldAutoRefresh()) {
            console.log('[Auto Refresh] Disabled for this page');
            return;
        }

        console.log('[Auto Refresh] Enabled - Interval:', CONFIG.refreshInterval / 1000, 'seconds');

        // Start auto refresh
        setInterval(refreshContent, CONFIG.refreshInterval);

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
            .auto-refresh-notification i {
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    }

    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose config for customization
    window.AutoRefresh = {
        config: CONFIG,
        refresh: refreshContent,
        enable: init
    };

})();
