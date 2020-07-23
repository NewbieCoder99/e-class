@extends('theme.master')
@section('title', 'Purchase History')
@section('content')

@include('admin.message')



<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.PurchaseHistory') }}</h1>
    </div>
</section> 
<!-- about-home start -->

<!-- about-home end -->
<section id="purchase-block" class="purchase-main-block">
	<div class="container">
		<div class="purchase-table table-responsive">
	        <table class="table">
			  <thead>
			    <tr>
	                <th class="purchase-history-heading">{{ __('frontstaticword.PurchaseHistory') }}</th>
				    <th class="purchase-text">{{ __('frontstaticword.Enrollon') }}</th>
				    <th class="purchase-text">{{ __('frontstaticword.EnrollEnd') }}</th>
				    <th class="purchase-text">{{ __('frontstaticword.PaymentMode') }}</th>
				    <th class="purchase-text">{{ __('frontstaticword.TotalPrice') }}</th>
				    <th class="purchase-text">{{ __('frontstaticword.PaymentStatus') }}s</th>
				    <th class="purchase-text">{{ __('frontstaticword.Actions') }}</th>
				    
			    </tr>
			  </thead>
				
				@foreach($orders as $order)
				@if($order->user_id == Auth::User()->id)
		            <div class="purchase-history-table">
		            	<tbody>
			            	<tr>
				    			<td >
				                    <div class="purchase-history-course-img">
				                    	@if($order->course_id != NULL)
					                    	@if($order->courses['preview_image'] !== NULL && $order->courses['preview_image'] !== '')
					                        	<a href="{{ route('user.course.show',['id' => $order->courses->id, 'slug' => $order->courses->slug ]) }}"><img src="{{ asset('images/course/'. $order->courses->preview_image) }}" class="img-fluid" alt="course"></a>
					                        @else
					                        	<a href="{{ route('user.course.show',['id' => $order->courses->id, 'slug' => $order->courses->slug ]) }}"><img src="{{ Avatar::create($order->courses->title)->toBase64() }}" class="img-fluid" alt="course"></a>
					                        @endif
				                        @else
				                        	@if($order->bundle['preview_image'] !== NULL && $order->bundle['preview_image'] !== '')
					                        	<a href="{{ route('bundle.detail', $order->bundle->id) }}"><img src="{{ asset('images/bundle/'. $order->bundle->preview_image) }}" class="img-fluid" alt="course"></a>
					                        @else
					                        	<a href="{{ route('bundle.detail', $order->bundle->id) }}"><img src="{{ Avatar::create($order->bundle->title)->toBase64() }}" class="img-fluid" alt="course"></a>
					                        @endif
					                    @endif

				                    </div>
				                    <div class="purchase-history-course-title">
				                    	@if($order->course_id != NULL)
				                        <a href="{{ route('user.course.show',['id' => $order->courses->id, 'slug' => $order->courses->slug ]) }}">{{ $order->courses->title }}</a>
				                        @else
				                        <a href="{{ route('bundle.detail', $order->bundle->id) }}">{{ $order->bundle->title }}</a>
				                        @endif
				                    </div>
				                </td>
				                <td>
				                   	<div class="purchase-text">{{ date('jS F Y', strtotime($order->created_at)) }}</div>			                   	
				                </td>

				                <td>
				                	<div class="purchase-text">
				                		@if($order->course_id != NULL)
				                		@if($order->enroll_expire != NULL)
				                            {{ date('jS F Y', strtotime($order->enroll_expire)) }}
				                        @else
				                            -
				                        @endif
				                        @endif
				                	</div>
				                </td>

				                <td>   
				                    <div class="purchase-text">{{ $order->payment_method }}</div>
				                </td>

				              
				                
				                <td>
				                	@if($order->coupon_discount == !NULL)
				                    	<div class="purchase-text"><b><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount - $order->coupon_discount }}</b></div>
				                    @else
				                    	<div class="purchase-text"><b><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount }}</b></div>
				                    @endif

				                </td>

				                <td>
				                	<div class="purchase-text">
				                		@if($order->status ==1)
				                            {{ __('frontstaticword.Recieved') }}
				                        @else
				                            {{ __('frontstaticword.Pending') }}
				                        @endif
				                	</div>
				                </td>
				               
				                <td>
				                    <div class="invoice-btn">
				                    	
				                    	<a href="{{route('invoice.show',$order->id)}}"  class="btn btn-secondary">{{ __('frontstaticword.Invoice') }}</a>
				                    	
				                    </div>

				                </td>
				                
				               
				            </tr>
				        </tbody>
		            </div>
	            @endif
	            @endforeach
	        </table>
        </div>
	</div>
</section>

@endsection
