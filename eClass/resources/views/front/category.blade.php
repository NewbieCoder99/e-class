@extends('theme.master')
@section('title', "$cats->title")

@section('content')
@include('admin.message')
<!-- categories-tab start-->
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">
        	@php
                $category = App\Categories::all();
            @endphp
            @foreach($category as $cat)
                @if($cat->status == 1)
	            <div class="item categories-tab-dtl">
	                <a href="{{ route('category.page',$cat->id) }}" title="tab"><i class="fa {{ $cat->icon }}"></i>{{ $cat->title }}</a>
	            </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<!-- categories-tab end-->
<!-- category-title start -->
<section id="business-home" class="business-home-main-block">
    <div class="container">
        <h1 class="text-white">{{ $cats->title }}</h1>
    </div>
</section>  
<!-- category-title end -->
<!-- category-slider start -->
<section id="business-home-slider" class="business-home-slider-main-block">
    <div class="container">
        <div id="business-home-slider-two" class="business-home-slider owl-carousel">
        	@foreach($courses as $course)
        	@if($course->featured == 1 && $course->status == 1)
            <div class="item business-home-slider-block">
                <div class="row">
                    <div class="col-md-5">
                        <div class="business-home-slider-img">
                            @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                                <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ asset('images/course/'.$course->preview_image) }}" class="img-fluid" alt="course"></a>
                            @else
                                <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ Avatar::create($course->title)->toBase64() }}" class="img-fluid" alt="course"></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="categories-popularity-dtl">
                            <ul>
                                <li>Featured course</li>
                                <li class="heart float-rgt">
                                    @if (Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $course->id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                                    <button class="wishlisht-btn heart-category" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $course->id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                                    <button class="wishlisht-btn heart" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                        <div class="heart">
                                            <a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}">{{ str_limit($course->title, $limit=50)}}</a></div>
                            <div class="last-updated btm-10">Last Updated {{ date('jS F Y', strtotime($course->updated_at)) }}</div>
                            <ul>
                                <li class="rgt-5">
                                	@php
                                        $data = App\CourseClass::where('course_id', $course->id)->get();
                                        if(count($data)>0){

                                            echo count($data);
                                        }
                                        else{

                                            echo "0";
                                        }
                                    @endphp 
                                	classes
                            	</li>
                                <li class="rgt-5">All Levels</li>
                                <li class="rgt-5">
                                    <ul class="rating">
                                        <li>
                                        	<?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                            ?> 
                                            @if(!empty($reviews[0]))
                                            <?php
                                            $count =  App\ReviewRating::where('course_id',$course->id)->count();

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
                                                <div class="pull-left"><p>No Ratings</p></div>
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                                <!-- overall rating -->
                                <?php 
                                $learn = 0;
                                $price = 0;
                                $value = 0;
                                $sub_total = 0;
                                $count =  count($reviews);
                                $onlyrev = array();

                                $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

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
                                    $reviewsrating = App\ReviewRating::where('course_id', $course->id)->first();
                                @endphp
                                @if(!$reviews->isEmpty())
                                <li class="rgt-5">
                                    <b>{{ round($overallrating, 1) }}</b>
                                </li>
                                @endif

                                <li>
                                	(@php
                                        $data = App\ReviewRating::where('course_id', $course->id)->get();
                                        if(count($data)>0){

                                            echo count($data);
                                        }
                                        else{

                                            echo "0";
                                        }
                                    @endphp ratings)
                                </li> 
                            </ul>
                            <p class="btm-20">{{ str_limit($course->short_detail, $limit = 70, $end='...') }}</p>
                            <div class="business-home-slider-btn btm-20">
                                <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}" type="button" class="btn btn-info">Explore course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>  
<!-- category sliderslider end -->
<!-- sub categories start -->
@if(isset($subcat))
<section id="categories" class="categories-main-block categories-main-block-one">
    <div class="container">
        <h4 class="categories-heading">Sub Categories</h4>
        <div class="row">

        	@foreach($subcat as $cat)
            @if($cat->status == 1)
            <div class="col-lg-3 col-sm-6">
                <div class="categories-block">
                    <ul>
                        <li><a href="#" title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>
                        </a></li>
                        <li><a href="{{ route('subcategory.page',$cat->id) }}">{{ $cat->title }}</a></li>
                    </ul>
                </div>  
            </div>
            @endif
            @endforeach
           

        </div>
    </div>
</section>
 @endif

@if(isset($childcat))
<section id="categories" class="categories-main-block categories-main-block-one">
    <div class="container">
        <h4 class="categories-heading">Sub Categories</h4>
        <div class="row">

            @foreach($childcat as $cat)
            @if($cat->status == 1)
            <div class="col-lg-3 col-sm-6">
                <div class="categories-block">
                    <ul>
                        <li><a href="#" title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>
                        </a></li>
                        <li><a href="{{ route('childcategory.page',$cat->id) }}">{{ $cat->title }}</a></li>
                    </ul>
                </div>  
            </div>
            @endif
            @endforeach

        </div>
    </div>
</section>

@endif


