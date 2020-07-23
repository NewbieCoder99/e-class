@extends('admin/layouts.master')
@section('title', 'Instructor Request - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.InstructorRequest') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              
              <thead>
              
                <tr>
                	<th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Detail') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.View') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  @if($item->status == '0')
                  	<td><img src="{{ asset('images/instructor/'.$item->image)}}"></td> 
                    <td>{{$item->fname}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{ str_limit($item->detail, $limit= 50, $end = '...')}}</td>
                    <td>
                      @if($item->status==1)
                        {{ __('adminstaticword.Approved') }}
                      @else
                        {{ __('adminstaticword.Pending') }}
                      @endif
                    </td>
                    <td><a class="btn btn-primary btn-sm" href="{{route('requestinstructor.edit',$item->id)}}">{{ __('adminstaticword.View') }}</a></td>

                    <td><form  method="post" action="{{url('requestinstructor/'.$item->id)}}
                          "data-parsley-validate class="form-horizontal form-label-left">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                           <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                        </form>
                    </td>
                  @endif

                  @endforeach
               
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection