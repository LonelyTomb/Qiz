<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;
use Illuminate\Support\Facades\Auth;
use App\quiz;
use App\quizAnswer;
use App\scripts;
use Illuminate\Support\Facades\DB;

class ExaminerController extends Controller
{

	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:examiner');
	}

	public function allCourses()
	{
		return DB::table('courses')->where('examiner_id', Auth::id())->get();
	}

	/**
	 * Show the application dashboard.
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$id = session()->get('type');
		return view('examiner.home', compact('id'));
	}

	public function viewResult()
	{
		$courses = $this->allCourses();
		return view('examiner.result', compact('courses'));
	}

	public function checkResult($id)
	{
		$quizzes = scripts::where('course_id', $id)
			->with('user')
			->with('quiz')
			->get();
		return view('examiner.checkResult', compact('quizzes'));
	}

	public function viewScript($id)
	{
		$quiz = quiz::find($id);

		if ($quiz) {
			$scripts = quizAnswer::where('quiz_id', $id)
				->with('question')
				->with('question.answer')
				->get();

			$totalTime = $scripts->reduce(function ($carry, $item) {
				return $carry + $item->speed;

			});
		}
		return view('examiner.viewScript', compact('quiz', 'scripts','totalTime'));
	}
}
