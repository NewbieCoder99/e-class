@extends('admin/layouts.master')
@section('title', 'Edit Question - Instructor')
@section('body')

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Question</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('instructorquestion/'.$que->id)}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}


              <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />
                   
              <select name="course_id" class="form-control col-md-7 col-xs-12 display-none">
               @foreach($courses as $cou)
               <option class="display-none" value="{{ $cou->id }}" {{$que->courses->id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
               @endforeach
              </select>

              <select name="user_id" class="form-control col-md-7 col-xs-12 display-none">
                @foreach($user as $cu)
                  <option class="display-none" value="{{ $cu->id }}" {{$que->courses->id == $cu->id  ? 'selected' : ''}}>{{ $cu->fname}}</option>
                @endforeach
              </select>
                   
              <div class="row">
                <div class="col-md-9">
                  <label for="exampleInputTit1e">Question:<span class="redstar">*</span></label>
                  <textarea name="question" rows="3" class="form-control" placeholder="Enter Your quetion">{{$que->question}}</textarea>
                </div>
              
                <div class="col-md-3">
                  <label for="exampleInputTit1e">Status:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb77" type="checkbox" {{ $que->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb77"></label>
                  </li>
                  <input type="hidden" name="status" value="{{ $que->status }}" id="jp">
                </div>
              </div> 
              <br>
                
              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary">Save</button>
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
