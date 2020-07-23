@extends('admin/layouts.master')
@section('title', 'All Pending Payouts - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">  {{ __('adminstaticword.PendingPayout') }}</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

        <thead>
          <br>
          <br>
          <th>#</th>
          <th>{{ __('adminstaticword.User') }}</th>
          <th>{{ __('adminstaticword.Course') }}</th>
          <th>{{ __('adminstaticword.TransactionId') }}</th>
          <th>{{ __('adminstaticword.TotalAmount') }}</th>
          <th>{{ __('adminstaticword.Delete') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @foreach($payout as $pay)
        <tr>
          <?php $i++;?>
          <td><?php echo $i;?></td>
            <td>{{$pay->user->fname}}</td>
            <td>{{$pay->courses->title}}</td>
            <td>{{$pay->order->order_id}}</td>
            <td><i class="fa {{$pay->currency_icon}}"></i>{{$pay->instructor_revenue}}</td> 
          

          <td><form  method="post" action="{{url('instructoranswer/'.$pay->id)}}
              "data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
        
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
