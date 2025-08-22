#!/bin/bash

echo "🚀 Production Deployment Script for GitHub Pages"
echo "================================================"

# Navigate to React frontend
cd /var/www/html/Ajesh/new/react-frontend

# Temporarily add homepage for production build
echo "📝 Adding production homepage URL..."
sed -i 's/"__homepage_for_production"/"homepage"/' package.json

# Build the React app for production
echo "🔨 Building React app for production..."
npm run build

# Deploy to GitHub Pages
echo "🌐 Deploying to GitHub Pages..."
npx gh-pages -d build -b gh-pages

# Restore development configuration
echo "🔄 Restoring development configuration..."
sed -i 's/"homepage"/"__homepage_for_production"/' package.json

echo "✅ Production deployment complete!"
echo "🌐 Check your site at: https://ajesh1998.github.io/Yuva-blood-bank/"
