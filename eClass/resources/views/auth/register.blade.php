@section('title', 'Sign Up')
@include('theme.head')
@include('admin.message')

<!-- end head -->
<!-- body start-->
<body>
<section id="nav-bar" class="nav-bar-main-block nav-bar-main-block-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="nav-bar-btn btm-20">
                    <a href="{{ url('/') }}" class="btn btn-secondary" title="Home"><i class="fa fa-chevron-left"></i>{{ __('frontstaticword.Backtohome') }}</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="logo text-center btm-10">
                    @php
                        $logo = App\Setting::first();
                    @endphp

                    @if($logo->logo_type == 'L')
                        <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" class="img-fluid" alt="logo"></a>
                    @else()
                        <a href="{{ url('/') }}"><b><div class="logotext">{{ $logo->project_title }}</div></b></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="Login-btn txt-rgt">
                    <a href="{{ route('login') }}" class="btn btn-secondary" title="login">{{ __('frontstaticword.Login') }}</a>
                </div> 
            </div>
        </div>
    </div>
</section>
<section id="signup" class="signup-block-main-block">
    <div class="container">
        <div class="col-lg-6 col-md-8 offset-md-3">
            <div class="signup-heading">
               {{ __('frontstaticword.StartLearning') }}!
            </div>

            <div class="signup-block">
                @if($gsetting->fb_login_enable == 1)
                    <div class="signin-link">
                        <a href="{{ url('/auth/facebook') }}" target="_blank" title="facebook" class="btn btn-info btm-10" title="Facebook"><i class="fa fa-facebook"></i>{{ __('frontstaticword.ContinuewithFacebook') }}</a>
                    </div>
                @endif
                
                @if($gsetting->google_login_enable == 1)
                    <div class="signin-link google">
                        <a href="{{ url('/auth/google') }}" target="_blank" title="google" class="btn btn-white btm-10" title="google"><i class="fab fa-google-plus-g"></i>{{ __('frontstaticword.ContinuewithGoogle') }}</a>
                    </div>
                @endif
                
                @if($gsetting->amazon_enable == 1)
                    <div class="signin-link amazon-button">
                        <a href="{{ url('/auth/amazon') }}" target="_blank" title="amazon" class="btn btn-info btm-10" title="Amazon"><i class="fab fa-amazon"></i>{{ __('frontstaticword.ContinuewithAmazon') }}</a>
                    </div>
                @endif

                @if($gsetting->linkedin_enable == 1)
                    <div class="signin-link linkedin-button">
                        <a href="{{ url('/auth/linkedin') }}" target="_blank" title="linkedin" class="btn btn-info btm-10" title="Linkedin"><i class="fab fa-linkedin"></i>{{ __('frontstaticword.ContinuewithLinkedin') }}</a>
                    </div>
                @endif

                @if($gsetting->twitter_enable == 1)
                    <div class="signin-link twitter-button">
                        <a href="{{ url('/auth/twitter') }}" target="_blank" title="twitter" class="btn btn-info btm-10" title="Twitter"><i class="fab fa-twitter"></i>{{ __('frontstaticword.ContinuewithTwitter') }}</a>
                    </div>
                @endif

                @if($gsetting->gitlab_login_enable == 1)
                    <div class="signin-link btm-10">
                        <a href="{{ url('/auth/gitlab') }}" target="_blank" title="gitlab" class="btn btn-white" title="gitlab"><i class="fab fa-gitlab"></i>{{ __('frontstaticword.ContinuewithGitLab') }}</a>
                    </div>
                @endif

                
                
                <form class="signup-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" id="fname" placeholder="First Name">
                        @if ($errors->has('fname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" id="lname" placeholder="Last Name">
                        @if($errors->has('lname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" id="email" placeholder="Email">
                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if($gsetting->mobile_enable == 1)
                    <div class="form-group">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" id="mobile" placeholder="Mobile">
                        @if($errors->has('mobile'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                    @endif
                    <div class="form-group">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <i class="fa fa-lock" aria-hidden="true"></i> 
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    
                    @if($gsetting->captcha_enable == 1)
                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                    @endif

                    
                    <button type="submit" title="Sign Up" class="btn btn-primary btm-20">{{ __('frontstaticword.Signup') }}</button> 

                    <div class="signin-link text-center btm-20">
                        {{ __('frontstaticword.Bysigningup') }} <a href="{{url('terms_condition')}}" title="Policy">{{ __('frontstaticword.Terms&Condition') }} </a>, <a href="{{url('privacy_policy')}}" title="Policy">{{ __('frontstaticword.PrivacyPolicy') }}.</a>
                    </div>
                    <hr>
                    <div class="sign-up text-center">{{ __('frontstaticword.Alreadyhaveanaccount') }}?<a href="{{ route('login') }}" title="sign-up"> {{ __('frontstaticword.Login') }}</a>
                    </div>
                </form>



            </div>
        </div>
    </div>
</section>


@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 
