@extends("admin/layouts.master")
@section('title','All Countries')
@section("body")

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary" >
        <div class="box-header with-border">
          <h3 class="box-title">Country</h3>
          <a href=" {{url('admin/country/create')}} " class="btn btn-info btn-sm">+ Add Country</a> 
        </div>
         

        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-responsive">
             
              <thead>
                <tr class="table-heading-row">
                  <th>#</th>
                  <th>Country Name </th>
                  <th>ISO Code 2</th>
                  <th>ISO Code 3</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?> 
                @foreach ($countries as $country)

                  <tr>
                    <?php $i++;?>
                    <td><?php echo $i;?></td>
                    <td>{{ $country->nicename }}</td>
                    <td>{{ $country->iso }}</td>
                    <td>{{ $country->iso3 }}</td>
                    <td>
                      <a class="btn btn-success btn-sm" href="{{url('admin/country/'.$country->id. '/edit')}}">

                        <i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                    <td><form  method="post" action="{{url('admin/country/'.$country->id)}}
                        "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                         <button  type="submit" class="btn btn-danger" onclick="return confirm('Delete This User..?)" ><i class="fa fa-fw fa-trash-o"></i></button></td>
                        </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>
@endsection

  

