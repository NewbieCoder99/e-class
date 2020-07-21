@extends('admin/layouts.master')
@section('title', 'Add Question - Instructor')
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
    <div class="col-xs-12"> 
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Question</h3>
        </div>
        <br>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{ route('instructorquestion.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                

                <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />

                <div class="row"> 
                  <div class="col-md-12">
                    <label for="exampleInputSlug">Course <span class="redstar">*</span></label>
                    <select name="course_id" class="form-control js-example-basic-single">
                      <option value="none" selected disabled hidden> 
                        Select an Option 
                      </option>
                      @foreach($course as $cor)
                          <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row"> 
                  <div class="col-md-12">
                    <select name="user_id" class="form-control display-none">
                      <option  value="{{ Auth::user()->id }}">{{ Auth::user()->fname }}</option>
                    </select>
                  </div>
                </div>
                <br>
                
                <div class="row">  
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Question:<sup class="redstar">*</sup></label>
                    <textarea name="question" rows="3" class="form-control" placeholder="Enter Your quetion"></textarea>
                  </div>
                </div>
                <br>
                
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Status:</label>               
                    <li class="tg-list-item">                
                      <input class="tgl tgl-skewed" id="c2222"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="c2222"></label>
                    </li>
                    <input type="hidden" name="status" value="0" id="t2222">
                  </div>
                </div>
                <br>
              
                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-3 btn-primary">Submit</button>
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