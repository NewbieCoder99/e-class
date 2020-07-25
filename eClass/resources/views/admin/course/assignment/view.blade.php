@extends('admin.layouts.master')
@section('title', 'View Assignment - Admin')
@section('body')
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-6">
    	<div class="box box-primary">
           	<div class="box-header with-border">
          	<h3 class="box-title">{{ __('adminstaticword.Assignment') }}</h3>
       		</div>
          	<div class="panel-body">

          		<div class="view-instructor">
                    <div class="instructor-detail">
                    	<ul>
                    		<li>
                          @if($assign->user->user_img != null || $assign->user->user_img !='')
                            <img src="{{ asset('images/user_img/'.$assign->user->user_img) }}" class="img-circle"/></li>
                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-circle" alt="User Image">
                          @endif
                    		<li>{{ __('adminstaticword.User') }}: {{ $assign->user->fname }} {{ $assign->user->lname }}</li>
                    		<li>{{ __('adminstaticword.Course') }}: {{ $assign->courses->title }}</li>
                    		<li>{{ __('adminstaticword.AssignmentTitle') }}: {{ $assign->title }}</li>
                    		<li>{{ __('adminstaticword.Assignment') }}: <a href="{{ asset('files/assignment/'.$assign->assignment) }}" download="{{$assign->assignment}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download"></i></a></li>

                    	</ul>
                    </div>
          		</div>
	              

	            
          	</div>
      	</div>
  	</div>
  </div>
</section>
@endsection
