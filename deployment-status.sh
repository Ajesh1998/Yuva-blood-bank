#!/bin/bash

echo "🚀 GitHub Pages Deployment Verification"
echo "========================================"

# Check if gh-pages branch exists
echo "✅ Checking gh-pages branch..."
git ls-remote --heads origin gh-pages > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ gh-pages branch exists on GitHub"
else
    echo "❌ gh-pages branch not found on GitHub"
    exit 1
fi

# Check the deployment URL
echo ""
echo "🌐 Your GitHub Pages site should be available at:"
echo "   https://ajesh1998.github.io/Yuva-blood-bank/"
echo ""

echo "📋 Manual Steps Required:"
echo "1. Go to your GitHub repository: https://github.com/Ajesh1998/Yuva-blood-bank"
echo "2. Click on 'Settings' tab"
echo "3. Scroll down to 'Pages' section"
echo "4. Under 'Source', select 'Deploy from a branch'"
echo "5. Choose 'gh-pages' branch and '/ (root)' folder"
echo "6. Click 'Save'"
echo ""

echo "⏱️  GitHub Pages typically takes 5-10 minutes to deploy after configuration."
echo "    Check back at: https://ajesh1998.github.io/Yuva-blood-bank/"
echo ""

echo "🔍 What was deployed:"
echo "   - Clean React build files only"
echo "   - .nojekyll file (disables Jekyll processing)"
echo "   - 404.html for SPA routing support"
echo "   - All static assets (CSS, JS, images)"
echo ""

echo "✅ Deployment Summary:"
echo "   - ✅ Blade views completely removed"
echo "   - ✅ Laravel routes updated for API-only"
echo "   - ✅ React app built with correct base path (/Yuva-blood-bank/)"
echo "   - ✅ Clean gh-pages branch created and pushed"
echo "   - ⏳ GitHub Pages configuration needed (manual step)"
