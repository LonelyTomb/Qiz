<?php

namespace App\Http\Controllers;

use Auth;
use App\scripts;
use App\quiz;
use App\quizAnswer;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$scripts = scripts::where('user_id',Auth::id())
			->with('course')
			->with('quiz')
			->get();

		return view('script.index', compact('scripts'));
	}

	public function show($id)
    {
        $quiz = quiz::find($id);

        if ($quiz) {
            $scripts = quizAnswer::where('quiz_id', $id)
                ->with('question')
                ->with('question.answer')
                ->get()
            ;
        }
        return view('script.show', compact('quiz', 'scripts'));
    }
}