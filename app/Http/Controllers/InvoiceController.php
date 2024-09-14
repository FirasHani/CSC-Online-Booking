<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Service;
class InvoiceController extends Controller
{
    public function create($client_id)
    {
        $client = Client::findOrFail($client_id);
        return view('invoices.create', compact('client'));
    }
    public function store(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        $service = Service::findOrFail($request->service_id);
        $totalPrice = $service->price; 
       
        Invoice::create([
            'client_id' => $request->client_id,
            'total_price' => $totalPrice,
        ]);
        return Redirect::route('invoices.index')->with('success', 'Invoice created successfully.');
    }
    public function index()
    {
        $clients = Client::all();
        $invoices = Invoice::with('client')->get();
        return view('invoices.index', compact('invoices','clients'));
    }
}