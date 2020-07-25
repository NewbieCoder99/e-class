@extends('admin.layouts.master')
@section('title', 'Dashboard - Instructor')
@section('body')

@if(Auth::User()->role == "instructor")

<section class="content-header">
  <h1>
    {{ __('adminstaticword.Dashboard') }}
    <small>{{ __('adminstaticword.Instructor') }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{ __('adminstaticword.Home') }}</a></li>
    <li class="active">{{ __('adminstaticword.Dashboard') }}</li>
  </ol>
</section>
<section class="content">
	<!-- Main row -->
  <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
            	@php
            		$course = App\Course::where('user_id', Auth::User()->id)->get();
            		if(count($course)>0){

            			echo count($course);
            		}
            		else{

            			echo "0";
            		}
            	@endphp
            </h3>
            <p>{{ __('adminstaticword.Course') }}</p>
          </div>
          <div class="icon">
            <i class="fa fa-wpforms"></i>
          </div>
          <a href="{{url('course')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->

        <div class="small-box bg-green">
          <div class="inner">
            <h3>
             
            	@php
            		$cat = App\Order::where('instructor_id', Auth::User()->id)->get();
            		if(count($cat)>0){

            			echo count($cat);
            		}
            		else{

            			echo "0";
            		}
            	@endphp

            </h3>
            <p> {{ __('adminstaticword.User') }} {{ __('adminstaticword.Enrolled') }}</p>
          </div>
          <div class="icon">
          	<i class="fa fa-id-badge"></i>
          </div>
          <a href="{{url('userenroll')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
            	@php
            		$question = App\Question::where('instructor_id', Auth::User()->id)->get();
            		if(count($question)>0){

            			echo count($question);
            		}
            		else{

            			echo "0";
            		}
            	@endphp
            </h3>
            <p> {{ __('adminstaticword.Total') }} {{ __('adminstaticword.Question') }}</p>
          </div>
          <div class="icon">
            <i class="fa fa-question-circle-o"></i>
          </div>
          <a href="{{url('instructorquestion')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>
            	@php
            		$answer = App\Answer::all();
            		if(count($answer)>0){

            			echo count($answer);
            		}
            		else{

            			echo "0";
            		}
            	@endphp
            </h3>
            <p> {{ __('adminstaticword.Total') }} {{ __('adminstaticword.Answer') }}</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{url('instructoranswer')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
  </div>
  <!-- /.row -->

	
</section>

@endif

@endsection