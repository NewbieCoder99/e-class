@extends('theme.master')
@section('title', 'Terms & Condition')
@section('content')
@include('admin.message')
  <!-- main wrapper -->
  <section id="blog-home" class="blog-home-main-block">
    <div class="container-fluid">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.Terms&Condition') }}</h1>
    </div>
  </section>
  <section id="policy-block" class="privacy-policy-block">
    <div class="container-fluid">
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-12"> 
              @php
                $data = App\Terms::first();
              @endphp             
              @if(isset($data))
                <div class="info">{!! $data->terms !!}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection
