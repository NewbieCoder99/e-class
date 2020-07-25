@extends('admin/layouts.master')
@section('title', 'Edit Review - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Review') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('reviewrating/'.$jp->id)}}"data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <div class="row">
                <div class="col-md-6">
                  <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.Course') }}</label>
                  <select name="course" class="form-control col-md-7 col-xs-12 display-none">
                    @foreach($courses as $cou)
                      <option value="{{ $cou->id }}" {{$jp->courses->id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.User') }}</label>
                  <select name="user" class="form-control col-md-7 col-xs-12 display-none">
                  @foreach($users as $cu)
                  <option value="{{ $cu->id }}" {{$jp->user->id == $cu->id  ? 'selected' : ''}}>{{ $cu->fname}}</option>
                  @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <label for="Details">{{ __('adminstaticword.Review') }}:<sup class="redstar">*</sup></label>
                  <textarea rows="3" name="review"  class="form-control" placeholder="Enter Your review">{{ $jp->review }}</textarea>
                </div>
              </div>   
              <br>

              <div class="row">
                <div class="col-md-3">
                  <label for="status">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="abcde" type="checkbox" {{ $jp->status==1 ? 'checked' : '' }}>
                  <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="abcde"></label>
                  </li>
                  <input type="hidden" name="status" value="{{ $jp->status }}" id="abcdef">
                </div>
                <div class="col-md-3">
                  <label for="approved">{{ __('adminstaticword.Approved') }}:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb10112" type="checkbox" {{ $jp->approved==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb10112"></label>
                  </li>
                  <input type="hidden" name="approved" value="{{ $jp->approved }}" id="jjjj">
                </div>
                <div class="col-md-3">
                  <label for="featured">{{ __('adminstaticword.Featured') }}:</label>
                  <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="featured1" type="checkbox" {{ $jp->featured==1 ? 'checked' : '' }}>
                  <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="featured1"></label>
                  </li>
                  <input type="hidden" name="featured" value="{{ $jp->featured }}" id="featured2">
                </div>
              </div>
              <br>
        
              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
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
