@extends('admin/layouts.master')
@section('title', 'Featured Course - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> Featured Course</h3>
        </div>
        <div class="box-header with-border">

          <a class="btn btn-info btn-md" href="{{route('featurecourse.create')}}">
          <i class="glyphicon glyphicon-th-l">+</i> Feature Course</a>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                
                <br>
                <br>
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.User') }}</th>
                  <th>{{ __('adminstaticword.Course') }}</th>
                  <th>{{ __('adminstaticword.TransactionId') }}</th>
                  <th>{{ __('adminstaticword.PaymentMethod') }}</th>
                  <th>{{ __('adminstaticword.TotalAmount') }}</th>
                  <th>{{ __('adminstaticword.View') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=0;?>
              @foreach($featured as $feature)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$feature->user['fname']}}</td>                 
                  <td>{{$feature->courses['title']}}</td>
                  <td>{{$feature->transaction_id}}</td>
                  <td>{{$feature->payment_method}}</td>
                  <td><i class="fa {{ $feature->currency_icon }}"></i>{{ $feature->total_amount }}</td>

                  

                  <td><a class="btn btn-primary btn-sm" href="{{route('featurecourse.show',$feature->id)}}">{{ __('adminstaticword.View') }}</a>
                  </td>
                  
                  <td>
                    <form  method="post" action="{{url('featurecourse/'.$feature->id)}}"
                        data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-fw fa-trash-o"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach 
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
