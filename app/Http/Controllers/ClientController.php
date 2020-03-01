<?php

namespace App\Http\Controllers;

use App\models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::paginate(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->user_id = Auth::id();
        $client->staff_id = $request->staff_id;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->notes = $request->notes;
        $client->tel = $request->tel;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->address = $request->address;
        $client->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Client::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
    }

    public function search_client($search)
    {
        return Client::where('name', 'LIKE', "%{$search}%")->paginate(500);
    }
}
