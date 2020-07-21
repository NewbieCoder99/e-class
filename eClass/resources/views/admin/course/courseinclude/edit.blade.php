@extends('admin/layouts.master')
@section('title', 'Edit Course Include - Admin')
@section('body')

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="panel panel-sum">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.CourseInclude') }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('courseinclude/'.$cate->id)}} "data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

                <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.SelectCourse') }}</label>
                <select name="course_id" class="form-control col-md-7 col-xs-12 display-none">
        
                  @foreach($courses as $cou)
                    <option  value="{{ $cou->id }}" {{$cate->courses->id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
                  @endforeach
                </select>

                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.Icon') }}: <sup class="redstar">*</sup></label>
                    <input type="text" class="form-control icp-auto icp" name="icon" id="exampleInputTitle" value="{{$cate->icon}}">
                  </div>
                   <div class="col-md-6">

                    <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                    <textarea rows="1" name="detail" class="form-control" >{!! $cate->detail !!}</textarea>
                  </div>
                </div>
                <br>

                <div class="row">
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
