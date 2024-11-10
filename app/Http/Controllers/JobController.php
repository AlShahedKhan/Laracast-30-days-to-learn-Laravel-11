<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $job = Job::with('employee')->latest()->simplePaginate(3);
        return view('jobs.index', [
            'jobs' => $job
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
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
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        // authorize hold on


        // and persist
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        // redirect to the job page
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize (On hold ...)

        // delete the job
        $job->delete();
        // redirect
        return redirect('/jobs');
    }
}