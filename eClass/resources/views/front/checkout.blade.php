@extends('theme.master')
@section('title', 'Checkout')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">{{ __('frontstaticword.Checkout') }}</h1>
    </div>
</section> 
<!-- about-home end -->
<section id="checkout-block" class="checkout-main-block">
	<div class="container">
		<div class="cart-items btm-30">
	        <div class="row">
	        	<div class="col-lg-4 col-sm-4">
	        		<h4 class="cart-heading">{{ __('frontstaticword.YourItems') }}
            		(@php
                        $item = App\Cart::where('user_id', Auth::User()->id)->get();
                        if(count($item)>0){

                            echo count($item);
                        }
                        else{

                            echo "0";
                        }
                    @endphp)
	            	</h4>
	            	<hr>
	            	<div class="checkout-items">
	            		@foreach($carts as $cart)
			            	<div class="row btm-10">
			            		<div class="col-lg-3 col-4">
			            			<div class="checkout-course-img">
			            				@if($cart->course_id != NULL)
				            				@if($cart->courses['preview_image'] !== NULL && $cart->courses['preview_image'] !== '')
				            					<a href="{{ route('user.course.show',['id' => $cart->courses->id, 'slug' => $cart->courses->slug ]) }}"><img src="{{ asset('images/course/'. $cart->courses->preview_image) }}" class="img-fluid" alt="course"></a>
				            				@else
												<a href="{{ route('user.course.show',['id' => $cart->courses->id, 'slug' => $cart->courses->slug ]) }}"><img src="{{ Avatar::create($cart->courses->title)->toBase64() }}" class="img-fluid" alt="course"></a>
				            				@endif
			            				@else
			            					@if($cart->bundle['preview_image'] !== NULL && $cart->bundle['preview_image'] !== '')
			                                	<img src="{{ asset('images/bundle/'. $cart->bundle->preview_image) }}" class="img-fluid" alt="blog">
			                                @else
			                                	<img src="{{ Avatar::create($cart->bundle->title)->toBase64() }}" class="img-fluid" alt="blog">
			                                @endif
		                                @endif
			            			</div>
			            		</div>
			            		<div class="col-lg-9 col-8">
			            			<ul>
			            				@if($cart->course_id != NULL)
			            					<li class="checkout-course-title"><a href="{{ route('user.course.show',['id' => $cart->courses->id, 'slug' => $cart->courses->slug ]) }}">{{ str_limit($cart->courses->title, $limit =35 , $end = '...') }}</a></li>
			            				@else
			            					<li class="checkout-course-title"><a href="{{ route('user.course.show',['id' => $cart->bundle->id, 'slug' => $cart->bundle->slug ]) }}">{{ str_limit($cart->bundle->title, $limit =35 , $end = '...') }}</a></li>
			            				@endif
			            				<li class="checkout-course-user">By {{ $cart->user->fname }}</li>
			            				@php
		                                    $currency = App\Currency::first();
		                                @endphp 
		                                @if($cart->offer_price == !NULL)
			            					<li class="checkout-course-price"><b><i class="{{ $currency->icon }}"></i>{{ $cart->offer_price }}</b>  <s><i class="{{ $currency->icon }}"></i>{{ $cart->price }}</s></li>
			            				@else
			            					<li class="checkout-course-price"><b><i class="{{ $currency->icon }}"></i>{{ $cart->price }}</b></li>
			            				@endif
			            			</ul>
			            		</div>
			            	</div>
	            		@endforeach
	            	</div>
                </div>
	            <div class="col-lg-8 col-sm-8">
	            	<div class="checkout-pricelist">
		            	<ul>
		            		<li><h1 class="checkout-total">{{ __('frontstaticword.Total') }}: <i class="{{ $currency->icon }}"></i>{{ $cart_total }}</h1></li>
		            		<li><div class="checkout-price"><s><i class="{{ $currency->icon }}"></i>{{ $price_total }}</s></div></li>
		            		<li><div class="checkout-percent">{{ round($offer_percent, 0) }}% Off</div></li>

		            		@php
		            			if($cart_total != '' || $cart_total != 0){
		            				$mainpay = round($cart_total,2);
		            			}else{
		            				$mainpay = round($cart_total,2);
		            			}
		            		@endphp
		            		
		            	</ul>
	            	</div>
	            	@php  			
        				$secureamount = Crypt::encrypt($mainpay);
        			@endphp
	            	<div class="payment-gateways">
	            		<div id="accordion" class="second-accordion">
	            			@if($gsetting->paypal_enable == 1)
						    <div class="card">
	                            <div class="card-header" id="headingOne">
							        <div class="panel-title">
							            <label for='r11'>
								            <input type='radio' id='r11' name='occupation' value='Working' required />
								            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
								              
								            <img src="{{ url('images/payment/paypal2.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseOne" class="panel-collapse collapse in">
							        <div class="card-body">
		                            
		                            	<div class="payment-proceed-btn">
		                            		<form action="{{ route('payWithpaypal') }}" method="POST" autocomplete="off">
		                            			@csrf
		                            			
		                         				<input type="hidden" name="amount" value="{{ $secureamount  }}"/>
		                         				{{-- <input type="hidden" name="course_id" value="{{ $cart->courses->id }}"/> --}}
		                            			<button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
		                            		</form>
		                            		
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif
							@if($gsetting->instamojo_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingTwo">
							        <div class="panel-title">
							            <label for='r12'>
								            <input type='radio' id='r12' name='occupation' value='Working' required />
								            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a>

							            	<img src="{{ url('images/payment/instamojo.png') }}" class="img-fluid-img" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseTwo" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">

		                            		<form action="{{ url('pay') }}" method="POST" name="laravel_instamojo" autocomplete="off">
											    {{ csrf_field() }}
											    
											     <div class="row">
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Name</strong>
											                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Mobile Number</strong>
											                <input type="text" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" required autocomplete="off">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Email Id</strong>
											                <input type="email" name="email" class="form-control" placeholder="Enter Email id" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <input type="hidden" name="amount" class="form-control" placeholder="" value="{{ $mainpay }}" readonly="">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
											        </div>
											    </div>
											     
											</form>
		                            		
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif
							@if($gsetting->stripe_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingThree">
							        <div class="panel-title">
							            <label for='r13'>
							              <input type='radio' id='r13' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
							              <img src="{{ url('images/payment/stripe.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseThree" class="panel-collapse collapse in">
							        <div class="card-body">
								      
									    <div class="creditCardForm">
										  
										    <div class="payment">
										        <form accept-charset="UTF-8" action="{{route('stripe.pay')}}" method="POST"autocomplete="off">
										    		{{ csrf_field() }}
										            <div class="form-group owner">
										                <label for="owner">Owner</label>
										                <input type="text" class="form-control" id="owner" required>
										            </div>
										            <div class="form-group CVV">
										                <label for="cvv">CVV</label>
										                <input type="text" class="form-control" id="cvv" name="ccv" required>
										            </div>
										            <div class="form-group" id="card-number-field">
										                <label for="cardNumber">Card Number</label>
										                <input type="text" class="form-control" id="cardNumber" name="card_no" required>
										            </div>
										            <div class="form-group" id="expiration-date">
										                <label>Expiration Date</label>
										                <select name="expiry_month" required> 
										                    <option value="01">January</option>
										                    <option value="02">February </option>
										                    <option value="03">March</option>
										                    <option value="04">April</option>
										                    <option value="05">May</option>
										                    <option value="06">June</option>
										                    <option value="07">July</option>
										                    <option value="08">August</option>
										                    <option value="09">September</option>
										                    <option value="10">October</option>
										                    <option value="11">November</option>
										                    <option value="12">December</option>
										                </select>
										                <select name="expiry_year" required>
										                    <option value="19">2019</option>
										                    <option value="20">2020</option>
										                    <option value="21">2021</option>
										                    <option value="22">2022</option>
										                    <option value="23">2023</option>
										                    <option value="24">2024</option>
										                    <option value="25">2025</option>
										                    <option value="26">2026</option>
										                    <option value="27">2027</option>
										                    <option value="28">2028</option>
										                    <option value="29">2029</option>
										                    <option value="30">2030</option>
										                    <option value="31">2031</option>
										                    <option value="32">2032</option>
										                </select>
										            </div>
										            <div class="form-group" id="credit_cards">
										                <img src="{{ url('images/payment/visa.jpg') }}" id="visa">
										                <img src="{{ url('images/payment/mastercard.jpg') }}" id="mastercard">
										                <img src="{{ url('images/payment/amex.jpg') }}" id="amex">
										            </div>

										            <input type="hidden" name="amount"  value="{{ $mainpay }}" />

										            <button class='form-control btn btn-default' type='submit'>{{ __('frontstaticword.Proceed') }}</button>
										        </form>
										    </div>
										</div>
							        </div>
							    </div>
							</div>
							@endif
							@if($gsetting->braintree_enable == 1)
							
							@endif
							@if($gsetting->razorpay_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingSix">
							        <div class="panel-title">
							            <label for='r16'>
							              <input type='radio' id='r16' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"></a>
							              <img src="{{ url('images/payment/razorpay.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							            
							        </div>
						    	</div>
							    <div id="collapseSix" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form action="{{ route('dopayment') }}" method="POST">
		                            			@csrf
		                            			
		                         				<input type="hidden" name="amount" value="{{ $secureamount  }}"/>
		                         				{{-- <input type="hidden" name="course_id" value="{{ $cart->courses->id }}"/> --}}

		                         				@php
												    $set = App\Setting::first();
												 @endphp

		                         				<script
												    src="https://checkout.razorpay.com/v1/checkout.js"
												    data-key="{{ env('RAZORPAY_KEY') }}"
												    data-amount= "{{ $mainpay*100 }}"
												    data-currency="INR"
												    data-order_id=""
												    data-buttontext="Proceed"
												    data-name="{{ $set->project_title }}"
												    data-description=""
												    data-image="{{ asset('images/logo/'.$set->logo) }}"
												    data-prefill.name="XYZ"
												    data-prefill.email="info@example.com"
												    data-theme.color="#F44A4A"
												></script>
		                            		</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif
							@if($gsetting->paystack_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingSeven">
							        <div class="panel-title">
							            <label for='r14'>
							              <input type='radio' id='r14' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"></a>
							              <img src="{{ url('images/payment/paystack.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							        </div>
						    	</div>
							    <div id="collapseSeven" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="POST" action="{{ route('paywithpaystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
										        <div class="row">
										          <div class="col-md-8 col-md-offset-2">
										            
										            <input type="hidden" name="email" value="{{Auth::User()->email}}"> 
										            <input type="hidden" name="amount" value="{{ $mainpay*100 }}">
										            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > 
										            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
										            <input type="hidden" name="key" value="{{ env('PAYSTACK_SECRET_KEY') }}"> 
										            {{ csrf_field() }} 

										             <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

										            <p>
										              <button class="btn btn-primary " type="submit" value="Pay Now">{{ __('frontstaticword.Proceed') }}</button>
										            </p>
										          </div>
										        </div>
											</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif
							@if($gsetting->paytm_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingFour">
							        <div class="panel-title">
							            <label for='r17'>
							              <input type='radio' id='r17' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"></a>
							              <img src="{{ url('images/payment/paytm.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							        </div>
						    	</div>
							    <div id="collapseFour" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="post" action="{{ url('/paywithpayment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
		                            			@csrf

										            <input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>

										          
												    <div class="row">
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Name</strong>
											                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{Auth::User()->fname}}" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Mobile Number</strong>
											                <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number" value="{{Auth::User()->mobile}}" required autocomplete="off">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Email Id</strong>
											                <input type="email" name="email" class="form-control" value="{{Auth::User()->email}}" placeholder="Enter Email id" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <input type="hidden" name="amount" class="form-control" placeholder="" value="{{ $mainpay }}" readonly="">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
											        </div>
											    </div>
										          
											</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif

							@php
								$banktransfer = App\BankTransfer::first();
							@endphp
							@if(isset($banktransfer))
							@if($banktransfer->bank_enable == '1')
							<div class="card">
	                            <div class="card-header" id="headingEight">
							        <div class="panel-title">
							            <label for='r18'>
							              <input type='radio' id='r18' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight"></a>
							              &emsp;<b>{{ __('frontstaticword.banktransfer') }}</b>
							            </label>
							        </div>
						    	</div>
							    <div id="collapseEight" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="POST" action="{{ url('process/banktransfer') }}" accept-charset="UTF-8" class="form-horizontal" role="form" enctype="multipart/form-data">
		                            			@csrf
										        <div class="row">
										          <div class="col-md-8 col-md-offset-2">

										          	<input type="file" name="proof" required />
										          	<br>
										            <small>(Please upload Proof Document)</small>
										            
									            	<input type="hidden" name="amount" value="{{ $mainpay }}"/>

										            <input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>

										            <input type="hidden" name="fname" value="{{Auth::User()->fname}}"/>

										             <input type="hidden" name="mobile" value="{{Auth::User()->mobile}}"/>

										            <input type="hidden" name="email" value="{{Auth::User()->email}}"/>


										            <p>
										              <button class="btn btn-primary " type="submit" value="Pay Now">{{ __('frontstaticword.Proceed') }}</button>
										            </p>
										          </div>
										        </div>
											</form>

											<div class="card">
											  <div class="card-header">
											    <h5 class="card-title">{{ __('frontstaticword.banktransferdetail') }}</h5>
											  </div>
											  @php
											  	$bankdetail = App\BankTransfer::first();
											  @endphp
											  <ul class="list-group list-group-flush">
											    <li class="list-group-item"><b>Account holder name:</b>&nbsp;{{ $bankdetail['account_holder_name'] }}</li>
											    <li class="list-group-item"><b>Bank name:</b>&nbsp;{{ $bankdetail['bank_name'] }}</li>
											    <li class="list-group-item"><b>Bank cccount number:</b>&nbsp;{{ $bankdetail['account_number'] }}</li>
											    @if(isset($bankdetail['ifcs_code']))
											    <li class="list-group-item"><b>IFCS Code</b>:&nbsp;{{ $bankdetail['ifcs_code'] }}</li>
											    @endif
											    @if(isset($bankdetail['swift_code']))
											    <li class="list-group-item"><b>Swift Code</b>:&nbsp;{{ $bankdetail['swift_code'] }}</li>
											    @endif
											  </ul>
											</div>
		                            	</div>
							        </div>
							    </div>
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

@endsection

@section('custom-script')

<script src="{{ url('js/jquery.payform.min.js')}}" charset="utf-8"></script>
<script src="{{ url('js/script.js') }}"></script>

<script src="{{ url('js/jquery.min.js') }}"></script>  
@endsection
