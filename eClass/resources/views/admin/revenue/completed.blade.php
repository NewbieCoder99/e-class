@extends('admin/layouts.master')
@section('title', 'All Completed - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">  {{ __('adminstaticword.CompletedPayout') }}</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

        <thead>
         
          <th>#</th>
          <th>{{ __('adminstaticword.User') }}</th>
          <th>{{ __('adminstaticword.Payer') }}</th>
          <th>{{ __('adminstaticword.PayTotal') }}</th>
          <th>{{ __('adminstaticword.OrderId') }}</th>
          <th>{{ __('adminstaticword.PayStatus') }}</th>
          <th>{{ __('adminstaticword.View') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @foreach($payout as $pay)
        <tr>
          <?php $i++;?>
            <td><?php echo $i;?></td>
            <td>{{$pay->user->fname}}</td>
            <td>{{$pay->payer_id}}</td>
            <td><i class="fa {{$pay->currency_icon}}"></i> {{$pay->pay_total}}</td>
            <td>
              @foreach($pay->order_id as $order)
                @php
                    $id= App\Order::find($order);
                @endphp
                {{ $id['order_id'] }},
                
              @endforeach
            <td>
              @if($pay->pay_status ==1)
                {{ __('adminstaticword.Recieved') }}
              @else
                {{ __('adminstaticword.Pending') }}
              @endif
            </td>

            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('completed.view', $pay->id) }}">View</a>
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
