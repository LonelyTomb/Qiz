<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as Storage;
use Rap2hpoutre\FastExcel\FastExcel;
use App\question;
use Illuminate\Support\Facades\DB;

class ExportModelToExcel extends Controller
{
	public function __construct()
	{

	}

	public function downloadExcelSheet()
	{
		return Storage::download('questionsList.xlsx');
	}

	public function getExcelSheet(Request $request)
	{
		$questions = question::where('course_id', $request->course)->get();
//		$questions = DB::table('questions')->where('course_id', $request->course)->get();

		(new FastExcel($questions))->download('questions.xlsx', function ($question) {
			return [
				'No' => $question->id,
				'Question' => $question->question,
				'Answer' => ''
			];
		});

//		Storage::delete('questionsList.xlsx');
//		Storage::copy('../.../../public/questions.xlsx', "questionsList.xlsx");
//
//		return redirect('/public/questions');
	}

}
