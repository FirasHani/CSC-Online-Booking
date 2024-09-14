<?php
// app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\EmailContent;
class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('client')->get();
        $clients = Client::all();
        return view('appointments.index', compact('appointments', 'clients'));
    }
    public function create()
    {
        $clients = Client::all();
        $services= Service::all();
        
        return view('appointments.create', compact('clients','services'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);
        Appointment::create($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }
    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        return view('appointments.edit', compact('appointment', 'clients'));
    }
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }

    public function showAppointment(Request $request)
    {
        $client=Client::find($request->client_id);
       
        $clientName = $client->name;
        $brandingStoreName = 'TestBrand';
        $appointmentStartDate = $client->appointment_date;
        $appointmentStartTime = $client->appointment_time;
        
        return view('emails.appointment', [
            'client'=>$client,
            'clientName' => $clientName,
            'brandingStoreName' => $brandingStoreName,
            'appointmentStartDate' => $appointmentStartDate,
            'appointmentStartTime' => $appointmentStartTime,
        ]);
    }
    public function saveContent(Request $request)
    {
        $client=Client::find($request->client_id);
    
        $content = $request->input('content');

            EmailContent::create([
            'content' => $content,
             'client_id'=>1   
        ]);
        return response()->json(['success' => true]);
    }
    public function showContent($id)
    {
    $emailContent = EmailContent::find($id);
    if (!$emailContent) {
        return response()->json(['error' => 'Email content not found'], 404);
    }
    return response()->json(['success' => true, 'content' => $emailContent->content]);
    }
    public function indexEmail()
    {
        $emails = EmailContent::all();
      
        return view('emails.index', compact('emails'));
    }
}