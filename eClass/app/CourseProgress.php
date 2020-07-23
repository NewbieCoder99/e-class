<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    protected $table = 'course_progress';
	
    protected $fillable = [ 'course_id', 'user_id', 'mark_chapter_id', 'all_chapter_id' ];

    protected $casts = [
        'mark_chapter_id' => 'array',
        'all_chapter_id' => 'array'
    ];
}
