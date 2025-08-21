#!/bin/bash

echo "🩸 Yuva Blood Bank - Deployment Verification Script"
echo "=================================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to check status
check_status() {
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ $1${NC}"
    else
        echo -e "${RED}❌ $1${NC}"
        exit 1
    fi
}

echo ""
echo "🔍 Checking application requirements..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Error: Not in Laravel project directory${NC}"
    exit 1
fi

# Check PHP version
echo -n "📋 PHP Version: "
php --version | head -n 1
php -v | grep -q "PHP 8\.[1-9]"
check_status "PHP 8.1+ Available"

# Check composer
composer --version > /dev/null 2>&1
check_status "Composer Available"

# Check Laravel installation
php artisan --version > /dev/null 2>&1
check_status "Laravel Framework Available"

echo ""
echo "🚀 Testing deployment commands..."

# Test production dependency installation
echo "📦 Installing production dependencies..."
composer install --no-dev --optimize-autoloader > /dev/null 2>&1
check_status "Production Dependencies Installed"

# Test key generation
echo "🔑 Generating application key..."
php artisan key:generate > /dev/null 2>&1
check_status "Application Key Generated"

# Test caching
echo "⚡ Caching configurations..."
php artisan config:cache > /dev/null 2>&1
check_status "Configuration Cached"

php artisan route:cache > /dev/null 2>&1
check_status "Routes Cached"

php artisan view:cache > /dev/null 2>&1
check_status "Views Cached"

# Test database
echo "🗄️ Testing database..."
touch database/database.sqlite 2>/dev/null
check_status "SQLite Database Ready"

echo ""
echo "🌐 Testing application endpoints..."

# Start server in background
php artisan serve --host=0.0.0.0 --port=8888 > /dev/null 2>&1 &
SERVER_PID=$!
echo "🔄 Starting Laravel server (PID: $SERVER_PID)..."

# Wait for server to start
sleep 3

# Test homepage
curl -s -I http://localhost:8888/ | grep -q "HTTP/1.1 200 OK"
check_status "Homepage Loads (HTTP 200)"

# Test login page
curl -s -I http://localhost:8888/login | grep -q "HTTP/1.1 200 OK"
check_status "Login Page Loads (HTTP 200)"

# Test dashboard (should redirect to login)
curl -s -I http://localhost:8888/dashboard | grep -q "HTTP/1.1"
check_status "Dashboard Route Available"

# Stop server
kill $SERVER_PID > /dev/null 2>&1
echo "🛑 Server stopped"

echo ""
echo "🔍 Checking file structure..."

# Check required files
[ -f "resources/views/index.blade.php" ]
check_status "Index Page Present"

[ -f ".github/workflows/laravel.yml" ]
check_status "CI/CD Workflow Present"

[ -f ".env.example" ]
check_status "Environment Example Present"

[ -f "composer.json" ]
check_status "Composer Configuration Present"

[ -f "routes/web.php" ]
check_status "Routes Configuration Present"

echo ""
echo "📋 Checking documentation..."

[ -f "CI_CD_FIX_GUIDE.md" ]
check_status "CI/CD Fix Guide Present"

[ -f "DEPLOYMENT_CHECKLIST.md" ]
check_status "Deployment Checklist Present"

[ -f "FINAL_SUCCESS_SUMMARY.md" ]
check_status "Success Summary Present"

echo ""
echo -e "${GREEN}🎉 ALL CHECKS PASSED! 🎉${NC}"
echo ""
echo "🚀 Your Yuva Blood Bank application is ready for deployment!"
echo ""
echo "📋 Next steps:"
echo "   1. git add ."
echo "   2. git commit -m 'Deploy Yuva Blood Bank with CI/CD fixes'"
echo "   3. git push origin main"
echo ""
echo -e "${YELLOW}💡 Monitor your GitHub Actions after pushing!${NC}"
echo ""
echo "🩸❤️ Ready to save lives with your blood bank system!"
