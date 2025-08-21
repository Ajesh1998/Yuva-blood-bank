import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface Stats {
  livesSaved: number;
  activeDonors: number;
  bloodTypes: number;
  availability: string;
}

interface AppInfo {
  app_name: string;
  version: string;
  description: string;
  tagline: string;
}

const HomePage: React.FC = () => {
  const [stats, setStats] = useState<Stats>({
    livesSaved: 500,
    activeDonors: 250,
    bloodTypes: 8,
    availability: '24/7'
  });
  
  const [appInfo, setAppInfo] = useState<AppInfo>({
    app_name: 'Yuva Blood Bank',
    version: '1.0.0',
    description: 'Professional Blood Donor Management System',
    tagline: 'Saving Lives Together'
  });

  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        // Replace with your actual Laravel API URL
        const API_BASE_URL = process.env.REACT_APP_API_URL || 'http://localhost:8000/api';
        
        const [statsResponse, appInfoResponse] = await Promise.all([
          axios.get(`${API_BASE_URL}/bloodbank/stats`),
          axios.get(`${API_BASE_URL}/bloodbank/app-info`)
        ]);

        if (statsResponse.data.stats) {
          setStats(statsResponse.data.stats);
        }
        
        if (appInfoResponse.data) {
          setAppInfo(appInfoResponse.data);
        }
      } catch (error) {
        console.error('Error fetching data:', error);
        // Keep default values if API is not available
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  return (
    <section className="hero-section">
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-lg-8 col-md-10">
            <div className="hero-content text-center">
              {/* Logo and Branding */}
              <div className="logo-container">
                <img src="/yuva.jpg" alt="Yuva Blood Bank" className="logo-main" />
                <h1 className="brand-name">YUVA</h1>
                <h2 className="brand-subtitle">Blood Bank</h2>
              </div>

              {/* Hero Content */}
              <p className="hero-tagline">
                <i className="fas fa-hands-helping me-2"></i>
                {appInfo.tagline}
              </p>

              <p className="hero-description">
                Welcome to {appInfo.app_name} - {appInfo.description}. 
                Our professional platform connects generous donors with those in urgent need, 
                making the life-saving process of blood donation simple, efficient, and impactful.
              </p>

              {/* Action Buttons */}
              <div className="action-buttons">
                <Link to="/register" className="btn-hero btn-primary-hero">
                  <i className="fas fa-user-plus me-2"></i>
                  Register as Donor
                </Link>
                <Link to="/donors" className="btn-hero btn-outline-hero">
                  <i className="fas fa-list me-2"></i>
                  View Donors
                </Link>
                <Link to="/login" className="btn-hero btn-outline-hero">
                  <i className="fas fa-sign-in-alt me-2"></i>
                  Staff Login
                </Link>
              </div>
            </div>
          </div>
        </div>

        {/* Statistics Section */}
        <div className="stats-section">
          <div className="stats-grid">
            <div className="stat-card">
              <div className="stat-number">{loading ? '...' : stats.livesSaved + '+'}</div>
              <div className="stat-label">Lives Saved</div>
            </div>
            <div className="stat-card">
              <div className="stat-number">{loading ? '...' : stats.activeDonors + '+'}</div>
              <div className="stat-label">Active Donors</div>
            </div>
            <div className="stat-card">
              <div className="stat-number">{stats.bloodTypes}</div>
              <div className="stat-label">Blood Types</div>
            </div>
            <div className="stat-card">
              <div className="stat-number">{stats.availability}</div>
              <div className="stat-label">Availability</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default HomePage;
