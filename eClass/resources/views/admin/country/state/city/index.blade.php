@extends("admin/layouts.master")
@section('title','All Cities')
@section("body")

<section class="content">
	@include('admin.message')
	<div class="row">
	  <div class="col-xs-12">
	    <div class="box box-primary" >
	      	<div class="box-header with-border">
	        	<h3 class="box-title">{{ __('adminstaticword.City') }}</h3>

	        	<a href="{{url('admin/city/create')}} " class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.City') }}</a>

	            <a data-toggle="modal" data-target="#myModalcity" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.CityManual') }}</a> 
	    	</div>
	             
		    <div class="box-body">
		    	<div class="table-responsive">
			        <table id="example2" class="table table-bordered table-striped table-responsive display nowrap">

			          	<thead>
				            <tr class="table-heading-row">
				              <th>#</th>
				              <th>{{ __('adminstaticword.City') }}</th>
				              <th>{{ __('adminstaticword.State') }}</th>
				              <th>{{ __('adminstaticword.Country') }}</th>
				              <th>{{ __('adminstaticword.Delete') }}</th>
				            </tr>
				          </thead>
			          	<tbody>
						<?php $i=0;?> 
		                @foreach ($cities as $city)

			                <tr>
			                  <?php $i++;?>
			                  <td><?php echo $i;?></td>
			                  <td>{{ $city->name }}</td>
			                  <td>{{ $city->state->name }}</td>
			                  <td>{{ $city->country->nicename }}</td>
			                  
			                 
			                  <td><form  method="post" action="{{url('admin/city/'.$city->id)}}" data-parsley-validate class="form-horizontal form-label-left">
			                      {{ csrf_field() }}
			                      {{ method_field('DELETE') }}
			                       <button  type="submit" class="btn btn-danger" onclick="return confirm('Delete This City..?)" ><i class="fa fa-fw fa-trash-o"></i></button></td>
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



<!--Model for add city -->
<div class="modal fade" id="myModalcity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.City') }}</h4>
      </div>
      <div class="box box-primary">
        <div class="panel panel-sum">
          <div class="modal-body">
            <form id="demo-form2" method="post" action="{{route('city.manual')}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

				<div class="row">
	              <div class="col-md-12">
	              	<label for="exampleInputDetails">{{ __('adminstaticword.ChooseState') }} :<sup class="redstar">*</sup></label>
	                <select style="width: 100%" required class="form-control js-example-basic-single" name="state_id">
	                  <option>{{ __('adminstaticword.ChooseState') }}:</option>

	                  @foreach ($states as $state)
	                    <option value="{{ $state->state_id }}">{{ $state->name }}</option>
	                  @endforeach
	                </select>
	              </div>
              	</div>
              	<br>

				<div class="row">
              	  <div class="col-md-12">
	                <label for="exampleInputDetails"> {{ __('adminstaticword.City') }}:<sup class="redstar">*</sup></label>
	                <input type="text" name="name" class="form-control" placeholder="Enter City Name">
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
@endsection



  

