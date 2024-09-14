<?php

// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Store;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        $store= Store::all();
        return view('services.index', compact('services','store'));
    }

    public function create()
    {
        $services = Service::all();
        $stores= Store::all();
        return view('services.create', compact('services','stores'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'store_id' => 'required|exists:stores,id', // Validate that store_id exists in the stores table
        ]);
    
        // Create a new service
        Service::create([
            'service_name' => $request->input('service_name'),
            'price' => $request->input('price'),
            'store_id' => $request->input('store_id'), // Add store_id to the create method
        ]);
    
        // Redirect with success message
        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }
    

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $service->update([
            'service_name' => $request->input('service_name'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
