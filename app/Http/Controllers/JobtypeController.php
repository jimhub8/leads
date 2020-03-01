<?php

namespace App\Http\Controllers;

use App\models\AutoGenerate;
use App\models\Jobtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Jobtype::paginate(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobtype = new Jobtype;
        $jobtype->user_id = Auth::id();
        $jobtype->jobtype = $request->jobtype;
        $jobtype->description = $request->description;
        $id = Jobtype::select('id')->orderBy('id', 'DESC')->first();
        // dd($id);
        // $id = $id->id + 1;
        $job_code = new AutoGenerate;
        $job_code = $job_code->uniqueJobcode();
        $jobtype->job_code = $job_code;
        $jobtype->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Jobtype  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Jobtype::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Jobtype  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $jobtype = Jobtype::find($id);
        $jobtype->user_id = Auth::id();
        $jobtype->job_type = $request->job_type;
        $jobtype->description = $request->description;
        $jobtype->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Jobtype  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jobtype::find($id)->delete();
    }
}
