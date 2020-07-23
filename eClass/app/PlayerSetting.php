<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerSetting extends Model
{
	protected $table = 'player_settings';
	
    protected $fillable = ['logo_enable', 'logo', 'cpy_text', 'share_enable', 'resumeplay', 'autoplay', 'download'];
}
