@extends('admin/layouts.master')
@section('title', 'Create new Zoom meeting')
@section('body')
<section class="content">
	<div class="box">

		<div class="box-header with-border">
			<div class="box-title">
				Create a new Zoom meeting
			</div>
		</div>

		<div class="box-body">
			<form autocomplete="off" action="{{ route('zoom.store') }}" method="POST">
					@csrf

					<div class="form-group">
						<label for="exampleInputDetails">{{ __('adminstaticword.LinkByCourse') }}:</label>
					    <li class="tg-list-item">
					        <input class="tgl tgl-skewed" id="link_by" type="checkbox" name="link_by" >
					        <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="link_by"></label>
					    </li>
					    <input type="hidden" name="free" value="0" for="opp" id="link_by">
				    </div>

				    <div class="form-group display-none" id="sec1_one" >
						<label>{{ __('adminstaticword.Courses') }}:<span class="redstar">*</span></label>
						<select name="course_id" id="course_id" class="form-control js-example-basic-single" required>
		                    @foreach($course as $cor)
		                      <option value="{{$cor->id}}">{{$cor->title}}</option>
		                    @endforeach
		                </select>
					</div>

					<div class="form-group">
						<label>
							Meeting Topic:<sup class="redstar">*</sup>
						</label>

						<input type="text" name="topic" placeholder="Ex. My Meeting" class="form-control" required>
					</div>

					<div class="form-group">
						<label>
							Meeting Start Time:<sup class="redstar">*</sup>
						</label>

                        <div class='input-group date' id='datetimepicker1'>
                          <input name="start_time" type='text' class="form-control" required />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
					</div>

					<div class="form-group">
						<label>
							Duration:<sup class="redstar">*</sup>
						</label>

						<input placeholder="enter in mins eg 60" type="number" min="1" name="duration" class="form-control" required>
					</div>

					<div class="form-group">
						<div class="eyeCy">
							<label>
								Meeting Password: (Optional)
							</label>

							<input id="password" type="password" name="password" class="form-control">
							<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
					</div>

					<div class="form-group">
						<label>
							Meeting Agenda:<sup class="redstar">*</sup>
						</label>

						<input type="text" name="agenda" placeholder="Meeting Agenda" class="form-control" required>
					</div>

					<div class="form-group">
						<label>TimeZone:</label>
						<select class="form-control" name="timezone">
							  <option value="None">Use Your Account Timezone</option>
							  <option value="Pacific/Midway">Midway Island, Samoa</option>
							  <option value="Pacific/Pago_Pago">Pago Pago</option>
							  <option value="Pacific/Honolulu">Hawaii</option>
							  <option value="America/Anchorage">Alaska</option>
							  <option value="America/Vancouver">Vancouver</option>
							  <option value="America/Los_Angeles">Pacific Time (US and Canada)</option>
							  <option value="America/Tijuana">Tijuana</option>
							  <option value="America/Edmonton">Edmonton</option>
							  <option value="America/Denver">Mountain Time (US and Canada)</option>
							  <option value="America/Phoenix">Arizona</option>
							  <option value="America/Mazatlan">Mazatlan</option>
							  <option value="America/Winnipeg">Winnipeg</option>
							  <option value="America/Regina">Saskatchewan</option>
							  <option value="America/Chicago">Central Time (US and Canada)</option>
							  <option value="America/Mexico_City">Mexico City</option>
							  <option value="America/Guatemala">Guatemala</option>
							  <option value="America/El_Salvador">El Salvador</option>
							  <option value="America/Managua">Managua</option>
							  <option value="America/Costa_Rica">Costa Rica</option>
							  <option value="America/Montreal">Montreal</option>
							  <option value="America/New_York">Eastern Time (US and Canada)</option>
							  <option value="America/Indianapolis">Indiana (East)</option>
							  <option value="America/Panama">Panama</option>
							  <option value="America/Bogota">Bogota</option>
							  <option value="America/Lima">Lima</option>
							  <option value="America/Halifax">Halifax</option>
							  <option value="America/Puerto_Rico">Puerto Rico</option>
							  <option value="America/Caracas">Caracas</option>
							  <option value="America/Santiago">Santiago</option>
							  <option value="America/St_Johns">Newfoundland and Labrador</option>
							  <option value="America/Montevideo">Montevideo</option>
							  <option value="America/Araguaina">Brasilia</option>
							  <option value="America/Argentina/Buenos_Aires">Buenos Aires, Georgetown</option>
							  <option value="America/Godthab">Greenland</option>
							  <option value="America/Sao_Paulo">Sao Paulo</option>
							  <option value="Atlantic/Azores">Azores</option>
							  <option value="Canada/Atlantic">Atlantic Time (Canada)</option>
							  <option value="Atlantic/Cape_Verde">Cape Verde Islands</option>
							  <option value="UTC">Universal Time UTC</option>
							  <option value="Etc/Greenwich">Greenwich Mean Time</option>
							  <option value="Europe/Belgrade">Belgrade, Bratislava, Ljubljana</option>
							  <option value="CET">Sarajevo, Skopje, Zagreb</option>
							  <option value="Atlantic/Reykjavik">Reykjavik</option>
							  <option value="Europe/Dublin">Dublin</option>
							  <option value="Europe/London">London</option>
							  <option value="Europe/Lisbon">Lisbon</option>
							  <option value="Africa/Casablanca">Casablanca</option>
							  <option value="Africa/Nouakchott">Nouakchott</option>
							  <option value="Europe/Oslo">Oslo</option>
							  <option value="Europe/Copenhagen">Copenhagen</option>
							  <option value="Europe/Brussels">Brussels</option>
							  <option value="Europe/Berlin">Amsterdam, Berlin, Rome, Stockholm, Vienna</option>
							  <option value="Europe/Helsinki">Helsinki</option>
							  <option value="Europe/Amsterdam">Amsterdam</option>
							  <option value="Europe/Rome">Rome</option>
							  <option value="Europe/Stockholm">Stockholm</option>
							  <option value="Europe/Vienna">Vienna</option>
							  <option value="Europe/Luxembourg">Luxembourg</option>
							  <option value="Europe/Paris">Paris</option>
							  <option value="Europe/Zurich">Zurich</option>
							  <option value="Europe/Madrid">Madrid</option>
							  <option value="Africa/Bangui">West Central Africa</option>
							  <option value="Africa/Algiers">Algiers</option>
							  <option value="Africa/Tunis">Tunis</option>
							  <option value="Africa/Harare">Harare, Pretoria</option>
							  <option value="Africa/Nairobi">Nairobi</option>
							  <option value="Europe/Warsaw">Warsaw</option>
							  <option value="Europe/Prague">Prague Bratislava</option>
							  <option value="Europe/Budapest">Budapest</option>
							  <option value="Europe/Sofia">Sofia</option>
							  <option value="Europe/Istanbul">Istanbul</option>
							  <option value="Europe/Athens">Athens</option>
							  <option value="Europe/Bucharest">Bucharest</option>
							  <option value="Asia/Nicosia">Nicosia</option>
							  <option value="Asia/Beirut">Beirut</option>
							  <option value="Asia/Damascus">Damascus</option>
							  <option value="Asia/Jerusalem">Jerusalem</option>
							  <option value="Asia/Amman">Amman</option>
							  <option value="Africa/Tripoli">Tripoli</option>
							  <option value="Africa/Cairo">Cairo</option>
							  <option value="Africa/Johannesburg">Johannesburg</option>
							  <option value="Europe/Moscow">Moscow</option>
							  <option value="Asia/Baghdad">Baghdad</option>
							  <option value="Asia/Kuwait">Kuwait</option>
							  <option value="Asia/Riyadh">Riyadh</option>
							  <option value="Asia/Bahrain">Bahrain</option>
							  <option value="Asia/Qatar">Qatar</option>
							  <option value="Asia/Aden">Aden</option>
							  <option value="Asia/Tehran">Tehran</option>
							  <option value="Africa/Khartoum">Khartoum</option>
							  <option value="Africa/Djibouti">Djibouti</option>
							  <option value="Africa/Mogadishu">Mogadishu</option>
							  <option value="Asia/Dubai">Dubai</option>
							  <option value="Asia/Muscat">Muscat</option>
							  <option value="Asia/Baku">Baku, Tbilisi, Yerevan</option>
							  <option value="Asia/Kabul">Kabul</option>
							  <option value="Asia/Yekaterinburg">Yekaterinburg</option>
							  <option value="Asia/Tashkent">Islamabad, Karachi, Tashkent</option>
							  <option value="Asia/Calcutta">India</option>
							  <option value="Asia/Kathmandu">Kathmandu</option>
							  <option value="Asia/Novosibirsk">Novosibirsk</option>
							  <option value="Asia/Almaty">Almaty</option>
							  <option value="Asia/Dacca">Dacca</option>
							  <option value="Asia/Krasnoyarsk">Krasnoyarsk</option>
							  <option value="Asia/Dhaka">Astana, Dhaka</option>
							  <option value="Asia/Bangkok">Bangkok</option>
							  <option value="Asia/Saigon">Vietnam</option>
							  <option value="Asia/Jakarta">Jakarta</option>
							  <option value="Asia/Irkutsk">Irkutsk, Ulaanbaatar</option>
							  <option value="Asia/Shanghai">Beijing, Shanghai</option>
							  <option value="Asia/Hong_Kong">Hong Kong</option>
							  <option value="Asia/Taipei">Taipei</option>
							  <option value="Asia/Kuala_Lumpur">Kuala Lumpur</option>
							  <option value="Asia/Singapore">Singapore</option>
							  <option value="Australia/Perth">Perth</option>
							  <option value="Asia/Yakutsk">Yakutsk</option>
							  <option value="Asia/Seoul">Seoul</option>
							  <option value="Asia/Tokyo">Osaka, Sapporo, Tokyo</option>
							  <option value="Australia/Darwin">Darwin</option>
							  <option value="Australia/Adelaide">Adelaide</option>
							  <option value="Asia/Vladivostok">Vladivostok</option>
							  <option value="Pacific/Port_Moresby">Guam, Port Moresby</option>
							  <option value="Australia/Brisbane">Brisbane</option>
							  <option value="Australia/Sydney">Canberra, Melbourne, Sydney</option>
							  <option value="Australia/Hobart">Hobart</option>
							  <option value="Asia/Magadan">Magadan</option>
							  <option value="SST">Solomon Islands</option>
							  <option value="Pacific/Noumea">New Caledonia</option>
							  <option value="Asia/Kamchatka">Kamchatka</option>
							  <option value="Pacific/Fiji">Fiji Islands, Marshall Islands</option>
							  <option value="Pacific/Auckland">Auckland, Wellington</option>
							  <option value="Asia/Kolkata">Mumbai, Kolkata, New Delhi</option>
							  <option value="Europe/Kiev">Kiev</option>
							  <option value="America/Tegucigalpa">Tegucigalpa</option>
							  <option value="Pacific/Apia">Independent State of Samoa</option>
							</select>

							<small class="text-muted"><i class="fa fa-question-circle"></i> Set to None if you want to use your account timezone.</small>
					</div>

					<div class="panel panel-default">
						<div class="panel-body">
							<h5 class="panel-title">Meeting Setting :</h5>
							<hr>
							<div class="custom-control custom-checkbox">
							  <input name="host_video" type="checkbox" class="custom-control-input" id="host_video">
							  <label class="custom-control-label" for="host_video">Enable Host Video</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input name="participant_video" type="checkbox" class="custom-control-input" id="participant_video">
							  <label class="custom-control-label" for="participant_video">Enable Participant Video</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input name="join_before_host" type="checkbox" class="custom-control-input" id="join_before_host">
							  <label class="custom-control-label" for="join_before_host">Join before host?</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input name="mute_upon_entry" type="checkbox" class="custom-control-input" id="mute_upon_entry">
							  <label class="custom-control-label" for="mute_upon_entry">Mute Upon Entry?</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input name="registrants_email_notification" type="checkbox" class="custom-control-input" id="registrants_email_notification">
							  <label class="custom-control-label" for="registrants_email_notification">Registrants email notification?</label>
							</div>
						</div>
	
						
					</div>
					<hr>
					<div class="m-1 form-group">
							<button class="btn btn-success btn-md">Create Meeting</button>
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