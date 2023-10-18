<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::get();
        return response()->json(["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create($request->all());

        return response()->json(["message" => "Insert data success"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return response()->json(["data" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $user->update($request->all());

        return response()->json(["message" => "Update data success"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();

        return response()->json(["message" => "Delete data success"]);
    }
}
