@extends('theme.master')
@section('title', 'Wishlist')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">{{ __('frontstaticword.Wishlist') }}</h1>
    </div>
</section> 
<!-- about-home end -->

@php
    $item = App\Wishlist::where('user_id', Auth::User()->id)->get();
@endphp

@if(count($item) > 0)
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container">
        <div class="row">
        	@foreach($wishlist as $wish)
        	@if($wish->user_id == Auth::User()->id)
                <div class="col-lg-3 col-sm-6 col-md-4">
                    <div class="view-block">
                        <div class="view-img">
                            @if($wish->courses['preview_image'] !== NULL && $wish->courses['preview_image'] !== '')
                                <a href="{{ route('user.course.show',['id' => $wish->courses->id, 'slug' => $wish->courses->slug ]) }}"><img src="{{ asset('images/course/'.$wish->courses->preview_image) }}" class="img-fluid" alt="course">
                            @else
                                <a href="{{ route('user.course.show',['id' => $wish->courses->id, 'slug' => $wish->courses->slug ]) }}"><img src="{{ Avatar::create($wish->courses->title)->toBase64() }}" class="img-fluid" alt="course">
                            @endif
                            </a>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $wish->courses->id, 'slug' => $wish->courses->slug ]) }}">{{ str_limit($wish->courses->title, $limit = 35, $end = '...') }}</a></div>
                            <p class="btm-10"><a href="#">by {{ $wish->courses->user->fname }}</a></p>
                            <div class="rating">
                                <ul>
                                    <li>
                                        {{-- star rating --}}
                                        <?php 
                                        $learn = 0;
                                        $price = 0;
                                        $value = 0;
                                        $sub_total = 0;
                                        $sub_total = 0;
                                        $reviews = App\ReviewRating::where('course_id',$wish->courses->id)->where('status','1')->get();
                                        ?> 
                                        @if(!empty($reviews[0]))
                                            <?php
                                            $count =  App\ReviewRating::where('course_id',$wish->courses->id)->count();

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
                                            <div class="pull-left">
                                                {{ __('frontstaticword.NoRating') }}
                                            </div>
                                        @endif
                                    </li>

                                    @php
                                    $reviews = App\ReviewRating::where('course_id' ,$wish->courses->id)->get();
                                    @endphp
                                    <?php 
                                    $learn = 0;
                                    $price = 0;
                                    $value = 0;
                                    $sub_total = 0;
                                    $count =  count($reviews);
                                    $onlyrev = array();

                                    $reviewcount = App\ReviewRating::where('course_id', $wish->courses->id)->where('status',"1")->WhereNotNull('review')->get();

                                    foreach($reviewcount as $review){

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
                                        $reviewsrating = App\ReviewRating::where('course_id', $wish->courses->id)->first();
                                    @endphp
                                    @if(!empty($reviewsrating))
                                    <li>
                                        <b>{{ round($overallrating, 1) }}</b>
                                    </li>
                                    @endif
                                  
                                    <li>({{ $wish->order->count() }})</li> 
                                </ul>
                            </div>
                            @if($wish->courses->type == 1)
                            <div class="rate text-right">
                                <ul>
                                    @php
                                        $currency = App\Currency::first();
                                    @endphp 
                                    @if($wish->courses->discount_price == !NULL)

                                        <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $wish->courses->price }}</s></li>
                                        <li><b><i class="{{ $currency->icon }}"></i>{{ $wish->courses->discount_price }}</b></li>
                                    @else
                                        <li><b><i class="{{ $currency->icon }}"></i>{{ $wish->courses->price }}</b></li>
                                    @endif
                                </ul>
                            </div>
                            @else
                            <div class="rate text-right">
                                <ul>
                                  <li><b>{{ __('frontstaticword.Free') }}</b></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="wishlist-action">
                        <div class="row">
                        	<div class="col-md-6 col-6">
                               
                                @if($wish->courses->type == 1)
                                <div class="cart-btn">
                                    <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $wish->courses->id, 'price' => $wish->courses->price, 'discount_price' => $wish->courses->discount_price ]) }}"
                                            data-parsley-validate class="form-horizontal form-label-left">
                                            {{ csrf_field() }}
                                            
                                            <input type="hidden" name="category_id"  value="{{$wish->courses->category['id']}}" />
                                                
                                        
                                         <button type="submit" class="btn btn-primary"  title="Add To Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                                @endif
                        	</div>
                        	<div class="col-md-6 col-6">
                                <div class="wishlist-btn txt-rgt">
                                    <form  method="post" action="{{url('delete/wishlist', $wish->id)}}" data-parsley-validate class="form-horizontal form-label-left">
            	                        {{ csrf_field() }}
            	                        
            	                      <button type="submit" class="btn btn-primary " title="Remove From Wishlist"><i class="fa fa-trash"></i></button>
            	                    </form>
                                </div>
                        	</div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
    <div class="container-fluid" id="adsense">
        <!-- google adsense code -->
        <?php
          if (isset($ad)) {
           if ($ad->iswishlist==1 && $ad->status==1) {
              $code = $ad->code;
              echo html_entity_decode($code);
           }
          }
        ?>
    </div>
</section>
@else
    <section id="search-block" class="search-main-block search-block-no-result text-center">
        <div class="container">
            <div class="no-result-courses btm-10">{{ __('frontstaticword.emptywishlist') }}</div>
            <div class="recommendation-btn text-white text-center">
                <a href="{{ url('/') }}" class="btn btn-primary" title="search"><b>{{ __('frontstaticword.Browse') }}</b></a>
            </div> 
        </div>
    </section>
@endif

@endsection
