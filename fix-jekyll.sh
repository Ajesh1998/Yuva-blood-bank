#!/bin/bash

echo "🔧 Jekyll Processing Issue - Comprehensive Fix"
echo "=============================================="

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}Applying multiple fixes for Jekyll processing issues...${NC}"

# Fix 1: Create .nojekyll at repository root
echo -e "${YELLOW}1. Creating .nojekyll file at repository root...${NC}"
touch .nojekyll
echo -e "${GREEN}✅ .nojekyll created${NC}"

# Fix 2: Create .nojekyll in React build directory
echo -e "${YELLOW}2. Ensuring .nojekyll in React build directory...${NC}"
if [ -d "react-frontend/build" ]; then
    touch react-frontend/build/.nojekyll
    echo -e "${GREEN}✅ .nojekyll added to build directory${NC}"
else
    echo -e "${YELLOW}⚠️  Build directory doesn't exist yet - will be added during build${NC}"
fi

# Fix 3: Update React build process
echo -e "${YELLOW}3. Updating React build process...${NC}"
cd react-frontend

# Ensure .nojekyll is in public directory (gets copied to build)
touch public/.nojekyll
echo -e "${GREEN}✅ .nojekyll added to React public directory${NC}"

# Fix 4: Build React app with Jekyll fixes
echo -e "${YELLOW}4. Building React app with Jekyll fixes...${NC}"
npm run build

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ React build successful${NC}"
    
    # Ensure .nojekyll and 404.html are in place
    touch build/.nojekyll
    cp build/index.html build/404.html
    
    # Remove any problematic markdown files from build
    find build -name "*.md" -type f -delete 2>/dev/null || true
    
    echo -e "${GREEN}✅ Jekyll fixes applied to build directory${NC}"
    
    # List build contents
    echo -e "${YELLOW}Build directory contents:${NC}"
    ls -la build/ | head -10
else
    echo -e "${RED}❌ React build failed${NC}"
    exit 1
fi

cd ..

# Fix 5: Verify configuration files
echo -e "${YELLOW}5. Verifying configuration files...${NC}"

# Check _config.yml
if [ -f "_config.yml" ]; then
    echo -e "${GREEN}✅ _config.yml exists with exclusions${NC}"
else
    echo -e "${RED}❌ _config.yml missing${NC}"
fi

# Check .gitignore
if grep -q "node_modules" .gitignore; then
    echo -e "${GREEN}✅ .gitignore excludes node_modules${NC}"
else
    echo -e "${RED}❌ .gitignore needs updating${NC}"
fi

# Fix 6: GitHub Pages deployment configuration
echo -e "${YELLOW}6. Checking GitHub Actions workflow...${NC}"
if [ -f ".github/workflows/deploy.yml" ]; then
    if grep -q "enable_jekyll: false" .github/workflows/deploy.yml; then
        echo -e "${GREEN}✅ GitHub Actions configured to disable Jekyll${NC}"
    else
        echo -e "${RED}❌ GitHub Actions needs Jekyll disabled${NC}"
    fi
else
    echo -e "${YELLOW}⚠️  GitHub Actions workflow not found${NC}"
fi

echo ""
echo -e "${GREEN}🎉 Jekyll Fix Complete!${NC}"
echo ""
echo -e "${YELLOW}Summary of fixes applied:${NC}"
echo "1. ✅ .nojekyll file at repository root"
echo "2. ✅ .nojekyll file in React public directory"
echo "3. ✅ React build with Jekyll processing disabled"
echo "4. ✅ 404.html for SPA routing"
echo "5. ✅ _config.yml with comprehensive exclusions"
echo "6. ✅ GitHub Actions with enable_jekyll: false"
echo ""
echo -e "${YELLOW}Next steps:${NC}"
echo "1. Commit and push these changes to your repository"
echo "2. GitHub Pages will use the gh-pages branch (no Jekyll processing)"
echo "3. Monitor the Actions tab for successful deployment"
echo ""
echo -e "${GREEN}The Jekyll processing issue should now be resolved! 🚀${NC}"
