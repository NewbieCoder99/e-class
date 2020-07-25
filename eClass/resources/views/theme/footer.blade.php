<footer id="footer" class="footer-main-block">
    <div class="container">
        <div class="footer-block">
            <div class="row">
                @php
                    $widgets = App\WidgetSetting::first();
                @endphp
                @if(isset($widgets))

                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_one }}</b></div>
                    <div class="footer-link">
                        <ul>
                            @if($gsetting->instructor_enable == 1)
                                @if(Auth::check())
                                    @if(Auth::User()->role == "user")
                                    <li><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('login') }}" title="Become an instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                @endif
                            @endif
                            <li><a href="{{ route('about.show') }}" title="About">{{ __('frontstaticword.Aboutus') }}</a></li>
                            @if(Auth::check())
                                <li><a href="{{url('user_contact')}}" title="About">{{ __('frontstaticword.Contactus') }}</a></li>
                            @else
                                <li><a href="{{ route('login') }}" title="Contact Us">{{ __('frontstaticword.Contactus') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_two }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('careers.show') }}" title="Careers">{{ __('frontstaticword.Careers') }}</a></li>
                            <li><a href="{{ route('blog.all') }}" title="Blog">{{ __('frontstaticword.Blog') }}</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_three }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('help.show') }}" title="Help">{{ __('frontstaticword.Help&Support') }}</a></li>
                            @php
                                $pages = App\Page::get();
                            @endphp
                            
                            @if(isset($pages))
                            @foreach($pages as $page)
                                @if($page->status == 1)
                                <li><a href="{{ route('page.show', $page->slug) }}" title="Help">{{ $page->title }}</a></li>
                                @endif
                            @endforeach
                            @endif
                            
                        </ul>
                    </div>
                </div>
                @endif
                <div class="col-lg-3 col-md-6">
                    @php
                        $languages = App\Language::all(); 
                    @endphp
                    @if(isset($languages) && count($languages) > 0)
                    <div class="footer-dropdown txt-rgt">
                        <a href="#" class="a" data-toggle="dropdown"><i class="fa fa-globe rgt-15"></i>{{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}<i class="fa fa-angle-up lft-10"></i></a>
                        
                       
                        <ul class="dropdown-menu">
                          
                            @foreach($languages as $language)
                            <a href="{{ route('languageSwitch', $language->local) }}"><li>{{$language->name}}</li></a>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="tiny-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo-footer">
                        <ul>
                            @php
                                $logo = App\Setting::first();
                            @endphp
                            <li>
                                @if($logo->logo_type == 'L')
                                    <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" alt="logo" class="img-fluid" ></a>
                                @else()
                                    <a href="{{ url('/') }}"><b>{{ $logo->project_title }}</b></a>
                                @endif
                            </li>

                            <li>{{ $cpy_txt }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="copyright-social">
                        <ul>
                            <li><a href="{{url('terms_condition')}}" title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a></li> 
                            <li><a href="{{url('privacy_policy')}}" title="Policy">{{ __('frontstaticword.PrivacyPolicy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('instructormodel')
