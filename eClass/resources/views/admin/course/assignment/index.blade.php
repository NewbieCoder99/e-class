<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      
      <br>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.User') }}</th>
              <th>{{ __('adminstaticword.Course') }}</th>
              <th>{{ __('adminstaticword.Assignment') }}</th>
              <th>{{ __('adminstaticword.View') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($assignment as $assign)
              <tr>
                <?php $i++;?>
                <td><?php echo $i;?></td>
                <td>{{$assign->user->fname}}</td>
                <td>{{$assign->courses->title}}</td>
                <td>{{ $assign->title }}</td>
            
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('assignment/'.$assign->id)}}">{{ __('adminstaticword.View') }}</a>
                </td> 

                <td>
                  <form  method="post" action="{{url('assignment/'.$assign->id)}}" ata-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  

</section> 
