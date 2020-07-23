@extends('admin.layouts.master')
@section('title', 'Course Text - Admin')
@section('body')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
 
<section class="content">
   @include('admin.message')
  	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.CourseText') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('CoursetextController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
		                
		              	<div class="row">
		                  <div class="col-md-6">
		                    <label for="heading">{{ __('adminstaticword.Heading') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show['heading'] }}" autofocus required name="heading" type="text" class="form-control" placeholder="Enter Facts Heading"/>
		                  </div>
		              	
		                  <div class="col-md-6">
		                    <label for="sub_heading">{{ __('adminstaticword.SubHeading') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show['sub_heading'] }}" autofocus required name="sub_heading" type="text" class="form-control" placeholder="Enter Facts Sub Heading"/>
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


