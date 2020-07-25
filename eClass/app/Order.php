<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	
    protected $fillable = [ 'course_id', 'user_id', 'instructor_id', 'order_id', 'transaction_id', 'payment_method', 'total_amount', 'coupon_discount', 'currency', 'currency_icon', 'status', 'duration','enroll_start', 'enroll_expire', 'bundle_course_id', 'bundle_id', 'proof'];

    protected $casts = [
        'bundle_course_id' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id');
    }

    public function bundle()
    {
        return $this->belongsTo('App\BundleCourse','bundle_id','id');
    }	
}
