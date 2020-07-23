@extends('theme.master')
@section('title', 'Contact Us')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">{{ __('frontstaticword.Contactus') }}</h1>
    </div>
</section> 
<!-- about-home end -->
<!-- contact-us start-->
<section id="contact-us" class="contact-us-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                @if($gsetting->map_enable == 'map')
                <!-- map -->
                    <section id="location" class="map-location btm-30"></section>
                <!-- end map -->
                @elseif($gsetting->map_enable == 'image')
                    <img src="{{ asset('images/contact/'.$gsetting->contact_image) }}" class="img-fluid">
                @endif
            </div>
            <div class="col-lg-5 col-md-6">
                <h4 class="contact-us-heading">{{ __('frontstaticword.KeepinTouch') }}</h4>
                <form id="demo-form2" method="post" action="{{ route('contact.user') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                    <div class="form-group">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                    </div>
                    <div class="comment btm-20">
                        <textarea id="comment" name="message" rows="6" placeholder="Your Message"></textarea>
                    </div>

                    
                    <div class="contact-form-btn">
                        <button type="submit" class="btn btn-primary" title="Send Message">{{ __('frontstaticword.Message') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="contact-dtl">
            <h4 class="contact-us-heading btm-40">{{ __('frontstaticword.ContactDetails') }}</h4>
            <div class="row">
                <div class="offset-lg-1 col-lg-3 col-md-4">
                    <ul>
                        <li class="btm-10"><i class="fa fa-map-marker"></i></li>
                        <li class="btm-10 caps">{{ __('frontstaticword.address') }}</li>
                        <li class="btm-40">{{ $gsetting->default_address }}</li>
                    </ul>
                </div>
                <div class="offset-lg-1 col-lg-3 col-md-4">
                    <ul>
                        <li class="btm-10"><i class="fa fa-envelope"></i></li>
                        <li class="btm-10 caps">{{ __('frontstaticword.Email') }} </li>
                        <li class="btm-40">{{ $gsetting->wel_email }}</li>
                    </ul>
                </div>
                <div class="offset-lg-1 col-lg-3 col-md-4">
                    <ul>
                        <li class="btm-10"><i class="fa fa-phone"></i></li>
                        <li class="btm-10 caps">{{ __('frontstaticword.Phone') }}</li>
                        <li class="btm-40">{{ $gsetting->default_phone }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact us end -->

@endsection

@section('custom-script')

<script>
    
jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "https://maps.googleapis.com/maps/api/js?key={{ $gsetting['map_api'] }}&libraries=places&callback=initialize";
    
    document.body.appendChild(script);
  });
  function initialize(){
    var myLatLng = {lat: {{ $gsetting['map_lat'] }}, lng: {{ $gsetting['map_long'] }}}; // Insert Your Latitude and Longitude For Footer Wiget Map
    var mapOptions = {
      center: myLatLng, 
      zoom: 15,
      disableDefaultUI: true,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]     
    }
    // For Footer Widget Map
    var map = new google.maps.Map(document.getElementById("location"), mapOptions);
    var image = 'images/icons/map.png';
    var beachMarker = new google.maps.Marker({
      position: myLatLng, 
      map: map,   
      icon: image
    });    
  }
</script>
<!-- end jquery -->

@endsection
