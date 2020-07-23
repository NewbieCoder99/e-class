@extends('admin/layouts.master')
@section('title', 'Feature Course - Admin')
@section('body')


<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> Pay to Feature a Course</h3>
        </div>
        <div class="box-body">
          <div class="form-group">


            <div class="row">
              <div class="col-md-5">


                <strong>Course:</strong>
                <br>
                <br>
                @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                    <img src="images/course/<?php echo $course['preview_image'];  ?>" class="img-responsive" >
                @else
                    <img src="{{ Avatar::create($course->title)->toBase64() }}" class="img-responsive" >
                @endif
                <br>
             
               {{ $course->title }}
                <br>
                <br>

                @php
                  $currency = App\Currency::first();
                @endphp

                <label for="total_amount">Amount to be paid to feature a course:</sup></label>&nbsp;
                <b><i class="{{ $currency->icon }}"></i>&nbsp;{{ $gsetting->feature_amount }}</b>
               
              </div>

             
              
              <div class="col-md-7">

                


                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Pay With Paytm</h3>
                    <div class="box-tools pull-right">
                      <!-- Collapse Button -->
                      <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                   <form method="post" action="{{ url('/paywithpaytm') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                    @csrf

                      <input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>
                              
                      <div class="row">
                        <div class="col-md-12">
                          <strong>Name</strong>
                          <input type="text" name="name" class="form-control" value="{{Auth::User()->fname}}" required>
                        </div>
                        <div class="col-md-12">
                          <strong>Mobile Number</strong>
                          <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number" value="{{Auth::User()->mobile}}" required autocomplete="off">
                        </div>
                        <div class="col-md-12">
                          <strong>Email Id</strong>
                          <input type="email" name="email" class="form-control" value="{{Auth::User()->email}}" placeholder="Enter Email id" required>
                        </div>
                        <div class="col-md-12">
                          <strong>Amount to pay</strong>
                          <input type="text" name="amount" class="form-control" placeholder="" value="{{ $payment->total_amount }}" readonly="">
                        </div>

                        <div class="col-md-12">
                            <br>
                            <button class="btn btn-primary" title="checkout" type="submit">Pay with Paytm</button>
                        </div>
                      </div>
                              
                    </form>
                  </div>
                 
                </div>
                <!-- /.box -->

                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Pay with Paypal</h3>
                    <div class="box-tools pull-right">
                      <!-- Collapse Button -->
                      <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>

                  @php        
                    $secureamount = Crypt::encrypt($payment->total_amount);
                  @endphp
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form action="{{ route('featuredWithpaypal') }}" method="POST" autocomplete="off">
                                      @csrf
                                      
                    <input type="hidden" name="amount" value="{{ $secureamount  }}"/>
                    {{-- <input type="hidden" name="course_id" value="{{ $cart->courses->id }}"/> --}}
                      <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
                    </form>
                  </div>
                  <!-- /.box-body -->
                  
                </div>
                <!-- /.box -->


                
              </div>
            </div>

              
            
                                 


            

          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 
@endsection


@section('script')

<script src="{{ url('js/jquery.payform.min.js')}}" charset="utf-8"></script>
<script src="{{ url('js/script.js') }}"></script>

<script src="{{ url('js/jquery.min.js') }}"></script>  
@endsection


