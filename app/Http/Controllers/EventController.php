<?php


namespace App\Http\Controllers;

use App\Models\Customer; 
use App\Models\Rdn;
use App\Models\SubscriptionType;
use App\Models\Subscriptions;
use App\Models\Payments;
use App\Models\ConsultationSched;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    public function show($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->update($request->all());
        return response()->json($event);
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return response()->json(null, 204);
    }
    public function getEvents()
    {
        $events = DB::table('consultation_sched')
            ->join('customer', 'consultation_sched.customer_id', '=', 'customer.customer_id')
            ->select(
                'consultation_sched.date as start',
                'consultation_sched.time as time',
                'customer.first_name as customer_name'
            )
            ->get();

        // Return the events in JSON format
        return response()->json($events);
    }

    // Method to create a new event
    public function createEvent(Request $request)
    {
        // Insert new event into the 'consultation_sched' table
        $eventId = DB::table('consultation_sched')->insertGetId([
            'date' => $request->input('start'),
            'time' => $request->input('time'),
            'customer_id' => $request->input('customer_id'), // Ensure this is provided in the request
            'rdn_id' => $request->input('rdn_id', 1), // Default to 1 if not specified
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Retrieve the created event to send it back
        $event = DB::table('consultation_sched')
            ->where('consultation_sched_id', $eventId)
            ->first();

        return response()->json($event);
    }
}
