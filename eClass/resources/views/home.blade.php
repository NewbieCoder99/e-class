@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')
<!-- categories-tab start-->
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">
            @php
                $category = App\Categories::orderBy('position','ASC')->get();
            @endphp
            @foreach($category as $cat)
                @if($cat->status == 1)
                <div class="item categories-tab-dtl">
                    <a href="{{ route('category.page',$cat->id) }}" title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>{{ $cat->title }}</a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<!-- categories-tab end-->
@php
$sliders = App\Slider::orderBy('position', 'ASC')->get();
@endphp
@if(isset($sliders))
<section id="home-background-slider" class="background-slider-block owl-carousel">
    <div class="item home-slider-img">
        @foreach($sliders as $slider)
        @if($slider->status == 1)
        <div id="home" class="home-main-block" style="background-image: url('{{ asset('images/slider/'.$slider['image']) }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-dtl">
                            <div class="home-heading text-white">{{ $slider['heading'] }}</div>
                            <p class="text-white btm-10">{{ $slider['sub_heading'] }}</p>
                            <p class="text-white btm-20">{{ $slider['detail'] }}</div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

<!-- home end -->
<!-- learning-work start -->
@php
    $facts = App\SliderFacts::limit(3)->get();
@endphp
@if(isset($facts))
<section id="learning-work" class="learning-work-main-block">
    <div class="container">
        <div class="row">
            @foreach($facts as $fact)
            <div class="col-lg-4 col-sm-6">
                <div class="learning-work-block text-white">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="learning-work-icon">
                                <i class="fa {{ $fact['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="learning-work-dtl">
                                <div class="work-heading">{{ $fact['heading'] }}</div>
                                <p>{{ $fact['sub_heading'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- learning-work end -->
<!-- learning-courses start -->
@php
    $categories = App\CategorySlider::first();
@endphp
@if(isset($categories))
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container">
        <div class="row">
            @php
                $items = App\CourseText::first();
            @endphp
            @if(isset($items))
            
            <div class="col-lg-3">
                <div class="learning-selection">
                    <div class="selection-heading">{{ $items['heading'] }}</div>
                    <p>{{ $items['sub_heading'] }}</p>
                </div>
            </div>
           
            @endif
            <div class="col-lg-9">
                <div class="learning-courses">
                    @php
                        $categories = App\CategorySlider::first();
                    @endphp
                    @if(isset($categories->category_id))
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      @foreach($categories->category_id as $cate)
                        @php
                            $cats= App\Categories::find($cate);
                        @endphp
                        @if($cats['status'] == 1)
                            <li class="btn nav-item" ><a class="nav-item nav-link" id="home-tab" data-toggle="tab" href="#content-tabs" role="tab" aria-controls="home" onclick="showtab('{{ $cats->id }}')" aria-selected="true">{{ $cats['title'] }}</a></li>
                        @endif
                      @endforeach
                    </ul>
                    @endif
                </div>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($categories))
                        @foreach($categories->category_id as $cate)
                            <div class="tab-pane fade show active" id="content-tabs" role="tabpanel" aria-labelledby="home-tab">
                                
                                <div id="tabShow">
                                    
                                </div>
                                
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- learning-courses end -->
<!-- Student start -->
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $cor = App\Course::all();
        @endphp
        @if( ! $cor->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.FeaturedCourses') }}</h4>
        <div id="student-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($cor as $c)
              @if($c->status == 1 && $c->featured == 1)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$c->id}}">
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
                                <div class="img-wishlist">
                                    <div class="protip-wishlist">
                                        <ul>
                                            @if(Auth::check())
                                                @php
                                                    $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                @endphp
                                                @if ($wish == NULL)
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post" action="{{ url('show/wishlist', $c->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                            <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $c->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                            <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @endif 
                                            @else
                                                <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block{{$c->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $c['title'] }}</h5>
                                <div class="protip-img">
                                    @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
                                        <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ asset('images/course/'.$c['preview_image']) }}" alt="student" class="img-fluid">
                                        </a>
                                    @else
                                        <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ Avatar::create($c->title)->toBase64() }}" alt="student" class="img-fluid">
                                        </a>
                                    @endif
                                </div>

                                <ul class="description-list">
                                    <li>{{ __('frontstaticword.Classes') }}: 
                                        @php
                                            $data = App\CourseClass::where('course_id', $c->id)->get();
                                            if(count($data)>0){

                                                echo count($data);
                                            }
                                            else{

                                                echo "0";
                                            }
                                        @endphp
                                    </li>
                                    &nbsp;
                                    <li>
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
                                    </li>
                                </ul>

                                <div class="main-des">
                                    <p>{{ $c->short_detail }}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            @if($c->type == 1)
                                                @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $order = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if(!empty($order) && $order->status == 1)
                                                            <div class="protip-btn">
                                                                <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                                            </div>
                                                        @else
                                                            @php
                                                                $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                            @endphp
                                                            @if(!empty($cart))
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                                        {{ csrf_field() }}
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $c->id, 'price' => $c->price, 'discount_price' => $c->discount_price ]) }}"
                                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                                            {{ csrf_field() }}

                                                                        <input type="hidden" name="category_id"  value="{{$c->category['id']}}" />
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.AddToCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                                    </div>
                                                @endif
                                            @else
                                                 @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if($enroll == NULL)
                                                            <div class="protip-btn">
                                                                <a href="{{url('enroll/show',$c->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                            </div>
                                                        @else
                                                            <div class="protip-btn">
                                                                <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.GoToCourse') }}</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="protip-wishlist">
                                                <ul>
                                                    @if(Auth::check())
                                                        @php
                                                            $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if ($wish == NULL)
                                                            <li class="protip-wish-btn">
                                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $c->id) }}" data-parsley-validate 
                                                                    class="form-horizontal form-label-left">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                                    <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                                    <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                                </form>
                                                            </li>
                                                        @else
                                                            <li class="protip-wish-btn-two">
                                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $c->id) }}" data-parsley-validate 
                                                                    class="form-horizontal form-label-left">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                                    <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                                    <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                                </form>
                                                            </li>
                                                        @endif 
                                                    @else
                                                        <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
              @endif
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- Students end -->

