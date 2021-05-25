<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class AuthController extends Controller
{
    public function login()
    {
        $user = auth()->user();

        if( !empty($user) ) {
            return redirect()->route('Complaint.index');
        }

        return view('login.index');

    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function loginSave(Request $request)
    {
        $credentials = $request->only('user', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if( !empty($user) ) {
                return redirect()->route('Complaint.index');
            }
        }

        return back()->withErrors([
            'user' => 'Invalid Login',
        ]);
    }

    public function loginAjax(Request $request)
    {
        $credentials = $request->only('user', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if( !empty($user) ) {
                $url = route('Complaint.index');
            }

            return response()->json([
                'status' => 1,
                'url' => $url
            ]);

        }

        return response()->json([
            'status' => 0,
            'mgs' => 'Incorrect Username or Password, Please try Again'
        ]);
    }

    // /**
    //  * Log the user out of the application.
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function logoutSave(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('Auth.login');
    }

}
