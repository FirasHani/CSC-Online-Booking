<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->name = $request->input('name');
        $client->email = $request->input('email');
    
        if ($request->filled('password')) {
            $client->password = Hash::make($request->input('password'));
        }
        $client->save();
        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }
}
