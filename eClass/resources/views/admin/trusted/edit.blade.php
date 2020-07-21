@extends('admin/layouts.master')
@section('title', 'Edit Trusted - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.TrustedSlider') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post"  action="{{url('trusted/'.$trusted->id)}}
            "data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.URL') }}:</label>
                  <input type="text" class="form-control" name="url" id="exampleInputTitle" value="{{$trusted->url}}">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-4">
                  <label>{{ __('adminstaticword.Image') }}:</label>
                  <input type="file" name="image" id="image"><img src="{{ url('/images/trusted/'.$trusted->image) }}" class="img-responsive" />
                  </br>
                </div>
                <div class="col-md-4">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $trusted->status == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                  <br>
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
  <!--/.row  -->
</section>

@endsection