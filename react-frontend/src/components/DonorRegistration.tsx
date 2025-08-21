import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface DonorData {
  name: string;
  email: string;
  phone: string;
  blood_type: string;
  age: number;
  address: string;
  medical_conditions: string;
  last_donation: string;
}

const DonorRegistration: React.FC = () => {
  const [formData, setFormData] = useState<DonorData>({
    name: '',
    email: '',
    phone: '',
    blood_type: '',
    age: 18,
    address: '',
    medical_conditions: '',
    last_donation: ''
  });

  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState<{ type: 'success' | 'error'; text: string } | null>(null);

  const bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: name === 'age' ? parseInt(value) || 18 : value
    }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setMessage(null);

    try {
      const API_BASE_URL = process.env.REACT_APP_API_URL || 'http://localhost:8000/api';
      const response = await axios.post(`${API_BASE_URL}/bloodbank/donors`, formData);

      if (response.data.success) {
        setMessage({ type: 'success', text: 'Donor registered successfully!' });
        setFormData({
          name: '',
          email: '',
          phone: '',
          blood_type: '',
          age: 18,
          address: '',
          medical_conditions: '',
          last_donation: ''
        });
      }
    } catch (error: any) {
      console.error('Registration error:', error);
      const errorMessage = error.response?.data?.message || 'Failed to register donor. Please try again.';
      setMessage({ type: 'error', text: errorMessage });
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="hero-section">
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-lg-8">
            <div className="form-container">
              <div className="text-center mb-4">
                <Link to="/admin" className="text-decoration-none">
                  <img src="/yuva.jpg" alt="Yuva Blood Bank" className="logo-main" style={{width: '80px', height: '80px'}} />
                  <h2 className="form-title mt-2">Register as Blood Donor</h2>
                </Link>
              </div>

              {message && (
                <div className={`alert alert-${message.type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`} role="alert">
                  {message.text}
                  <button type="button" className="btn-close" onClick={() => setMessage(null)}></button>
                </div>
              )}

              <form onSubmit={handleSubmit}>
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <label htmlFor="name" className="form-label fw-semibold">Full Name *</label>
                    <input
                      type="text"
                      className="form-control"
                      id="name"
                      name="name"
                      value={formData.name}
                      onChange={handleChange}
                      required
                      placeholder="Enter your full name"
                    />
                  </div>
                  
                  <div className="col-md-6 mb-3">
                    <label htmlFor="email" className="form-label fw-semibold">Email Address *</label>
                    <input
                      type="email"
                      className="form-control"
                      id="email"
                      name="email"
                      value={formData.email}
                      onChange={handleChange}
                      required
                      placeholder="Enter your email"
                    />
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-6 mb-3">
                    <label htmlFor="phone" className="form-label fw-semibold">Phone Number *</label>
                    <input
                      type="tel"
                      className="form-control"
                      id="phone"
                      name="phone"
                      value={formData.phone}
                      onChange={handleChange}
                      required
                      placeholder="Enter your phone number"
                    />
                  </div>
                  
                  <div className="col-md-3 mb-3">
                    <label htmlFor="blood_type" className="form-label fw-semibold">Blood Type *</label>
                    <select
                      className="form-select"
                      id="blood_type"
                      name="blood_type"
                      value={formData.blood_type}
                      onChange={handleChange}
                      required
                    >
                      <option value="">Select Blood Type</option>
                      {bloodTypes.map(type => (
                        <option key={type} value={type}>{type}</option>
                      ))}
                    </select>
                  </div>
                  
                  <div className="col-md-3 mb-3">
                    <label htmlFor="age" className="form-label fw-semibold">Age *</label>
                    <input
                      type="number"
                      className="form-control"
                      id="age"
                      name="age"
                      value={formData.age}
                      onChange={handleChange}
                      min="18"
                      max="65"
                      required
                    />
                  </div>
                </div>

                <div className="mb-3">
                  <label htmlFor="address" className="form-label fw-semibold">Address *</label>
                  <textarea
                    className="form-control"
                    id="address"
                    name="address"
                    rows={3}
                    value={formData.address}
                    onChange={handleChange}
                    required
                    placeholder="Enter your complete address"
                  ></textarea>
                </div>

                <div className="mb-3">
                  <label htmlFor="medical_conditions" className="form-label fw-semibold">Medical Conditions (if any)</label>
                  <textarea
                    className="form-control"
                    id="medical_conditions"
                    name="medical_conditions"
                    rows={2}
                    value={formData.medical_conditions}
                    onChange={handleChange}
                    placeholder="List any medical conditions or medications"
                  ></textarea>
                </div>

                <div className="mb-4">
                  <label htmlFor="last_donation" className="form-label fw-semibold">Last Donation Date (if applicable)</label>
                  <input
                    type="date"
                    className="form-control"
                    id="last_donation"
                    name="last_donation"
                    value={formData.last_donation}
                    onChange={handleChange}
                  />
                </div>

                <div className="text-center">
                  <button
                    type="submit"
                    className="btn btn-submit me-3"
                    disabled={loading}
                  >
                    {loading ? (
                      <>
                        <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                        Registering...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-user-plus me-2"></i>
                        Register as Donor
                      </>
                    )}
                  </button>
                  <Link to="/admin" className="btn btn-outline-secondary">
                    <i className="fas fa-arrow-left me-2"></i>
                    Back to Dashboard
                  </Link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default DonorRegistration;
