@extends('admin.layouts.master')
@section('title', 'Payment Settings - Instructor')
@section('body')
 
<section class="content">
   	@include('admin.message')
  	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              		<h3 class="box-title">{{ __('adminstaticword.Setuppaymentinformations') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ route('instructor.payout', $user->id) }}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('POST') }}


		            <div class="row">
	                  <div class="col-md-6">
	                    <label for="type">{{ __('adminstaticword.Type') }}:<sup class="redstar">*</sup></label>
	                    <select name="type" id="paytype" class="form-control js-example-basic-single" required >
	                      <option value="none" selected disabled hidden >{{ __('adminstaticword.ChoosePaymentType') }}</option>

	                      @if($isetting['paytm_enable'] == 1)
	                      	<option {{ $user->prefer_pay_method == 'paytm' ? 'selected' : ''}} value="paytm">{{ __('adminstaticword.Paytm') }}</option>
	                      @endif
	                      @if($isetting['paypal_enable'] == 1)
	                      <option {{ $user->prefer_pay_method == 'paypal' ? 'selected' : ''}} value="paypal">{{ __('adminstaticword.Paypal') }}</option>
	                      @endif
	                      @if($isetting['bank_enable'] == 1)
	                      <option {{ $user->prefer_pay_method == 'banktransfer' ? 'selected' : ''}} value="bank">{{ __('adminstaticword.BankTransfer') }}</option>
	                      @endif
	                    </select>
	                  </div>
	              	</div>
	            	<br>
					
						
		              
		         
                        <div class="row">
			                <div class="col-md-6">

			                	<div id="paypalpayment" @if($user['prefer_pay_method'] == "banktransfer" || $user['prefer_pay_method'] == "paytm" ) class="display-none" @endif>
			                	
			                	<h5 class="box-title">{{ __('adminstaticword.PAYPALPAYMENT') }}</h5>
			                    <label for="pay_cid">{{ __('adminstaticword.PaypalEmail') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user['paypal_email'] }}" autofocus name="paypal_email" type="text" class="form-control" placeholder="Enter Paypal Email"/>
			                    <br>
			                </div>
			                </div>

		              	</div>
		              	<br>
		             

						
		              
                        <div class="row">
			                <div class="col-md-6">

			                	<div id="paytmpayment" @if($user['prefer_pay_method'] == "banktransfer" || $user['prefer_pay_method'] == "paypal" ) class="display-none" @endif>
			                	<h5 class="box-title">{{ __('adminstaticword.PAYTMPAYMENT') }}</h5>
			                    <label for="pay_cid">{{ __('adminstaticword.PaytmMobileNo') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user['paytm_mobile'] }}" autofocus name="paytm_mobile" type="text" class="form-control" placeholder="Enter Paytm Mobile No"/>
			                    <br>
			                </div>
			                </div>

		              	</div>
		              	<br>
						
		           
		              
                        <div class="row">

                        	<div id="bankpayment" @if($user['prefer_pay_method'] == "paypal" || $user['prefer_pay_method'] == "paytm" ) class="display-none" @endif>



			                <div class="col-md-6">

			                    <label for="pay_cid">{{ __('adminstaticword.AccountHolderName') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->bank_acc_name }}" autofocus name="bank_acc_name" type="text" class="form-control" placeholder="Enter Account Holder Name"/>
			                    <br>
			                </div>

			                <div class="col-md-6">
			                    <label for="pay_cid">{{ __('adminstaticword.BankName') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->bank_acc_no }}" autofocus name="bank_acc_no" type="text" class="form-control" placeholder="Enter Bank Name"/>
			                    <br>
			                </div>

			                <div class="col-md-6">
			                    <label for="pay_cid">{{ __('adminstaticword.IFCSCode') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->ifsc_code }}" autofocus name="ifsc_code" type="text" class="form-control" placeholder="Enter IFCS Code"/>
			                    <br>
			                </div>

			                <div class="col-md-6">
			                    <label for="pay_cid">{{ __('adminstaticword.AccountNumber') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->bank_name }}" autofocus name="bank_name" type="text" class="form-control" placeholder="Enter Account Number"/>
			                    <br>
			                </div>
			            </div>

		              	</div>
		              	<br>
		              	<br>

		                   

						
						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
    </div>
</section>
@endsection



@section('script')

<script type="text/javascript">
	 $('#paytype').change(function() {
      
    if($(this).val() == 'paytm')
    {
      $('#paytmpayment').show();
      $('#paypalpayment').hide();
      $('#bankpayment').hide();
     
    }
    else if($(this).val() == 'paypal')
    { 
      $('#paytmpayment').hide();
      $('#paypalpayment').show();
      $('#bankpayment').hide();
    
    }
    else if($(this).val() == 'bank')
    {
    	$('#bankpayment').show();
      $('#paypalpayment').hide();
      $('#paytmpayment').hide();
      
    }
  });

    
</script>

@endsection


