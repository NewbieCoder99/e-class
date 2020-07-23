@extends('theme.master')
@section('title', 'Blog')
@section('content')

@include('admin.message')
<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.Blog') }}</h1>
    </div>
</section> 
<!-- about-home end --> 
<!-- blog start -->
@if(isset($blogs))
<section id="blog" class="blog-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div id="blog-slider" class="blog-slider owl-carousel btm-40">
                    @foreach($blogs->take(3) as $item)
                    @if($item->status == 1 && $item->approved == 1)
                        <div class="item blog-slider-block">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="blog-slider-img">
                                        <a href="{{ route('blog.detail',$item->id) }}"><img src="{{ asset('images/blog/'.$item->image) }}" class="img-fluid" alt="blog"></a>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="blog-slider-dtl">
                                        <div class="slider-date btm-10">{{ date('jS F Y', strtotime($item->created_at)) }}</div>
                                        <h3 class="blog-slider-heading"><a href="{{ route('blog.detail',$item->id) }}" title="heading">{{ $item->heading }}</a></h3>
                                        <p class="btm-10">{!! str_limit($item->detail, $limit = 400, $end = '...') !!}</p>
                                        <div class="business-home-slider-btn btm-20">
                                            <button type="button" class="btn btn-link">{{ $item->text }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    @endif
                    @endforeach
                </div>
                @foreach($blogs as $blog )
                @if($blog->status == 1 && $blog->approved == 1)
                    <div class="blog-block btm-40">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="slider-date btm-10">{{ date('jS F Y', strtotime($blog->created_at)) }}</div>
                                <div class="blog-block-img">
                                   <a href="{{ route('blog.detail',$blog->id) }}"><img src="{{ asset('images/blog/'.$blog->image) }}" class="img-fluid"  alt="blog"></a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="block-block-dtl">
                                    <h3 class="blog-slider-heading"><a href="{{ route('blog.detail',$blog->id) }}" title="heading">{{ $blog->heading }}</a></h3>
                                    <p>{!! str_limit($item->detail, $limit = 400, $end = '...') !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
                @endforeach
                <div class="pull-right">{{ $blogs->links() }}</div>
            </div>
            
        </div>
    </div>
    <hr>
</section>
@endif
<!-- blog end -->

@endsection
