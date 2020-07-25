@extends('admin/layouts.master')
@section('title', 'Add Faq - Admin')
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
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.FAQ') }}</h3>
        </div>       
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{url('faq/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}


              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="title" placeholder=" Enter Your Titie" id="exampleInputTitle" value="">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="details" class="form-control" rows="5" placeholder="Enter Your Details" value=""></textarea>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <br>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>
              </div>
              <br>

            <div class="box-footer">
              <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
            </div>

          </form>
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


@section('script')

<script>
(function($) {
"use strict";
  tinymce.init({selector:'textarea'});
})(jQuery);
</script>

@endsection