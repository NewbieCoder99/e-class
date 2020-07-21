<!DOCTYPE html>

<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
?>

<html class="no-js" lang="en" @if (in_array($language,$rtl)) dir="rtl" @endif>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | {{ $project_title }}</title>
  <!-- Tell the browser to be 
   to screen width -->

  @php
    $meta = App\Setting::all();
  @endphp

  @foreach($meta as $met)
    <meta name="description" content="{{ $met->meta_data_desc }}">
    <meta name="keywords" content="{{ $met->meta_data_keyword }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $met->google_ana }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ $met->google_ana }}');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '{{ $met->fb_pixel }}');
      fbq('track', 'PageView');
    </script>

    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
    <noscript>
      <img style="display:none" src="https://www.facebook.com/tr?id={{ $met->fb_pixel }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
  @endforeach

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('css/datepicker.css') }}">
  <link rel="icon" type="image/icon" href="{{ asset('images/favicon/'.$gsetting->favicon) }}"> <!-- favicon-icon -->
  <link rel="stylesheet" href="{{ url('admin/css/select2.min.css') }}"> <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ url('css/fontawesome-iconpicker.min.css') }}">
  <link rel="stylesheet" href="{{url('admin/css/jquery-ui.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> <!-- Theme style -->
  <link rel="stylesheet" href="{{url('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <?php
  $language = Session::get('changed_language'); //or 'english' //set the system language
  $rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
  ?>
  @if (in_array($language,$rtl))
  <link rel="stylesheet" href="{{url('admin/dist/css/AdminLTE-rtl.min.css')}}">  <!-- adminLTE RTL  style -->
  @else
  <link rel="stylesheet" href="{{url('admin/dist/css/AdminLTE.min.css')}}">
  @endif
  
  <link rel="stylesheet" href="{{url('css/toggle.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/component.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/normalize.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('admin/plugins/pace/pace.min.css') }}">
  <link rel="stylesheet" href="{{url('admin/dist/css/skins/_all-skins.min.css')}}">
  <link href="{{url('admin/css/bootstrap-toggle.min.css')}}">
  <link rel="stylesheet" href="{{ url('css/animate.min.css') }}"><!-- Custom Css -->
  @if (in_array($language,$rtl))
  <link rel="stylesheet" href="{{ url('admin/css/admin-rtl.css') }}">
  @else
  <link rel="stylesheet" href="{{ url('admin/css/admin.css') }}">
  @endif
  <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">



  @yield('stylesheets')
  
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img title="{{ $project_title }}" width="20px" src="{{ url('images/favicon/'.$gsetting->favicon) }}" alt=""/>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> <img title="{{ $project_title }}" width="100px" src="{{ url('images/logo/'.$gsetting->logo) }}" alt=""/></span>
    </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            @php
                $languages = App\Language::all(); 
            @endphp
            <li class="dropdown admin-nav language">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-globe"></i> {{Session::has('changed_language') ? Session::get('changed_language') : ''}}</button>

              <ul class="dropdown-menu animated flipInX">
                @if (isset($languages) && count($languages) > 0)
                  @foreach ($languages as $language)
                    <li><a href="{{ route('languageSwitch', $language->local) }}">{{$language->name}} ({{$language->local}}) </a></li>
                  @endforeach
                @endif
              </ul>
              
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li><a href="{{ url('/') }}" target="_blank" class="visit site" >{{ __('adminstaticword.VisitSite') }}</a></li>

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                  <img src="{{ asset('images/user_img/'.Auth::User()->user_img)}}" class="user-image" alt="">
                @else
                  <img src="{{ asset('images/default/user.jpg')}}" class="user-image" alt="">
                @endif
                <span class="hidden-xs">Hi ! {{ Auth::User()->fname }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                    <img src="{{ asset('images/user_img/'.Auth::User()->user_img)}}" class="img-circle" alt="User Image">
                  @else
                    <img src="{{ asset('images/default/user.jpg')}}" class="img-circle" alt="User Image">
                  @endif
                  </br>
                  <p>
                   {{Auth::User()->fname}}
                    <small>{{ __('adminstaticword.MemberSince') }}: {{ date('jS F Y',strtotime( Auth::User()->created_at))}}</small>
                  </p>
                  
                </li>

                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('user/edit/'.Auth::User()->id)}}" class="btn btn-default btn-flat">{{ __('adminstaticword.Profile') }}</a>
                  </div>
                  <div class="pull-right">

                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    {{ __('adminstaticword.Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>

            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                 <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    {{ __('adminstaticword.Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    @if(Auth::User()->role == "admin")
      @include('admin.layouts.sidebar')
    @endif
    @if(Auth::User()->role == "instructor")
      @include('instructor.layouts.sidebar')
    @endif
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      @yield('body')
      <!-- Main content end-->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        {{ $project_title }} (Version 2.0)
      </div>
     {{ $cpy_txt }} 
    </footer>
    <!-- /.control-sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ url('admin/js/select2.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script> <!-- DataTables -->
  <script src="{{url('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> <!-- SlimScroll -->
  <script src="{{url('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script> <!-- FastClick -->
  <script src="{{url('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{url('admin/dist/js/adminlte.min.js')}}"></script> <!-- AdminLTE for demo purposes -->
  <script src="{{url('admin/dist/js/demo.js')}}"></script>
  <script src="{{ URL::asset('admin/bower_components/PACE/pace.min.js') }}"></script> 
  <!-- PACE -->
  <script src="{{ URL::asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
  <!-- CK Editor -->
  <script src="{{ URL::asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script> <!-- bootstrap datepicker -->
  <script src="{{ url('admin/js/jquery-ui.js')}}"></script>
  <script src="{{ url('js/custom-toggle.js') }}"></script>
  <script src="{{ url('js/custom-file-input.js')}}"></script>
  <script src="{{ url('js/fontawesome-iconpicker.js')}}"></script>
  <script src="{{ url('admin/js/courseclass.js')}}"></script>
   
  <script src="{{ url('admin/js/tinymce.min.js')}}"></script>
  <script src="{{ url('admin/bower_components/moment/moment.js') }}"></script>
  <script src="{{ url('js/datepicker.js') }}"></script>
  <script src="{{ url('js/custom-js.js')}}"></script>

  <script src="{{ url('admin/js/dataTables.buttons.min.js')}}"></script> 
  <script src="{{ url('admin/js/buttons.flash.min.js')}}"></script> 
  <script src="{{ url('admin/js/jszip.min.js')}}"></script>
  <script src="{{ url('admin/js/pdfmake.min.js')}}"></script>
  <script src="{{ url('admin/js/vfs_fonts.js')}}"></script>
  <script src="{{ url('admin/js/buttons.html5.min.js')}}"></script>
  <script src="{{ url('admin/js/buttons.print.min.js')}}"></script>

  
  <!-- page script -->
  <script>
    $(function () {
      $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })
    }) 
  </script>

  <script>
    $(document).ready(function() {
      $('#example2').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
      });
    });
  </script>
 
  <script>
  (function($) {
    "use strict"; 
    tinymce.init({
      mode : "specific_textareas",
      editor_selector : "myTextEditor",
      plugins: 'table,textcolor,image,lists,link,code,wordcount,advlist, autosave',
      theme: 'modern',
      menubar: 'none',
      height : '300',
      toolbar: 'restoredraft,bold italic underline | fontselect |  fontsizeselect | forecolor backcolor |alignleft aligncenter alignright alignjustify| bullist,numlist | link image'
    });

    })();
  </script>

  <script>
    window.setTimeout(function(){
      $(".alert").fadeTo(300,0).slideUp(500, function(){
        $(this).remove();
      });
    },2000);
  </script>

  <script>
    $(function(){
      $('.icp-auto').iconpicker();
    });
  </script>

  <script>
 
    $(function () {
      $('.action-destroy').on('click', function () {
        $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
      });
      $(document).on('click', '.action-placement', function (e) {
        $('.action-placement').removeClass('active');
        $(this).addClass('active');
        $('.icp-opts').data('iconpicker').updatePlacement($(this).text());
        e.preventDefault();
        return false;
      });
      $('.action-create').on('click', function () {
        $('.icp-auto').iconpicker();

        $('.icp-dd').iconpicker({
          
        });
        $('.icp-opts').iconpicker({
          title: 'With custom options',
          icons: [
            {
              title: "fab fa-github",
              searchTerms: ['repository', 'code']
            },
            {
              title: "fas fa-heart",
              searchTerms: ['love']
            },
            {
              title: "fab fa-html5",
              searchTerms: ['web']
            },
            {
              title: "fab fa-css3",
              searchTerms: ['style']
            }
          ],
          selectedCustomClass: 'label label-success',
          mustAccept: true,
          placement: 'bottomRight',
          showFooter: true,
          // note that this is ignored cause we have an accept button:
          hideOnSelect: true,
          // fontAwesome5: true,
          templates: {
            footer: '<div class="popover-footer">' +
            '<div style="text-align:left; font-size:12px;">Placements: \n\
            <a href="#" class=" action-placement">inline</a>\n\
            <a href="#" class=" action-placement">topLeftCorner</a>\n\
            <a href="#" class=" action-placement">topLeft</a>\n\
            <a href="#" class=" action-placement">top</a>\n\
            <a href="#" class=" action-placement">topRight</a>\n\
            <a href="#" class=" action-placement">topRightCorner</a>\n\
            <a href="#" class=" action-placement">rightTop</a>\n\
            <a href="#" class=" action-placement">right</a>\n\
            <a href="#" class=" action-placement">rightBottom</a>\n\
            <a href="#" class=" action-placement">bottomRightCorner</a>\n\
            <a href="#" class=" active action-placement">bottomRight</a>\n\
            <a href="#" class=" action-placement">bottom</a>\n\
            <a href="#" class=" action-placement">bottomLeft</a>\n\
            <a href="#" class=" action-placement">bottomLeftCorner</a>\n\
            <a href="#" class=" action-placement">leftBottom</a>\n\
            <a href="#" class=" action-placement">left</a>\n\
            <a href="#" class=" action-placement">leftTop</a>\n\
            </div><hr></div>'
          }
        }).data('iconpicker').show();
      }).trigger('click');

      
      $('.icp').on('iconpickerSelected', function (e) {
        $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
          e.iconpickerInstance.options.iconBaseClass + ' ' +
          e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
      });
    });

  </script>
  
  <script>
    $('#datepicker').datepicker({
      autoclose: true,
      changeYear: true,
    })
  </script>

  <script>
    $(function(){
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if(activeTab){
          $('#nav-tab a[href="' + activeTab + '"]').tab('show');
      }
    });
  </script>

  <script>
    $(function() {
        $('form').attr('autocomplete','off');
    });
  </script>

  <script>
    $(function() {
      $('.js-example-basic-single').select2();
    });
  </script>

  @if($gsetting->rightclick=='1')
    <script>
      (function($) {
        "use strict";
          $(function() {
            $(document).on("contextmenu",function(e) {
               return false;
            });
        });
      })(jQuery);
    </script>
  @endif
  @if($gsetting->inspect=='1')
    <script>
      (function($) {
      "use strict";
           document.onkeydown = function(e) {
          if(event.keyCode == 123) {
             return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
             return false;
          }
        }
      })(jQuery);
    </script>
  @endif

@yield('scripts')
@yield('script')

</body>
</html>
