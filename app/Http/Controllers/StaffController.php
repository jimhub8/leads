<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles')->paginate(500);
        $staffs = $users->reject(function ($user, $key) {
            return !$user->hasRole('Staff');
        });
        $id = [];
        foreach ($staffs as  $staff) {
            $id[] = $staff->id;
        }
        return User::whereIn('id', $id)->paginate(500);
        // return $staffs;
        // return view('admin.report_roles', ['roles'=>$roles, 'nonmembers' => $staffs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function search_staff($search)
    {
        $users = User::with('roles')->paginate(500);
        $staffs = $users->reject(function ($user, $key) {
            return !$user->hasRole('Staff');
        });
        $id = [];
        foreach ($staffs as  $staff) {
            $id[] = $staff->id;
        }
        return User::whereIn('id', $id)->where('name', 'LIKE', "%{$search}%")->paginate(500);
    }
}
