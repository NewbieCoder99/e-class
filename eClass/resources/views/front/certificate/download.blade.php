<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2019.
**********************************************************************************************************  -->
<!-- 
Template Name: NextClass
Version: 1.0.0
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->
<html lang="en">
<!-- <![endif]-->
<!-- head -->
<!-- theme styles -->
<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/> <!-- custom css -->
<!-- google fonts -->



<style type="text/css">
  
  @font-face {
    font-family: 'Great Vibes';
    src: url('{{ public_path('GreatVibes-Regular.ttf') }}') format("ttf");
  }

</style>


</head>


<!-- end head -->
<!-- body start-->
<body>
<!-- terms end-->
<!-- about-home start -->
<section id="cirtificate" class="course-cirtificate">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="cirtificate-border-one text-center">
                    <div class="cirtificate-border-two">
                       <div class="cirtificate-heading" style="">{{ __('frontstaticword.CertificateofCompletion') }}</div>
                        @php
                            $mytime = Carbon\Carbon::now();
                        @endphp
                       <p class="cirtificate-detail" style="font-size:30px">{{ __('frontstaticword.Thisistocertifythat') }} <b>&nbsp;{{ Auth::User()['fname'] }}&nbsp;{{ Auth::User()['lname'] }}</b> {{ __('frontstaticword.successfullycompleted') }} <b>{{ $course['title'] }}</b> {{ __('frontstaticword.onlinecourseon') }} <br>
                        @if(Auth::User()->role == "admin")
                        <span style="font-size:25px">{{ date('jS F Y', strtotime($mytime)) }}</span>
                        @else
                        <span style="font-size:25px">{{ date('jS F Y', strtotime($course['created_at'])) }}</span>
                        @endif
                      </p>

                       <span class="cirtificate-instructor">{{ ($course->user['fname']) }} {{ ($course->user['lname']) }}</span>
                       <br>
                       <span class="cirtificate-one">{{ ($course->user['fname']) }} {{ ($course->user['lname']) }}, {{ __('frontstaticword.Instructor') }}</span>
                       <br>
                       <span>&</span>
                       <div class="cirtificate-logo">
                        @if($gsetting['logo_type'] == 'L')
                            <img src="{{ asset('images/logo/'.$gsetting['logo']) }}" class="img-fluid" alt="logo">
                        @else()
                            <a href="{{ url('/') }}"><b><div class="logotext">{{ $gsetting['project_title'] }}</div></b></a>
                        @endif
                      </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer start -->

<!-- footer end -->
<!-- jquery -->
<script src="{{ url('js/jquery-2.min.js') }}"></script> <!-- jquery library js -->
<script src="{{ url('js/bootstrap.bundle.js') }}"></script> <!-- bootstrap js -->
<!-- end jquery -->
</body>
<!-- body end -->
</html> 





