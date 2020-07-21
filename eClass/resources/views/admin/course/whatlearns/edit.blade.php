@extends('admin/layouts.master')
@section('title', 'Edit WhatLearn - Admin')
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
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.WhatLearns') }}</h4>
        </div>
        <br>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('whatlearns/'.$cate->id)}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

             <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.SelectCourse') }}</label>
              <select  name="course_id" class="form-control col-md-7 col-xs-12 display-none">
      
                @foreach($courses as $cou)
                  <option class="display-none" value="{{ $cou->id }}"{{$cate->courses->id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
                @endforeach
              </select>

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea rows="1" name="detail"  class="form-control" >{!! $cate->detail !!}</textarea>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $cate->status == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>
              </div>
              <br>
                    
              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 

@endsection