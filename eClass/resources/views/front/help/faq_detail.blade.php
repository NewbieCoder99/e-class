@extends('theme.master')
@section('title', "$data->title")
@section('content')

@include('admin.message')

<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ $data->title }}</h1>
    </div>
</section> 
<!-- faq detail start -->
<section id="faq-detail-block" class="faq-detail-main-block">
    <div class="container">
    	<div class="blog-link btm-30"><a href="{{ route('help.show') }}" title="back to blog"><i class="fa fa-chevron-left"></i>{{ __('frontstaticword.Backtofaq') }}</a></div>
    	<p>{!! $data->details !!}</p>
    </div>
</section>
<!-- faq detail end -->

@endsection
