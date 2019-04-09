<?php

namespace App\Http\Controllers;

use Auth;
use App\quiz;
use App\quizAnswer;
use App\course;
use App\question;
use App\questionAnswer;
use App\scripts;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Requests\QuizStoreRequest;

class QuizController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a new test.
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// $topics = Topic::inRandomOrder()->limit(10)->get();

		$courses = course::inRandomOrder()->get();

		return view('quiz.index', compact('courses'));
	}

	// public function create()
	// {
	//     return true;
	// }

	public function show($id, Request $request)
	{
		$timer_display = false;
		$questions = question::where('course_id', $id)->get();
		if (isset($request->timer)) {
			$timer_display = true;

		}
		$course = course::where('id', $id)->first();
		return view('quiz.show', compact('questions', 'id', 'course', 'timer_display'));

	}

	/**
	 * Store a newly solved Test in storage with results.
	 * @param  \App\Http\Requests\StoreResultsRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		dd($request->input('questions'));
		$result = 0;
		$totalQuestionsMarks = 0;

		$quiz = quiz::create([
			'user_id' => Auth::id(),
			'course_id' => $request->input('course'),
			'result' => $result,
		]);

		scripts::create([
			'user_id' => Auth::id(),
			'course_id' => $request->input('course'),
			'quiz_id' => $quiz->id,
			'questions' => json_encode($request->input('questions')),
			'answers' => json_encode($request->input('answers'))
		]);

		foreach ($request->input('questions', []) as $key => $question) {
			$startTime = array_sum(explode(' ', microtime()));
			$count = 0;
			$score1 = 0;
			$score2 = 0;
			$totalScore1 = 0;
			$totalScore2 = 0;
			$totalScore = 0;
			$status = 0;

			$quizAnswer = trim($request->input('answers.' . $question));
			$quizAnswer_split = explode(' ', strtolower($quizAnswer));

//			Scoring Using Matching
			$questionMarks = questionAnswer::find($question)->marks;
			$totalQuestionsMarks += $questionMarks;
			$questionAns = questionAnswer::find($question)->answer;
			$questionAns_split = explode(" ", $questionAns);

			$count = count($questionAns_split);
			// matching starts from here
			foreach ($questionAns_split as $ky => $questionA) {
				foreach ($quizAnswer_split as $quizA) {
					if ($questionA == $quizA) {
						++$score1;
						array_splice($questionAns_split, $ky, 1, '');
					}
				}
			}
			$totalScore1 = (($score1 / $count) * 100);
			$totalScore1 = $totalScore1 > 100 ? 100 : $totalScore1; /// TODO: TO be deliberated

//			Scoring Using Keywords
			$keywords = questionAnswer::find($question)->keywords;
			$keywords_split = explode(',', $keywords);
			$count = count($keywords_split);

			foreach ($keywords_split as $keyword) {
				if (in_array(strtolower($keyword), $quizAnswer_split, false)) {
					++$score2;
//					array_shift($keywords_split);
				}
			}
			$totalScore2 += (($score2 / $count) * 100);

			$totalScore = ($totalScore1 + $totalScore2) / 2;
			$score = ($totalScore * $questionMarks) / 100;

			if ($totalScore >= 50) {
				$result++;
				$status = 1;
			}

//			Final Result
			$result += $score;
			$stopTime = array_sum(explode(' ', microtime()));
			// matching ends here
			quizAnswer::create([
				'user_id' => Auth::id(),
				'quiz_id' => $quiz->id,
				'question_id' => $question,
				'score' => $score,
				'correctiveConfidence' => $totalScore1,
				'keywordsMatched' => $totalScore2,
				'correct' => $status,
				'answer' => $request->input('answers.' . $question),
				'speed' => $stopTime - $startTime
			]);
		}

		$result = round($result / $totalQuestionsMarks * 100, 2);

		$quiz->update(['result' => $result]);

		return redirect()->route('script.show', [$quiz->id]);
	}
}

