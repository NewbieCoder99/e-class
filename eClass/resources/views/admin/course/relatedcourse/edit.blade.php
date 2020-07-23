@extends('admin/layouts.master')
@section('title', 'Edit Related Course- Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.RelatedCourse') }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <form id="demo-form" method="post" action="{{url('relatedcourse/'.$cate->id)}}"data-parsley-validate class="form-horizontal form-label-left">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="hidden" class="form-control " name="user_id" id="user_id" value="{{ $cate->user_id }}"> 

                <div class="row" class="display-none">             
                  <div class="col-md-12">  
                    <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.Course') }}</label>
                    <select class="display-none" name="main_course_id" class="form-control">
                      <option value="{{ $cate->main_course_id }}">{{ $cate->main_course_id }}</option>
                    </select>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-8">
                    <label for="exampleInputSlug">{{ __('adminstaticword.RelatedCourse') }}</label>
                    <select name="course_id" class="form-control col-md-7 col-xs-12">
                     @foreach($courses as $cou)
                     <option value="{{ $cou->id }}" {{$cate->course_id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
                     @endforeach
                    </select>
                    <p class="txt-desc">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.RelatedCourse') }}</p>
                  </div>
                
                  <div class="col-md-4">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb7" type="checkbox" {{ $cate->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb7"></label>
                    </li>
                    <input type="hidden" name="status" value="{{ $cate->status }}" id="jeeet">
                  </div>
                </div>
                <br>
                
                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Submit') }}</button>
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









