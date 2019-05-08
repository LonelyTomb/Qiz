<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class singleAnswer extends Model
{
    protected $fillable = ['user_id', 'question_id', 'score', 'correctiveConfidence', 'keywordsMatched', 'answer', 'correct', 'speed'];


    public function question()
    {
        return $this->belongsTo(question::class);
    }
    public function examiner()
    {
        return $this->belongsTo(Examiner::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(course::class);
    }
}