<!-- sub categories end -->
<!-- instructor profiles start -->
<section id="instructors" class="instructors-main-block btm-40">
    <div class="container">
        @php
            $instructors = App\User::where('role', 'instructor')->get();
        @endphp
        @if(! $instructors->isEmpty())
        <h4 class="btm-40">Popular Instructors</h4>
        <div id="testimonial-slider-one" class="testimonial-slider-main-block owl-carousel">
            @foreach($instructors as $user)
            @if($user['status'] == 1)
                @if($user->role == "instructor")
                    <div class="item testimonial-block text-center btm-30">
                        <div class="instructors-img-block btm-20">
                            @if($user['user_img'] != null || $user['user_img'] !='')
                                <a href="{{ route('instructor.profile', $user->id) }}" title="instructor"><img src="{{ asset('images/user_img/'.$user['user_img']) }}" alt="User"></a>
                            @else
                                <a href="{{ route('instructor.profile', $user->id) }}" title="instructor"><img src="{{ asset('images/user_img/default.jpg')}}" class="user-image" alt="User Image"></a>
                            @endif
                        </div>
                        <div class="instructors-dtl">
                            <ul>
                                <li>{{ $user['fname'] }}</li>
                                <li>
                                    @php
                                        $data = App\Course::where('user_id', $user->user['id'])->get();
                                        if(count($data)>0){

                                            echo count($data );
                                        }
                                        else{

                                            echo "0";
                                        }
                                    @endphp
                                    Course
                                </li>
                                <li>{{ strip_tags(str_limit($user->detail, $limit = 75, $end = '...')) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            @endif
            @endforeach
        </div> 
        @endif
    </div>
</section>
<!-- instructor profiles end -->
<!-- categories start -->
<section id="categories-popularity" class="categories-popularity-main-block">
    <div class="container">
    	<h2 class="btm-40">{{ $cats->title }} Courses</h2>
        <div class="row">
            <div class="col-lg-9">
                <div class="students-bought btm-30">
					@foreach($courses as $course)
					@if($course->status == 1)
                    <div class="course-bought-block protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$course->id}}">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                                    <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ asset('images/course/'.$course->preview_image) }}" alt="course" class="img-fluid"></a>
                                @else
                                    <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ Avatar::create($course->title)->toBase64() }}" alt="course" class="img-fluid"></a>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="categories-popularity-dtl">
                                    <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}">{{ $course->title }}</a></div>
                                    <ul>
                                        <li>
                                            @php
                                                $data = App\CourseClass::where('course_id', $course->id)->get();
                                                if(count($data)>0){

                                                    echo count($data);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp Classes
                                        </li>
                                        <li>
                                             @php
                                                $enroll = App\Order::where('course_id', $course->id)->get();
                                                if(count($enroll)>0){

                                                    echo count($enroll);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp Students
                                        </li>
                                        <li>All Levels</li>
                                    </ul>
                                    <p>{{  str_limit($course->short_detail, $limit = 125, $end = '..') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="rate text-right">
                                    <ul>
                                    	@if($course->type == 1)
                                            @php
                                                $currency = App\Currency::first();
                                            @endphp
                                            @if($course->discount_price == !NULL) 
                                                <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $course->discount_price }}&nbsp;<s><i class="{{ $currency->icon }}"></i>{{ $course->price }}</s> </li>
                                            @else
                                                <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $course->price }}</li>
                                            @endif
                                        @else
                                            <li class="rate-r">Free</li>
                                        @endif
                                    </ul>
                                    <div class="rating">
                                        <ul>
                                          <li>
                                            <!-- star rating -->
                                          	<?php 
		                                    $learn = 0;
		                                    $price = 0;
		                                    $value = 0;
		                                    $sub_total = 0;
		                                    $sub_total = 0;
		                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
		                                    ?> 
		                                    @if(!empty($reviews[0]))
		                                    <?php
		                                    $count =  App\ReviewRating::where('course_id',$course->id)->count();

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
		                                        <div class="pull-left"><p>No Ratings</p></div>
		                                    @endif
		                                  </li>
                                            
                                            <!-- overall rating -->
                                            <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $count =  count($reviews);
                                            $onlyrev = array();

                                            $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

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
                                                $reviewsrating = App\ReviewRating::where('course_id', $course->id)->first();
                                            @endphp
                                            @if(!$reviews->isEmpty())
                                            <li>
                                                <b>({{ round($overallrating, 1) }})</b>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                    <ul>
                                        <li>
                                        	(@php
				                                $data = App\ReviewRating::where('course_id', $course->id)->get();
				                                if(count($data)>0){

				                                    echo count($data);
				                                }
				                                else{

				                                    echo "0";
				                                }
				                            @endphp ratings)
                                        </li> 
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @if($course['whatlearns']->isNotEmpty())
                            <div id="prime-next-item-description-block{{$course->id}}" class="prime-description-block">
                            <div class="prime-description-under-block">
                                <div class="prime-description-under-block">
                                    <h6 >What you will learn</h6>
                                    
                                    @foreach($course['whatlearns'] as $wl)
                                    @if($wl->status ==1)
                                        <div class="product-learn-dtl protip-whatlearn">
                                            <ul>
                                                <li><i class="fa fa-check"></i>{{ str_limit($wl['detail'], $limit = 120, $end = '...') }}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                            </div>
                        @endif
                        
                    </div>
                    <hr>
                    @endif
                    @endforeach

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="top-20">{{ $courses->links() }}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- categories end -->
@endsection
