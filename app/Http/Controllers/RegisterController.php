<?php

// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\Store;
class RegisterController extends Controller
{
  
    public function showRegistrationForm()
    {
        $services = Service::all();
        $stores=Store::all();
        return view('register', compact('services','stores'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'location' => 'required|string|max:255',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'services' => 'array',
            'services.*' => 'exists:services,id',
        ]);
    
   
        $client = Client::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'location' => $request->input('location'),
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
        ]);
         $clientId = $client->id;
         
        $invoice=Invoice::create(
            [
                'total_price'=>$request->input('total_price'),
                'client_id' => $clientId,

            ]
            );
        if ($request->has('services')) {
            $client->services()->sync($request->input('services'));
        }
    
        return redirect()->route('register')->with('success', 'Registration successful!');
    }
    
}
