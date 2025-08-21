# Yuva Blood Bank - React Frontend

This is the React frontend for the Yuva Blood Bank application, designed to work with GitHub Pages and consume the Laravel backend API.

## 🚀 Features

- **Modern React with TypeScript**: Type-safe development
- **Responsive Design**: Mobile-first Bootstrap 5 styling
- **Component-Based Architecture**: Reusable and maintainable components
- **API Integration**: Connects to Laravel backend via REST APIs
- **PWA Ready**: Manifest and service worker support
- **GitHub Pages Compatible**: Static deployment ready

## 📦 Components

### 1. HomePage
- Hero section with branding
- Dynamic statistics from API
- Action buttons for navigation
- Responsive design

### 2. DonorRegistration
- Complete donor registration form
- Form validation
- API integration for donor creation
- Success/error feedback

### 3. DonorsList
- Display all registered donors
- Blood type filtering
- Search functionality
- Responsive table design

## 🛠️ Development Setup

### Prerequisites
- Node.js 16+ and npm
- Running Laravel backend API

### Installation

1. **Install dependencies:**
   ```bash
   cd react-frontend
   npm install
   ```

2. **Configure environment:**
   ```bash
   # Update .env file with your Laravel API URL
   REACT_APP_API_URL=http://localhost:8000/api
   ```

3. **Start development server:**
   ```bash
   npm start
   ```

4. **Open your browser:**
   Navigate to `http://localhost:3000`

## 🌐 Deployment to GitHub Pages

### Method 1: Using gh-pages (Recommended)

1. **Install gh-pages:**
   ```bash
   npm install --save-dev gh-pages
   ```

2. **Update package.json homepage:**
   ```json
   {
     "homepage": "https://yourusername.github.io/your-repo-name"
   }
   ```

3. **Update production API URL:**
   Update `.env.production` with your deployed Laravel API URL:
   ```bash
   REACT_APP_API_URL=https://your-laravel-backend.herokuapp.com/api
   ```

4. **Deploy:**
   ```bash
   npm run build
   npm run deploy
   ```

### Method 2: Manual GitHub Pages Setup

1. **Build the project:**
   ```bash
   npm run build
   ```

2. **Create a new repository or use existing one**

3. **Push the build folder contents to gh-pages branch:**
   ```bash
   cd build
   git init
   git add -A
   git commit -m "Deploy React app to GitHub Pages"
   git branch -M gh-pages
   git remote add origin https://github.com/yourusername/your-repo-name.git
   git push -u origin gh-pages
   ```

4. **Enable GitHub Pages:**
   - Go to repository Settings
   - Navigate to Pages section
   - Select "gh-pages" branch as source
   - Save settings

## 🔧 Environment Variables

### Development (.env)
```bash
REACT_APP_API_URL=http://localhost:8000/api
REACT_APP_NAME=Yuva Blood Bank
REACT_APP_VERSION=1.0.0
```

### Production (.env.production)
```bash
REACT_APP_API_URL=https://your-laravel-backend.herokuapp.com/api
REACT_APP_NAME=Yuva Blood Bank
REACT_APP_VERSION=1.0.0
```

## 🔌 API Integration

The React app consumes the following Laravel API endpoints:

### Public Endpoints
- `GET /api/bloodbank/app-info` - Get application information
- `GET /api/bloodbank/stats` - Get statistics (donors, lives saved, etc.)
- `GET /api/bloodbank/donors` - Get all donors
- `POST /api/bloodbank/donors` - Register new donor
- `GET /api/bloodbank/donors/{id}` - Get specific donor
- `GET /api/bloodbank/donors/blood-type/{type}` - Search by blood type

### CORS Configuration
Ensure your Laravel backend has CORS configured to allow requests from your React app domain.

## 🎨 Styling

- **Framework**: Bootstrap 5
- **Icons**: Font Awesome 6
- **Fonts**: Google Fonts (Poppins)
- **Custom CSS**: Component-specific styles in App.css

## 📱 Responsive Design

The application is fully responsive with:
- Mobile-first approach
- Breakpoints for tablets and desktops
- Touch-friendly interfaces
- Optimized for various screen sizes

## 🔄 State Management

Currently using React hooks for state management:
- `useState` for component state
- `useEffect` for side effects
- `axios` for API calls

For larger applications, consider adding:
- Redux Toolkit
- React Query
- Context API

## 🚀 Performance Optimization

- Code splitting with React.lazy()
- Image optimization
- Bundle size optimization
- Service worker for caching

## 📋 Available Scripts

```bash
# Start development server
npm start

# Build for production
npm run build

# Run tests
npm test

# Deploy to GitHub Pages
npm run deploy

# Eject (not recommended)
npm run eject
```

## 🔗 Backend Requirements

Your Laravel backend should:

1. **Enable CORS** for your React app domain
2. **Provide API endpoints** as listed above
3. **Handle validation** and return appropriate JSON responses
4. **Support HTTPS** for production deployment

## 🌟 Deployment Checklist

### Before Deployment:

- [ ] Update `.env.production` with production API URL
- [ ] Test all API endpoints
- [ ] Verify CORS configuration
- [ ] Optimize images and assets
- [ ] Test responsive design
- [ ] Update package.json homepage URL

### After Deployment:

- [ ] Verify GitHub Pages is serving the app
- [ ] Test all functionality on live site
- [ ] Check browser console for errors
- [ ] Verify API calls are working
- [ ] Test on multiple devices/browsers

## 🛡️ Security Considerations

- Environment variables for sensitive data
- Input validation on forms
- Sanitized API responses
- HTTPS for production
- Content Security Policy headers

## 📞 Support

For issues related to:
- **React Frontend**: Check browser console and network tab
- **API Connectivity**: Verify Laravel backend is running
- **Deployment**: Check GitHub Pages settings and build logs

## 🔄 Future Enhancements

- [ ] Authentication integration
- [ ] Real-time notifications
- [ ] Advanced search and filtering
- [ ] Data visualization charts
- [ ] Offline support with service workers
- [ ] Push notifications
- [ ] Multi-language support

---

**Note**: This React frontend is designed to work independently of the Laravel views, making it perfect for deployment on GitHub Pages while your Laravel backend can be hosted anywhere (Heroku, DigitalOcean, AWS, etc.).
