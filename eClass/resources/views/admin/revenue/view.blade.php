@extends('admin.layouts.master')
@section('title', 'Payout - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Invoice') }}</h3>
            </div>
            <div class="panel-body">
        
            <div id="printableArea">
              <!-- title row -->
              <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      @if($gsetting->logo_type == 'L')
                        <div class="logo-invoice">
                          <img src="{{ asset('images/logo/'.$gsetting->logo) }}">
                        </div>
                      @else()
                          <a href="{{ url('/') }}"><b><div class="logotext" >{{ $gsetting->project_title }}</div></b></a>
                      @endif
                      <small>{{ __('adminstaticword.Date') }}:&nbsp;{{ date('jS F Y', strtotime($payout['created_at'])) }}</small>
                    </h2>
                  </div>
                  <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="view-order">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      {{ __('adminstaticword.From') }}:
                      <address>
                        <strong>{{ $payout->payer['fname'] }}</strong><br>
                        Address: {{ $payout->payer['address'] }}<br>
                        @if($payout->payer['state_id'] == !NULL)
                        {{ $payout->payer->state['name'] }},
                        @endif
                        @if($payout->payer['country_id'] == !NULL)
                          {{ $payout->payer->country['name'] }}
                        @endif
                        <br>
                        {{ __('adminstaticword.Phone') }}:&nbsp;{{ $payout->payer['mobile'] }}<br>
                        {{ __('adminstaticword.Email') }}:&nbsp;{{ $payout->payer['email'] }}
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      {{ __('adminstaticword.To') }}:
                      <address>
                        <strong>{{ $payout->user['fname'] }}</strong><br>
                          {{ __('adminstaticword.Address') }}: {{ $payout->user['address'] }}<br>
                        @if($payout->user['state_id'] == !NULL)
                          {{ $payout->user->state['name'] }},
                        @endif
                        @if($payout->user['country_id'] == !NULL)
                          {{ $payout->user->country['name'] }}<br>
                        @endif
                          {{ __('adminstaticword.Phone') }}:&nbsp;{{ $payout->user['mobile'] }}<br>
                          {{ __('adminstaticword.Email') }}:&nbsp;{{ $payout->user['email'] }}
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <br>
                      <b>{{ __('adminstaticword.OrderId') }}:</b>&nbsp;

                      @foreach($payout->order_id as $order)
                        @php
                            $id= App\Order::find($order);
                        @endphp
                        {{ $id['order_id'] }},
                        
                      @endforeach
                      <br>

                      <b>{{ __('adminstaticword.PaymentMethod') }}:</b>&nbsp;{{ $payout['payment_method'] }}<br>
                      <b>{{ __('adminstaticword.Currency') }}:</b>&nbsp;{{ $payout['currency'] }}
                    </div>
                    <!-- /.col -->
                </div>
              </div>
              <!-- /.row -->
                    
              <div class="order-table">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>{{ __('adminstaticword.Instructor') }}</th>
                      <th>{{ __('adminstaticword.Currency') }}</th>
                     
                      <th>{{ __('adminstaticword.Total') }}</th>
                      <th>{{ __('adminstaticword.PaymentMethod') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $payout->user['fname'] }}</td>
                      <td>{{ $payout['currency'] }}</td>
                      <td><i class="fa {{ $payout['currency_icon'] }}"></i>{{ $payout['pay_total'] }}</td>
                      <td>{{ $payout->payment_method }}</td>

                    

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
            
            <input type="button" class="btn btn-primary"  onclick="printDiv('printableArea')" value="Print Invoice" />

            </div>
        </div>
      </div>
    </div>
</section>

@endsection


@section('scripts')

<script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
</script>

<script lang='javascript'>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
  }
</script>
@endsection


