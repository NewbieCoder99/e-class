@extends('admin/layouts.master')
@section('title', 'Enroll a student - Admin')
@section('body')


<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> Enroll a user</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{route('order.store')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
                      
           
              <div class="row">
                <div class="col-md-6">
                  <label>User<span class="redstar">*</span></label>
                  <select name="user_id" id="user_id" class="form-control js-example-basic-single" required>
                    <option value="">{{ __('adminstaticword.SelectanOption') }}</option>
                    @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->fname}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Course<span class="redstar">*</span></label>
                  <select name="course_id" id="course_id" class="form-control js-example-basic-single" required>
                    <option value="">{{ __('adminstaticword.SelectanOption') }}</option>
                    @foreach($courses as $course)
                      <option value="{{$course->id}}">{{$course->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>

              
      
              <div class="box-footer">
                <button type="submit" value="Add Slider" class="btn btn-md col-md-2 btn-primary">Enrol User</button>
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

