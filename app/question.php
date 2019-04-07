<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $fillable = ['question', 'course_id'];
    
    public function course()
    {
        return $this->belongsTo(course::class);
    }

    public function answer()
    {
        return $this->hasOne(questionAnswer::class);
    }
}
