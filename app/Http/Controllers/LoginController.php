<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        $status=DB::table('users')
        // ->select('users.status')
        // ->where('users.status','=',1)
        ->where('users.email','=',request('email'))
        ->latest()->first();

        if ($status) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('panel');
            }

            return redirect('/login');
        }else{
            return redirect('/login');
        }
        
    }
     
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
