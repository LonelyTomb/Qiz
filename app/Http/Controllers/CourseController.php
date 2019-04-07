<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
	public static function allCourses(){
	return  DB::table('courses')->where('examiner_id',Auth::id())->get();
	}
	public function __construct()
	{
		$this->middleware('auth:examiner');
	}

	public function Courses()
	{
		$courses = self::allCourses();
		return view('examiner.courses', compact('courses'));
	}

	public function viewCourse($id)
	{
		$course = DB::table('courses')->where('id', $id)->first();
		return view('examiner.updateCourse', compact('course'));

	}

	public function updateCourse(Request $request)
	{
		$courses = DB::table('courses')->get();
		DB::table('courses')->where(
			'id', $request->id
		)->update(
			[
				'title' => $request->name,
				'number' => $request->qnumber,
				'time' => $request->time]
		);
		return redirect()->route('examiner.view_quizzes',compact('courses'));
	}

	public function saveCourse(Request $request)
	{
		$courses = self::allCourses();
		DB::table('courses')->insert(
			[
				'examiner_id' => session()->get('id'),
				'title' => $request->name,
				'number' => $request->qnumber,
				'time' => $request->time]
		);
		return view('examiner.courses',compact('courses'));
	}
	public function deleteCourse($id)
	{
		DB::table('courses')->where('id',$id)->delete();
		DB::table('questions')->where('id', '=', $id)->delete();
		DB::table('question_answers')->where('question_id', '=', $id)->delete();
		return redirect(url()->previous());
	}
}
