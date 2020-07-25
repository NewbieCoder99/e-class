@extends('admin/layouts.master')
@section('title', 'Edit Course - Admin')
@section('body')

<div class="box">
  <div class="box-header">
    <h3 >{{$cor->title }}</h3>
  </div>
  <div class="box-body">
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  </div>    
</div>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <div class="content-header">
        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
              <li role="presentation" class="active"><a href="#a" aria-controls="home" role="tab" data-toggle="tab">{{ __('adminstaticword.Course') }}</a></li>
              <li class=""  role="presentation"><a href="#b" aria-controls="profile" role="tab" data-toggle="tab">{{ __('adminstaticword.CourseInclude') }}</a></li>
              <li  class=""  role="presentation"><a href="#c" aria-controls="messages" role="tab" data-toggle="tab">{{ __('adminstaticword.WhatLearns') }}</a></li>
              <li  class=""  role="presentation"><a href="#d" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.CourseChapter') }}</a></li>
              <li  class=""  role="presentation"><a href="#e" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.CourseClass') }}</a></li>
              <li  class=""  role="presentation"><a href="#market" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.RelatedCourse') }}</a></li>
              <li  class=""  role="presentation"><a href="#copy" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.Question') }}</a></li>
              <li  class=""  role="presentation"><a href="#ans" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.Answer') }}</a></li>
              <li  class=""  role="presentation"><a href="#jj" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.ReviewRating') }}</a></li>
              <li  class=""  role="presentation"><a href="#an" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.Announcement') }}</a></li>
              <li  class=""  role="presentation"><a href="#report" aria-controls="settings" role="tab" data-toggle="tab">{{ __('adminstaticword.ReviewReport') }}</a></li>
              <li  class=""  role="presentation"><a href="#topic" aria-controls="topic" role="tab" data-toggle="tab">{{ __('adminstaticword.QuizTopic') }}</a></li>
              <li  class=""  role="presentation"><a href="#assign" aria-controls="topic" role="tab" data-toggle="tab">{{ __('adminstaticword.Assignment') }}</a></li>
              <li  class=""  role="presentation"><a href="#appoint" aria-controls="Appointment" role="tab" data-toggle="tab">{{ __('adminstaticword.Appointment') }}</a></li>
           
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="a">
                @include('admin.course.editcor')
              </div>
              <div role="tabpanel" class="tab-pane fade" id="b">
                @include('admin.course.courseinclude.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="c">
                @include('admin.course.whatlearns.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="d">
                @include('admin.course.coursechapter.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="e">
                @include('admin.course.courseclass.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="market">
                @include('admin.course.relatedcourse.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="copy">
                @include('admin.course.questionanswer.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="ans">
                @include('admin.course.answer.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="jj">
                @include('admin.course.reviewrating.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="an">
                @include('admin.course.announsment.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="report">
                @include('admin.course.reviewreport.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="topic">
                @include('admin.course.quiztopic.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="assign">
                @include('admin.course.assignment.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="appoint">
                @include('admin.course.appointment.index')
              </div>
             
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


@section('script')

<script>
(function($) {
"use strict";
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }
  });
})(jQuery);
</script>

@endsection
  