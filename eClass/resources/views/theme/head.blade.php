<head>
<meta charset="utf-8" />
<title>@yield('title') | {{ $project_title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{{ $gsetting->meta_data_desc }}" />
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
<meta name="author" content="Media City" />
<meta name="MobileOptimized" content="320" />
<link rel="icon" type="image/icon" href="{{ asset('images/favicon/'.$gsetting->favicon) }}"> <!-- favicon-icon -->
<!-- theme styles -->
<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:300,400,500,700" rel="stylesheet"> <!--  google fonts -->
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap:400,500,600,700" rel="stylesheet"><!-- google fonts -->
<link rel="stylesheet" href="{{ url('vendor/fontawesome/css/all.css') }}" /> <!--  fontawesome css -->
<link rel="stylesheet" href="{{ url('vendor/font/flaticon.css') }}" /> <!-- fontawesome css -->
<link rel="stylesheet" href="{{ url('vendor/navigation/menumaker.css') }}" /> <!-- navigation css -->
<link rel="stylesheet" href="{{ url('vendor/owl/css/owl.carousel.min.css') }}" /> <!-- owl carousel css -->
<link rel="stylesheet" href="{{ url('vendor/protip/protip.css') }}" /> <!-- menu css -->

<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
?>
@if (in_array($language,$rtl))
<link href="{{ url('css/rtl.css') }}" rel="stylesheet" type="text/css"/> <!-- rtl css -->
@else

<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/> <!-- custom css -->
@endif
<link rel="stylesheet" href="{{ url('css/colorbox.css') }}">
<link rel="stylesheet" href="{{url('admin/bower_components/font-awesome/css/font-awesome.min.css')}}"><!-- fontawesome css -->
<link rel="stylesheet" href="{{ url('css/select2.min.css') }}"> <!-- select2 css -->
<link rel="stylesheet" href="{{ URL::asset('css/pace.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('css/protip.css') }}" /> <!-- protip css -->
<link rel="manifest" href="{{url('manifest.json')}}">
<link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"/>



<!-- end theme styles -->
</head>