import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface Donor {
  id: string;
  name: string;
  email: string;
  phone: string;
  blood_type: string;
  age: number;
  address: string;
  medical_conditions?: string;
  last_donation?: string;
  registration_date: string;
  status: string;
}

const DonorsList: React.FC = () => {
  const [donors, setDonors] = useState<Donor[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchBloodType, setSearchBloodType] = useState('');
  const [filteredDonors, setFilteredDonors] = useState<Donor[]>([]);

  const bloodTypes = ['All', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

  useEffect(() => {
    fetchDonors();
  }, []);

  useEffect(() => {
    if (searchBloodType === '' || searchBloodType === 'All') {
      setFilteredDonors(donors);
    } else {
      setFilteredDonors(donors.filter(donor => donor.blood_type === searchBloodType));
    }
  }, [donors, searchBloodType]);

  const fetchDonors = async () => {
    try {
      const API_BASE_URL = process.env.REACT_APP_API_URL || 'http://localhost:8000/api';
      const response = await axios.get(`${API_BASE_URL}/bloodbank/donors`);
      
      if (response.data.donors) {
        setDonors(response.data.donors);
      }
    } catch (error) {
      console.error('Error fetching donors:', error);
    } finally {
      setLoading(false);
    }
  };

  const getBloodTypeColor = (bloodType: string) => {
    const colors: { [key: string]: string } = {
      'A+': 'bg-danger',
      'A-': 'bg-danger-subtle text-danger',
      'B+': 'bg-primary',
      'B-': 'bg-primary-subtle text-primary',
      'AB+': 'bg-success',
      'AB-': 'bg-success-subtle text-success',
      'O+': 'bg-warning text-dark',
      'O-': 'bg-warning-subtle text-warning'
    };
    return colors[bloodType] || 'bg-secondary';
  };

  if (loading) {
    return (
      <div className="hero-section d-flex align-items-center justify-content-center">
        <div className="text-center text-white">
          <div className="spinner-border" role="status" style={{ width: '3rem', height: '3rem' }}>
            <span className="visually-hidden">Loading...</span>
          </div>
          <p className="mt-3">Loading donors...</p>
        </div>
      </div>
    );
  }

  return (
    <div className="hero-section">
      <div className="container py-5">
        <div className="row">
          <div className="col-12">
            <div className="form-container">
              <div className="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <Link to="/admin" className="text-decoration-none">
                    <img src="/yuva.jpg" alt="Yuva Blood Bank" style={{width: '50px', height: '50px', borderRadius: '50%'}} />
                  </Link>
                  <h2 className="form-title d-inline-block ms-3 mb-0">Registered Donors</h2>
                </div>
                <div className="d-flex gap-2">
                  <Link to="/register" className="btn btn-submit">
                    <i className="fas fa-user-plus me-2"></i>
                    Register Donor
                  </Link>
                  <Link to="/admin" className="btn btn-outline-secondary">
                    <i className="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                  </Link>
                </div>
              </div>

              {/* Search Filter */}
              <div className="row mb-4">
                <div className="col-md-6">
                  <label htmlFor="bloodTypeFilter" className="form-label fw-semibold">Filter by Blood Type:</label>
                  <select
                    className="form-select"
                    id="bloodTypeFilter"
                    value={searchBloodType}
                    onChange={(e) => setSearchBloodType(e.target.value)}
                  >
                    {bloodTypes.map(type => (
                      <option key={type} value={type === 'All' ? '' : type}>{type}</option>
                    ))}
                  </select>
                </div>
                <div className="col-md-6 d-flex align-items-end">
                  <div className="text-muted">
                    <i className="fas fa-users me-2"></i>
                    Showing {filteredDonors.length} of {donors.length} donors
                  </div>
                </div>
              </div>

              {filteredDonors.length === 0 ? (
                <div className="text-center py-5">
                  <i className="fas fa-users fa-3x text-muted mb-3"></i>
                  <h4 className="text-muted">No donors found</h4>
                  <p className="text-muted">
                    {donors.length === 0 ? 'No donors registered yet.' : 'No donors found for the selected blood type.'}
                  </p>
                  <Link to="/register" className="btn btn-submit">
                    <i className="fas fa-user-plus me-2"></i>
                    Register First Donor
                  </Link>
                </div>
              ) : (
                <div className="table-responsive">
                  <table className="table table-hover">
                    <thead className="table-dark">
                      <tr>
                        <th>Name</th>
                        <th>Blood Type</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      {filteredDonors.map((donor) => (
                        <tr key={donor.id}>
                          <td>
                            <div className="d-flex align-items-center">
                              <div className="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                   style={{width: '35px', height: '35px', fontSize: '14px'}}>
                                {donor.name.charAt(0).toUpperCase()}
                              </div>
                              <div>
                                <div className="fw-semibold">{donor.name}</div>
                                <small className="text-muted">{donor.address.substring(0, 30)}...</small>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span className={`badge ${getBloodTypeColor(donor.blood_type)} px-3 py-2`}>
                              {donor.blood_type}
                            </span>
                          </td>
                          <td>{donor.age} years</td>
                          <td>
                            <a href={`tel:${donor.phone}`} className="text-decoration-none">
                              <i className="fas fa-phone me-1"></i>
                              {donor.phone}
                            </a>
                          </td>
                          <td>
                            <a href={`mailto:${donor.email}`} className="text-decoration-none">
                              <i className="fas fa-envelope me-1"></i>
                              {donor.email}
                            </a>
                          </td>
                          <td>{new Date(donor.registration_date).toLocaleDateString()}</td>
                          <td>
                            <span className={`badge ${donor.status === 'active' ? 'bg-success' : 'bg-warning text-dark'}`}>
                              {donor.status}
                            </span>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default DonorsList;
