@extends('admin/layouts.master')
@section('title', 'Your Zoom Meetings')
@section('body')
<section class="content">
  @include('admin.message')
  <div class="box">
  	<div class="box-header with-border">
  		<div class="box-title">
  			All Meetings ({{ count($meetings) }})
  		</div>

  		<a title="Create a new meeting" href="{{ route('meeting.create') }}" class="pull-right btn btn-md btn-info">
  			<i class="fa fa-plus"></i> Create a new meeting
  		</a>
  	</div>

  	<div class="box-body">
		
		<div class="panel panel-default">
			 <div class="panel-heading">Your Zoom Profile</div>
			  <div class="panel-body">
			    <div class="col-md-2">
			    	<img src="{{ isset($profile['pic_url']) ? $profile['pic_url'] : Avatar::create($profile['first_name'])}}" alt="your_profile_picture" class="img-responsive">
			    </div>

			    <div class="col-md-4">
			    	<p><b>First Name:</b> {{ $profile['first_name'] }}</p>
			    	<p><b>Last Name:</b> {{ $profile['last_name'] }}</p>
			    	<p><b>Timezone:</b> {{ $profile['timezone'] }}</p> 
			    </div>

			    <div class="col-md-4">
			    	<p><b>Status:</b> {{ $profile['status'] }}</p>
			    	<p><b>Zoom ID:</b> {{ $profile['id'] }}</p>
			    	<p><b>Langauge:</b> {{ $profile['language'] }}</p> 
			    </div>

			  </div>
		</div>

  		<table class="table table-bordered table-striped table-hover">
  			<thead>
  				<th>
  				#
	  			</th>
	  			<th>
	  				Meeting ID
	  			</th>
	  			<th>
	  				Meeting URL
	  			</th>
	  			<th>
	  				Action
	  			</th>
  			</thead>

  			<tbody>
  				@foreach($meetings as $key => $meeting)
					<tr>
						<td>
							{{ $key+1 }}
						</td>

						<td>
							<p><b>Meeting ID:</b> {{ $meeting['id'] }}</p>
							<p><b>Meeting Topic:</b> {{ $meeting['topic'] }}</p>
							<p><b>Agenda:</b> {{ isset($meeting['agenda']) ? $meeting['agenda'] : "" }}</p>
							<p><b>Duration:</b> {{ isset($meeting['duration']) ? $meeting['duration'] : "" }} min</p>
							<p><b>Start Time:</b>{{ isset($meeting['start_time']) ? date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) : "" }} </p>
						</td>

						<td>
							<a title="Join Meeting" target="_blank" href="{{ $meeting['join_url'] }}">
								{{ $meeting['join_url'] }}
							</a>
						</td>

						<td>

							@php
								$curl = curl_init();
								$token = Auth::user()->jwt_token;
								$meetingID = $meeting['id'];
									curl_setopt_array($curl, array(
									  CURLOPT_URL => "https://api.zoom.us/v2/meetings/$meetingID",
									  CURLOPT_RETURNTRANSFER => true,
									  CURLOPT_ENCODING => "",
									  CURLOPT_MAXREDIRS => 10,
									  CURLOPT_TIMEOUT => 30,
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									  CURLOPT_CUSTOMREQUEST => "GET",
									  CURLOPT_HTTPHEADER => array(
									    "authorization: Bearer $token"
									  ),
									));

									$url = curl_exec($curl);
									$err = curl_error($curl);
									$url = json_decode($url,true);
									curl_close($curl);
								@endphp

							<a title="Edit Meeting" href="{{ route('zoom.edit',$meeting['id']) }}" class="btn btn-sm btn-success">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</a>

							<a title="Delete Meeting" data-toggle="modal" data-target="#delete{{ $meeting['id'] }}" class="btn btn-sm btn-primary">
								<i class="fa fa-trash-o"></i>
							</a>
							
							<a title="View Meeting" href="{{ route('zoom.show',$meeting['id']) }}" class="btn btn-sm btn-default">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							
							
							<a title="Start Meeting" href="{{ $url['start_url'] }}" class="btn btn-sm btn-info">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
							</a>

							



						</td>

						 <div id="delete{{ $meeting['id'] }}" class="delete-modal modal fade" role="dialog">
			                    <div class="modal-dialog modal-sm">
			                      <!-- Modal content-->
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <button type="button" class="close" data-dismiss="modal">&times;</button>
			                          <div class="delete-icon"></div>
			                        </div>
			                        <div class="modal-body text-center">
			                          <h4 class="modal-heading">Are You Sure ?</h4>
			                          <p>Do you really want to delete this meeting? This process cannot be undone.</p>
			                        </div>
			                        <div class="modal-footer">
			                       <form method="post" action="{{ route('zoom.delete',$meeting['id']) }}" class="pull-right">
			                                         {{csrf_field()}}
			                                         {{method_field("DELETE")}}
			                                          
			                                  
			                                          
			                        
			                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
			                            <button type="submit" class="btn btn-danger">Yes</button>
			                          </form>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
					</tr>
  				@endforeach
  			</tbody>
  		</table>

  		<div class="text-center">
  			{!! $meetings->links() !!}
  		</div>

  	</div>
  </div>
</section>
@endsection