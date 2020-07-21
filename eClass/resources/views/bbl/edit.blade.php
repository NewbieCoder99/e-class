@extends('admin/layouts.master')
@section('title', 'Edit meeting '.$meeting->meetingid)
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box">
  	<div class="box-header with-border">
  		<div class="box-title">
  			Edit meeting : #{{ $meeting->meetingid }}
  		</div>
  	</div>

  	<div class="box-body">
  		<form action="{{ route('bbl.update',$meeting->id) }}" method="POST">
  			@csrf


      <div class="form-group">
        <label for="exampleInputDetails">{{ __('adminstaticword.LinkByCourse') }}:</label>
        <li class="tg-list-item">
            <input class="tgl tgl-skewed" id="link_by" type="checkbox" name="link_by" {{ $meeting->link_by == 'course' ? 'checked' : '' }}>
            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="link_by"></label>
        </li>
        <input type="hidden" name="free" value="0" for="opp" id="link_by">
      </div>
        
        
      <div class="form-group" style="{{ $meeting['link_by'] == 'course' ? '' : 'display:none' }}" id="sec1_one">
        <label>{{ __('adminstaticword.Courses') }}:</label>
        <select name="course_id" id="course_id" class="form-control js-example-basic-single">
                  
            @php
              $course = App\Course::where('status', '1')->get();
            @endphp

            @foreach($course as $caat)
              <option {{ $meeting['course_id'] == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
            @endforeach 
        </select>
      </div>
			
			<div class="form-group">
				<label>Meeting ID: <sup class="redstar">*</sup></label>
				<input readonly="" value="{{ $meeting->meetingid }}" type="text" name="meetingid" class="form-control" required="" placeholder="enter meeting id">
			</div>

      <div class="form-group">
        <label>Presenter name: <sup class="redstar">*</sup></label>
        <input value="{{ $meeting->presen_name }}" type="text" name="presen_name" class="form-control" required="" placeholder="enter presenter name">
      </div>

			<div class="form-group">
				<label>Meeting Name: <sup class="redstar">*</sup></label>
				<input value="{{ $meeting->meetingname }}" type="text" name="meetingname" class="form-control" required="" placeholder="enter meeting name">
			</div>

			<div class="form-group">
				<label>Meeting Duration: <sup class="redstar">*</sup></label>
				<input value="{{ $meeting->duration }}" type="text" name="duration" class="form-control" required="" placeholder="enter meeting duration eg. 40">
				<small class="text-muted">It will be count in minutes</small>
			</div>

      <div class="form-group">
        <label>Meeting Detail: <sup class="redstar">*</sup></label>
        <textarea rows="5" cols="30" name="detail" class="form-control" placeholder="enter meeting detail">{!! $meeting->detail !!}</textarea>
      </div>

			<div class="form-group">
              <div class="eyeCy">
                <label>Moderator Password:</label>

                <input value="{{ $meeting->modpw }}" required id="modpw" value="" type="password" name="modpw" class="form-control" placeholder="enter moderator password">
                <span toggle="#modpw" class="fa fa-fw fa-eye field-icon toggle-password"></span>
  
              </div>
      </div>

      <div class="form-group">
        <div class="eyeCy">
          <label>Attandee Password:</label>

          <input value="{{ $meeting->attendeepw }}" required id="attendeepw" value="" type="password" name="attendeepw" class="form-control" placeholder="enter attandee password">
          <span toggle="#attendeepw" class="fa fa-fw fa-eye field-icon toggle-password"></span>

        </div>
      </div>

            <div class="form-group">
            	<label>Set Welcome Message:</label>
            	<input value="{{ $meeting->welcomemsg }}" type="text" class="form-control" name="welcomemsg" placeholder="enter welcome message">
            </div>

            <div class="form-group">
            	<label>Set Max Participants:</label>
            	<input value="{{ $meeting->setMaxParticipants }}" type="number" min="-1" class="form-control" name="setMaxParticipants" placeholder="enter maximum participant no., leave blank if want unlimited participant"/>
            </div>

            <div class="form-group">
            	<label>Set Mute on Start:</label>
            	<input {{ $meeting->setMuteOnStart == 1 ? "checked" : "" }} class="tgl tgl-skewed" name="setMuteOnStart" id="setMuteOnStart" type="checkbox"/>
		    	    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="setMuteOnStart"></label>
            </div>

             <div class="form-group">
              <label>Allow Record:</label>
              <input {{ $meeting->allow_record == '1' ? "checked" : "" }} class="tgl tgl-skewed" name="allow_record" id="allow_record" type="checkbox"/>
              <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="allow_record"></label>
            </div>

            

            <div class="form-group">
            	<button type="submit" class="btn btn-md btn-primary">
            		+ Update Meeting
            	</button>
            </div>


  		</form>
  	</div>
  </div>
</section>

@endsection
@section('script')
	<script>
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
      });

    (function($) {
    "use strict";
      tinymce.init({selector:'textarea'});
  })(jQuery);

		$(".toggle-password").on('click', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if(input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
	</script>

  <script>
  (function($) {
    "use strict";

    $(function(){

        $('#link_by').change(function(){
          if($('#link_by').is(':checked')){
            $('#sec1_one').show('fast');
          }else{
            $('#sec1_one').hide('fast');
          }

        });
     
    });
  })(jQuery);
  </script>
@endsection