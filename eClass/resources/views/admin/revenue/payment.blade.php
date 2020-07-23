@extends('admin/layouts.master')
@section('title', 'Payment - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">  {{ __('adminstaticword.PaytoInstructor') }}</h3>
        </div>
        <div class="box-body">

          <div class="view-order">
            <div class="row">
              <div class="col-md-12">
                <b>Instructor </b>:  {{ $user->fname }}
                <br>
                <b>Total Instructor Revenue</b>:  {{ $total }}
                <br>
                
              </div>
            </div>
            <br>
          </div>
          
        @if($user->prefer_pay_method == "paypal")
          <form method="post" action="{{ route('admin.paypal', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" value="{{ $total }}" name="total" class="form-control">
              
              <div class="display-none">
              @foreach($allchecked as $checked)
               <label >
                  <input type="hidden" name="checked[]" value="{{ $checked }}">
                  {{ $checked }}
               </label>
              @endforeach
              </div>
             
              <b>PayPal Email</b>:  {{ $user->paypal_email }}
              <br>
              <br>
               
            <button type="submit" class="btn btn-md col-md-3 btn-secondary">Pay With Paypal</button>
          </form>
        @endif


        @if($user->prefer_pay_method == "banktransfer")
          <form method="post" action="{{ route('admin.banktransfer', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" value="{{ $total }}" name="total" class="form-control">
              
              <div class="display-none">
              @foreach($allchecked as $checked)
               <label >
                  <input type="hidden" name="checked[]" value="{{ $checked }}">
                  {{ $checked }}
               </label>
              @endforeach
              </div>
             
              <b>Bank Transfer</b>: 

              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Account holder name:</b>&nbsp;{{ $user['bank_acc_name'] }}</li>
                <li class="list-group-item"><b>Bank name:</b>&nbsp;{{ $user['bank_name'] }}</li>
                <li class="list-group-item"><b>IFCS Code</b>:&nbsp;{{ $user[' ifsc_code'] }}</li>
                <li class="list-group-item"><b>Bank cccount number:</b>&nbsp;{{ $user['bank_acc_no'] }}</li>
              </ul>
                 
              <br>
               
            <button type="submit" class="btn btn-md col-md-3 btn-secondary">Pay to Instructor</button>
          </form>
        @endif


        @if($user->prefer_pay_method == "paytm")
          <form method="post" action="{{ route('admin.paytm', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" value="{{ $total }}" name="total" class="form-control">
              
              <div class="display-none">
              @foreach($allchecked as $checked)
               <label >
                  <input type="hidden" name="checked[]" value="{{ $checked }}">
                  {{ $checked }}
               </label>
              @endforeach
              </div>
             
              <b>Paytm Mobile</b>:  {{ $user->paytm_mobile }}
              <p>Do Manual payment to this paytm mobile number</p>
              <br>
              <br>
               
            <button type="submit" class="btn btn-md col-md-3 btn-secondary">Pay With Paytm</button>
          </form>
        @endif
      
       
          
          
         
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection


@section('scripts')
  

  
@endsection
