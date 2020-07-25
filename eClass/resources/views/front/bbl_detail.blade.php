@extends('theme.master')
@section('title', "$bbl->meetingname")
@section('content')

@include('admin.message')
<!-- course detail header start -->
<section id="about-home" class="about-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-home-block text-white">
                    <h1 class="about-home-heading text-white">{{ $bbl['meetingname'] }}</h1>
                    <ul>
                       
                    <ul>
                        <li><a href="#" title="about">{{ __('frontstaticword.Created') }}: {{ $bbl->user['fname'] }} </a></li>
                        <li><a href="#" title="about">Start At: {{ date('d-m-Y | h:i:s A',strtotime($bbl['start_time'])) }}</a></li>
                        
                    </ul>
                </div>
            </div>
            <!-- course preview -->
            <div class="col-lg-4">
                
                
                <div class="about-home-product">
                    <div class="video-item hidden-xs">
                       
                        <div class="video-device">
                            <img src="{{ Avatar::create($bbl['meetingname'])->toBase64() }}" class="bg_img img-fluid" alt="Background">
                        </div>
                    </div>
               
                     
                    <div class="about-home-dtl-training">
                        <div class="about-home-dtl-block btm-10">
                        
                            <div class="about-home-btn btm-20">
                                <a href="" data-toggle="modal" data-target="#myModalBBL" title="join" class="btn btn-secondary" title="course">{{ __('frontstaticword.JoinMeeting') }}</a>
                            </div>

                            <div class="modal fade" id="myModalBBL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			                    <div class="modal-dialog modal-lg" role="document">
			                      <div class="modal-content">
			                        <div class="modal-header">

			                          <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.JoinMeeting') }}</h4>
			                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                        </div>
			                        <div class="box box-primary">
			                          <div class="panel panel-sum">
			                            <div class="modal-body">
			                                 
                                             <form action="{{ route('bbl.api.join') }}" method="POST">
                                                 @csrf

                                                <div class="form-group"> 
                                                    <label>Meeting ID:</label>
                                                    <input readonly="" type="text" name="meetingid" value="{{ $bbl['meetingid'] }}" class="form-control">
                                                </div>

                                                <div class="form-group"> 
                                                    <label>Your Name:</label>
                                                    <input value="{{ old('name') }}" type="text" required="" name="name" placeholder="enter your name" class="form-control">
                                                </div>

                                                <div class="form-group"> 
                                                    <label>Meeting Password:</label>
                                                    <input type="password" name="password" placeholder="enter meeting password" class="form-control" required="">
                                                </div>

                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    + Start
                                                </button>

                                             </form>
			                            
			                            </div>
			                          </div>
			                        </div>
			                      </div>
			                    </div> 
			                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- course header end -->
<!-- course detail start -->
<section id="about-product" class="about-product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="requirements">
                    <h3>{{ __('frontstaticword.Detail') }}</h3>
                    <ul>
                        <li class="comment more">
                           
                           {!! $bbl->detail !!}
                           
                        </li>
                       
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</section>


<!-- course detail end -->
@endsection

