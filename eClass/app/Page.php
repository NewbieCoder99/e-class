<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;

    protected $table = 'pages';

	protected $fillable = [
    	'title','slug','details','status'
	];
}
