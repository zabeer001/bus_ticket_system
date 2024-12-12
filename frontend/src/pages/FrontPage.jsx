
import { Link } from 'react-router-dom';

const FrontPage = () => {
    return (
        <div className="container text-center mt-5">
            <h1>Welcome to the Management System</h1>
            <p className="mt-3">
                Navigate to different sections of the system using the buttons below.
            </p>
            <div className="mt-4">
                <Link to="/attendance/employee/1" className="btn btn-primary me-3">
                    Go to Attendance Page
                </Link>
                <Link to="/payrolls/1" className="btn btn-secondary">
                    Go to Payroll Page
                </Link>
            </div>
        </div>
    );
};

export default FrontPage;
