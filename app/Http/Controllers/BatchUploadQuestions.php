<?php

namespace App\Http\Controllers;

use App\course;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CourseController;
use App\question;
use App\singleAnswer;
use App\questionAnswer;
use Rap2hpoutre\FastExcel\FastExcel;
use App\quiz;
use App\quizAnswer;
use App\scripts;

class BatchUploadQuestions extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:examiner');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$courses = $this->allCourses();
		$users = DB::table('users')->all();
		$template = Storage::url('questions.xlsx');
		return view('examiner.upload', compact('courses', 'template', 'users'));
	}

	public function selectCourse(Request $request)
	{
		$questions = question::where('course_id', $request->id)->get();
        $template = Storage::url('answers.xlsx');
//		dd($questions);
		return view('examiner.selectQuestionToMark', compact('questions','template'));
	}


	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function allCourses()
	{
		return DB::table('courses')->where('examiner_id', Auth::id())->get();
	}

	public function processUploadQuestions(Request $request)
	{
		$questions = $this->parseFile($request);
		$course = $request->course;
		$count = 1;


		$questionsArr = [];
		$answerArr = [];
		foreach ($questions['collection'] as $key => $question) {
			$questionsArr[$count++] = $question["no"];
			$answerArr[$question['no']] = $question['answer'];
		}

		$quiz = [
			"questions" => $questionsArr,
			"answers" => $answerArr
		];
		$scriptId = $this->markUpoadScripts($request->user, $course, $quiz);
		return redirect()->route('examiner.viewScript', $scriptId);
	}

	/**
	 * Process Uploaded Excel Sheet
	 * @param Request $request
	 * @return array
	 * @throws \Box\Spout\Common\Exception\IOException
	 * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
	 * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
	 */
	public function parseFile(Request $request)
	{
		if ($request->hasFile('file')) {
			if ($request->file('file')->isValid()) {
				$path = $request->file('file')->getRealPath();
				$collection = (new FastExcel)->import($path);
				// $pagination = new LengthAwarePaginator($collection,$collection->count(),5);
				return ['collection' => $collection];
			}
		}
	}

	public function UploadMarkPage()
	{
		$courses = $this->allCourses();
		$template = Storage::url('Scripts.xlsx');
		$users = User::all();
		return view('examiner.batchUploadMark', compact('courses', 'template', 'users'));
	}

	public function markUpoadScripts($user, $course, $sheet)
	{
		$result = 0;
		$totalQuestionsMarks = 0;

		$quiz = quiz::create([
			'user_id' => $user,
			'course_id' => $course,
			'result' => $result,
		]);

		scripts::create([
			'user_id' => $user,
			'course_id' => $course,
			'quiz_id' => $quiz->id,
			'questions' => json_encode($sheet['questions']),
			'answers' => json_encode($sheet['answers'])
		]);

		foreach ($sheet['questions'] as $key => $question) {
			$startTime = array_sum(explode(' ', microtime()));
			$count = 0;
			$score1 = 0;
			$score2 = 0;
			$totalScore1 = 0;
			$totalScore2 = 0;
			$totalScore = 0;
			$status = 0;

			$quizAnswer = trim($sheet['answers'][$question]);
			$quizAnswer_split = explode(' ', strtolower($quizAnswer));

//			Scoring Using Matching
			$questionMarks = questionAnswer::find($question)->marks;
			$totalQuestionsMarks += $questionMarks;
			$questionAns = questionAnswer::find($question)->answer;
			$questionAns_split = explode(" ", $questionAns);

			$count = count($questionAns_split);
			// matching starts from here
			foreach ($questionAns_split as $questionA) {
				foreach ($quizAnswer_split as $quizA) {
					if ($questionA == $quizA) {
						++$score1;
//						array_shift($quizAnswer_split);
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
				'user_id' => $user,
				'quiz_id' => $quiz->id,
				'question_id' => $question,
				'score' => $score,
				'correctiveConfidence' => $totalScore1,
				'keywordsMatched' => $totalScore2,
				'correct' => $status,
				'answer' => $sheet['answers'][$question],
				'speed' => $stopTime - $startTime
			]);

		}

		$result = ($result / $totalQuestionsMarks) * 100;
		$quiz->update(['result' => $result]);

		return $quiz->id;
	}

	public function markCourse(Request $request, $id)
	{
		$answers = $this->parseFile($request);
		$question = $request->question;
		$quizId = $request->quiz;
		$course = $id;
		$count = 1;

		$questionsArr = [];
		$answerArr = [];

		foreach ($answers['collection'] as $key => $answer) {
			$questionsArr[1] = $question;
			$user = $answer['email'];
			$answerArr[$question] = $answer['answer'];

			$quiz = [
				"questions" => $questionsArr,
				"answers" => $answerArr
			];

			$this->markUploadAnswers($user, $course, $quizId, $question, $quiz);
		}

		return redirect()->route('examiner.home');
	}

	//Batch Mark Answers one by one
	public function markUploadAnswers($userEm, $course, $quizId, $questionId, $sheet)
	{
		$result = 0;
		$totalQuestionsMarks = 0;
		$user = DB::table('users')->where('email', $userEm)->get()[0]->id;



		foreach ($sheet['questions'] as $key => $question) {
			$startTime = array_sum(explode(' ', microtime()));
			$count = 0;
			$score1 = 0;
			$score2 = 0;
			$totalScore1 = 0;
			$totalScore2 = 0;
			$totalScore = 0;
			$status = 0;

			$quizAnswer = trim($sheet['answers'][$question]);
			$quizAnswer_split = explode(' ', strtolower($quizAnswer));

//			Scoring Using Matching
			$questionMarks = questionAnswer::find($question)->marks;
			$totalQuestionsMarks += $questionMarks;
			$questionAns = questionAnswer::find($question)->answer;
			$questionAns_split = explode(" ", $questionAns);

			$count = count($questionAns_split);
			// matching starts from here
			foreach ($questionAns_split as $questionA) {
				foreach ($quizAnswer_split as $quizA) {
					if ($questionA == $quizA) {
						++$score1;
//						array_shift($quizAnswer_split);
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
			singleAnswer::create([
				'user_id' => $user,
				'question_id' => $question,
				'course_id'=>$course,
				'score' => $score,
				'correctiveConfidence' => $totalScore1,
				'keywordsMatched' => $totalScore2,
				'correct' => $status,
				'answer' => $sheet['answers'][$question],
				'speed' => $stopTime - $startTime
			]);

		}

		$result = ($result / $totalQuestionsMarks) * 100;
	}
}
