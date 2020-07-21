@extends('admin.layouts.master')
@section('title', 'Edit Answer - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
   	<div class="row">
	    <div class="col-md-12">
	    	<div class="box box-primary">
	           	<div class="box-header with-border">
	          	<h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Answer') }}</h3>
	       		</div>
	          	<div class="panel-body">
	          		<form action="{{route('courseanswer.update',$show->id)}}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
						

						<input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />
						
		                <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.SelectCourse') }}</label>
	                    <input value="{{ $show->course_id }}" autofocus name="course_id" type="text" class="form-control display-none" >


	                    <div class="row">
	                    	<div class="col-md-12">
	                    		<label for="exampleInput">{{ __('adminstaticword.Answer') }}:<sup class="redstar">*</sup></label>
	                  			<textarea name="answer" rows="4" class="form-control" placeholder="Please Enter Your Answer" required>{{ $show->answer }}</textarea>
	                    	</div>
	                    </div>
		              	
		              	<br>


		              	<div class="row">
		              		<div class="col-md-12">
			                	<div class="form-group">
				                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
				                <li class="tg-list-item">
				                <input class="tgl tgl-skewed" id="cb10111" type="checkbox" {{ $show->status==1 ? 'checked' : '' }}>
				                <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb10111"></label>
				                </li>
				                <input type="hidden" name="status" value="{{ $show->status }}" id="jjjj">
			            	</div>
		              	</div>
		              	<br>
		              	<br>
		              	<br>
		              	
						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
	  	</div>
  	</div>
</section>
@endsection
