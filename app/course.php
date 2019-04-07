<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $fillable = ['examiner_id','title', 'number', 'time'];
	protected $table = 'courses';
    public function question()
    {
        return $this->hasMany(question::class);
    }

	public function scripts()
	{
		return $this->hasMany(scripts::class);
    }

	public function examiner()
	{
		return $this->belongsTo(examiner::class);
    }

}
