<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table = 'meetings';

    protected $fillable = ['meeting_id', 'owner_id', 'start_time', 'zoom_url', 'user_id', 'meeting_title', 'course_id', 'link_by'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

}
