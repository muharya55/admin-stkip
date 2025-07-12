<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth/login',  []);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('loginError', 'Incorrect username or password!');
    }
    // public function authenticate(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'password' => 'required'
    //     ]);

    //     // Check if username exists in the database
    //     $user = \App\Models\User::where('username', $request->username)->where('type', '!=', 'z')->first();

    //     if (!$user) {
    //         // If username does not exist
    //         return redirect()->back()->withErrors(['username' => 'username tidak ditemukan']);
    //     }

    //     if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    //         // If password is incorrect
    //         return redirect()->back()->withErrors(['password' => 'Password tidak sesuai']);
    //     }
    //     $request->session()->regenerate();
    //     // activity()->causedBy(Auth::user())->log('User melakukan login');
    //     return redirect()->intended('/dashboard');
    // }
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
