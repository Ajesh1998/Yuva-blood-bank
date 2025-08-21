import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const ForgotPasswordPage: React.FC = () => {
  const [email, setEmail] = useState('');
  const [submitted, setSubmitted] = useState(false);
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1500));
    
    setSubmitted(true);
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
                <h2 className="form-title mb-1">Reset Password</h2>
                <p className="text-muted">Enter your email to receive reset instructions</p>
              </div>

              {!submitted ? (
                <form onSubmit={handleSubmit}>
                  <div className="mb-4">
                    <label htmlFor="email" className="form-label fw-semibold">
                      <i className="fas fa-envelope me-2"></i>
                      Email Address
                    </label>
                    <input
                      type="email"
                      className="form-control form-control-lg"
                      id="email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      placeholder="Enter your email address"
                      required
                      disabled={loading}
                    />
                  </div>

                  <div className="d-grid mb-3">
                    <button
                      type="submit"
                      className="btn btn-submit btn-lg"
                      disabled={loading || !email}
                    >
                      {loading ? (
                        <>
                          <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                          Sending Instructions...
                        </>
                      ) : (
                        <>
                          <i className="fas fa-paper-plane me-2"></i>
                          Send Reset Instructions
                        </>
                      )}
                    </button>
                  </div>
                </form>
              ) : (
                <div className="text-center">
                  <div className="alert alert-success" role="alert">
                    <i className="fas fa-check-circle fa-2x mb-3 d-block"></i>
                    <h5 className="alert-heading">Instructions Sent!</h5>
                    <p className="mb-0">
                      If an account with email <strong>{email}</strong> exists, 
                      you will receive password reset instructions shortly.
                    </p>
                  </div>
                </div>
              )}

              {/* Footer Links */}
              <hr className="my-4" />
              <div className="text-center">
                <Link to="/login" className="btn btn-outline-primary me-2">
                  <i className="fas fa-arrow-left me-2"></i>
                  Back to Login
                </Link>
                <Link to="/home" className="btn btn-outline-secondary">
                  <i className="fas fa-home me-2"></i>
                  Home
                </Link>
              </div>

              {/* Demo Note */}
              <div className="mt-4 text-center">
                <small className="text-muted">
                  <i className="fas fa-info-circle me-1"></i>
                  This is a demo page. No actual emails will be sent.
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ForgotPasswordPage;
