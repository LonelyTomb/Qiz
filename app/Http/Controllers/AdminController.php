<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examiners = DB::table('examiners')->get();
        return view('admin.home', compact('examiners'));
    }

    public function examiners()
    {
        $examiners = DB::table('examiners')->get();
        return view('admin.examiners', compact('examiners'));        
    }

    public function students()
    {
        $students = DB::table('users')->get();
        return view('admin.students', compact('students'));        
    }

    public function courses()
    {
        $courses = DB::table('courses')->get();
        return view('admin.courses', compact('courses'));        
    }

   
	// public function user()
	// {
	// 	return view('student.home');
    // }
}
