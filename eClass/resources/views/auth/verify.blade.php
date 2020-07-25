@section('title', 'Verify Email')
@include('theme.head')
@section('Verify Email', 'Sign Up')

@include('admin.message')

<!-- end head -->
<!-- body start-->
<body>

<section id="signup" class="signup-block-main-block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 