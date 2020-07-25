@extends('admin/layouts.master')
@section('title', 'Edit Announcement - Instructor')
@section('body')

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Annoncement') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('instructor/announcement/'.$announs->id)}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}


              <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />
              
                   
              <div class="row">
                <div class="col-md-9">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Announsment') }}:<span class="redstar">*</span></label>
                  <textarea name="announsment" rows="3" class="form-control" placeholder="Enter Question">{{$announs->announsment}}</textarea>
                </div>
              
                <div class="col-md-3">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb77" type="checkbox" {{ $announs->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb77"></label>
                  </li>
                  <input type="hidden" name="status" value="{{ $announs->status }}" id="jp">
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
