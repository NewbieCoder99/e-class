@php
    $cats= App\Categories::find($cate);
@endphp


<div class="row no-gutters">
    @foreach($cats->courses->take(3) as $c)
    @if($c->status == 1)
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="item immi-slider-block development">
                <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$c->id}}">
                    <div class="view-block">
                        <div class="view-img">
                            @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
                                <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ asset('images/course/'.$c['preview_image']) }}" alt="course" class="img-fluid" >
                                </a>
                            @else
                                <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ Avatar::create($c->title)->toBase64() }}" alt="course"class="img-fluid">
                                </a>
                            @endif
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}">{{ str_limit($c['title'], $limit = 35, $end = '...') }}</a></div>
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
                                    
                                    {{-- overall rating --}}
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

                                            <li><a><b><i class="{{ $currency['icon'] }}"></i>{{ $c['discount_price'] }}</b></a></li>&nbsp;
                                            <li><a><b><strike><i class="{{ $currency['icon'] }}"></i>{{ $c['price'] }}</strike></b></a></li>
                                            
                                        @else
                                            <li><a><b><i class="{{ $currency['icon'] }}"></i>{{ $c->price }}</b></a></li>
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

                                            <li><a><b><i class="{{ $currency['icon'] }}"></i>{{ $c['discount_price'] }}</b></a></li>&nbsp;
                                            <li><a><b><strike><i class="{{ $currency['icon'] }}"></i>{{ $c['price'] }}</strike></b></a></li>
                                            
                                        @else
                                            <li><a><b><i class="{{ $currency['icon'] }}"></i>{{ $c->price }}</b></a></li>
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
                                                        <a href="{{url('show/coursecontent',$c->id)}}" class="btn btn-secondary" title="course">Go To Course</a>
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

                                                                    <input type="hidden" name="category_id"  value="{{$c->category->id}}" />
                                                                            
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
    @endif
    @endforeach
</div>


@php
    $count = $cats->courses->where('status','=','1')->count();
@endphp
@if($count >= 3)
    <div class="view-button txt-rgt">
        <a href="{{ route('category.page',$cats->id) }}" class="btn btn-secondary" title="View More">{{ __('frontstaticword.ViewMore') }}</a>
    </div>
@endif