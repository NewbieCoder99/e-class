@extends('admin.layouts.master')
@section('title', 'ADD User - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
      <div class="content">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.Review') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('ReviewratingController@update') }}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}

		              	<div class="row">
		                  <div class="col-md-6">
		                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
			                <li class="tg-list-item">
				                <input class="tgl tgl-skewed" id="cb10111" type="checkbox" {{ $show->status==1 ? 'checked' : '' }}>
				                <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb10111"></label>
				            </li>
			                <input type="hidden" name="status" value="{{ $show->status }}" id="jjjj">
		                  </div>
		                  <div class="col-md-6">
		                    <label for="detail">{{ __('adminstaticword.Approved') }}:</label>
		                    <li class="tg-list-item">
				                <input class="tgl tgl-skewed" id="cb10112" type="checkbox" {{ $show->approved==1 ? 'checked' : '' }}>
				                <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb10112"></label>
				            </li>
				            <input type="hidden" name="status" value="{{ $show->approved }}" id="jjjj">
		                  </div>
		              	</div>
		              	<br>

		              	<button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Save') }}</button>

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection


