<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showLoginForm()
    {
        return view('admin.pages.auth.login');
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin_code' => 'required|digits:4',
        ]);

        // Code PIN secret (remplace par une valeur dynamique depuis la DB si besoin)
        $correctPin = "1234";

        if ($request->pin_code === $correctPin) {
            Session::put('admin_logged_in', true); // Stocker l'admin en session
            return redirect()->route('admin');
        }

        return redirect()->route('admin-Login')->with('error', 'Code PIN incorrect');
    }

    public function logout()
    {
        Session::forget('admin_logged_in'); // Déconnecter l’admin
        return redirect()->route('admin');
    }
}
