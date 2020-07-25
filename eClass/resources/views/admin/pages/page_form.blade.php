@extends('admin/layouts.master')
@section('title', 'Add Page - Admin')
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
    <!-- left column -->
    <div class="col-xs-12"> 
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Pages') }}</h3>
        </div>
        <br>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{url('page/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
          
              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                  <input type="text"  class="form-control" name="title" placeholder="Enter Your Title"  id="exampleInputTitle" value="">
                </div>
                <div class="col-md-6">                 
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="123"  type="checkbox"/>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="123"></label>
                  </li>
                  <input type="hidden" name="status" value="0" id="1234">
                </div>
                
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="details" id="editor2" rows="5" class="form-control" placeholder="Enter Your Details"></textarea>
                  <br>
                </div>
                
              </div>
              <br>

              <div class="box-footer">
               <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
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


@section('scripts')

<script>
    $(function () {
      CKEDITOR.replace('editor2');
    });
  </script>
@endsection