<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quizAnswer extends Model
{
	protected $fillable = ['user_id', 'quiz_id', 'question_id', 'score', 'correctiveConfidence', 'keywordsMatched', 'answer', 'correct','speed'];


	public function question()
	{
		return $this->belongsTo(question::class);
	}

	public function scripts()
	{
		return $this->belongsTo(scripts::class);
	}
}
