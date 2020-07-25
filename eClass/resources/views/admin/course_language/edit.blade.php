@extends('admin/layouts.master')
@section('title', 'Edit Course Language - Admin')
@section('body')

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Language') }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
     
          <div class="box-body">
            <div class="form-group">
            <form id="demo-form" method="post" action="{{url('courselang/'.$language->id)}}
                  "data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-9">
                <label for="exampleInputSlug">{{ __('adminstaticword.Name') }}: <sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="name" value="{{ $language->name }}" id="exampleInputPassword1" placeholder="Please Enter Your  Language Name">
              </div>
           
              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                <li class="tg-list-item">
                <input class="tgl tgl-skewed" id="xyz" type="checkbox" {{ $language->status==1 ? 'checked' : '' }}>
                <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="xyz"></label>
                </li>
                <input type="hidden" name="status" value="{{ $language->status }}" id="xyzz">
              </div>
            </div>
            <br>
            <div class="box-footer">
              <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Submit') }}</button>
            </div>
            </div>
          <!-- /.box-body -->
          
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
