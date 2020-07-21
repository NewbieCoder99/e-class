@section('title', 'ComingSoon')
@include('theme.head')

<!-- end head -->
<!-- body start-->
<body>

@if(isset($data))
<!-- top-nav bar start-->
<section id="comimg-soon" class="coming-soon-main-block" style="background-image: url('{{ asset('images/comingsoon/'.$data->bg_image) }}')">
    <div class="overlay-bg"></div>
    <div class="container-fluid">
        <div class="logo text-center">
            @php
                $logo = App\Setting::first();
            @endphp

            @if($logo->logo_type == 'L')
                <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" alt="logo"></a>
            @else()
                {{ $logo->project_title }}
            @endif
        </div>
        <div class="coming-soon-block">
            <h1 class="comming-soon-heading text-white text-center btm-40"> {{ $data->heading }} </h1>
            <div class="facts-dtl-block btm-40">
                <div class="row">
                    <div class="offset-lg-2 col-lg-2 col-md-3 col-sm-6 col-6">
                        <div class="facts-block text-center btm-20">
                            <h1 class="facts-heading counter text-white">{{ $data->count_one }}</h1>
                            <div class="facts-dtl text-white">{{ $data->text_one }}</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <div class="facts-block text-center btm-20">
                            <h1 class="facts-heading counter text-white">{{ $data->count_two }}</h1>
                            <div class="facts-dtl text-white">{{ $data->text_one }}</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <div class="facts-block text-center btm-20">
                            <h1 class="facts-heading counter text-white">{{ $data->count_three }}</h1>
                            <div class="facts-dtl text-white">{{ $data->text_one }}</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <div class="facts-block text-center btm-20">
                            <h1 class="facts-heading counter text-white">{{ $data->count_four }}</h1>
                            <div class="facts-dtl text-white">{{ $data->text_one }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-bar-btn btm-20 text-center">
                <a href="index.html" class="btn btn-primary" title="instructor">{{ $data->btn_text }}</a>
            </div>
        </div>
    </div>
</section>
<!-- top-nav bar end-->
@endif

@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 