import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';

interface LoginCredentials {
  username: string;
  password: string;
}

const LoginPage: React.FC = () => {
  const [credentials, setCredentials] = useState<LoginCredentials>({
    username: '',
    password: ''
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [showPassword, setShowPassword] = useState(false);
  
  const navigate = useNavigate();

  // Static credentials for demo purposes
  const STATIC_CREDENTIALS = {
    admin: 'admin123',
    staff: 'staff123',
    manager: 'manager123'
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setCredentials(prev => ({
      ...prev,
      [name]: value
    }));
    // Clear error when user starts typing
    if (error) setError(null);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError(null);

    // Simulate API call delay
    await new Promise(resolve => setTimeout(resolve, 1000));

    // Static authentication logic
    const { username, password } = credentials;
    
    if (!username || !password) {
      setError('Please enter both username and password');
      setLoading(false);
      return;
    }

    // Check against static credentials
    if (STATIC_CREDENTIALS[username as keyof typeof STATIC_CREDENTIALS] === password) {
      // Store authentication state in localStorage for demo
      localStorage.setItem('isAuthenticated', 'true');
      localStorage.setItem('username', username);
      localStorage.setItem('role', username); // Using username as role for simplicity
      
      // Add a small delay to ensure localStorage is set, then redirect
      console.log('Login successful, redirecting to /admin');
      setTimeout(() => {
        navigate('/admin', { replace: true });
      }, 100);
    } else {
      setError('Invalid username or password');
    }
    
    setLoading(false);
  };

  return (
    <div className="hero-section">
      <div className="container">
        <div className="row justify-content-center align-items-center min-vh-100">
          <div className="col-lg-5 col-md-7 col-sm-9">
            <div className="form-container">
              {/* Logo and Header */}
              <div className="text-center mb-4">
                <Link to="/home" className="text-decoration-none">
                  <img 
                    src="/yuva.jpg" 
                    alt="Yuva Blood Bank" 
                    className="logo-main mb-3" 
                    style={{width: '80px', height: '80px'}} 
                  />
                </Link>
                <h2 className="form-title mb-1">Yuva Blood Bank</h2>
                <p className="text-muted">Staff Login Portal</p>
              </div>

              {/* Error Message */}
              {error && (
                <div className="alert alert-danger alert-dismissible fade show" role="alert">
                  <i className="fas fa-exclamation-triangle me-2"></i>
                  {error}
                  <button 
                    type="button" 
                    className="btn-close" 
                    onClick={() => setError(null)}
                  ></button>
                </div>
              )}

              {/* Demo Credentials Info */}
              <div className="alert alert-info" role="alert">
                <h6 className="alert-heading">
                  <i className="fas fa-info-circle me-2"></i>
                  Demo Credentials
                </h6>
                <hr />
                <small>
                  <strong>Admin:</strong> admin / admin123<br />
                  <strong>Staff:</strong> staff / staff123<br />
                  <strong>Manager:</strong> manager / manager123
                </small>
              </div>

              {/* Login Form */}
              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="username" className="form-label fw-semibold">
                    <i className="fas fa-user me-2"></i>
                    Username
                  </label>
                  <input
                    type="text"
                    className="form-control form-control-lg"
                    id="username"
                    name="username"
                    value={credentials.username}
                    onChange={handleChange}
                    placeholder="Enter your username"
                    disabled={loading}
                    autoComplete="username"
                  />
                </div>

                <div className="mb-4">
                  <label htmlFor="password" className="form-label fw-semibold">
                    <i className="fas fa-lock me-2"></i>
                    Password
                  </label>
                  <div className="input-group">
                    <input
                      type={showPassword ? 'text' : 'password'}
                      className="form-control form-control-lg"
                      id="password"
                      name="password"
                      value={credentials.password}
                      onChange={handleChange}
                      placeholder="Enter your password"
                      disabled={loading}
                      autoComplete="current-password"
                    />
                    <button
                      type="button"
                      className="btn btn-outline-secondary"
                      onClick={() => setShowPassword(!showPassword)}
                      disabled={loading}
                    >
                      <i className={`fas ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                    </button>
                  </div>
                </div>

                <div className="d-grid mb-3">
                  <button
                    type="submit"
                    className="btn btn-submit btn-lg"
                    disabled={loading}
                  >
                    {loading ? (
                      <>
                        <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                        Signing In...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-sign-in-alt me-2"></i>
                        Sign In
                      </>
                    )}
                  </button>
                </div>

                {/* Additional Options */}
                <div className="text-center">
                  <Link to="/forgot-password" className="text-decoration-none text-muted small">
                    <i className="fas fa-question-circle me-1"></i>
                    Forgot Password?
                  </Link>
                </div>
              </form>

              {/* Footer Links */}
              <hr className="my-4" />
              <div className="text-center">
                <Link to="/home" className="btn btn-outline-secondary me-2">
                  <i className="fas fa-home me-2"></i>
                  Back to Home
                </Link>
                <Link to="/donors" className="btn btn-outline-primary">
                  <i className="fas fa-users me-2"></i>
                  View Donors
                </Link>
              </div>

              {/* Security Note */}
              <div className="mt-4 text-center">
                <small className="text-muted">
                  <i className="fas fa-shield-alt me-1"></i>
                  This is a static demo login for GitHub Pages deployment
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LoginPage;
