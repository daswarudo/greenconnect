<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Customer; 
use App\Models\Rdn;
use App\Models\SubscriptionType;
use App\Models\Subscriptions;
use App\Models\Payments;
use Illuminate\Support\Facades\Hash;
use App\Models\ConsultationSched;

class ConsultationController extends Controller
{
    public function create()
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId'); // Logged-in user's ID
        $userType = session()->get('userType'); // Logged-in user's type

        // Ensure only customers can create consultations
        if ($userType != 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can make consultations.');
        }

        // Fetch the customer using the loginId
        $customer = Customer::findOrFail($loginId);

        // Hardcode the RDN ID (assuming only one RDN with ID = 1)
        $rdnId = 1; // or replace with logic to fetch the only RDN

        // Pass the necessary data to the view
        return view('consultations.create', compact('loginId', 'userType', 'customer', 'rdnId'));
    }

    // Store the new consultation in the database
    public function store(Request $request)
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId');
        $userType = session()->get('userType');

        // Ensure only customers can create consultations
        if ($userType != 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can make consultations.');
        }

        // Validate the incoming data
        $request->validate([
            'date' => 'required|date', // Validate the date
            'time' => 'required|date_format:H:i', // Validate the time (HH:MM format)
        ]);

        // Create a new consultation record
        ConsultationSched::create([
            'customer_id' => $loginId, // The logged-in customer
            'rdn_id' => 1, // Hardcoded RDN ID for the single RDN
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Redirect back with a success message
        return redirect()->route('consultation.create')->with('success', 'Consultation added successfully!');
    }
    
    public function showConsultations()//no worky
    {
        // Fetch all consultations
        $consultations = ConsultationSched::with('customer', 'rdn')->get();

        // Return the view with the consultations
        return view('consultations.calendar', compact('consultations'));
    }

    
    
    // Example Controller
    // Example Controller method
    /*
    public function showCalendar()
    {
        // Fetch appointments from the consultation_sched table
        $appointments = DB::table('consultation_sched')
            ->select('consultation_sched_id', 'customer_id', 'date', 'time')
            ->get()
            ->map(function($appointment) {
                // Format date and time separately, then combine them into a full datetime for FullCalendar
                $appointment->formatted_date = Carbon::parse($appointment->date)->format('Y-m-d');
                $appointment->formatted_time = Carbon::parse($appointment->time)->format('H:i');
                
                // Combine date and time into a full datetime for FullCalendar (ISO 8601 format)
                $appointment->start = Carbon::parse($appointment->date . ' ' . $appointment->time)->toIso8601String();

                return $appointment;
            });

        // Return the data to a view (appointments.blade.php)
        return view('appointments', compact('appointments'));
    }*/
    public function showCalendar()
    {
        // Fetch appointments with the customer's first name by joining the consultation_sched and customer tables
        $appointments = DB::table('consultation_sched')
            ->join('customer', 'consultation_sched.customer_id', '=', 'customer.customer_id')  // Join with customer table
            ->select('consultation_sched.consultation_sched_id', 'consultation_sched.customer_id', 'consultation_sched.date', 'consultation_sched.time', 'customer.first_name')  // Select necessary fields
            ->get()
            ->map(function($appointment) {
                // Format the date and time separately, then combine them into a full datetime for FullCalendar
                $appointment->formatted_date = Carbon::parse($appointment->date)->format('Y-m-d');
                $appointment->formatted_time = Carbon::parse($appointment->time)->format('H:i');
                
                // Combine date and time into a full datetime for FullCalendar (ISO 8601 format)
                $appointment->start = Carbon::parse($appointment->date . ' ' . $appointment->time)->toIso8601String();

                return $appointment;
            });

        // Return the data to a view (appointments.blade.php)
        return view('appointments', compact('appointments'));
    }



}