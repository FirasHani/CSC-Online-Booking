<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Store;
use App\Models\Employee;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('store', 'employees', 'client')->get();
        return view('jobs.index', compact('jobs'));
    }
    public function create()
    {
        $clients = Client::all(); 
        $stores = Store::all(); 
        $employees = Employee::all();
        $services = Service::all();
        return view('jobs.create', compact('clients', 'stores', 'employees','services'));

    }
    public function store(Request $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('job_files');
        }
    
        $job = Job::create([
            'name' => $request->name,
            'description' => $request->description,
            'file_path' => $filePath,
            'client_id' => $request->client_id,
            'store_id' => $request->store_id, 
            'appointment_date' => $request->appointment_date, 
            'appointment_time' => $request->appointment_time,
        ]);
    
        // Attach selected employees to the job
        if ($request->has('employee_ids')) {
            $job->employees()->sync($request->employee_ids);
        }
    
        return Redirect::route('jobs.index')->with('success', 'Job created successfully.');
    }
    
    
    

    public function edit(Job $job)
    {
        $clients = Client::all();
        return view('jobs.edit', compact('job', 'clients'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($request->hasFile('file')) {
            if ($job->file_path) {
                Storage::delete($job->file_path);
            }
            $job->file_path = $request->file('file')->store('job_files');
        }

        $job->update([
            'name' => $request->name,
            'description' => $request->description,
            'file_path' => $job->file_path,
            'client_id' => $request->client_id,
        ]);

        return Redirect::route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        if ($job->file_path) {
            Storage::delete($job->file_path);
        }
        $job->delete();
        return Redirect::route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
