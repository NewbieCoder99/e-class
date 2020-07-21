@extends('theme.master')
@section('title', "$user->fname")
@section('content')
@include('admin.message')


<section id="instructor-block" class="instructor-main-block instructor-profile">
	 <div class="container">
	 	<div class="row">
	 		<div class="col-xl-8 col-lg-8 col-md-8">
	 			<div class="instructor-block">
	 				<div class="instructor-small-heading">instructor</div>
	 				<h1>{{ $user['fname'] }} {{ $user['lname'] }}</h1>
	 				<div class="sub-heading">{{ $user['email'] }}</div>
	 				<div class="instructor-business-block">
		 				<div class="instructor-student">
		 					<div class="total-students">Total students</div>
		 					<div class="total-number">
		 						@php
	                                $data = App\Order::where('instructor_id', $user->id)->get();
	                                if(count($data)>0){

	                                    echo count($data);
	                                }
	                                else{

	                                    echo "0";
	                                }
	                            @endphp
                        	</div>
		 				</div>
		 				
		 			</div>
		 			<div class="about-instructor">
		 				@if($user['detail'] != NULL)
		 				<div class="heading">About me</div>
		 				
		 				<div id="section">
						  <div class="article">
						  	<p>
						  		{!! $user['detail'] !!}
						    </p>
						   
						  </div>
						</div>
						@endif
						<!--         -->
						<div class="about-instructor">
		 					<div class="heading">My Courses
		 						(@php
	                                $data = App\Course::where('user_id', $user->id)->get();
	                                if(count($data)>0){

	                                    echo count($data);
	                                }
	                                else{

	                                    echo "0";
	                                }
	                            @endphp)
		 					</div>
					        
					        <div class="row">
			 					@foreach($course as $c)
					              @if($c->status == 1)
					                <div class="col-lg-6 col-sm-6">
					                	<div class="student-view-block">
					                        <div class="view-block">
					                            <div class="view-img">
					                                @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
					                                    <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ asset('images/course/'.$c['preview_image']) }}" alt="course" class="img-fluid"></a>
					                                @else
					                                    <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ Avatar::create($c->title)->toBase64() }}" alt="course" class="img-fluid"></a>
					                                @endif
					                            </div>
					                            <div class="view-dtl">
					                                <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}">{{ str_limit($c->title, $limit = 30, $end = '...') }}</a></div>
					                                <p class="btm-10"><a herf="#">by {{ $c->user['fname'] }}</a></p>
					                                <div class="rating">
					                                    <ul>
					                                        <li>
					                                            <?php 
					                                            $learn = 0;
					                                            $price = 0;
					                                            $value = 0;
					                                            $sub_total = 0;
					                                            $sub_total = 0;
					                                            $reviews = App\ReviewRating::where('course_id',$c->id)->get();
					                                            ?> 
					                                            @if(!empty($reviews[0]))
					                                            <?php
					                                            $count =  App\ReviewRating::where('course_id',$c->id)->count();

					                                            foreach($reviews as $review){
					                                                $learn = $review->price*5;
					                                                $price = $review->price*5;
					                                                $value = $review->value*5;
					                                                $sub_total = $sub_total + $learn + $price + $value;
					                                            }

					                                            $count = ($count*3) * 5;
					                                            $rat = $sub_total/$count;
					                                            $ratings_var = ($rat*100)/5;
					                                            ?>
					                            
					                                            <div class="pull-left">
					                                                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
					                                                </div>
					                                            </div>
					                                       
					                                             
					                                            @else
					                                                <div class="pull-left">{{ __('frontstaticword.NoRating') }}</div>
					                                            @endif
					                                        </li>
					                                        <!-- overall rating-->
					                                        <?php 
					                                        $learn = 0;
					                                        $price = 0;
					                                        $value = 0;
					                                        $sub_total = 0;
					                                        $count =  count($reviews);
					                                        $onlyrev = array();

					                                        $reviewcount = App\ReviewRating::where('course_id', $c->id)->WhereNotNull('review')->get();

					                                        foreach($reviews as $review){

					                                            $learn = $review->learn*5;
					                                            $price = $review->price*5;
					                                            $value = $review->value*5;
					                                            $sub_total = $sub_total + $learn + $price + $value;
					                                        }

					                                        $count = ($count*3) * 5;
					                                         
					                                        if($count != "")
					                                        {
					                                            $rat = $sub_total/$count;
					                                     
					                                            $ratings_var = ($rat*100)/5;
					                                   
					                                            $overallrating = ($ratings_var/2)/10;
					                                        }
					                                         
					                                        ?>

					                                        @php
					                                            $reviewsrating = App\ReviewRating::where('course_id', $c->id)->first();
					                                        @endphp
					                                        @if(!empty($reviewsrating))
					                                        <li>
					                                            <b>{{ round($overallrating, 1) }}</b>
					                                        </li>
					                                        @endif
					                                      <li>({{ $c->order->count() }})</li> 
					                                    </ul>
					                                </div>
					                                @if( $c->type == 1)
					                                    <div class="rate text-right">
					                                        <ul>
					                                            @php
					                                                $currency = App\Currency::first();
					                                            @endphp

					                                            @if($c->discount_price == !NULL)

					                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->discount_price }}</b></a></li>&nbsp;
					                                                <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $c->price }}</strike></b></a></li>
					                                                
					                                            @else
					                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->price }}</b></a></li>
					                                            @endif
					                                        </ul>
					                                    </div>
					                                @else
					                                    <div class="rate text-right">
					                                        <ul>
					                                            <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
					                                        </ul>
					                                    </div>
					                                @endif
					                            </div>
					                        </div>
					                    </div>
					                </div> 
					              @endif
					            @endforeach

					        </div>
					       
							<div class="pull-right">{{ $course->links() }}</div>


		 				</div>
		 			</div>
			 	</div>
	 		</div>
	 		<div class="col-xl-4 col-lg-4 col-md-4">
	 			<div class="instructor-img">
	 				<img src="{{ asset('images/user_img/'.$user['user_img']) }}" alt="img" class="img-fluid">
	 			</div>
	 			<div class="instructor-link">
	 				<ul>
	 					@if($user->linkedin_url != NULL)
	 						<a href="{{ $user->linkedin_url }}" target="_blank"><li><i class="fab fa-linkedin-in"></i>LinkedIn</li></a>
	 					@endif
	 					@if($user->twitter_url != NULL)
	 						<a href="{{ $user->twitter_url }}" target="_blank"><li><i class="fa fa-twitter"></i>Twitter</li></a>
	 					@endif
	 					@if($user->fb_url != NULL)
	 						<a href="{{ $user->fb_url }}" target="_blank"><li><i class="fa fa-facebook-f"></i>Facebook</li></a>
	 					@endif
	 					@if($user->youtube_url != NULL)
	 						<a href="{{ $user->youtube_url }}" target="_blank"><li><i class="fa fa-youtube"></i>Youtube</li></a>
	 					@endif
	 				</ul>
	 			</div>
	 		</div>
		</div>
	 </div>
</section>
<hr>
@endsection


