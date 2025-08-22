#!/bin/bash

# GitHub Pages Deployment Verification Script
# This script checks the status of your GitHub Pages deployment

echo "🔍 Checking GitHub Pages Deployment Status..."
echo "============================================"

# Check if gh-pages branch exists
echo "📋 Checking gh-pages branch..."
git ls-remote --heads origin gh-pages > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ gh-pages branch exists on remote"
else
    echo "❌ gh-pages branch not found on remote"
    echo "💡 Try running: cd react-frontend && npm run deploy"
    exit 1
fi

# Check latest commit on gh-pages
echo "📋 Latest gh-pages commit:"
git log origin/gh-pages -1 --oneline 2>/dev/null || echo "❌ Could not fetch gh-pages commits"

# Test site accessibility
echo "📋 Testing site accessibility..."
SITE_URL="https://ajesh1998.github.io/Yuva-blood-bank/"

# Test with curl
echo "🌐 Testing $SITE_URL"
HTTP_STATUS=$(curl -o /dev/null -s -w "%{http_code}" "$SITE_URL")

if [ "$HTTP_STATUS" = "200" ]; then
    echo "✅ Site is accessible (HTTP $HTTP_STATUS)"
    echo "🎉 Your application is live!"
else
    echo "⚠️  Site returned HTTP $HTTP_STATUS"
    if [ "$HTTP_STATUS" = "404" ]; then
        echo "💡 This might be temporary. GitHub Pages can take 5-10 minutes to deploy."
        echo "💡 Make sure GitHub Pages is enabled in repository settings:"
        echo "   1. Go to repository Settings → Pages"
        echo "   2. Set source to 'Deploy from a branch'"
        echo "   3. Select 'gh-pages' branch and '/ (root)' folder"
    fi
fi

echo ""
echo "📋 Deployment Summary:"
echo "🌐 Site URL: $SITE_URL"
echo "🔧 Repository: https://github.com/Ajesh1998/Yuva-blood-bank"
echo "📖 GitHub Pages Settings: https://github.com/Ajesh1998/Yuva-blood-bank/settings/pages"
echo ""
echo "🎯 Demo Credentials:"
echo "   Username: admin"
echo "   Password: admin123"
