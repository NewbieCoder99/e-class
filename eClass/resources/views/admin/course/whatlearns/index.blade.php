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
      <a data-toggle="modal" data-target="#myModaljj" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
      <br><br>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.Course') }}</th>       
              <th>{{ __('adminstaticword.Detail') }}</th>
              <th>{{ __('adminstaticword.Status') }}</th>
              <th>{{ __('adminstaticword.Edit') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($whatlearns as $cat)
              <tr>
                <?php $i++;?>
                  <td><?php echo $i;?></td>
                <td>{{$cat->courses->title}}</td>
                <td>{{ strip_tags($cat->detail) }}</td> 
                <td>
                  <form action="{{ route('what.quick',$cat->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $cat->status ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($cat->status ==1)
                        {{ __('adminstaticword.Active') }}
                      @else
                        {{ __('adminstaticword.Deactive') }}
                      @endif
                    </button>
                  </form>
                </td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('whatlearns/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                </td> 
                <td>
                  <form  method="post" action="{{url('whatlearns/'.$cat->id)}}" data-parsley-validate class="form-horizontal form-label-left">
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
  <div class="modal fade" id="myModaljj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.WhatLearns') }}</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{ route('whatlearns.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}

                <select name="course_id" class="form-control display-none">
                  <option class="display-none" name="course_id"  value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-6">
                    <label  for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                    <textarea rows="1" name="detail" class="form-control" placeholder="Enter Your Detail"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                     <li class="tg-list-item">              
                      <input class="tgl tgl-skewed" id="status1" type="checkbox" name="status" >
                      <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status1"></label>
                    </li>
                    <input type="hidden"  name="free" value="0" for="status1" id="status1">
                  </div>
                </div>
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
