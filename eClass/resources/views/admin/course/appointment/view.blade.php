@extends('admin.layouts.master')
@section('title', 'View Appointment - Admin')
@section('body')
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
    	<div class="box box-primary">
       	<div class="box-header with-border">
      	<h3 class="box-title">{{ __('adminstaticword.Appointment') }}</h3>
   		</div>
    	<div class="panel-body">

    		<div class="view-instructor">
          <div class="instructor-detail">
          	<ul>
          		<li>

                @if($appoint->user->user_img != null || $appoint->user->user_img !='')
                  <img src="{{ asset('images/user_img/'.$appoint->user->user_img) }}" class="img-circle"/>
                @else
                  <img src="{{ asset('images/default/user.jpg')}}" class="img-circle" alt="User Image">
                @endif
              </li>
          		<li>{{ __('adminstaticword.User') }}: {{ $appoint->user->fname }} {{ $appoint->user->lname }}</li>
          		<li>{{ __('adminstaticword.Course') }}: {{ $appoint->courses->title }}</li>
          		<li>{{ __('adminstaticword.Title') }}: {{ $appoint->title }}</li>
          		<li>{{ __('adminstaticword.Detail') }}: {!! $appoint->detail !!}</li>

          	</ul>
          </div>
    		</div>


        <form action="{{route('appointment.update',$appoint->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <input type="hidden" value="{{ $appoint->user_id }}" name="user_id" class="form-control">

            <input type="hidden" value="{{ $appoint->course_id }}" name="course_id" class="form-control">

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Accept') }}:</label>
                <br>
                <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="appoint_accept" type="checkbox" name="accept" {{ $appoint->accept == 1 ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="appoint_accept"></label>
                </li>
              </div>
            </div>
            <br>

            <div class="row" style="{{ $appoint['accept'] == '1' ? '' : 'display:none' }}" id="sec1_one">
              <div class="col-md-12">
                <label for="exampleInputDetails">{{ __('adminstaticword.Reply') }}:</label>
                <textarea id="reply" name="reply" rows="1" class="form-control" placeholder="Enter class detail">{{ $appoint['reply'] }}</textarea>
              </div>
            </div>
            <br>


            <button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Save') }}</button>

        </form>
      </div>
  	</div>
  </div>
</section>
@endsection


@section('script')
<!--courseclass.js is included -->

<script>
 tinymce.init({selector:'textarea#reply'});

</script>


<script>
(function($) {
  "use strict";

  $(function(){

      $('#appoint_accept').change(function(){
        if($('#appoint_accept').is(':checked')){
          $('#sec1_one').show('fast');
          $('#sec_one').hide('fast');
        }else{
          $('#sec1_one').hide('fast');
          $('#sec_one').show('fast');
        }

      });
   
  });
})(jQuery);
</script>

@endsection
