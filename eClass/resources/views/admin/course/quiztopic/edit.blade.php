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
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Quiz') }}</h3>
          
        </div>
        <br>
        <div class="panel-body">

           <form id="demo-form2" method="POST" action="{{route('quiztopic.update', $topic->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                     
                     

                      <div class="row">
                        <div class="col-md-12">
                          <label for="exampleInputTit1e">{{ __('adminstaticword.QuizTopic') }}:<span class="redstar">*</span> </label>
                          <input type="text" placeholder="Enter Quiz Topic" class="form-control " name="title" id="exampleInputTitle" value="{{ $topic->title }}">
                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="col-md-12">
                          <label for="exampleInputDetails">{{ __('adminstaticword.QuizDescription') }}:<sup class="redstar">*</sup></label>
                          <textarea name="description" rows="3" class="form-control" placeholder="Enter Description">{{ $topic->description }}</textarea>
                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="col-md-12">
                          <label for="exampleInputTit1e">{{ __('adminstaticword.PerQuestionMarks') }}:<span class="redstar">*</span> </label>
                          <input type="number" placeholder="Enter Per Question Mark" class="form-control " name="per_q_mark" id="exampleInputTitle" value="{{ $topic->per_q_mark }}">
                        </div>
                      </div>
                      <br>


                      <div class="row display-none">
                        <div class="col-md-12">
                          <label for="exampleInputTit1e">{{ __('adminstaticword.QuizTimer') }}:<span class="redstar">*</span> </label>
                          <input type="text" placeholder="Enter Quiz Time" class="form-control" name="timer" id="exampleInputTitle" value="{{ $topic->timer }}">
                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="col-md-12">
                          <label for="exampleInputTit1e">{{ __('adminstaticword.Days') }}:</label>
                          <small>(Days after quiz will start when user enroll in course)</small>
                          <input type="text" placeholder="Enter Due Days" class="form-control" name="due_days" id="exampleInputTitle" value="{{ $topic->due_days }}">
                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="col-md-4">
                          <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                            <li class="tg-list-item">              
                              <input class="tgl tgl-skewed" id="111" type="checkbox" name="status" {{ $topic->status == '1' ? 'checked' : '' }} >
                              <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="111"></label>
                            </li>
                            <input type="hidden" name="free" value="0" for="status" id="122">
                        </div>

                        <div class="col-md-4">
                          <label for="exampleInputTit1e">{{ __('adminstaticword.QuizReattempt') }}:</label>
                            <li class="tg-list-item">              
                              <input class="tgl tgl-skewed" id="112" type="checkbox" name="quiz_again" {{ $topic->quiz_again == '1' ? 'checked' : '' }} >
                              <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="112"></label>
                            </li>
                            <input type="hidden" name="free" value="0" for="quiz_again" id="123">
                        </div>
                      </div>
                      <br>
              
                      <div class="box-footer">
                        <button type="submit" value="Add Answer" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
                      </div>

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