<!-- Bundle start -->
<section id="student" class="student-main-block">
    <div class="container">

        @php
            $bundles = App\BundleCourse::get();
        @endphp
        
        @if( ! $bundles->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.BundleCourses') }}</h4>
        <div id="bundle-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($bundles as $bundle)
                @if($bundle->status == 1)
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-3{{$bundle->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== '')
                                    <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ asset('images/bundle/'.$bundle['preview_image']) }}" alt="course" class="img-fluid"></a>
                                @else
                                    <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="course" class="img-fluid"></a>
                                @endif
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('bundle.detail', $bundle->id) }}">{{ str_limit($bundle->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">by {{ $bundle->user['fname'] }}</a></p>

                                <p class="btm-10"><a herf="#">Created At: {{ date('d-m-Y',strtotime($bundle['created_at'])) }}</a></p>

                                @if($bundle->type == 1)
                                    <div class="rate text-right">
                                        <ul>
                                            @php
                                                $currency = App\Currency::first();
                                            @endphp

                                            @if($bundle->discount_price == !NULL)

                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $bundle->discount_price }}</b></a></li>&nbsp;
                                                <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $bundle->price }}</strike></b></a></li>
                                                
                                            @else
                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $bundle->price }}</b></a></li>
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
                    <div id="prime-next-item-description-block-3{{$bundle->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $bundle['title'] }}</h5>
                                <div class="protip-img">
                                    @if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== '')
                                        <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ asset('images/bundle/'.$bundle['preview_image']) }}" alt="student" class="img-fluid">
                                        </a>
                                    @else
                                        <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="student" class="img-fluid">
                                        </a>
                                    @endif
                                </div>

                                

                                <div class="main-des">
                                    <p>{!! str_limit($bundle['detail'], $limit = 200, $end = '...') !!}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if($bundle->type == 1)
                                                @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $order = App\Order::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                                        @endphp
                                                        @if(!empty($order) && $order->status == 1)
                                                            <div class="protip-btn">
                                                                <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                            </div>
                                                        @else
                                                            @php
                                                                $cart = App\Cart::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                                            @endphp
                                                            @if(!empty($cart))
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                                        {{ csrf_field() }}
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('bundlecart', $bundle->id) }}"
                                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                                            {{ csrf_field() }}

                                                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                                        <input type="hidden" name="bundle_id"  value="{{$bundle->id}}" />
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.AddToCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                                    </div>
                                                @endif
                                            @else
                                                 @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if($enroll == NULL)
                                                            <div class="protip-btn">
                                                                <a href="{{url('enroll/show',$bundle->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                            </div>
                                                        @else
                                                            <div class="protip-btn">
                                                                <a href="" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.Purchased') }}</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 

                @endif
             
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- Bundle end -->

