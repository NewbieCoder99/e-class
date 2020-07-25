@extends('admin/layouts.master')
@section('title', 'All Testimonial - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Testimonial') }}</h3>
          <a href="{{url('testimonial/create')}}" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
          
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.Image') }}</th>
              <th>{{ __('adminstaticword.Name') }}</th>
              <th>{{ __('adminstaticword.Detail') }}</th>
              <th>{{ __('adminstaticword.Status') }}</th>
              <th>{{ __('adminstaticword.Update') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
            </thead>
            <tbody>
              @foreach($test as $key=>$p)
            <tr>
              <td>{{$key+1}}</td>
              <td>
                <img src="images/testimonial/<?php echo $p['image']; ?>">
              </td>
              <td>{{$p->client_name}}</td>
              <td>{{ strip_tags($p->details) }}</td>
             
              <td>
                 <form action="{{ route('testimonial.quick',$p->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button  type="Submit" class="btn btn-xs {{ $p->status ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($p->status ==1)
                      {{ __('adminstaticword.Active') }}
                      @else
                      {{ __('adminstaticword.Deactive') }}
                      @endif
                    </button>
                  </form>
              </td>           

              <td><a class="btn btn-success btn-sm" href="{{url('testimonial/'.$p->id.'/edit')}}">
                <i class="glyphicon glyphicon-pencil"></i></a>
              </td>
              <td><form  method="post" action="{{url('testimonial/'.$p->id)}}
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
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
