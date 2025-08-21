#!/bin/bash

# Quick Deployment Script for Yuva Blood Bank React Frontend
# Run this from the project root directory

echo "🩸 Yuva Blood Bank - Quick GitHub Pages Deployment"
echo "================================================="

# Colors
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Check if we're in the right directory
if [ ! -d "react-frontend" ]; then
    echo -e "${RED}❌ Error: react-frontend directory not found!"
    echo "Please run this script from the project root directory."
    exit 1
fi

echo -e "${BLUE}📁 Moving to react-frontend directory...${NC}"
cd react-frontend

# Check for package.json
if [ ! -f "package.json" ]; then
    echo -e "${RED}❌ Error: package.json not found in react-frontend directory!"
    exit 1
fi

echo -e "${YELLOW}📦 Installing dependencies...${NC}"
npm install

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Failed to install dependencies!"
    exit 1
fi

echo -e "${YELLOW}🔨 Building React application...${NC}"
npm run build

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Build failed!"
    exit 1
fi

echo -e "${GREEN}✅ Build successful!${NC}"

# Check if gh-pages is installed
if ! npm list gh-pages > /dev/null 2>&1; then
    echo -e "${YELLOW}📦 Installing gh-pages...${NC}"
    npm install --save-dev gh-pages
fi

echo -e "${YELLOW}🚀 Deploying to GitHub Pages...${NC}"
npm run deploy

if [ $? -eq 0 ]; then
    echo ""
    echo -e "${GREEN}🎉 DEPLOYMENT SUCCESSFUL!${NC}"
    echo ""
    echo "📱 Your React app should be available at:"
    
    # Try to extract GitHub username and repo from git remote
    REMOTE_URL=$(git config --get remote.origin.url 2>/dev/null)
    if [ $? -eq 0 ]; then
        # Extract username and repo from GitHub URL
        if [[ $REMOTE_URL =~ github\.com[:/]([^/]+)/([^.]+) ]]; then
            USERNAME="${BASH_REMATCH[1]}"
            REPO="${BASH_REMATCH[2]}"
            echo -e "${BLUE}🌐 https://${USERNAME}.github.io/${REPO}${NC}"
        else
            echo -e "${BLUE}🌐 https://yourusername.github.io/yourrepo${NC}"
        fi
    else
        echo -e "${BLUE}🌐 https://yourusername.github.io/yourrepo${NC}"
    fi
    
    echo ""
    echo -e "${YELLOW}⏰ Note: GitHub Pages may take a few minutes to update.${NC}"
    echo ""
    echo -e "${GREEN}📋 Next Steps:${NC}"
    echo "1. 🔧 Enable GitHub Pages in your repository settings"
    echo "2. 📱 Test all functionality on the live site"
    echo "3. 🚀 Deploy your Laravel API to Heroku or another service"
    echo "4. 🔗 Update .env.production with your live API URL"
    echo ""
    echo -e "${BLUE}📖 For detailed instructions, see:${NC}"
    echo "   • REACT_DEPLOYMENT_CHECKLIST.md"
    echo "   • REACT_MIGRATION_GUIDE.md"
    echo ""
else
    echo -e "${RED}❌ Deployment failed!"
    echo "Please check the error messages above and try again."
    exit 1
fi
