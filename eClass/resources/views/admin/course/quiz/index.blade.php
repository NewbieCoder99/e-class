@extends('admin.layouts.master')
@section('title', 'Add Question - Admin')
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
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Quiz') }} {{ __('adminstaticword.Question') }}</h3>
        </div>
        <div class="box-header">
          <a data-toggle="modal" data-target="#myModalquiz" href="#" class="btn btn-info btn-sm">+   {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Question') }}</a>

        </div>

        <br>
        <br>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Course') }}</th>
                  <th>{{ __('adminstaticword.Topic') }}</th>
                  <th>{{ __('adminstaticword.Question') }}</th>
                  <th>{{ __('adminstaticword.A') }}</th>
                  <th>{{ __('adminstaticword.B') }}</th>
                  <th>{{ __('adminstaticword.C') }}</th>
                  <th>{{ __('adminstaticword.D') }}</th>
                  <th>{{ __('adminstaticword.Answer') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach($quizes as $quiz)
                <?php $i++;?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td>{{$quiz->course_id}}</td>
                    <td>{{$quiz->topic_id}}</td> 
                    <td>{{$quiz->question}}</td>
                    <td>{{$quiz->a}}</td>
                    <td>{{$quiz->b}}</td>
                    <td>{{$quiz->c}}</td>
                    <td>{{$quiz->c}}</td>
                    <td>{{$quiz->answer}}</td>
                    <td>
                      <a data-toggle="modal" data-target="#myModaledit{{$quiz->id}}" href="#" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                    <td>
                      <form  method="post" action="{{url('admin/questions/'.$quiz->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                      </form>
                    </td>
                  </tr>  

                  <!--Model for edit question-->
                  <div class="modal fade" id="myModaledit{{$quiz->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Question') }}</h4>
                        </div>
                        <div class="box box-primary">
                          <div class="panel panel-sum">
                            <div class="modal-body">
                              <form id="demo-form2" method="POST" action="{{route('questions.update', $quiz->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <input type="hidden" name="course_id" value="{{ $topic->course_id }}"  />

                                <input type="hidden" name="topic_id" value="{{ $topic->id }}"  />

                                <div class="row"> 
                                  <div class="col-md-6">
                                    <label for="exampleInputTit1e">{{ __('adminstaticword.Question') }}</label>
                                    <textarea name="question" rows="6" class="form-control" placeholder="Enter Your Question" >{{ $quiz->question }}</textarea>
                                    <br>

                                    <label for="exampleInputDetails">{{ __('adminstaticword.Answer') }}:<sup class="redstar">*</sup></label>
                                    <select style="width: 100%" name="answer" class="form-control js-example-basic-single">
                                      <option {{ $quiz->answer == 'A' ? 'selected' : ''}} value="A">{{ __('adminstaticword.A') }}</option>
                                      <option {{ $quiz->answer == 'B' ? 'selected' : ''}} value="B">{{ __('adminstaticword.B') }}</option>
                                      <option {{ $quiz->answer == 'C' ? 'selected' : ''}} value="C">{{ __('adminstaticword.C') }}</option>
                                      <option  {{ $quiz->answer == 'D' ? 'selected' : ''}} value="D">{{ __('adminstaticword.D') }}</option>
                                    </select>
                                  </div>
                                
                             
                                  <div class="col-md-6">
                                   
                                    <label for="exampleInputDetails">{{ __('adminstaticword.AOption') }} :<sup class="redstar">*</sup></label>
                                    <input type="text" name="a" value="{{ $quiz->a }}" class="form-control" placeholder="Enter Option A">
                                  </div>
                                 
                                  <div class="col-md-6">
                                    <label for="exampleInputDetails">{{ __('adminstaticword.BOption') }} :<sup class="redstar">*</sup></label>
                                    <input type="text" name="b" value="{{ $quiz->b }}" class="form-control" placeholder="Enter Option B" />
                                  </div>

                                  <div class="col-md-6">
                                
                                    <label for="exampleInputDetails">{{ __('adminstaticword.COption') }} :<sup class="redstar">*</sup></label> 
                                    <input type="text" name="c" value="{{ $quiz->c }}" class="form-control" placeholder="Enter Option C" />
                                  </div>

                                  <div class="col-md-6">
                                 
                                    <label for="exampleInputDetails">{{ __('adminstaticword.DOption') }} :<sup class="redstar">*</sup></label>
                                    <input type="text" name="d" value="{{ $quiz->d }}" class="form-control" placeholder="Enter Option D" />
                                  </div>
                                   


                                  </div>
                                </div>
                                <br>
                               
                              
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Model close -->
          
      
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!--Model for add question -->
<div class="modal fade" id="myModalquiz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Question') }}</h4>
      </div>
      <div class="box box-primary">
        <div class="panel panel-sum">
          <div class="modal-body">
            <form id="demo-form2" method="post" action="{{route('questions.store')}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" name="course_id" value="{{ $topic->course_id }}"  />

              <input type="hidden" name="topic_id" value="{{ $topic->id }}"  />

              <div class="row"> 
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Question') }}</label>
                  <textarea name="question" rows="6" class="form-control" placeholder="Enter Your Question"></textarea>
                  <br>

                  <label for="exampleInputDetails">{{ __('adminstaticword.Answer') }}:<sup class="redstar">*</sup></label>
                  <select style="width: 100%" name="answer" class="form-control js-example-basic-single">
                    <option value="none" selected disabled hidden> 
                      {{ __('adminstaticword.SelectanOption') }}
                    </option>
                    <option value="A">{{ __('adminstaticword.A') }}</option>
                    <option value="B">{{ __('adminstaticword.B') }}</option>
                    <option value="C">{{ __('adminstaticword.C') }}</option>
                    <option value="D">{{ __('adminstaticword.D') }}</option>
                  </select>
                </div>
              
           
                <div class="col-md-6">
                 
                  <label for="exampleInputDetails">{{ __('adminstaticword.AOption') }} :<sup class="redstar">*</sup></label>
                  <input type="text" name="a" class="form-control" placeholder="Enter Option A">
                </div>
               
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.BOption') }} :<sup class="redstar">*</sup></label>
                  <input type="text" name="b" class="form-control" placeholder="Enter Option B" />
                </div>

                <div class="col-md-6">
              
                  <label for="exampleInputDetails">{{ __('adminstaticword.COption') }} :<sup class="redstar">*</sup></label>
                  <input type="text" name="c" class="form-control" placeholder="Enter Option C" />
                </div>

                <div class="col-md-6">
               
                  <label for="exampleInputDetails">{{ __('adminstaticword.DOption') }} :<sup class="redstar">*</sup></label>
                  <input type="text" name="d" class="form-control" placeholder="Enter Option D" />
                </div>
                 


                </div>
              </div>
              <br>
             
            
              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Model close --> 


</section> 

@endsection
