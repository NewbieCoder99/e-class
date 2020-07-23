@extends('admin/layouts.master')
@section('title', 'View Subcategory - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.SubCategory') }}</h3>
        </div>
        <div class="box-header">
          <a class="btn btn-info btn-sm" href="{{url('subcategory/create')}}">
          <i class="glyphicon glyphicon-th-"></i>+ {{ __('adminstaticword.AddSubCategory') }}</a>
          <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Category') }}</th>
                  <th>{{ __('adminstaticword.SubCategory') }}</th>
                  <th>{{ __('adminstaticword.Icon') }}</th>
                  <th>{{ __('adminstaticword.Slug') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach($subcategory as $cat)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$cat->categories['title']}}</td>
                  <td>{{$cat->title}}</td>
                  <td><i class="fa {{$cat->icon}}"></i></td>
                  <td>{{$cat->slug}}</td>
                  <td>
                      <form action="{{ route('subcategory.quick',$cat->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="Submit" class="btn btn-xs {{ $cat->status ==1 ? 'btn-success' : 'btn-danger' }}">
                          @if($cat->status ==1)
                          {{ __('adminstaticword.Active') }}
                          @else
                          {{ __('adminstaticword.Deactive') }}
                          @endif
                        </button>
                      </form>
                  </td>
                  <td>
                    <a class="btn btn-success btn-sm" href="{{url('subcategory/'.$cat->id)}}">
                    <i class="glyphicon glyphicon-pencil"></i></a>
                  </td>
                  <td>
                    <form  method="post" action="{{url('subcategory/'.$cat->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
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