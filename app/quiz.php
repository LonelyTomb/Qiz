<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
	protected $fillable = ['user_id', 'course_id','result'];

	public function examiner()
	{
		return $this->belongsTo(Examiner::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function quizAnswer()
	{
		return $this->hasMany(quizAnswer::class);
	}
	public function course()
	{
		return $this->belongsTo(course::class);
	}
}
