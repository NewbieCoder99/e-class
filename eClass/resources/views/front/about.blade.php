@extends('theme.master')
@section('title', 'About Us')
@section('content')

@include('admin.message')

<!-- about-home start -->
@if($about['one_enable'] == 1)
<section id="about-home-one" class="about-home-one-main-block" style="background-image: url('{{ asset('images/about/'.$about->one_image) }}')">
    <div class="overlay-bg"></div>
    <div class="container">
        <h1 class="about-home-one-heading text-white text-center">{{ $about->one_heading }}</h1>
    </div>
</section>
<section id="about-blog" class="about-blog-main-block">
    <div class="container">
        <div class="about-blog-block text-center"><a href="{{ $about->link_four }}" title="NextClass Blog"><span>
            <i class="fa fa-circle rgt-10"></i>{{ $gsetting->project_title }} Blog: </span>{{ $about->one_text }}</a>
        </div>
    </div>   
</section>
@endif 
<!-- about-blog end -->
<!-- about-Transforming start -->
@if($about['two_enable'] == 1)
<section id="about-transforming" class="about-transforming-main-block">
   <div class="container">
        <div class="about-transforming-heading-block text-center">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-12">
                    <h1 class="text-center">{{ $about->two_heading }}</h1>  
                    <p>{{ $about->two_text }}</p>
                </div>
            </div>
        </div>
        <div class="about-block-two">       
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active"  id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                    <div class="row no-gutters">
                        <div class="col-lg-8">
                            <div class="about-transforming-img">
                                <a href="#" title="about">
                                    <img src="{{ asset('images/about/'.$about->two_imageone) }}" class="img-fluid" alt="about-img"><div class="overlay-bg"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-transforming-block">
                                <h3>{{ $about->two_txtone }}</h3>
                                <p class="btm-40">{{ $about->two_imagetext }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                    <div class="row no-gutters">
                        <div class="col-lg-8">
                            <div class="about-transforming-img">
                                <a href="#" title="about">
                                    <img src="{{ asset('images/about/'.$about->two_imagetwo) }}" class="img-fluid" alt="about-img"><div class="overlay-bg"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-transforming-block">
                                <h3>{{ $about->two_txttwo }}</h3>
                                <p class="btm-40">{{ $about->text_one }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                    <div class="row no-gutters">
                        <div class="col-lg-8">
                            <div class="about-transforming-img">
                                <a href="#" title="about">
                                    <img src="{{ asset('images/about/'.$about->two_imagethree) }}" class="img-fluid" alt="about-img"><div class="overlay-bg"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-transforming-block">
                                <h3>{{ $about->two_txtthree }}</h3>
                                <p class="btm-40">{{ $about->text_two }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab">
                    <div class="row no-gutters">
                        <div class="col-lg-8">
                            <div class="about-transforming-img">
                                <a href="#" title="about">
                                    <img src="{{ asset('images/about/'.$about->two_imagefour) }}" class="img-fluid" alt="about-img"><div class="overlay-bg"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-transforming-block">
                                <h3>{{ $about->two_txtfour }}</h3>
                                <p class="btm-40">{{ $about->text_three }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <div class="col-lg-3 col-sm-6">
                        <a class="nav-item nav-link" id="nav-one-tab" data-toggle="tab" href="#nav-one" role="tab" aria-controls="nav-one" aria-selected="true"><img src="{{ asset('images/about/'.$about->two_imageone) }}" class="img-fluid" alt="about-img"><div class="about-nav-heading active">{{ $about->two_txtone }}</div></a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a class="nav-item nav-link" id="nav-two-tab" data-toggle="tab" href="#nav-two" role="tab" aria-controls="nav-two" aria-selected="false"><img src="{{ asset('images/about/'.$about->two_imagetwo) }}" class="img-fluid" alt="about-img"><div class="about-nav-heading active">{{ $about->two_txttwo }}</div></a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a class="nav-item nav-link" id="nav-three-tab" data-toggle="tab" href="#nav-three" role="tab" aria-controls="nav-three" aria-selected="false"><img src="{{ asset('images/about/'.$about->two_imagethree) }}" class="img-fluid" alt="about-img"><div class="about-nav-heading active">{{ $about->two_txtthree }}</div></a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a class="nav-item nav-link" id="nav-four-tab" data-toggle="tab" href="#nav-four" role="tab" aria-controls="nav-four" aria-selected="false"><img src="{{ asset('images/about/'.$about->two_imagefour) }}" class="img-fluid" alt="about-img"><div class="about-nav-heading active">{{ $about->two_txtfour }}</div></a>
                    </div>
                </div>
            </nav>
        </div>
   </div> 
</section>
@endif
<!-- about-Transforming end -->
<!-- facts start-->
@if($about['three_enable'] == 1)
<section id="facts" class="facts-main-block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="facts-block-heading text-center">{{ $about->three_heading }}</h1>
                <p class="text-center btm-40">{{ $about->three_text }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="facts-block text-center btm-40">
                    <h1 class="facts-heading counter">{{ $about->three_countone }}</h1>
                    <div class="facts-dtl">{{ $about->three_txtone }}</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="facts-block text-center btm-40">
                    <h1 class="facts-heading counter">{{ $about->three_counttwo }}</h1>
                    <div class="facts-dtl">{{ $about->three_txttwo }}</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="facts-block text-center btm-40">
                    <h1 class="facts-heading counter">{{ $about->three_countthree }}</h1>
                    <div class="facts-dtl">{{ $about->three_txtthree }}</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="facts-block text-center btm-40">
                    <h1 class="facts-heading counter">{{ $about->three_countfour }}</h1>
                    <div class="facts-dtl">{{ $about->three_txtfour }}</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="facts-block text-center btm-40">
                    <h1 class="facts-heading counter">{{ $about->three_countfive }}</h1>
                    <div class="facts-dtl">{{ $about->three_txtfive }}</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="facts-block text-center btm-40">
                    <h1 class="facts-heading counter">{{ $about->three_countsix }}</h1>
                    <div class="facts-dtl">{{ $about->three_txtsix }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- facts end-->
<!-- about-work start-->
@if($about['four_enable'] == 1)
<section id="about-work" class="about-work-main-block">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="about-work-block text-center">
                    <div class="about-work-heading">{{ $about->four_heading }}</div>
                    <p class="text-white btm-30">{{ $about->four_text }}</p>
                   
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-work-video">
                    <div class="video-item hidden-xs">
                        <script type="text/javascript">
                        var video_url = '<iframe src="https://www.youtube.com/embed/ZMdCsIaE7II?autoplay=1&showinfo=0" frameborder="0"></iframe>';
                        </script>
                        <div class="video-device">
                            <img src="{{ asset('images/about/'.$about->four_imageone) }}" class="bg_img img-fluid" alt="Background">

                            <div class="overlay-bg"></div>
                            <div class="video-preview">
                                <p>{{ $about->four_txtone }}</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="about-work-video">
                    <div class="video-item hidden-xs">
                        <script type="text/javascript">
                        var video_url = '<iframe src="https://www.youtube.com/embed/ZMdCsIaE7II?autoplay=1&showinfo=0" frameborder="0"></iframe>';
                        </script>
                        <div class="video-device">
                            <img src="{{ asset('images/about/'.$about->four_imagetwo) }}" class="bg_img img-fluid" alt="Background">

                            <div class="overlay-bg"></div>
                            <div class="video-preview">
                                <p>{{ $about->four_txttwo }}</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-work-block text-center">
                    <div class="about-work-heading">{{ $about->four_heading }}</div>
                    <p class="text-white btm-30">{{ $about->four_text }}</p>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- about-work end-->
<!-- about-team start-->
@if($about['five_enable'] == 1)
<section id="about-team" class="about-team-main-block">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="about-team-block text-center">
                    <div class="about-team-heading btm-20">{{ $about->five_heading }}</div>
                    <p class="btm-40">{{ str_limit($about->five_text, $limit = 200, $end = '...') }}</p>
                   
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-team-img">
                    <img src="{{ asset('images/about/'.$about->five_imageone) }}" class="img-fluid" alt="about-img">
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6 col-sm-6">
                       <div class="about-team-img">
                            <img src="{{ asset('images/about/'.$about->five_imagetwo) }}" class="img-fluid" alt="about-img">
                        </div> 
                    </div>
                    <div class="col-lg-6 col-sm-6">
                       <div class="about-team-img">
                            <img src="{{ asset('images/about/'.$about->five_imagethree) }}" class="img-fluid" alt="about-img">
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- about-team start-->
<!-- about-learning-blog start-->
@if($about['six_enable'] == 1)
<section id="about-learning-blog" class="about-learning-blog-main-block btm-40">
    <div class="container">
        <h1 class="about-learning-blog-heading text-white text-center btm-40">{{ $about->six_heading }}</h1>
        <div class="about-learning-blog-block">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{ $about->link_one }}">
                    <div class="about-learning-blog-dtl text-white btm-20">
                        <h3 class="about-learning-blog-dtl-heading text-white">{{ $about->six_txtone }}</h3>
                        <div class="row">
                            <div class="col-lg-10 col-9">
                                <div class="about-learning-blog-paragraph">
                                    <p>{{ str_limit($about->six_deatilone, $limit = 100, $end = '...') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-3">
                                <div class="about-learning-blog-icon lft-7">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ $about->link_two }}">
                    <div class="about-learning-blog-dtl text-white btm-20">
                        <h3 class="about-learning-blog-dtl-heading text-white">{{ $about->six_txttwo }}</h3>
                        <div class="row">
                            <div class="col-lg-10 col-9">
                                <div class="about-learning-blog-paragraph lft-7">
                                    <p>{{ str_limit($about->six_deatiltwo, $limit = 100, $end = '...') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-3">
                                <div class="about-learning-blog-icon">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ $about->link_three }}">
                    <div class="about-learning-blog-dtl text-white">
                        <h3 class="about-learning-blog-dtl-heading text-white">{{ $about->six_txtthree }}</h3>
                        <div class="row">
                            <div class="col-lg-10 col-9">
                                <div class="about-learning-blog-paragraph">
                                    <p>{{ str_limit($about->six_deatilthree, $limit = 100, $end = '...') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-3">
                                <div class="about-learning-blog-icon lft-7">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="about-social-list text-white text-center">
        <ul>
            <li>Follow Us :</li>
            <li><a href="{{ $about->four_btntext }}" target="_blank" title="facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="{{ $about->five_btntext }}" target="_blank" title="instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</section>
@endif
<!-- about-learning-blog end-->
@endsection
