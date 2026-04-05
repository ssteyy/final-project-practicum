# Auto-Refresh Feature Guide

## Overview

The auto-refresh feature has been implemented to automatically refresh pages when updates are detected. This ensures users always see the most current data without manually refreshing their browser.

## How It Works

The system uses an intelligent polling mechanism that:
1. Fetches the current page content at regular intervals
2. Creates a checksum (hash) of the page content
3. Compares the new checksum with the previous one
4. Automatically refreshes the page when changes are detected
5. Shows a brief notification before refreshing

## Polling Intervals by Page Type

The system automatically adjusts polling frequency based on the page:
- **Chat pages** (`/chat/*`): Every 3 seconds (most frequent)
- **Messages/Orders pages**: Every 5 seconds
- **All other pages**: Every 10 seconds

## Features

- ✅ Automatic page refresh on updates
- ✅ Configurable polling interval
- ✅ Visual notification before refresh
- ✅ Can be enabled/disabled via browser console
- ✅ Prevents concurrent checks
- ✅ Works on all pages using the app layout

## Configuration

### Change Polling Interval

The polling interval varies by page type (3s for chat, 5s for messages/orders, 10s for others). To change it:

**Option 1: Via Browser Console (Temporary)**
```javascript
// Set to 15 seconds (15000 milliseconds)
window.autoRefresh.setInterval(15000);
```

**Option 2: Modify the Source Code (Permanent)**

Edit `resources/js/auto-refresh.js` and change the interval values in the initialization section:
```javascript
let interval = 10000; // Default: 10 seconds

if (isChatPage) {
    interval = 3000; // Chat: 3 seconds (change this)
} else if (isMessagesPage || isOrdersPage) {
    interval = 5000; // Messages/Orders: 5 seconds (change this)
}
```

Then rebuild the assets:
```bash
npm run build
```

### Disable Auto-Refresh

**Temporarily (via Browser Console):**
```javascript
window.autoRefresh.stop();
```

**Re-enable:**
```javascript
window.autoRefresh.start();
```

**Permanently:**

Edit `resources/js/auto-refresh.js` and set `enabled: false`:
```javascript
window.autoRefresh = new AutoRefresh({
    interval: 30000,
    enabled: false // Disable auto-refresh
});
```

Then rebuild:
```bash
npm run build
```

## Customization

### Change Notification Style

Edit the `showRefreshNotification()` method in `resources/js/auto-refresh.js` to customize the notification appearance.

### Disable Notification

Comment out or remove the notification call in the `refresh()` method:
```javascript
refresh() {
    this.stop();
    // this.showRefreshNotification(); // Comment this line
    setTimeout(() => {
        window.location.reload();
    }, 500);
}
```

### Page-Specific Behavior

To disable auto-refresh on specific pages, add this to your blade template:
```html
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.autoRefresh) {
            window.autoRefresh.stop();
        }
    });
</script>
```

## Technical Details

### Detection Method

The system uses HTTP GET requests to fetch the page content and creates a checksum (hash) to detect changes. This method:
1. **Fetches the full page** - Gets the complete HTML content
2. **Creates a hash** - Generates a unique checksum from content
3. **Compares checksums** - Detects any content changes
4. **Triggers refresh** - Automatically reloads when changes detected

This approach is more reliable than header-based detection as it catches all content changes.

### Browser Compatibility

Works in all modern browsers that support:
- Fetch API
- ES6 Classes
- Async/await

### Performance

- Minimal bandwidth usage (HEAD requests only)
- No impact on server performance
- Efficient polling mechanism
- Prevents concurrent checks

## Troubleshooting

### Auto-refresh not working

1. **Check browser console** for errors:
   - Press F12 to open Developer Tools
   - Look for error messages

2. **Verify the feature is enabled:**
   ```javascript
   console.log(window.autoRefresh);
   ```

3. **Check if polling is active:**
   ```javascript
   window.autoRefresh.timerId // Should not be null
   ```

4. **Rebuild assets:**
   ```bash
   npm run build
   ```

### Too frequent refreshes

Increase the polling interval:
```javascript
window.autoRefresh.setInterval(60000); // 60 seconds
```

### Page refreshes unexpectedly

This can happen if:
- Server time is not synchronized
- Cache headers are not properly set
- Multiple tabs are open

## Development Mode

When running `npm run dev`, Vite's hot module replacement (HMR) will handle updates automatically. The auto-refresh feature works alongside HMR without conflicts.

## Production Deployment

After making changes:

1. Build the assets:
   ```bash
   npm run build
   ```

2. Clear Laravel cache:
   ```bash
   php artisan cache:clear
   php artisan view:clear
   ```

3. Deploy the updated files to your server

## Support

For issues or questions:
- Check the browser console for error messages
- Review the `resources/js/auto-refresh.js` file
- Ensure assets are properly built with `npm run build`
