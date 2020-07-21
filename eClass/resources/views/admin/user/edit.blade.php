@extends('admin.layouts.master')
@section('title', 'Edit User - Admin')
@section('body')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Users') }}</h3>

          
        </div>
        <br>
        <div class="panel-body">
          <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="fname">
                  {{ __('adminstaticword.FirstName') }}:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->fname }}" autofocus required name="fname" type="text" class="form-control" placeholder="Enter first name"/>
              </div>

              <div class="col-md-6">
                <label for="lname">
                  {{ __('adminstaticword.LastName') }}:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->lname }}" required name="lname" type="text" class="form-control" placeholder="Enter last name"/>
              </div>
            </div>
            <br>

            <div class="row">

              <div class="col-md-6">
                <label for="mobile"> {{ __('adminstaticword.Mobile') }}:<sup class="redstar">*</sup></label>
                <input value="{{ $user->mobile }}" required type="text" name="mobile" placeholder="Enter mobile no" class="form-control">
               </div>
               <div class="col-md-6">
                <label for="mobile">{{ __('adminstaticword.Email') }}:<sup class="redstar">*</sup> </label>
                <input value="{{ $user->email }}" required type="email" name="email" placeholder="Enter email" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                  <label for="address">{{ __('adminstaticword.Address') }}:<sup class="redstar">*</sup> </label>
                  <textarea name="address" class="form-control" rows="1" required  placeholder="Enter adderss" value="">{{ $user->address }}</textarea>
              </div>

              <div class="col-md-6">
                <label for="dob">{{ __('adminstaticword.DateofBirth') }}: </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {{-- <input type="date" value="{{ $user->dob }}" name="dob" required class="form-control pull-right" id="datepicker" placeholder="Enter your date of birth"> --}}
                  <input type="date" id="date" name="dob" class="form-control" placeholder="" value="{{ $user->dob }}" >
                </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
               <label for="gender">{{ __('adminstaticword.Gender') }}:</label>
                <br>
                <input type="radio" name="gender" id="ch1" value="m" {{ $user->gender == 'm' ? 'checked' : '' }}> {{ __('adminstaticword.Male') }}
                <input type="radio" name="gender" id="ch2" value="f" {{ $user->gender == 'f' ? 'checked' : '' }}> {{ __('adminstaticword.Female') }}
                <input type="radio" name="gender" id="ch3" value="o" {{ $user->gender == 'o' ? 'checked' : '' }}> {{ __('adminstaticword.Other') }}
              </div>

              <div class="col-md-6">
                <label for="role">{{ __('adminstaticword.SelectRole') }}:</label>
                  @if(Auth::User()->role=="admin")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('adminstaticword.User') }}</option>
                    <option {{ $user->role == 'admin' ? 'selected' : ''}} value="admin">{{ __('adminstaticword.Admin') }}</option>
                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">{{ __('adminstaticword.Instructor') }}</option>
                  </select>
                  @endif
                  @if(Auth::User()->role=="instructor")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('adminstaticword.User') }}</option>
                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">{{ __('adminstaticword.Instructor') }}</option>
                  </select>
                  @endif
                  @if(Auth::User()->role=="user")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('adminstaticword.User') }}</option>
                  </select>
                  @endif
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.Country') }}:</label>
                <select id="country_id" class="form-control js-example-basic-single" name="country_id">
                  <option value="none" selected disabled hidden> 
                      {{ __('adminstaticword.SelectanOption') }}
                    </option>
                  
                  @foreach ($countries as $coun)
                    <option value="{{ $coun->country_id }}" {{ $user->country_id == $coun->country_id ? 'selected' : ''}}>{{ $coun->nicename }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.State') }}:</label>
                <select id="upload_id" class="form-control js-example-basic-single" name="state_id">
                  <option value="none" selected disabled hidden> 
                    {{ __('adminstaticword.SelectanOption') }}
                  </option>
                  @foreach ($states as $s)
                    <option value="{{ $s->state_id}}" {{ $user->state_id==$s->state_id ? 'selected' : '' }}>{{ $s->name}}</option>
                  @endforeach

                </select>
              </div>

              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.City') }}:</label>
                <select id="grand" class="form-control js-example-basic-single" name="city_id">
                  <option value="none" selected disabled hidden> 
                     {{ __('adminstaticword.SelectanOption') }}
                  </option>
                  @foreach ($cities as $c)
                    <option value="{{ $c->id }}" {{ $user->city_id == $c->id ? 'selected' : ''}}>{{ $c->name }}
                    </option>
                  @endforeach
                </select>
              </div>
          
              <div class="col-md-3">
                <label for="pin_code">{{ __('adminstaticword.Pincode') }}:</label>
                <input value="{{ $user->pin_code }}" placeholder="Enter Pincode" type="text" name="pin_code" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Verified') }}:</label>
                <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="c033"   type="checkbox"  {{ $user->verified==1 ? 'checked' : '' }}>
                <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes" for="c033"></label>
                </li>
                <input type="hidden" name="verified" value="{{ $user->varified }}" id="tt">
              </div>

              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $user->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
              </li>
              <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>


              <div class="col-md-3">
                  <label  for="married_status">{{ __('adminstaticword.ChooseMarrigeStatus') }}: </label>
                  <select class="form-control js-example-basic-single" id="married_status" name="married_status">
                    <option value="none" selected disabled hidden> 
                       {{ __('adminstaticword.SelectanOption') }}
                    </option> 
                    <option id="Unmarried" {{ $user->married_status == 'Unmarried' ? 'selected' : ''}} value="Unmarried">{{ __('adminstaticword.Unmarried') }}</option>
                    <option id="Married" {{ $user->married_status == 'Married' ? 'selected' : ''}} value="Married">{{ __('adminstaticword.Married') }}</option>
                    <option id="Divorced" {{ $user->married_status == 'Divorced' ? 'selected' : ''}} value="Divorced">{{ __('adminstaticword.Divorced') }}</option>
                    <option id="Widowed" {{ $user->married_status == 'Widowed' ? 'selected' : ''}} value="Widowed">{{ __('adminstaticword.Widowed') }}</option>
                  </select>
                  <br> 
              </div>


              <div class="col-md-3 display-none" id="doaboxxx">
                <label for="dob">{{ __('adminstaticword.DateofAnniversary') }}: </label>
                <input value="{{ $user->doa }}" name="doa" id="doa" type="text" class="form-control" placeholder="Enter Date of anniversary">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                <input type="file" name="user_img" class="form-control">
              </div>
              <div class="col-md-6">
                @if($user->user_img != null || $user->user_img !='')
                  <div class="edit-user-img">
                    <img src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @else
                  <div class="edit-user-img">
                    <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @endif
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-12">
                <div class="update-password">
                  <label for="box1"> {{ __('adminstaticword.UpdatePassword') }}:</label>
                  <input type="checkbox" id="myCheck" name="update_pass" onclick="myFunction()">
                </div>
              </div>
            </div>

            <div class="row display-none" id="update-password">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.Password') }}</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
              </div>
              <div class="col-md-6">
                <label>{{ __('adminstaticword.ConfirmPassword') }}</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password">
              </div>
            </div>
            <br>


            <div class="row">
              <div class="col-md-12">
                <label for="detail">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                <textarea id="detail" name="detail" class="form-control" rows="5" placeholder="Enter your details" value="">{{ $user->detail }}</textarea>
              </div>
            </div>
            <br>

            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.SocialProfile') }}</h3>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label for="fb_url">
                {{ __('adminstaticword.FacebookUrl') }}:
                </label>
                <input autofocus name="fb_url" value="{{ $user->fb_url }}" type="text" class="form-control" placeholder="Facebook.com/"/>
              </div>
              <div class="col-md-6">
                <label for="youtube_url">
                {{ __('adminstaticword.YoutubeUrl') }}:
                </label>
                <input autofocus name="youtube_url" value="{{ $user->youtube_url }}" type="text" class="form-control" placeholder="youtube.com/"/>
                <br>
              </div>
            
              <div class="col-md-6">
                <label for="twitter_url">
                {{ __('adminstaticword.TwitterUrl') }}:
                </label>
                <input autofocus name="twitter_url" value="{{ $user->twitter_url }}" type="text" class="form-control" placeholder="Twitter.com/"/>
              </div>
              <div class="col-md-6">
                <label for="linkedin_url">
                {{ __('adminstaticword.LinkedInUrl') }}:
                </label>
                <input autofocus name="linkedin_url" value="{{ $user->linkedin_url }}" type="text" class="form-control" placeholder="Linkedin.com/"/>
              </div>
            </div>
            <br>
            <br>
            

            <div class="box-footer">
              <button type="submit" class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}
              </button>
            </form>
              <a href="{{ route('user.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
              </a>
            </div>
            <br>

          </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection

@section('scripts')

<script>
(function($) {
  "use strict";

  $( function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });
  

  $('#married_status').change(function() {
      
    if($(this).val() == 'Married')
    {
      $('#doaboxxx').show();
    }
    else
    {
      $('#doaboxxx').hide();
    }
  });

  tinymce.init({selector:'textarea#detail'});

  $(function() {
    var urlLike = '{{ url('country/dropdown') }}';
    $('#country_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val();    
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

  $(function() {
    var urlLike = '{{ url('country/gcity') }}';
    $('#upload_id').change(function() {
      var up = $('#grand').empty();
      var cat_id = $(this).val();    
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

})(jQuery);
</script>

<script>
  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("update-password");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
</script>

@endsection

