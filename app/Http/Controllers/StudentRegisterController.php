<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentRegisterController extends Controller
{
    // แสดงหน้าสมัครสมาชิก
    public function showRegisterForm()
    {
        $faculties = Faculty::orderBy('faculty_name')->get();

        $programs = Program::orderBy('program_name')->get();

        return view(
            'auth.student-register',
            compact('faculties', 'programs')
        );
    }

    // บันทึกข้อมูลสมัครสมาชิก
    public function register(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:20|unique:students,student_id',

            'student_name' => 'required|string|max:255',

            'faculty_id' => 'required|exists:faculty,faculty_id',

            'program_id' => 'required|exists:program,program_id',

            'birth_date' => 'required|date',

            'email' => 'required|email|max:255|unique:students,email',

            'address' => 'nullable|string|max:255',

            'username' => 'required|string|max:255|unique:students,username',

            'password' => 'required|min:6|confirmed',
        ]);

        Student::create([
            'student_id' => $request->student_id,
            'student_name' => $request->student_name,
            'faculty_id' => $request->faculty_id,
            'program_id' => $request->program_id,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'address' => $request->address,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('student.login.form')
            ->with(
                'success',
                'สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ'
            );
    }
}
