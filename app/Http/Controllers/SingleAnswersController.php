<?php

namespace App\Http\Controllers;

use App\singleAnswer;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class SingleAnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:examiner');
    }

    public function exportAnswers($id)
    {
        $answers = singleAnswer::where('course_id', $id)
            ->with('user')
            ->with('course')
            ->get();

        if (count($answers) == 0)
            return redirect()->route('examiner.view_quizzes');
        (new FastExcel($answers))->download('answers.xlsx', function ($answer) {
            return [
                'Course' => $answer->course->title,
                'User' => $answer->user->name,
                'Score' => $answer->score,
                'CorrectiveConfidence' => $answer->correctiveConfidence,
                'KeywordsMatched' => $answer->keywordsMatched,
                'Answer' => $answer->answer,
                'Speed' => $answer->speed

            ];
        });
    }
}
