@extends('admin/layouts.master')
@section('title', 'All Pages - Admin')
@section('body')
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Pages') }}</h3>
          <a href="{{url('page/create')}}" class="btn btn-info btn-sm" >+ {{ __('adminstaticword.Add') }}</a> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
             
              <tr>
                <th>#</th>                  
                <th>{{ __('adminstaticword.Title') }}</th>
                <th>{{ __('adminstaticword.Slug') }}</th>
                <th>{{ __('adminstaticword.Detail') }}</th>
                <th>{{ __('adminstaticword.Status') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </tr>
              </thead>
              <tbody>
                @foreach($page as $key=>$p)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$p->title}}</td>
                <td>{{$p->slug}}</td>
                <td>{!!$p->details!!}</td>
                <td>
                    <form action="{{ route('page.quick',$p->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button type="Submit" class="btn btn-xs {{ $p->status ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($p->status ==1)
                        {{ __('adminstaticword.Active') }}
                        @else
                        {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>
                </td>
                
                <td><a class="btn btn-success btn-sm" href="{{url('page/'.$p->id.'/edit')}}">
                  <i class="glyphicon glyphicon-pencil"></i></a>
                </td>

                <td><form  method="post" action="{{url('page/'.$p->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>

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



