@extends('admin.layouts.master')
@section('title', 'Featured Course - Instructor')
@section('body')
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Featured Course</h3>
          </div>
            <div class="panel-body">

              <div class="view-instructor">
                    <div class="instructor-detail">
                      <ul>
                        <li><img src="{{ asset('images/course/'.$featured->courses->preview_image) }}" class="img-circle"/></li>
                        <li>{{ __('adminstaticword.Course') }}: {{ $featured->courses->title }} </li>
                        <li>{{ __('adminstaticword.User') }}: {{ $featured->user->fname }}</li>
                        <li>{{ __('adminstaticword.Transactionid') }}: {{ $featured->transaction_id }}</li>
                        <li>{{ __('adminstaticword.PaymentMethod') }}: {{ $featured->payment_method }}</li>
                        <li>{{ __('adminstaticword.Amount') }}: <i class="fa {{ $currency->icon }}"></i> {{ $featured->total_amount }}</li>
                        <li>{{ __('adminstaticword.Currency') }}:  {{ $featured->currency }}</li>
                        

                      </ul>
                    </div>
              </div>
              
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
