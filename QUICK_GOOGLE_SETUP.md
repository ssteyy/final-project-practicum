# Quick Google OAuth Setup - Step by Step

## ⚠️ IMPORTANT: You MUST complete these steps for Google login to work!

The error you're seeing happens because you haven't created Google OAuth credentials yet. Follow these exact steps:

---

## 📋 Step-by-Step Instructions

### Step 1: Go to Google Cloud Console
1. Open your browser and go to: **https://console.cloud.google.com/**
2. Sign in with your Google account

### Step 2: Create a New Project
1. Click the **"Select a project"** dropdown at the top
2. Click **"NEW PROJECT"** button
3. Enter project name: **FreelanceHub**
4. Click **"CREATE"**
5. Wait for the project to be created (takes a few seconds)
6. Make sure your new project is selected in the dropdown

### Step 3: Configure OAuth Consent Screen
1. In the left sidebar, click **"APIs & Services"**
2. Click **"OAuth consent screen"**
3. Select **"External"** (the only option available)
4. Click **"CREATE"**
5. Fill in the required fields:
   - **App name**: `FreelanceHub`
   - **User support email**: Select your email from dropdown
   - **Developer contact information**: Enter your email
6. Click **"SAVE AND CONTINUE"**
7. On the "Scopes" page, just click **"SAVE AND CONTINUE"** (don't add anything)
8. On the "Test users" page, just click **"SAVE AND CONTINUE"** (don't add anything)
9. Click **"BACK TO DASHBOARD"**

### Step 4: Create OAuth Client ID (MOST IMPORTANT!)
1. In the left sidebar, click **"Credentials"**
2. Click the **"+ CREATE CREDENTIALS"** button at the top
3. Select **"OAuth client ID"**
4. For "Application type", select **"Web application"**
5. For "Name", enter: **FreelanceHub Web Client**
6. Under **"Authorized JavaScript origins"**, click **"+ ADD URI"**
   - Enter: `http://localhost:8000`
7. Under **"Authorized redirect URIs"**, click **"+ ADD URI"**
   - Enter: `http://localhost:8000/auth/google/callback`
8. Click **"CREATE"**

### Step 5: Copy Your Credentials
**THIS IS THE MOST IMPORTANT STEP!**

A popup will appear showing:
- **Your Client ID** (looks like: `123456789012-abc123def456.apps.googleusercontent.com`)
- **Your Client Secret** (looks like: `GOCSPX-abc123def456ghi789`)

**DO NOT CLOSE THIS POPUP YET!**

### Step 6: Update Your .env File
1. Open your project's `.env` file
2. Find these lines:
   ```
   GOOGLE_CLIENT_ID=your-google-client-id
   GOOGLE_CLIENT_SECRET=your-google-client-secret
   ```
3. Replace them with your ACTUAL credentials:
   ```
   GOOGLE_CLIENT_ID=paste-the-client-id-here
   GOOGLE_CLIENT_SECRET=paste-the-client-secret-here
   ```
4. **SAVE the .env file**

### Step 7: Clear Laravel Cache
Open your terminal in the project directory and run:
```bash
php artisan config:clear
php artisan cache:clear
```

### Step 8: Restart Your Server
If your Laravel server is running, stop it (Ctrl+C) and start it again:
```bash
php artisan serve
```

### Step 9: Test It!
1. Go to: **http://localhost:8000/login**
2. Click the **"Google"** button
3. You should now see Google's login page!
4. Sign in with your Google account
5. You'll be redirected back to your app and logged in!

---

## ✅ Checklist - Make Sure You Did All These:

- [ ] Created a Google Cloud project
- [ ] Configured OAuth consent screen
- [ ] Created OAuth client ID
- [ ] Added `http://localhost:8000` to Authorized JavaScript origins
- [ ] Added `http://localhost:8000/auth/google/callback` to Authorized redirect URIs
- [ ] Copied the Client ID and Client Secret
- [ ] Pasted them into your `.env` file (replacing the placeholder text)
- [ ] Saved the `.env` file
- [ ] Ran `php artisan config:clear`
- [ ] Ran `php artisan cache:clear`
- [ ] Restarted your Laravel server

---

## 🔍 How to Verify Your Credentials Are Correct

Your `.env` file should look like this (with YOUR actual values):

```env
GOOGLE_CLIENT_ID=123456789012-abcdefghijklmnopqrstuvwxyz123456.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-abcdefghijklmnopqrstuvwxyz
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

**Signs your credentials are WRONG:**
- ❌ Still says `your-google-client-id`
- ❌ Still says `your-google-client-secret`
- ❌ Client ID doesn't end with `.apps.googleusercontent.com`
- ❌ Client Secret doesn't start with `GOCSPX-`

---

## 🆘 Still Having Issues?

### Error: "invalid_client"
- You haven't created the OAuth credentials yet, OR
- You didn't copy them correctly into `.env`, OR
- You didn't run `php artisan config:clear`

### Error: "redirect_uri_mismatch"
- The redirect URI in Google Cloud Console doesn't match exactly
- Make sure it's: `http://localhost:8000/auth/google/callback`
- No trailing slash!
- Check for typos!

### Can't Find Where to Create Credentials
1. Make sure you're in the correct project (check the dropdown at the top)
2. Go to: APIs & Services → Credentials
3. Look for the "+ CREATE CREDENTIALS" button at the top

---

## 📸 Visual Reference

When you create the OAuth client ID, your screen should look like this:

```
Application type: Web application
Name: FreelanceHub Web Client

Authorized JavaScript origins:
  http://localhost:8000

Authorized redirect URIs:
  http://localhost:8000/auth/google/callback

[CREATE] [CANCEL]
```

---

## 🎉 Success!

Once you complete all steps correctly, clicking the Google button on your login page will:
1. Redirect you to Google's login page
2. Ask you to sign in with your Google account
3. Ask for permission to access your basic profile
4. Redirect you back to your app
5. Automatically log you in or create a new account!

---

**Need more help?** Check the detailed guide in `GOOGLE_OAUTH_SETUP.md`
