<?php

namespace App\Http\Controllers;

use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BatchCreateQuestions extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:examiner');
	}

	public function index()
	{
		return view('examiner.batchCreate');
	}

	public function uploadQuestions(Request $request, $id)
	{
		$questionFile = $this->parseFile($request);
		foreach ($questionFile['collection'] as $key => $question) {

			$questionId = DB::table('questions')->insertGetId(
				[
					'course_id' => $id,
					'question' => $question['question']
				]
			);
			DB::table('question_answers')->insert(
				[
					'question_id' => $questionId,
					'answer' => $question['answer'],
					'marks' => $question['marks'],
					'keywords' => $question['keywords']
				]
			);
		}
		return redirect('examiner/courses/view/' . $id);
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
}
