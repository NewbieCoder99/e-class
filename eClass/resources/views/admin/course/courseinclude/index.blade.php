<section class="content">
 
<div class="row">
  <div class="col-md-12">
    <a data-toggle="modal" data-target="#myModalJ" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
    <br>
    <br>
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('adminstaticword.Course') }}</th>
            <th>{{ __('adminstaticword.Icon') }}</th>
            <th>{{ __('adminstaticword.Detail') }}</th>
            <th>{{ __('adminstaticword.Status') }}</th>
            <th>{{ __('adminstaticword.Edit') }}</th>
            <th>{{ __('adminstaticword.Delete') }}</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=0;?>
          @foreach($courseinclude as $cat)
            <tr>
              <?php $i++;?>
              <td><?php echo $i;?></td>
              <td>{{$cat->courses->title}}</td>
              <td>{{$cat->icon}}</td>
              <td>{{ strip_tags($cat->detail) }}</td> 
              <td>
                @if($cat->status==1)
                  {{ __('adminstaticword.Active') }}
                @else
                  {{ __('adminstaticword.Deactive') }}
                @endif
                
              </td>
              <td>
                  <a class="btn btn-success btn-sm" href="{{url('courseinclude/'.$cat->id)}}">
                    <i class="glyphicon glyphicon-pencil"></i></a>
              </td>              

              <td>
                <form  method="post" action="{{url('courseinclude/'.$cat->id)}}
                     "data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button  type="submit"  class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
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
<div class="modal fade" id="myModalJ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.CourseInclude') }}</h4>
      </div>
       <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{ route('courseinclude.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
     
                <select class="display-none" name="course_id" class="form-control">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-6">
                    <label for="">{{ __('adminstaticword.Icon') }}:<sup class="redstar">*</sup></label>
                    <input type="text" name="icon" class="form-control icp-auto icp" autocomplete="off" required>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                    <textarea rows="1" name="detail" class="form-control" placeholder="Enter Your Detail"></textarea>
                  </div>
                </div>
                <br>

                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>
                <br>
                <br>
                <br>
                <div class="box-footer">
                  <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
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


