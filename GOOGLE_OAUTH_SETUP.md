# Google OAuth Setup Guide

This guide will help you set up Google OAuth authentication for your FreelanceHub application.

## Prerequisites

- A Google account
- Your Laravel application running locally or on a server

## Step 1: Create a Google Cloud Project

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Click on "Select a project" at the top of the page
3. Click "New Project"
4. Enter a project name (e.g., "FreelanceHub")
5. Click "Create"

## Step 2: Enable Google+ API

1. In your Google Cloud Console, go to "APIs & Services" > "Library"
2. Search for "Google+ API"
3. Click on it and press "Enable"

## Step 3: Create OAuth 2.0 Credentials

1. Go to "APIs & Services" > "Credentials"
2. Click "Create Credentials" > "OAuth client ID"
3. If prompted, configure the OAuth consent screen:
   - Choose "External" user type
   - Fill in the required fields:
     - App name: FreelanceHub
     - User support email: your email
     - Developer contact information: your email
   - Click "Save and Continue"
   - Skip the "Scopes" section (click "Save and Continue")
   - Skip the "Test users" section (click "Save and Continue")
   - Click "Back to Dashboard"

4. Now create the OAuth client ID:
   - Click "Create Credentials" > "OAuth client ID"
   - Application type: "Web application"
   - Name: FreelanceHub Web Client
   - Authorized JavaScript origins:
     - `http://localhost` (for local development)
     - `http://localhost:8000` (for local development)
     - Add your production URL when deploying
   - Authorized redirect URIs:
     - `http://localhost/auth/google/callback`
     - `http://localhost:8000/auth/google/callback`
     - Add your production callback URL when deploying
   - Click "Create"

5. Copy your Client ID and Client Secret

## Step 4: Configure Your Laravel Application

1. Open your `.env` file
2. Update the Google OAuth credentials:

```env
GOOGLE_CLIENT_ID=your-actual-google-client-id
GOOGLE_CLIENT_SECRET=your-actual-google-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

Replace `your-actual-google-client-id` and `your-actual-google-client-secret` with the values you copied from Google Cloud Console.

## Step 5: Test the Integration

1. Start your Laravel development server:
   ```bash
   php artisan serve
   ```

2. Navigate to the login page: `http://localhost:8000/login`

3. Click the "Google" button

4. You should be redirected to Google's login page

5. After successful authentication, you'll be redirected back to your application and logged in

## Important Notes

### For Production Deployment

When deploying to production, make sure to:

1. Update the `.env` file with your production URL:
   ```env
   APP_URL=https://yourdomain.com
   GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
   ```

2. Add your production URLs to the Google Cloud Console:
   - Authorized JavaScript origins: `https://yourdomain.com`
   - Authorized redirect URIs: `https://yourdomain.com/auth/google/callback`

### Security Considerations

- Never commit your `.env` file to version control
- Keep your Google Client Secret secure
- Use HTTPS in production
- Regularly review and rotate your OAuth credentials

## Troubleshooting

### Error: "redirect_uri_mismatch"
- Make sure the redirect URI in your `.env` file exactly matches one of the authorized redirect URIs in Google Cloud Console
- Check for trailing slashes - they must match exactly

### Error: "invalid_client"
- Verify your Client ID and Client Secret are correct
- Make sure you copied them correctly without extra spaces

### Users can't log in
- Check that the Google+ API is enabled in your Google Cloud Console
- Verify your OAuth consent screen is properly configured
- Make sure the user's email is added to test users if your app is in testing mode

## Features Implemented

✅ Google OAuth login on login page
✅ Google OAuth signup on register page
✅ Automatic user creation for new Google users
✅ Automatic email verification for Google users
✅ Linking existing accounts with Google OAuth
✅ Secure password generation for OAuth users

## Database Changes

A new `google_id` column has been added to the `users` table to store the Google user ID for OAuth authentication.

## Files Modified

- `app/Http/Controllers/Auth/GoogleAuthController.php` - New controller for Google OAuth
- `app/Models/User.php` - Added `google_id` to fillable fields
- `config/services.php` - Added Google OAuth configuration
- `routes/web.php` - Added Google OAuth routes
- `resources/views/auth/login.blade.php` - Added Google login button
- `resources/views/auth/register.blade.php` - Added Google signup button
- `.env` - Added Google OAuth credentials
- `database/migrations/2026_01_28_125659_add_google_id_to_users_table.php` - Migration for google_id column

## Support

If you encounter any issues, please check the Laravel Socialite documentation: https://laravel.com/docs/socialite
