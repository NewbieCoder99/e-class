<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2020.
**********************************************************************************************************  -->
<!-- 
Template Name: eClass - Learning Management System 
Version: 2.0.0
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->

<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
?>

<html lang="en" @if (in_array($language,$rtl)) dir="rtl" @endif>
<!-- <![endif]-->
<!-- head -->
@include('theme.head')
<!-- end head -->
<!-- body start-->
<body>
<!-- preloader --> 
@if($gsetting->preloader_enable == 1)
<div class="preloader">
    <div class="status">
        <div class="status-message">
        	<img src="{{ asset('images/favicon/'.$gsetting['favicon']) }}" alt="logo" class="img-fluid">
        </div>
    </div>
</div>
@endif

@php
  if(isset(Auth::user()->orders)){
      //Run User Enroll expire background process
      App\Jobs\EnrollExpire::dispatchNow();
  }
@endphp
<!-- end preloader -->
<!-- top-nav bar start-->
@include('theme.nav')
<!-- top-nav bar end-->
<!-- home start -->
@yield('content')
<!-- testimonial end -->
<!-- footer start -->
@include('theme.footer')
<!-- footer end -->
<!-- jquery -->
@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 