<!-- Zoom start -->
@if($gsetting->zoom_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $meetings = App\Meeting::where('link_by', NULL)->get();
            $mytime = Carbon\Carbon::now();
        @endphp
        @if( ! $meetings->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.ZoomMeetings') }}</h4>
        <div id="zoom-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($meetings as $meeting)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-2{{$meeting->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($meeting['meeting_title'] !== NULL && $meeting['meeting_title'] !== '')
                                    <img src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course" class="img-fluid">
                                @endif
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10">{{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</div>
                                <p class="btm-10"><a herf="#">by {{ $meeting->user['fname'] }}</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-2{{$meeting->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $meeting['meeting_title'] }}</h5>
                                <div class="protip-img">
                                    <h3 class="description-heading">by {{ $meeting->user['fname'] }}</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner: {{ $meeting->owner_id }}</a></p>
                                </div>
                                <div class="main-des">
                                    <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                </div>
                                <div class="des-btn-block">
                                    <a href="{{ $meeting->zoom_url }}" target="_blank" class="btn btn-light">Join Meeting</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- Zoom end -->


<!-- Bundle start -->
@if($gsetting->bbl_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">

        @php
            $bigblue = App\BBL::where('is_ended','!=',1)->where('link_by', NULL)->get();
        @endphp
        
        @if( ! $bigblue->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.BigBlueMeetings') }}</h4>
        <div id="bbl-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($bigblue as $bbl)
                
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-4{{$bbl->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                <a href="{{ route('bbl.detail', $bbl->id) }}"><img src="{{ Avatar::create($bbl['meetingname'])->toBase64() }}" alt="course" class="img-fluid"></a>
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('bbl.detail', $bbl->id) }}">{{ str_limit($bbl['meetingname'], $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">by {{ $bbl->user['fname'] }}</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($bbl['start_time'])) }}</a></p>
                              
                            </div>
                           
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-4{{$bbl->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $bbl['meetingname'] }}</h5>
                                <div class="protip-img">
                                    <a href="{{ route('bbl.detail', $bbl->id) }}"><img src="{{ Avatar::create($bbl->user['fname'])->toBase64() }}" alt="course" class="img-fluid"></a>
                                </div>

                                <div class="main-des">
                                    <p>{!! $bbl['detail'] !!}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- Bundle end -->
<!-- recommendations start -->
<section id="border-recommendation" class="border-recommendation">
    @php
        $gets = App\GetStarted::first();
    @endphp
    @if(isset($gets)) 
    <div class="top-border"></div>
    <div class="recommendation-main-block  text-center" style="background-image: url('{{ asset('images/getstarted/'.$gets['image']) }}')">
        <div class="container">
            <h3 class="text-white">{{ $gets['heading'] }}</h3>
            <p class="text-white btm-20">{{ $gets['sub_heading'] }}</p>
            @if($gets->button_txt == !NULL)
            <div class="recommendation-btn text-white">
                <a href="{{ url('/') }}" class="btn btn-primary " title="search">{{ $gets['button_txt'] }}</a>
            </div>
            @endif 
        </div>
    </div>
    @endif
</section>
<!-- recommendations end -->
<!-- categories start -->
@php
    $topcats = App\Categories::orderBy('position', 'ASC')->get();
@endphp
@if(!$topcats->isEmpty())
<section id="categories" class="categories-main-block">
    <div class="container">
        
        <h3 class="categories-heading btm-30">{{ __('frontstaticword.TopCategories') }}</h3>
        <div class="row">
            @foreach($topcats as $t)
            @if($t->status == 1)
            <div class="col-lg-3 col-sm-6">
                <div class="categories-block">
                    <ul>
                        <li><a href="#" title="{{ $t['title'] }}"><i class="fa {{ $t['icon'] }}"></i>
                        </a></li>
                        <li><a href="{{ route('category.page',$t->id) }}">{{ $t['title'] }}</a></li>
                    </ul>
                </div>      
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- categories end -->
<!-- testimonial start -->
 @php
    $testi = App\Testimonial::all();
@endphp
@if( ! $testi->isEmpty() )
<section id="testimonial" class="testimonial-main-block">
    <div class="container">
        <h3 class="btm-30">{{ __('frontstaticword.HomeTestimonial') }}</h3>
        <div id="testimonial-slider" class="testimonial-slider-main-block owl-carousel">
            
            @foreach($testi as $tes)
             @if($tes->status == 1)
            <div class="item testimonial-block">
                <ul>
                    <li><img src="{{ asset('images/testimonial/'.$tes['image']) }}" alt="blog"></li>
                    <li><h5 class="testimonial-heading">{{ $tes['client_name'] }}</h5></li>
                </ul>
                <p>{!! str_limit($tes->details , $limit = 300, $end = '...') !!}</p>
            </div>
             @endif
            @endforeach
        </div> 
        
    </div>
</section>
@endif

@php
    $trusted = App\Trusted::all();
@endphp
@if( !$trusted->isEmpty() )
<section id="trusted" class="trusted-main-block">
    <div class="container">
        <div class="patners-block">
            
            <h6 class="patners-heading text-center btm-40">{{ __('frontstaticword.Trusted') }}</h6>
            <div id="patners-slider" class="patners-slider owl-carousel">
                @foreach($trusted as $trust)
                    @if($trust->status == 1)
                    <div class="item-patners-img">
                        <a href="{{ $trust['url'] }}" target="_blank"><img src="{{ asset('images/trusted/'.$trust['image']) }}" class="img-fluid" alt="patners-1"></a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
</section>
@endif

<section id="trusted" class="trusted-main-block">
    <!-- google adsense code -->
    <div class="container-fluid" id="adsense">
        @php
            $ad = App\Adsense::first();
        @endphp
        <?php
            if (isset($ad) ) {
             if ($ad->ishome==1 && $ad->status==1) {
                $code = $ad->code;
                echo html_entity_decode($code);
             }
            }
        ?>
    </div>
</section>

@endsection

@section('custom-script')
<script>
    (function($) {
      "use strict";
        $(function() {
           $( "#home-tab" ).trigger( "click" );
        });
    })(jQuery);

    function showtab(id){
        $.ajax({
            type : 'GET',
            url  : '{{ url('/tabcontent') }}/'+id,
            dataType  : 'html',
            success : function(data){

                $('#tabShow').html('');
                $('#tabShow').append(data);
            }
        });
    }
</script>

@endsection
