@extends('admin/layouts.master')
@section('title', 'Facts Slider - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.FactsSlider') }}</h3>
          <a class="btn btn-info btn-sm" href="{{url('facts/create')}}">
              <i class="glyphicon glyphicon">+</i> {{ __('adminstaticword.Add') }}</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
           
              <tr>
                <th>#</th>
                <th>{{ __('adminstaticword.Icon') }}</th>
                <th>{{ __('adminstaticword.Heading') }}</th>
                <th>{{ __('adminstaticword.SubHeading') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach($facts as $fact)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?></td>
                <td><i class="fa {{$fact->icon}}"></i></td>
                <td>{{$fact->heading}}</td>
                <td>{{$fact->sub_heading}}</td>
              
                <td>
                  <a class="btn btn-primary btn-sm" href="{{route('facts.edit',$fact->id)}}">
                  <i class="glyphicon glyphicon-pencil"></i></a>
                </td>

                <td><form  method="post" action="{{url('facts/'.$fact->id)}}
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
</section>

@endsection
