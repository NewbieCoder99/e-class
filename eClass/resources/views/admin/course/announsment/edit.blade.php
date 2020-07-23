@extends('admin/layouts.master')
@section('title', 'Edit Announcement - Admin')
@section('body')

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Announcement') }}</h3>
        </div>
        <!-- /.box-header -->
     
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('announsment/'.$annou->id)}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.SelectCourse') }}</label>
              <select name="course_id" class="form-control col-md-7 col-xs-12 display-none">
                @foreach($courses as $cou)
                  <option class="display-none" value="{{ $cou->id }}" {{$annou->courses->id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
                @endforeach
              </select>

              <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.User') }}</label>
              <select  name="user" class="form-control col-md-7 col-xs-12 display-none">
                @foreach($user as $cu)
                  <option class="display-none" value="{{ $cu->id }}" {{$annou->user->id == $cu->id  ? 'selected' : ''}}>{{ $cu->fname}}</option>
                @endforeach
              </select>
                 
              <div class="row">
                <div class="col-md-9">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Announcement') }}:<sup class="redstar">*</sup></label>
                  <textarea name="announsment" rows="3" class="form-control" >{{$annou->announsment}}</textarea>
                </div>
                <div class="col-md-3">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                      <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $annou->status == '1' ? 'checked' : '' }} >
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









