<?php

namespace App\Http\Controllers;

use App\models\Client;
use App\models\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function user_count()
    {
        return User::count();
    }
    public function client_count()
    {
        return Client::count();
    }
    public function jobs_count()
    {
        return Job::count();
    }
    public function complete_jobs_count()
    {
        return Job::where('status', 'Complete')->count();
    }
    public function pedding_jobs_count()
    {
        return Job::where('status', 'Pending')->count();
    }
    public function open_leads_count()
    {
        return Client::where('status', 'open')->count();
    }
    public function closed_leads_count()
    {
        return Client::where('status', 'open')->count();
    }
    public function cancelled_leads_count()
    {
        return Client::where('status', 'Cancelled')->count();
    }
    public function today_jobs_count()
    {
        $tomorrow = Carbon::tomorrow();
        $today = Carbon::today();
        return Job::whereBetween('created_at', [$today, $tomorrow])->count();
    }
    public function avarage_revenue()
    {
        // $tomorrow = Carbon::tomorrow();
        // $today = Carbon::today();
        $start = new Carbon('first day of this month');
        $end = Carbon::today();
        // dd($start, $end);

        return Job::whereBetween('created_at', [$start, $end])->count();
    }
}
