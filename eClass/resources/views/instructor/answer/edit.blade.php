@extends('admin/layouts.master')
@section('title', 'Edit Answer - Instructor')
@section('body')

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Answer') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form action="{{url('instructoranswer/'.$answer->id)}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <label class="display-none" for="exampleInputSlug">{{ __('adminstaticword.SelectCourse') }}</label>
                  <input value="{{ $answer->course_id }}" autofocus name="course_id" type="text" class="form-control display-none" >


                  <div class="row">
                    <div class="col-md-12">
                      <label for="exampleInput"> {{ __('adminstaticword.Answer') }}:<sup class="redstar">*</sup></label>
                      <textarea name="answer" rows="4" class="form-control" placeholder="Please Enter Your Answer">{{ $answer->answer }}</textarea>
                    </div>
                  </div>
                
                <br>


                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb10111" type="checkbox" {{ $answer->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb10111"></label>
                    </li>
                    <input type="hidden" name="status" value="{{ $answer->status }}" id="jjjj">
                </div>
                </div>
                <br>
                <br>
                <br>
                
                <div class="box-footer">
                  <button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
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
