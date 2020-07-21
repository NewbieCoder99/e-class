@extends('admin.layouts.master')
@section('title', 'Get Started - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
  	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.GetStarted') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('GetstartedController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
		                
		              	<div class="row">
		                  <div class="col-md-6">
		                    <label for="heading">{{ __('adminstaticword.Heading') }}</label>
		                    <input value="{{ $show['heading'] }}" autofocus name="heading" type="text" class="form-control" placeholder="Enter Heading"/>
		                  </div>
		                  <div class="col-md-6">
		                    <label for="sub_heading">{{ __('adminstaticword.SubHeading') }}</label>
		                    <input value="{{ $show['sub_heading'] }}" autofocus name="sub_heading" type="text" class="form-control" placeholder="Enter Sub Heading"/>
		                  </div>
		              	</div>
		              	<br>

		              	<div class="row">
		                  <div class="col-md-6">
		                    <label for="button_txt">{{ __('adminstaticword.ButtonText') }}</label>
		                    <input value="{{ $show['button_txt'] }}" autofocus name="button_txt" type="text" class="form-control" placeholder="Enter Button Text"/>
		                  </div>
		              	
		                  <div class="col-md-6">
		                    <label for="image">{{ __('adminstaticword.BackgroundImage') }}<sup class="redstar">*</sup></label>
		                    <input type="file" name="image" id="image">
		                    <img src="{{ url('/images/getstarted/'.$show['image']) }}" class="img-responsive"/>
		                  </div>
		              	</div>
		              	<br>
		              	<div class="box-footer">
		              		<button value="" type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>
		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection


