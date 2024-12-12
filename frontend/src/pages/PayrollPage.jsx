import { useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom'; // Import useParams to get employee_id from URL

const PayrollPage = () => {
  // State for the form fields
  const [monthId, setMonthId] = useState('');
  const [message, setMessage] = useState('');
  const [error, setError] = useState('');

  // Use useParams to get employee_id from the URL
  const { employee_id } = useParams();

  // Handle form submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    
    // Clear previous messages
    setMessage('');
    setError('');

    try {
      // Prepare the data
      const data = {
        month_id: monthId,
      };

      // Send POST request to the API with employee_id in the URL
      const response = await axios.post(`http://127.0.0.1:8000/api/payroll/employee/${employee_id}`, data);

      // Handle success response
      if (response.status === 201) {
        setMessage('Payroll record updated successfully');
      }
    } catch (err) {
      // Handle error response
      if (err.response) {
        setError(err.response.data.error || 'An error occurred');
      } else {
        setError('Failed to connect to the server');
      }
    }
  };

  return (
    <div className="container">
      <h2>Store Payroll Record</h2>
      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label htmlFor="monthId" className="form-label">
            Month ID
          </label>
          <input
            type="number"
            className="form-control"
            id="monthId"
            value={monthId}
            onChange={(e) => setMonthId(e.target.value)}
            required
          />
        </div>
        <button type="submit" className="btn btn-primary">
          Save Payroll
        </button>
      </form>

      {message && <div className="alert alert-success mt-3">{message}</div>}
      {error && <div className="alert alert-danger mt-3">{error}</div>}
    </div>
  );
};

export default PayrollPage;
