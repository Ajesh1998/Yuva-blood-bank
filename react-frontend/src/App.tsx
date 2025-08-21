import React, { useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, useNavigate } from 'react-router-dom';
import HomePage from './components/HomePage';
import DonorRegistration from './components/DonorRegistration';
import DonorsList from './components/DonorsList';
import LoginPage from './components/LoginPage';
import ForgotPasswordPage from './components/ForgotPasswordPage';
import AdminDashboard from './components/AdminDashboard';
import ProtectedRoute from './components/ProtectedRoute';
import './App.css';

// Component to handle root route redirect
const RootRedirect: React.FC = () => {
  const navigate = useNavigate();
  
  useEffect(() => {
    const isAuthenticated = localStorage.getItem('isAuthenticated') === 'true';
    console.log('RootRedirect: isAuthenticated =', isAuthenticated);
    console.log('RootRedirect: localStorage =', localStorage.getItem('isAuthenticated'));
    
    if (isAuthenticated) {
      console.log('Redirecting to /admin');
      navigate('/admin', { replace: true });
    } else {
      console.log('Redirecting to /login');
      navigate('/login', { replace: true });
    }
  }, [navigate]);
  
  return (
    <div style={{ 
      display: 'flex', 
      justifyContent: 'center', 
      alignItems: 'center', 
      height: '100vh',
      background: 'linear-gradient(135deg, #dc3545 0%, #8b0000 100%)',
      color: 'white',
      fontSize: '18px'
    }}>
      <div style={{ textAlign: 'center' }}>
        <div className="spinner-border text-light mb-3" role="status"></div>
        <p>Checking authentication...</p>
        <p>Redirecting...</p>
      </div>
    </div>
  );
};

function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/" element={<RootRedirect />} />
          <Route path="/home" element={<HomePage />} />
          <Route path="/register" element={<DonorRegistration />} />
          <Route path="/donors" element={<DonorsList />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/forgot-password" element={<ForgotPasswordPage />} />
          <Route 
            path="/admin" 
            element={
              <ProtectedRoute>
                <AdminDashboard />
              </ProtectedRoute>
            } 
          />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
