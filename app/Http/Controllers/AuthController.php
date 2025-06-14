<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showPraRegister()
    {
        return view('auth.praRegister', ['noNavbar' => true], ['noSidebar' => true]);
    }

    public function showRegister()
    {
        return view('auth.register', ['noNavbar' => true],['noSidebar' => true]);
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);


            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'pengguna',
                'is_mustaqirrah' => false,
            ]);


            return redirect()->route('login')->with('success', 'Registrasi berhasil');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function landingPage(){
        return view('landingPage', ['noSidebar' => true]);
    }
}
