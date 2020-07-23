@extends('admin/layouts.master')

@section('body')

<section class="content">
  @include('admin.message')
    <div class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Review') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                  <br>
                  <tr>
                    <th>{{ __('adminstaticword.User') }}</th>
                    <th>{{ __('adminstaticword.Course') }}</th>
                    <th>{{ __('adminstaticword.Learn') }}</th>
                    <th>{{ __('adminstaticword.Price') }}</th>
                    <th>{{ __('adminstaticword.Value') }}</th>
                    <th>{{ __('adminstaticword.Review') }}</th>
                    <th>{{ __('adminstaticword.Status') }}</th>
                    <th>{{ __('adminstaticword.Approved') }}</th>
                    <th>{{ __('adminstaticword.Edit') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                  <tr>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->course_id}}</td>
                    <td>{{$item->learn}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->value}}</td>
                    <td>{{$item->review}}</td>
                    <td>
                      <form action="{{ route('review.quick',$item->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="Submit" class="btn btn-xs {{ $item->status ==1 ? 'btn-success' : 'btn-danger' }}">
                          @if($item->status ==1)
                          {{ __('adminstaticword.Active') }}
                          @else
                          {{ __('adminstaticword.Deactive') }}
                          @endif
                        </button>
                      </form>
                    </td>
                    <td>
                      <form action="{{ route('approved.quick',$item->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="Submit" class="btn btn-xs {{ $item->approved ==1 ? 'btn-success' : 'btn-danger' }}">
                          @if($item->approved ==1)
                          {{ __('adminstaticword.Active') }}
                          @else
                          {{ __('adminstaticword.Deactive') }}
                          @endif
                        </button>
                      </form>
                    </td>
                  
                    <td><a class="btn btn-primary btn-sm" href="{{action('ReviewController@show',$item->id)}}">
                      <i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                    @endforeach
                 
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>

@endsection