<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    $job = Job::all();
    // dd($job[2]->salary);
    // return view('home');
});

// index
Route::get('/jobs', function () {
    $job = Job::with('employee')->latest()->simplePaginate(3);
    return view('jobs.index', [
        'jobs' => $job
    ]);
});

// Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    Job::create(
        [
            'title' => request('title'),
            'salary' => request('salary'),
            'employee_id' => 1
        ]
    );

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

//Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize hold on

    // update the job
    $job = Job::findOrFail($id);

    // and persist
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    // redirect to the job page
    return redirect('/jobs/' . $job->id);
});

//Delete
Route::delete('/jobs/{id}', function ($id) {
    // authorize (On hold ...)

    // delete the job
    Job::findOrFail($id)->delete();
    // redirect
    return redirect('/jobs');
});
Route::get('/contact', function () {
    return view('contact');
});
