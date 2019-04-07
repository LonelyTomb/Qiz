<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\question;
use App\questionAnswer;


class QuestionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:examiner');
	}


	public function viewQuestions($id)
	{
//		$questions = DB::table('questions')->where(
//			'course_id', $id
//		)->get();
//		$answers = DB::table('question_answers')->get();

		$questions = question::where('course_id', $id)
			->with('answer')
			->get();
		return view('examiner.viewQuestions', compact('questions'));
	}

	public function addQuestions($id)
	{
		$course = DB::table('courses')->where('id', $id)->first();
		$count = DB::table('questions')->where('id', $id)->get()->count();

		return view('examiner.addQuestions', compact('course', 'count'));
	}

	public function saveQuestions(Request $request)
	{

		$id = DB::table('questions')->insertGetId(
			[
				'course_id' => $request->id,
				'question' => $request->question
			]
		);
		DB::table('question_answers')->insert(
			[
				'question_id' => $id,
				'answer' => $request->answer,
				'marks' => $request->marks,
				'keywords' => $request->keywords
			]
		);
		return redirect('examiner/courses/view/' . $request->id);
	}

	public function deleteQuestion($id)
	{
		DB::table('questions')->where('id', '=', $id)->delete();
		DB::table('question_answers')->where('question_id', '=', $id)->delete();
		return redirect(url()->previous());
	}
}
