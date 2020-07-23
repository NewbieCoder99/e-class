@extends('admin/layouts.master')
@section('title', 'Add Facts Slider - Admin')
@section('body')

@section("title","Add Sub Category")

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.FactsSlider') }}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{action('SliderfactsController@store')}}"vdata-parsley-validate 
              class="form-horizontal form-label-left"enctype="multipart/form-data">
              {{ csrf_field() }}
                  

              <div class="row">
                <div class="col-md-4">
                  <label for="icon">{{ __('adminstaticword.Icon') }}:<sup class="redstar">*</sup></label>
                  <input class="form-control icp-auto icp" type="text" name="icon" placeholder="Select Icon">
                </div>
                <div class="col-md-4">
                  <label for="heading">{{ __('adminstaticword.Heading') }}:<sup class="redstar">*</sup></label>
                  <input class="form-control" type="text" name="heading" placeholder="Please Enter Your Heading">
                </div>
                <div class="col-md-4">
                  <label for="sub_heading">{{ __('adminstaticword.SubHeading') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="Please Enter Your Sub Heading">
                </div>
              </div>
              <br>
              
              <div class="box-footer">
                <button type="submit" value="Add Slider" class="btn btn-md col-md-2 btn-primary">+ {{ __('adminstaticword.Save') }}</button>
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

