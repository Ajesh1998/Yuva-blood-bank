#!/bin/bash

# Yuva Blood Bank - React Frontend Deployment Script

echo "🚀 Yuva Blood Bank - React Deployment Script"
echo "============================================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if we're in the right directory
if [ ! -f "package.json" ]; then
    echo -e "${RED}Error: package.json not found. Please run this script from the react-frontend directory.${NC}"
    exit 1
fi

echo -e "${YELLOW}Step 1: Installing dependencies...${NC}"
npm install

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Failed to install dependencies.${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Dependencies installed successfully${NC}"

echo -e "${YELLOW}Step 2: Building React application...${NC}"
npm run build

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Failed to build React application.${NC}"
    exit 1
fi

echo -e "${GREEN}✅ React application built successfully${NC}"

echo -e "${YELLOW}Step 3: Checking if gh-pages is installed...${NC}"
if ! npm list gh-pages > /dev/null 2>&1; then
    echo -e "${YELLOW}Installing gh-pages...${NC}"
    npm install --save-dev gh-pages
fi

echo -e "${GREEN}✅ gh-pages is ready${NC}"

echo -e "${YELLOW}Step 4: Deploying to GitHub Pages...${NC}"

# Check if we have git repository
if [ ! -d ".git" ]; then
    echo -e "${RED}Error: Not a git repository. Please initialize git first.${NC}"
    echo "Run: git init && git add . && git commit -m 'Initial commit'"
    exit 1
fi

# Deploy
npm run deploy

if [ $? -eq 0 ]; then
    echo -e "${GREEN}🎉 Deployment successful!${NC}"
    echo ""
    echo "Your React app should be available at:"
    echo "https://$(git config --get remote.origin.url | sed 's/.*github.com[:/]\([^/]*\)\/\([^.]*\).*/\1.github.io\/\2/')"
    echo ""
    echo "Note: It may take a few minutes for GitHub Pages to update."
    echo ""
    echo -e "${YELLOW}Next steps:${NC}"
    echo "1. Check your GitHub repository settings"
    echo "2. Ensure GitHub Pages is enabled on gh-pages branch"
    echo "3. Update your Laravel API CORS settings if needed"
    echo "4. Test all functionality on the live site"
else
    echo -e "${RED}Error: Deployment failed.${NC}"
    echo "Please check your git configuration and try again."
    exit 1
fi
