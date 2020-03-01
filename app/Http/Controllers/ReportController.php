<?php

namespace App\Http\Controllers;

use App\models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function jobs_report(Request $request)
    {
        // return $request->all();
        $date = $request->start_date == null || $request->end_date == null;
        if (count($request->client) < 1 && count($request->staff) < 1 && count($request->status) < 1 && count($request->jobtype_id) < 1 && $date) {
            abort(422, 'Please choose atleast one field');
        }
        // DB::enableQueryLog(); // Enable query log
        $date_arr = [
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ];
        $jobs = new Job;
        if ($request->start_date && $request->end_date) {
            $jobs = $jobs->whereBetween('created_at', $date_arr);
        }
        if (count($request->client) > 0) {
            $jobs = $jobs->whereIn('client_id', $request->client);
        }
        if (count($request->staff) > 0) {
            $jobs = $jobs->whereIn('staff_id', $request->staff);
        }
        // if (count($request->jobtype_id) > 0) {
        //     $jobs = $jobs->whereIn('jobtype_id', $request->jobtype_id);
        // }
        if (count($request->status) > 0) {
            $jobs = $jobs->whereIn('status', $request->status);
        }
        $jobs = $jobs->get();
        // dd(DB::getQueryLog()); // Show results of log
        return $this->transform_job($jobs);
    }

    public function transform_job($jobs)
    {
        $jobs->transform(function ($job) {
            $job_type = '';
            $price = 0;
            foreach ($job->jobtype as  $jobtype) {
                if ($job_type == '') {
                    $job_type = $jobtype->jobtype;
                } else {
                    $job_type = $job_type . ', ' . $jobtype->jobtype;
                }
                // dd($jobtype->pivot);
                $price += $jobtype->pivot->price;
            }
            $job->job_type = $job_type;
            $job->total_price = $price;
            $job->client_name = $job->client->name;
            $job->staff_name = $job->staff->name;
            $job->user_name = $job->user->name;
            return $job;
        });
        return $jobs;
    }
}
