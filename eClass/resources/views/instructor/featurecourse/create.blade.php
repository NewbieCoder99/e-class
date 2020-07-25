@extends('admin/layouts.master')
@section('title', 'Add Feature Course - Admin')
@section('body')


<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">  {{ __('adminstaticword.Feature') }} {{ __('adminstaticword.Course') }}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{route('featurecourse.store')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
                      
           
              <div class="row">
                <div class="col-md-12">
                  <label>{{ __('adminstaticword.SelectCourse') }}: <span class="redstar">*</span></label>
                  <select name="course_id" id="course_id" class="form-control js-example-basic-single" required>
                    <option value="">{{ __('adminstaticword.SelectanOption') }}</option>
                    @foreach($courses as $course)
                      <option value="{{$course->id}}">{{$course->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>

              <div class="row">

                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.User') }}</label>
                  <select name="user_id" class="form-control js-example-basic-single">
                      <option value="{{Auth::user()->id}}">{{Auth::user()->fname}}</option>
                  </select>
                </div>
              </div>
              <br>
             

              <div class="row">
                <div class="col-md-12 display-none"> 
                  <label for="total_amount">Amount to be paid to feature Course:</sup></label>
                  <input value="{{ $gsetting->feature_amount }}" type="hidden" name="total_amount" class="form-control" readonly="">
                </div>
              </div>

              @php
                  $currency = App\Currency::first();
              @endphp

              <label for="total_amount">Amount to be paid to feature a course:</sup></label>&nbsp;
              <i class="{{ $currency->icon }}"></i>&nbsp;{{ $gsetting->feature_amount }}

              
      
              <div class="box-footer">
                <button type="submit" value="Add Slider" class="btn btn-md col-md-4 btn-primary">Pay to feature course</button>
              </div>
         
            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 
@endsection

