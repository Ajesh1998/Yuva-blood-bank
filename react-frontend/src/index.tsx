import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';

console.log('🚀 index.tsx loaded');
console.log('📱 React version:', React.version);
console.log('🌐 DOM ready state:', document.readyState);

const rootElement = document.getElementById('root');
console.log('🎯 Root element found:', !!rootElement);

if (!rootElement) {
  console.error('❌ Root element not found!');
  document.body.innerHTML = `
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh; background: linear-gradient(135deg, #dc3545 0%, #8b0000 100%); color: white; font-family: Arial, sans-serif; text-align: center;">
      <div>
        <h1>🚨 React Mount Error</h1>
        <p>Could not find root element with id "root"</p>
        <p>Check the HTML structure</p>
      </div>
    </div>
  `;
} else {
  try {
    const root = ReactDOM.createRoot(rootElement);
    console.log('✅ React root created successfully');
    
    root.render(
      <React.StrictMode>
        <App />
      </React.StrictMode>
    );
    console.log('✅ React app rendered successfully');
  } catch (error) {
    console.error('❌ Error rendering React app:', error);
    document.body.innerHTML = `
      <div style="display: flex; align-items: center; justify-content: center; height: 100vh; background: linear-gradient(135deg, #dc3545 0%, #8b0000 100%); color: white; font-family: Arial, sans-serif; text-align: center;">
        <div>
          <h1>🚨 React Render Error</h1>
          <p>Error rendering the React application</p>
          <pre style="text-align: left; background: rgba(0,0,0,0.3); padding: 15px; border-radius: 5px; font-size: 12px;">${error}</pre>
        </div>
      </div>
    `;
  }
}
