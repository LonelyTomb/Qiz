<?php

namespace App;

use Auth;
use App\quiz;
use App\question;
use App\quizAnswer;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class scripts extends Model
{

	protected $fillable = ['user_id', 'course_id', 'quiz_id', 'questions', 'answers'];


	public function index()
	{
		$scripts = quiz::all()->load('user');

		return view('scripts.index', compact('scripts'));
	}

	/**
	 * Set attribute to date format
	 * @param $input
	 */
	public function setDateAttribute($input)
	{
		if ($input != null) {
			$this->attributes['date'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
		} else {
			$this->attributes['date'] = null;
		}
	}

	/**
	 * Get attribute from date format
	 * @param $input
	 * @return string
	 */
	public function getDateAttribute($input)
	{
		$zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

		if ($input != $zeroDate && $input != null) {
			return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
		} else {
			return '';
		}
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function question()
	{
		return $this->belongsTo(question::class);
	}

	public function course()
	{
		return $this->belongsTo(course::class);
	}

	public function quiz()
	{
		return $this->belongsTo(quiz::class);
	}

	public function quizAnswer()
	{
		return $this->hasMany(quizAnswer::class);
	}
}
