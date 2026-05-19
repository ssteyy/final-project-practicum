# Google Cloud Setup for Hosting Laravel Website

This guide shows how to deploy your Laravel app (using the existing Dockerfile) to Google Cloud Run.

## Prerequisites
1. Google account with a Google Cloud project
2. Billing enabled on your Google Cloud account
3. Install Google Cloud SDK (gcloud CLI): https://cloud.google.com/sdk/docs/install
4. Docker Desktop installed and running

## Step 1: Create and Select Project
```bash
# Replace my-project-id with your actual project ID
gcloud projects create my-project-id --name="Freelancer Market"

# Set the project as default
gcloud config set project my-project-id
```

## Step 2: Enable Required APIs
```bash
gcloud services enable run.googleapis.com
gcloud services enable artifactregistry.googleapis.com
gcloud services enable sqladmin.googleapis.com
```

## Step 3: Create Docker Repository
```bash
gcloud artifacts repositories create freelancer-repo \
  --repository-format=docker \
  --location=us-central1 \
  --description="Laravel app images"
```

## Step 4: Build and Push Docker Image
```bash
# Configure Docker to use Artifact Registry
gcloud auth configure-docker us-central1-docker.pkg.dev

# Build image (from project root)
docker build -t us-central1-docker.pkg.dev/my-project-id/freelancer-repo/app:latest .

# Push to Google Cloud
docker push us-central1-docker.pkg.dev/my-project-id/freelancer-repo/app:latest
```

## Step 5: Deploy to Cloud Run
```bash
gcloud run deploy freelancer-market \
  --image=us-central1-docker.pkg.dev/my-project-id/freelancer-repo/app:latest \
  --platform=managed \
  --region=us-central1 \
  --allow-unauthenticated \
  --port=8080
```

## Step 6: Configure Environment Variables
1. Go to Cloud Run → Select your service → Edit & Deploy New Revision
2. Add these environment variables (from your .env file):
   - `APP_ENV=production`
   - `APP_KEY=your-laravel-app-key`
   - `DB_CONNECTION=mysql`
   - `DB_HOST=your-cloud-sql-ip`
   - `DB_DATABASE=your-db-name`
   - `DB_USERNAME=your-db-user`
   - `DB_PASSWORD=your-db-password`

## Step 7: Set Up Database (Cloud SQL)
1. Create Cloud SQL instance (MySQL or PostgreSQL)
2. Create database and user
3. Whitelist Cloud Run service account in SQL connections
4. Update app to connect via Cloud SQL

## Step 8: Add Custom Domain (Optional)
1. In Cloud Run, go to "Manage custom domains"
2. Add your domain
3. Update DNS records at your registrar
4. Wait for SSL certificate provisioning

## Useful Commands
- View logs: `gcloud run services logs tail freelancer-market --region=us-central1`
- Update service: Re-run Step 4 and Step 5 with new image tag

## Notes
- Cloud Run scales to zero when idle (saves cost)
- First 2 million requests per month are free
- Monitor usage in Google Cloud Console Billing section

Done! Your website will be live at the URL shown after deployment.
