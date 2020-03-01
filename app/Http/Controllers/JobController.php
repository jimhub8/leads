<?php

namespace App\Http\Controllers;

use App\models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::paginate(500);
        return $this->transform_job($jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $job = new Job;
        $job->user_id = Auth::id();
        $job->description = $request->description;
        // $job->staff_comments = $request->staff_comments;
        // $job->status = $request->status;
        // $job->completed_on = $request->completed_on;
        // $job->cancelled_on = $request->cancelled_on;


        $job->start_date = Carbon::parse($request->start_date);
        $job->end_date = Carbon::parse($request->end_date);
        $job->jobtype_id = 1;
        $job->client_id = $request->client;
        $job->staff_id = $request->staff;
        // $job->staff_id = $request->staff;
        $job->save();

        $job->jobtype()->attach($request->jobs_arr);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function transform_job($jobs)
    {
        $jobs->transform(function ($job) {
            // $job->job_type = 'test';
            // $job->job_type = $job->jobtype->jobtype;
            $job->client_name = $job->client->name;
            $job->staff_name = $job->staff->name;
            $job->user_name = $job->user->name;
            return $job;
        });
        return $jobs;
    }
}
