@extends('admin/layouts.master')
@section('title', 'Edit Category - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.EditCategory') }}</h3>
        </div>
       
        <div class="panel-body">

          <form id="demo-form" method="post" action="{{url('category/'.$cate->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" autocomplete="off">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Category') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{$cate->title}}">
              </div>
              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Featured') }}:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="featured" type="checkbox" name="featured" {{ $cate->featured == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="featured"></label>
                </li>
              <input type="hidden"  name="free" value="0" for="featured" id="featured">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Icon') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control icp-auto icp" name="icon" id="exampleInputTitle" value="{{$cate->icon}}">
              </div>

              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
               
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $cate->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                </li>
                <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>
              
            </div>
            <br>
       
            <div class="row box-footer">
              <button type="submit" class="btn btn-md col-lg-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
