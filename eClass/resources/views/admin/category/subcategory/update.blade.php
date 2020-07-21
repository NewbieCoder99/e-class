@extends('admin/layouts.master')
@section('title', 'Edit Subcategory - Admin')
@section('body')
  
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Edit') }}{{ __('adminstaticword.SubCategory') }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <form id="demo-form" method="post" action="{{url('subcategory/'.$cate->id)}}
                    " data-parsley-validate class="form-horizontal form-label-left" autocomplete="off">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="row">

                  <div class="col-md-6">
                    <label for="exampleInputSlug">{{ __('adminstaticword.SelectCategory') }}</label>
                    <select name="category_id" class="form-control js-example-basic-single col-md-7 col-xs-12">
          
                      @foreach($category as $cou)
                       <option value="{{ $cou->id }}" {{$cate->category_id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
                      @endforeach
                    </select>
                  </div>
                
                  <div class="col-md-6">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.SubCategory') }}:<span class="redstar">*</span></label>
                    <input type="title" class="form-control" name="title" id="exampleInputTitle" value="{{$cate->title}}">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <label for="icon">{{ __('adminstaticword.Icon') }}:<span class="redstar">*</span></label>
                    <input type="text" class="form-control icp-auto icp" name="icon" id="exampleInputTitle" value="{{$cate->icon}}">
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
