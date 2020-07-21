@extends('theme.master')
@section('title', "$bundle->title")
@section('content')

@include('admin.message')
<!-- course detail header start -->
<section id="about-home" class="about-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-home-block text-white">
                    <h1 class="about-home-heading text-white">{{ $bundle['title'] }}</h1>
                    <ul>
                       
                    <ul>
                        <li><a href="#" title="about">{{ __('frontstaticword.Created') }}: {{ $bundle->user['fname'] }} </a></li>
                        <li><a href="#" title="about">{{ __('frontstaticword.LastUpdated') }}: {{ date('jS F Y', strtotime($bundle['updated_at'])) }}</a></li>
                        
                    </ul>
                </div>
            </div>
            <!-- course preview -->
            <div class="col-lg-4">
                
                
                <div class="about-home-product">
                    <div class="video-item hidden-xs">
                       
                        <div class="video-device">
                            @if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== '')
                                <img src="{{ asset('images/bundle/'.$bundle['preview_image']) }}" class="bg_img img-fluid" alt="Background">
                            @else
                                <img src="{{ Avatar::create($bundle->title)->toBase64() }}" class="bg_img img-fluid" alt="Background">
                            @endif
                           
                        </div>
                    </div>
               
                     
                    <div class="about-home-dtl-training">
                        <div class="about-home-dtl-block btm-10">
                        @if($bundle->type == 1)
                            <div class="about-home-rate">
                                <ul>
                                    @php
                                        $currency = App\Currency::first();
                                    @endphp
                                    @if($bundle->discount_price == !NULL) 
                                        <li><i class="{{ $currency['icon'] }}"></i>{{ $bundle['discount_price'] }}</li>
                                        <li><span><s><i class="{{ $currency->icon }}"></i>{{ $bundle['price'] }}</s></span></li>
                                    @else
                                        <li><i class="{{ $currency['icon'] }}"></i>{{ $bundle['price'] }}</li>
                                    @endif

                                </ul>
                            </div>
                            @if(Auth::check())
                                @if(Auth::User()->role == "admin")
                                    <div class="about-home-btn btm-20">
                                        <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                    </div>
                                @else
                                    

                                    @php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                    @endphp

                                   

                                    @if(!empty($order) && $order->status == 1)
                                       
                                        <div class="about-home-btn btm-20">
                                            <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>

                                    @else
                                        @php
                                            $cart = App\Cart::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                        @endphp
                                        @if(!empty($cart))
                                            <div class="about-home-btn btm-20">
                                                <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                    {{ csrf_field() }}
                                                            
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="about-home-btn btm-20">
                                                <form id="demo-form2" method="post" action="{{ route('bundlecart', $bundle->id) }}"
                                                    data-parsley-validate class="form-horizontal form-label-left">
                                                        {{ csrf_field() }}
                                                            
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <div class="about-home-btn btm-20">
                                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                </div>
                            @endif
                        @else
                            <div class="about-home-rate">
                                <ul>
                                    <li>Free</li>
                                </ul>
                            </div>
                            @if(Auth::check())
                                @if(Auth::User()->role == "admin")
                                    <div class="about-home-btn btm-20">
                                        <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                    </div>
                                @else
                                    @php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                    @endphp
                                    @if($enroll == NULL)
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('bundle/enroll',$bundle->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                        </div>
                                    @else
                                        <div class="about-home-btn btm-20">
                                            <a href="" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <div class="about-home-btn btm-20">
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
</section>
<!-- course header end -->
<!-- course detail start -->
<section id="about-product" class="about-product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="requirements">
                    <h3>{{ __('frontstaticword.Detail') }}</h3>
                    <ul>
                        <li class="comment more">
                           
                           {!! $bundle->detail !!}
                           
                        </li>
                       
                    </ul>
                </div>
                <div class="course-content-block btm-30">
                    <h3>{{ __('frontstaticword.CoursesInBundle') }}</h3>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">
                                @foreach($bundle->course_id as $bundles)

                                @php
                                	$course = App\Course::where('id', $bundles)->first();
                                @endphp
                                                               
                                <div class="card">
                                    <div class="card-header" id="headingTwo{{ $course->id }}">
                                        <div class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo{{ $course->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                               
                                                <div class="row">
	                                                <div class="col-lg-8 col-6">
	                                                    <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}">{{ $course->title }}</a>
	                                                </div>
	                                                
	                                            </div>
                                            
                                            </button>
                                        </div>

                                    </div>

                                    <div id="collapseTwo{{ $course->id }}" class="collapse {{ $loop->first ? "show" : "" }}" aria-labelledby="headingTwo" data-parent="#accordion">
                                        
                                        <div class="card-body">
                                            <table class="table">  
                                                <tbody>
                                                	<tr>
                                                        <td class="class-icon">
                                                    		{{ $course->short_detail }}
                                                    	</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   
                                </div>

                               
                             
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- course detail end -->
@endsection

