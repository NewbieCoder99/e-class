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
      <a data-toggle="modal" data-target="#myModalabc" href="#" class="btn btn-info btn-sm">+{{ __('adminstaticword.Add') }}</a>
      <br>
      <br>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.RelatedCourse') }}</th>
              <th>{{ __('adminstaticword.Status') }}</th>
              <th>{{ __('adminstaticword.Edit') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($relatedcourse as $cat)
              <tr>
                <?php $i++;?>
                <td><?php echo $i;?></td>
                <td>{{$cat->courses->title}}</td>
                <td>
                    @if($cat->status==1)
                     {{ __('adminstaticword.Active') }}
                    @else
                     {{ __('adminstaticword.Deactive') }}
                    @endif
                </td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('relatedcourse/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                  <form  method="post" action="{{url('relatedcourse/'.$cat->id)}}
                  "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--Model start-->
  <div class="modal fade" id="myModalabc" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.RelatedCourse') }}</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{ route('relatedcourse.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}

                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $cor->user_id }}"> 

                <div class="row display-none">             
                  <div class="col-md-12">  
                    <label for="exampleInputSlug">{{ __('adminstaticword.Course') }}</label>
                    <select name="main_course_id" class="form-control">
                      <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                    </select>
                  </div>
                </div> 
                      
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.RelatedCourse') }}:<sup class="redstar">*</sup></label>
                    @php
                    $courses = App\Course::all();
                    @endphp
                    <select style="width: 100%" name="course_id" class="form-control js-example-basic-single">
                      @foreach($courses as $course)
                        @if($course->id !== $cor->id)
                          <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endif
                      @endforeach
                    </select>
                    <p class="txt-desc"> {{ __('adminstaticword.Select') }} {{ __('adminstaticword.RelatedCourse') }}</p>
                  </div>
                </div>
                <br>
                
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="c2"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="c2"></label>
                    </li>
                    <input type="hidden" name="status" value="1" id="t2">
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
