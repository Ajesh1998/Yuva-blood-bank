#!/bin/bash

echo "🔍 Yuva Blood Bank - Deployment Verification"
echo "============================================="

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}Checking React Frontend...${NC}"

# Check if we're in the react-frontend directory
if [ ! -f "package.json" ]; then
    echo -e "${RED}❌ Please run this from the react-frontend directory${NC}"
    exit 1
fi

# Check if build directory exists
if [ ! -d "build" ]; then
    echo -e "${RED}❌ Build directory not found. Run 'npm run build' first.${NC}"
    exit 1
else
    echo -e "${GREEN}✅ Build directory exists${NC}"
fi

# Check for .nojekyll file
if [ -f "build/.nojekyll" ]; then
    echo -e "${GREEN}✅ .nojekyll file present (Jekyll disabled)${NC}"
else
    echo -e "${RED}❌ .nojekyll file missing${NC}"
fi

# Check for 404.html
if [ -f "build/404.html" ]; then
    echo -e "${GREEN}✅ 404.html present (SPA routing configured)${NC}"
else
    echo -e "${RED}❌ 404.html missing${NC}"
fi

# Check build size
BUILD_SIZE=$(du -sh build/ | cut -f1)
echo -e "${GREEN}✅ Build size: $BUILD_SIZE${NC}"

# Check if main JS and CSS files exist
if ls build/static/js/main.*.js >/dev/null 2>&1; then
    echo -e "${GREEN}✅ Main JavaScript bundle found${NC}"
else
    echo -e "${RED}❌ Main JavaScript bundle missing${NC}"
fi

if ls build/static/css/main.*.css >/dev/null 2>&1; then
    echo -e "${GREEN}✅ Main CSS bundle found${NC}"
else
    echo -e "${RED}❌ Main CSS bundle missing${NC}"
fi

echo ""
echo -e "${YELLOW}Checking Laravel Backend...${NC}"

# Check if Laravel server is running
if curl -s http://localhost:8000/api/bloodbank/app-info > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Laravel API is responding${NC}"
else
    echo -e "${RED}❌ Laravel API not responding (start with 'php artisan serve')${NC}"
fi

# Check donors endpoint
if curl -s http://localhost:8000/api/bloodbank/donors > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Donors API endpoint working${NC}"
else
    echo -e "${RED}❌ Donors API endpoint not working${NC}"
fi

echo ""
echo -e "${YELLOW}Summary:${NC}"
echo "📁 React build directory: $(pwd)/build"
echo "🌐 Laravel API: http://localhost:8000"
echo "🖥️  React app: http://localhost:3000"
echo ""
echo "🚀 Ready for deployment!"
echo "Run './deploy.sh' to deploy to GitHub Pages"
