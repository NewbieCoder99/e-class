<section class="content">
  <div class="row">
    <div class="col-md-12">
      <br>
      <br>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('adminstaticword.Course') }}</th>
                <th>{{ __('adminstaticword.User') }}</th>
                <th>{{ __('adminstaticword.Review') }}</th>
                <th>{{ __('adminstaticword.Learn') }}</th>
                <th>{{ __('adminstaticword.Price') }}</th>
                <th>{{ __('adminstaticword.Value') }}</th>
                <th>{{ __('adminstaticword.Status') }}</th>
                <th>{{ __('adminstaticword.Approved') }}</th>
                <th>{{ __('adminstaticword.Featured') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach($cor->review as $jp)
                <tr>
                  <?php $i++;?>
                <td><?php echo $i;?></td>
                  <td>{{$jp->courses->title}}</td>

                  @php
                  $chn = App\User::where('id','=',$cor->user_id)->get();
                  @endphp
                  <td>
                  @foreach($chn as $ccc)
                  {{ $ccc['fname'] }}
                  @endforeach
                  </td>

                  <td>{{str_limit($jp->review, $limit = 50, $end = '...')}}</td>
                  <td>{{$jp->learn}}</td>
                  <td>{{$jp->price}}</td>
                  <td>{{$jp->value}}</td> 

                  <td>
                    <form action="{{ route('reviewstatus.quick',$jp->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button type="Submit" class="btn btn-xs {{ $jp->status ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($jp->status ==1)
                        {{ __('adminstaticword.Active') }}
                        @else
                        {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>
                  </td>
                  <td>
                    <form action="{{ route('reviewapproved.quick',$jp->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button type="Submit" class="btn btn-xs {{ $jp->approved ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($jp->approved ==1)
                        {{ __('adminstaticword.Active') }}
                        @else
                        {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>
                  </td>
                  <td>
                    <form action="{{ route('reviewfeatured.quick',$jp->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button type="Submit" class="btn btn-xs {{ $jp->featured ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($jp->featured ==1)
                        {{ __('adminstaticword.Active') }}
                        @else
                        {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>
                  </td>
        
                  <td><a class="btn btn-success btn-sm" href="{{url('reviewrating/'.$jp->id)}}"><i class="glyphicon glyphicon-pencil"></i></a></td> 
            

                  <td>
                    <form  method="post" action="{{url('reviewrating/'.$jp->id)}}"data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                    </form>
                  </td>
                 
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</section> 
