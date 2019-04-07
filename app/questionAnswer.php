<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questionAnswer extends Model
{
	protected $fillable = ['answer', 'question_id', 'marks', 'keywords'];

	public function question()
	{
		return $this->belongsTo(question::class);
	}
}
