@extends('admin/layouts.master')
@section('title', 'List all meetings')
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box">
	<div class="box-header with-border">
		<div class="box-title">
			List all meetings
		</div>

		<a href="{{ route('bbl.create') }}" title="Create a new meeting" class="pull-right btn btn-md btn-primary">
			+ New meeting
		</a>
	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered">
			<thead>
				<th>
					#
				</th>
				<th>
					Meeting ID
				</th>
				<th>
					Meeting Details
				</th>
				<th>
					Passwords
				</th>
				<th>
					Action
				</th>
			</thead>

			<tbody>
				@foreach($meetings as $key=> $meeting)
					<tr>
						<td>{{ $key+1 }}</td>
						<td><b>{{ $meeting->meetingid }}</b></td>
						<td>
							<p><b>Meeting Name:</b> {{ $meeting->meetingname }}</p>
							<p><b>Meeting Participant:</b> {{ $meeting->setMaxParticipants == -1 ? "Unlimited" : $meeting->setMaxParticipants }}</p>
							<p><b>Duration:</b> {{ $meeting->duration }}min</p>
							<p><b>Welcome Message:</b> {{ $meeting->welcomemsg == '' ? "Not set" : $meeting->welcomemsg }}</p>
							<p><b>Mute on start:</b> {{ $meeting->setMuteOnStart == 1 ? "Yes" : "No" }}</p>
							@if($meeting->link_by == 'course')
							<p><b>Link on course:</b> {{ $meeting->course['title'] }}</p>
							@endif
						</td>
						<td>
							<p><b>Moderator Password:</b> {{ $meeting->modpw }}</p>
							<p><b>Attendee Password:</b> {{ $meeting->attendeepw }}</p>
						</td>
						<td>

							<a title="Delete Meeting" data-toggle="modal" data-target="#delete{{ $meeting->id }}" class="btn btn-sm btn-primary">
								<i class="fa fa-trash-o"></i>
							</a>

							<a title="Edit meeting" href="{{ route('bbl.edit',$meeting->id) }}" class="btn btn-sm btn-info">
								<i class="fa fa-pencil"></i>
							</a>

							<a title="Start Meeting" target="_blank" href="{{ route('api.create.meeting',$meeting->id) }}" class="btn btn-sm btn-success">
								<i class="fa fa-camera"></i>
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
		                       <form method="post" action="{{ route('bbl.delete',$meeting['id']) }}" class="pull-right">
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
	</div>
</div>

</section>

@endsection