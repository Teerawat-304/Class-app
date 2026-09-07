<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    // แสดงหน้า Login
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    // ตรวจสอบการ Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('student')->attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ],
            $remember
        )) {

            $request->session()->regenerate();

            return redirect()
                ->intended('/student/dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
            ])
            ->onlyInput('email');
    }

    // ออกจากระบบ
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('student.login.form')
            ->with('success', 'ออกจากระบบเรียบร้อยแล้ว');
    }
}
