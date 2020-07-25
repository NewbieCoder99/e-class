@if($gsetting->promo_enable == 1)
<div id="promo-outer">
    <div id="promo-inner">
        <a href="{{ $gsetting['promo_link'] }}">{{ $gsetting['promo_text'] }}</a>
        <span id="close">x</span>
    </div>
</div>
<div id="promo-tab" class="display-none">SHOW</div>
@endif

<section id="nav-bar" class="nav-bar-main-block">
    <div class="container">
        <!-- start navigation -->
        <div class="navigation fullscreen-search-block">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()" class="hamburger">&#9776; </span>
            <div class="logo">
                @php
                    $setting = App\Setting::first();
                @endphp

                @if($setting->logo_type == 'L')
                    <a href="{{ url('/') }}" ><img src="{{ asset('images/logo/'.$setting->logo) }}" class="img-fluid" alt="logo"></a>
                @else()
                    <a href="{{ url('/') }}"><b><div class="logotext">{{ $setting->project_title }}</div></b></a>
                @endif
            </div>
            <div class="nav-search nav-wishlist">
                <a href="#find"><i class="fa fa-search"></i></a>
            </div>
            @auth
            <div class="shopping-cart">
                <a href="{{ route('cart.show') }}" title="Cart"><i class="flaticon-shopping-cart"></i></a>
                <span class="red-menu-badge red-bg-success">
                    @php
                        $item = App\Cart::where('user_id', Auth::User()->id)->get();
                        if(count($item)>0){

                            echo count($item);
                        }
                        else{

                            echo "0";
                        }
                    @endphp
                </span>
            </div>
            <div class="nav-wishlist">
                <div id="notification_li">
                    <a href="{{ url('send') }}" id="notificationLinkk" title="Notification"><i class="fa fa-bell"></i></a>
                    <span class="red-menu-badge red-bg-success">
                        {{ Auth()->user()->unreadNotifications->count() }}
                    </span>
                    <div id="notificationContainerr">
                    <div id="notificationTitle">{{ __('frontstaticword.Notifications') }}</div>
                    <div id="notificationsBody" class="notifications">
                        <ul>
                            @foreach(Auth()->user()->unreadNotifications as $notification)
                                <li class="unread-notification">
                                    <a href="{{url('notifications/'.$notification->id)}}">          
                                    <div class="notification-image">
                                        @if($notification->data['image'] !== NULL )
                                            <img src="{{ asset('images/course/'.$notification->data['image']) }}" alt="course" class="img-fluid" >
                                        @else
                                            <img src="{{ Avatar::create($notification->data['id'])->toBase64() }}" alt="course" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="notification-data">
                                        In {{ str_limit($notification->data['id'], $limit = 20, $end = '...') }}
                                        <br>
                                        {{ str_limit($notification->data['data'], $limit = 20, $end = '...') }}
                                    </div>
                                    </a>
                                </li>
                            @endforeach

                            @foreach(Auth()->user()->readNotifications as $notification)
                                <li>
                                    <a href="{{ route('mycourse.show') }}">
                                    <div class="notification-image">
                                        @if($notification->data['image'] !== NULL )
                                            <img src="{{ asset('images/course/'.$notification->data['image']) }}" alt="course" class="img-fluid" >
                                        @else
                                           <img src="{{ Avatar::create($notification->data['id'])->toBase64() }}" alt="course" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="notification-data">
                                        In {{  str_limit($notification->data['id'], $limit = 20, $end = '...') }}
                                        <br>
                                        {{ str_limit($notification->data['data'], $limit = 20, $end = '...') }}
                                    </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="notificationFooter"><a href="{{route('deleteNotification')}}">{{ __('frontstaticword.ClearAll') }}</a></div>
                    </div>
                </div>
            </div>
            @endauth
            

            <div id="mySidenav" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                @guest
                <div class="login-block">
                    <a href="{{ route('register') }}" class="btn btn-primary" title="register">{{ __('frontstaticword.Signup') }}</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary" title="login">{{ __('frontstaticword.Login') }}</a>
                </div>
                @endguest
                @auth

                <div id="notificationTitle">
                    @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                      <img src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" class="dropdown-user-circle" alt="user">
                    @else
                        <img src="{{ asset('images/default/user.jpg')}}" class="dropdown-user-circle" alt="user">
                    @endif
                    <div class="user-detailss">
                        Hi, {{ Auth::User()->fname }}
                        
                    </div>
                    
                </div>

                <div class="login-block">

                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div id="notificationFooter">
                            {{ __('frontstaticword.Logout') }}
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                                @csrf
                            </form>
                        </div>
                    </a>
                </div>

                @endauth
                
                <div class="wrapper center-block">
                    @php
                     $categories = App\Categories::orderBy('position','ASC')->get();
                    @endphp
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($categories as $cate)
                      <div class="panel panel-default">
                        <div class="panel-heading active" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $cate->id }}" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa {{ $cate->icon }} rgt-10"></i> <label class="prime-cat" data-url="{{ route('category.page',$cate->id) }}">{{ str_limit($cate->title, $limit = 20, $end = '..') }}</label> 
                            </a>
                            </h4>
                        </div>

                        
                        <div id="collapseOne{{ $cate->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        @foreach($cate->subcategory as $sub)
                          <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingeleven">
                                  <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseeleven{{ $sub->id }}" aria-expanded="false" aria-controls="collapseeleven">
                                      <i class="fa {{ $sub->icon }} rgt-10"></i> <label class="sub-cate" data-url="{{ route('subcategory.page',$sub->id) }}">{{ str_limit($sub->title, $limit = 15, $end = '..') }}</label>

                                    </a>
                                  </h4>
                                </div>

                                <div id="collapseeleven{{ $sub->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingeleven">
                                  @foreach($sub->childcategory as $child)
                                  <div class="panel-body sub-cat">
                                    <i class="fa {{ $child->icon }} rgt-10"></i> <label class="child-cate" data-url="{{ route('childcategory.page',$child->id) }}">{{ $child->title }} </label>
                                  </div>
                                  @endforeach
                                </div>
                                
                            </div>
                          </div>
                        @endforeach
                        </div>
                        
                      </div>
                    @endforeach
                  </div>
                      
                </div>
              
                <!-- ........  -->
                @auth


                <div class="sidebar-nav-icon">
                    <ul>
                        @if(Auth::User()->role == "admin" )
                        <a target="_blank" href="{{ url('/admins') }}"><li><i class="fa fa-dashboard"></i>{{ __('frontstaticword.AdminDashboard') }}</li></a>
                        @endif
                        @if(Auth::User()->role == "instructor")

                        <a target="_blank" href="{{ url('/admins') }}"><li><i class="fa fa-dashboard"></i>{{ __('frontstaticword.InstructorDashboard') }}</li></a>
                        @endif
                        <a href="{{ route('mycourse.show') }}"><li><i class="fa fa-diamond"></i>{{ __('frontstaticword.MyCourses') }}</li></a>
                        {{-- <a href="{{ route('wishlist.show') }}"><li><i class="fa fa-heart"></i>{{ __('frontstaticword.MyWishlist') }}</li></a> --}}
                        {{-- <a href="{{ route('purchase.show') }}"><li><i class="fa fa-shopping-cart"></i>{{ __('frontstaticword.PurchaseHistory') }}</li></a> --}}
                        <a href="{{route('profile.show',Auth::User()->id)}}"><li ><i class="fa fa-user"></i>{{ __('frontstaticword.UserProfile') }}</li></a>
                        {{-- @if(Auth::User()->role == "user")
                            @if($gsetting->instructor_enable == 1)
                            <a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor"><li><i class="fas fa-chalkboard-teacher"></i>{{ __('frontstaticword.BecomeAnInstructor') }}</li></a>
                            @endif
                
                        @endif   --}}

                       
                    </ul>
                </div>
                
               
                @endauth
            </div>
        </div>
        
        <!-- end navigation -->
        <div class="row smallscreen-search-block">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="logo">
                            @php
                                $setting = App\Setting::first();
                            @endphp

                            @if($setting->logo_type == 'L')
                                <a href="{{ url('/') }}" ><img src="{{ asset('images/logo/'.$setting->logo) }}" class="img-fluid" alt="logo"></a>
                            @else()
                                <a href="{{ url('/') }}"><b><div class="logotext">{{ $setting->project_title }}</div></b></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="navigation">
                            <div id="cssmenu">
                                <ul>
                                    <li><a href="#" title="Categories"><i class="flaticon-grid"></i>{{ __('frontstaticword.Categories') }}</a>
                                        @php
                                         $categories = App\Categories::orderBy('position','ASC')->get();
                                        @endphp
                                        <ul>
                                            @foreach($categories as $cate)
                                            @if($cate->status == 1 )
                                            <li><a href="{{ route('category.page',$cate->id) }}" title="{{ $cate->title }}"><i class="fa {{ $cate->icon }} rgt-20"></i>{{ $cate->title }}<i class="fa fa-chevron-right float-rgt"></i></a>
                                            <ul>   
                                                @foreach($cate->subcategory as $sub)
                                                @if($sub->status ==1)
                                                <li><a href="{{ route('subcategory.page',$sub->id) }}" title="{{ $sub->title }}"><i class="fa {{ $sub->icon }} rgt-20"></i>{{ $sub->title }}
                                                    <i class="fa fa-chevron-right float-rgt"></i></a>
                                                    <ul>
                                                        @foreach($sub->childcategory as $child)
                                                        @if($child->status ==1)
                                                        <li>
                                                            <a href="{{ route('childcategory.page',$child->id) }}" title="{{ $child->title }}"><i class="fa {{ $child->icon }} rgt-20"></i>{{ $child->title }}</a>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endif
                                               @endforeach
                                            </ul>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                @guest
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="learning-business">
                            @if($setting->instructor_enable == 1)
                                <a href="{{ route('login') }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Login/Register To Become an Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="Login-btn">
                            <a href="#find" class="nav-search nav-wishlist"><i class="fa fa-search"></i></a>
                            <a href="{{ route('register') }}" class="btn btn-primary" title="register">{{ __('frontstaticword.Signup') }}</a>
                            <a href="{{ route('login') }}" class="btn btn-secondary" title="login">{{ __('frontstaticword.Login') }}</a>
                        </div> 
                    </div>
                @endguest

                @auth
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="learning-business learning-business-two">
                            @if(Auth::User()->role == "user")
                                @if($setting->instructor_enable == 1)
                                    <a href="#" class="btn btn-link" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-6">
                        <div class="learning-business">
                            <a href="{{ route('mycourse.show') }}" class="btn btn-link" title="My Course">{{ __('frontstaticword.MyCourses') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                        <div class="nav-wishlist">
                            <ul id="nav">
                                <li id="notification_li">
                                    <a href="{{ url('send') }}" id="notificationLink" title="Notification"><i class="fa fa-bell"></i></a>
                                    <span class="red-menu-badge red-bg-success">
                                        {{ Auth()->user()->unreadNotifications->count() }}
                                    </span>
                                    <div id="notificationContainer">
                                    <div id="notificationTitle">{{ __('frontstaticword.Notifications') }}</div>
                                    <div id="notificationsBody" class="notifications">
                                        <ul>
                                            @foreach(Auth()->user()->unreadNotifications as $notification)
                                                <li class="unread-notification">
                                                    <a href="{{url('notifications/'.$notification->id)}}">          
                                                    <div class="notification-image">
                                                        @if($notification->data['image'] !== NULL )
                                                            <img src="{{ asset('images/course/'.$notification->data['image']) }}" alt="course" class="img-fluid" >
                                                        @else
                                                            <img src="{{ Avatar::create($notification->data['id'])->toBase64() }}" alt="course" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="notification-data">
                                                        In {{ str_limit($notification->data['id'], $limit = 20, $end = '...') }}
                                                        <br>
                                                        {{ str_limit($notification->data['data'], $limit = 20, $end = '...') }}
                                                    </div>
                                                    </a>
                                                </li>
                                            @endforeach

                                            @foreach(Auth()->user()->readNotifications as $notification)
                                                <li>
                                                    <a href="{{ route('mycourse.show') }}">
                                                    <div class="notification-image">
                                                        @if($notification->data['image'] !== NULL )
                                                            <img src="{{ asset('images/course/'.$notification->data['image']) }}" alt="course" class="img-fluid" >
                                                        @else
                                                           <img src="{{ Avatar::create($notification->data['id'])->toBase64() }}" alt="course" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="notification-data">
                                                        In {{  str_limit($notification->data['id'], $limit = 20, $end = '...') }}
                                                        <br>
                                                        {{ str_limit($notification->data['data'], $limit = 20, $end = '...') }}
                                                    </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div id="notificationFooter"><a href="{{route('deleteNotification')}}">{{ __('frontstaticword.ClearAll') }}</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                        <div class="nav-wishlist">
                            <a href="{{ route('wishlist.show') }}" title="Go to Wishlist"><i class="fa fa-heart"></i></a>
                            <span class="red-menu-badge red-bg-success">
                                @php
                                    $data = App\Wishlist::where('user_id', Auth::User()->id)->get();
                                    if(count($data)>0){

                                        echo count($data);
                                    }
                                    else{

                                        echo "0";
                                    }
                                @endphp
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                        <div class="shopping-cart">
                            <a href="{{ route('cart.show') }}" title="Cart"><i class="flaticon-shopping-cart"></i></a>
                            <span class="red-menu-badge red-bg-success">
                                @php
                                    $item = App\Cart::where('user_id', Auth::User()->id)->get();
                                    if(count($item)>0){

                                        echo count($item);
                                    }
                                    else{

                                        echo "0";
                                    }
                                @endphp
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                        <div class="nav-search nav-wishlist">
                            <a href="#find"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="my-container">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle  my-dropdown" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                                  <img src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" class="circle" alt="user">
                                @else
                                    <img src="{{ asset('images/default/user.jpg')}}"  class="circle" alt="user">
                                @endif
                                <span class="dropdown__item name" id="name">{{ str_limit(Auth::User()->fname, $limit = 10, $end = '..') }}</span>
                                <span class="dropdown__item caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right User-Dropdown U-open" aria-labelledby="dropdownMenu1">
                                <div id="notificationTitle">
                                    @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                                      <img src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" class="dropdown-user-circle" alt="user">
                                    @else
                                        <img src="{{ asset('images/default/user.jpg')}}" class="dropdown-user-circle" alt="user">
                                    @endif
                                    <div class="user-detailss">
                                        {{ Auth::User()->fname }}
                                        <br>
                                        {{ Auth::User()->email }}
                                    </div>
                                    
                                </div>
                                @if(Auth::User()->role == "admin" )
                                <a target="_blank" href="{{ url('/admins') }}"><li><i class="fa fa-dashboard"></i>{{ __('frontstaticword.AdminDashboard') }}</li></a>
                                @endif
                                @if(Auth::User()->role == "instructor")

                                <a target="_blank" href="{{ url('/admins') }}"><li><i class="fa fa-dashboard"></i>{{ __('frontstaticword.InstructorDashboard') }}</li></a>
                                @endif
                                <a href="{{ route('mycourse.show') }}"><li><i class="fa fa-diamond"></i>{{ __('frontstaticword.MyCourses') }}</li></a>
                                <a href="{{ route('wishlist.show') }}"><li><i class="fa fa-heart"></i>{{ __('frontstaticword.MyWishlist') }}</li></a>
                                <a href="{{ route('purchase.show') }}"><li><i class="fa fa-shopping-cart"></i>{{ __('frontstaticword.PurchaseHistory') }}</li></a>
                                <a href="{{route('profile.show',Auth::User()->id)}}"><li ><i class="fa fa-user"></i>{{ __('frontstaticword.UserProfile') }}</li></a>
                                @if(Auth::User()->role == "user")
                                @if($gsetting->instructor_enable == 1)
                                <a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor"><li><i class="fas fa-chalkboard-teacher"></i>{{ __('frontstaticword.BecomeAnInstructor') }}</li></a>
                                @endif
                        
                                @endif

                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div id="notificationFooter">
                                        {{ __('frontstaticword.Logout') }}
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                                            @csrf
                                        </form>
                                    </div>
                                </a>
                            </ul>
                          </div>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
        
    </div>
</section>

<!-- start search -->
<div id="find" class="small-screen-navigation">
    <button type="button" class="close">×</button>
     <form action="{{ route('search') }}" class="form-inline search-form" method="GET">
         <input type="find" name="searchTerm" class="form-control" id="search"  placeholder="{{ __('frontstaticword.Searchforcourses') }}" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
         <button type="submit" class="btn btn-outline-info btn_sm">Search</button> 
     </form>
</div>
<!-- start end -->


<!-- side navigation  -->
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

@section('custom-script')
<script>
    $('.prime-cat').on('click',function(){

        var url = $(this).data('url');

        location.href = url;

    });

    $('.sub-cate').on('click',function(){

        var url = $(this).data('url');

        location.href = url;

    });

    $('.child-cate').on('click',function(){

        var url = $(this).data('url');

        location.href = url;

    });
</script>

@endsection

@include('instructormodel')

