<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;

class ReportingController extends Controller
{
    public function dashboard()
    {
        // Fetch necessary data for the dashboard
        $patientCount = Patient::count();
        $appointmentCount = Appointment::count();
        $doctorCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'Doctor');
        })->count();
        $userCount = User::count();

        // Retrieve data for the Patients chart (example data)
        $patientsData = Patient::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Retrieve data for the Appointment Status chart (example data)
        $appointmentStatusData = Appointment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Retrieve patient and appointment records
        $patients = Patient::limit(10)->get();
        $appointments = Appointment::limit(10)->get();

        // Retrieve data for the Patient Gender chart (example data)
        $patientGenderData = Patient::selectRaw('gender, COUNT(*) as count')
            ->groupBy('gender')
            ->get();

        // Retrieve data for the Appointments by Month chart
        $appointmentsByMonthData = Appointment::selectRaw('YEAR(date_time) as year, MONTH(date_time) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Pass data to the reporting dashboard view
        return view('app.reporting.dashboard', [
            'patientCount' => $patientCount,
            'appointmentCount' => $appointmentCount,
            'doctorCount' => $doctorCount,
            'userCount' => $userCount,
            'patientsData' => $patientsData,
            'appointmentStatusData' => $appointmentStatusData,
            'patients' => $patients,
            'appointments' => $appointments,
            'patientGenderData' => $patientGenderData,
            'appointmentsByMonthData' => $appointmentsByMonthData,
        ]);
    }
}
