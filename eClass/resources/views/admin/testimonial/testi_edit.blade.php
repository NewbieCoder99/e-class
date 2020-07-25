@extends('admin/layouts.master')
@section('title', 'Edit Testimonial - Admin')
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
    <div class="col-md-12">
     <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} - {{ $test->client_name}} </h3>
        </div>
        <div class="box-body">
          <div class="form-group">              
            <form id="demo-form2" method="post" action="{{url('testimonial/'.$test->id)}}" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('PATCH')}}

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputName">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="client_name" id="exampleInputTitle"value="{{$test->client_name}}">
                </div>
                <div class="col-md-6">
                  
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-9">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="details" row="5" class="form-control">{{$test->details}}</textarea>
                </div>
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.Image') }}</label>
                  <input type="file" name="image" id="image"><img src="{{ url('/images/testimonial/'.$test->image) }}" class="img-responsive" />
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="welmail" type="checkbox" name="status" {{ $test->status == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="welmail"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="welmail" id="welmail">
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
(function($) {
  "use strict";
  tinymce.init({selector:'textarea'});
})(jQuery);
</script>

@endsection