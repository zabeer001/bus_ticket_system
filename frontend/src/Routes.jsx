
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import AttendancePage from './pages/AttendancePage';
import PayrollPage from './pages/PayrollPage';
import FrontPage from './pages/FrontPage';

const AppRoutes = () => {
    return (
        <Router>
            <Routes>
                {/* Front Page */}
                <Route path="/" element={<FrontPage />} />

                {/* Attendance Route */}
                <Route
                    path="/attendance/employee/:employee_id"
                    element={<AttendancePage />}
                />

                {/* Payroll Route */}
                <Route
                    path="/payrolls/:employee_id"
                    element={<PayrollPage />}
                />
            </Routes>
        </Router>
    );
};

export default AppRoutes;
