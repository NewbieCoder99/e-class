<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $table = 'coupons';
	
    protected $fillable = [
      'code','distype','amount','link_by','maxusage','minamount','expirydate','course_id', 'category_id'
    ];

    public function cate (){
     	return $this->belongsTo("App\Categories","category_id");
    }

    public function product (){
     	return $this->belongsTo("App\Course","course_id");
    }
}
