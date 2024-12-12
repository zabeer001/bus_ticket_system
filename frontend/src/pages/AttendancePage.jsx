import { useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom'; // Import useParams to get employee_id from URL

const AttendancePage = () => {
  // State for the form fields
  const [attendanceTime, setAttendanceTime] = useState('');
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

    // Ensure the attendance time is in 24-hour format with seconds (HH:mm:ss)
    const formattedAttendanceTime = `${attendanceTime}:00`; // Append ':00' for seconds

    try {
      // Prepare the data
      const data = {
        attendance_time: formattedAttendanceTime,
        month_id: monthId,
      };

      // Send POST request to the API with employee_id in the URL
      const response = await axios.post(`http://127.0.0.1:8000/api/attendance/employee/${employee_id}`, data);

      // Handle success response
      if (response.status === 201) {
        setMessage('Attendance record saved successfully');
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
      <h2>Store Attendance Record</h2>
      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label htmlFor="attendanceTime" className="form-label">
            Attendance Time (24-hour format)
          </label>
          <input
            type="time"
            className="form-control"
            id="attendanceTime"
            value={attendanceTime}
            onChange={(e) => setAttendanceTime(e.target.value)}
            required
          />
        </div>
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
          Save Attendance
        </button>
      </form>

      {message && <div className="alert alert-success mt-3">{message}</div>}
      {error && <div className="alert alert-danger mt-3">{error}</div>}
    </div>
  );
};

export default AttendancePage;
