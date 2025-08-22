#!/bin/bash

# Clean deployment script for GitHub Pages
echo "Starting clean deployment to GitHub Pages..."

# Ensure we're on master branch
git checkout master

# Build the React app
echo "Building React application..."
cd react-frontend
npm run build
cd ..

# Create a temporary directory for clean deployment
rm -rf temp-gh-pages
mkdir temp-gh-pages

# Copy only the React build files to temporary directory
cp -r react-frontend/build/* temp-gh-pages/

# Add .nojekyll file to disable Jekyll processing
touch temp-gh-pages/.nojekyll

# Copy 404.html for SPA routing
cp react-frontend/build/index.html temp-gh-pages/404.html

# Initialize git in temp directory and create gh-pages branch
cd temp-gh-pages
git init
git checkout -b gh-pages
git add .
git commit -m "Deploy React app to GitHub Pages"

# Add remote and force push
git remote add origin https://github.com/Ajesh1998/Yuva-blood-bank.git
git push -f origin gh-pages

# Clean up
cd ..
rm -rf temp-gh-pages

echo "Deployment completed! Check https://ajesh1998.github.io/Yuva-blood-bank/ in 5-10 minutes."
