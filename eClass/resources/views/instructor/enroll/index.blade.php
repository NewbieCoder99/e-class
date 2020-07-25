@extends('admin/layouts.master')
@section('title', 'All Order - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.User') }} {{ __('adminstaticword.Order') }}</h3>
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
                  <th>{{ __('adminstaticword.Currency') }}</th>
                  <th>{{ __('adminstaticword.TotalAmount') }}</th>
                  <th>{{ __('adminstaticword.View') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=0;?>
              @foreach($orders as $order)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$order->user->fname}}</td>                 
                  <td>{{$order->courses['title']}}</td>
                  <td>{{$order->transaction_id}}</td>
                  <td>{{$order->payment_method}}</td>
                  <td>{{$order->currency}}</td>

                  @if($order->coupon_discount == !NULL)
                    <td><i class="{{ $order->currency_icon }}"></i>{{ $order->total_amount - $order->coupon_discount }}</td>
                  @else
                    <td><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount }}</td>
                  @endif

                  <td><a class="btn btn-primary btn-sm" href="{{route('view.order',$order->id)}}">{{ __('adminstaticword.View') }}</a>
                  </td>
                  
                  <td>
                    <form  method="post" action="{{url('order/'.$order->id)}}"
                        data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger">
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
