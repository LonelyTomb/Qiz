<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\quiz;
use App\course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = course::count();
//		$id = session('id');
        return view('student.home', compact('quizzes'));
    }

	public function user()
	{
		return view('student.home');
    }
}
