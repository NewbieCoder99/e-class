@extends('admin/layouts.master')
@section('title', 'All Order - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Order') }}</h3>
          @if(Auth::User()->role == "admin")
            <a class="btn btn-info btn-md" href="{{route('order.create')}}">
            <i class="glyphicon glyphicon-th-l">+</i> Enroll&nbsp;User</a>
          @endif
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.User') }}</th>
                  <th>{{ __('adminstaticword.Course') }}</th>
                  <th>{{ __('adminstaticword.TransactionId') }}</th>
                  <th>{{ __('adminstaticword.PaymentMethod') }}</th>
                  <th>{{ __('adminstaticword.TotalAmount') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
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
                  <td>{{$order->user['fname']}}</td>                 
                  <td>
                    
                    @if($order->course_id != NULL)
                      {{ $order->courses['title'] }}
                    @else
                      {{ $order->bundle['title'] }}
                    @endif
                  </td>
                  <td>{{$order->transaction_id}}</td>
                  <td>{{$order->payment_method}}</td>
                 

                  @if($order->coupon_discount == !NULL)
                    <td><i class="{{ $order->currency_icon }}"></i>{{ $order->total_amount - $order->coupon_discount }}</td>
                  @else
                    <td><i class="fa {{ $order->currency_icon }}"></i>{{ $order->total_amount }}</td>
                  @endif

                  <td>
                    <form action="{{ route('order.quick',$order->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button  type="Submit" class="btn btn-xs {{ $order->status ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($order->status ==1)
                          {{ __('adminstaticword.Active') }}
                        @else
                          {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>
                  </td>

                  <td><a class="btn btn-primary btn-sm" href="{{route('view.order',$order->id)}}">{{ __('adminstaticword.View') }}</a>
                  </td>
                  
                  <td>
                    <form  method="post" action="{{url('order/'.$order->id)}}"
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
