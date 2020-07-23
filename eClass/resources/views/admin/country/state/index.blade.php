@extends("admin/layouts.master")
@section('title','All States')
@section("body")

@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

<section class="content">
	@include('admin.message')
	<div class="row">
	  <div class="col-xs-12">
	    <div class="box box-primary" >
	      <div class="box-header with-border">
	        <h3 class="box-title">{{ __('adminstaticword.State') }}</h3>
	        <a href=" {{url('admin/state/create')}} " class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.State') }}</a> 

	        <a data-toggle="modal" data-target="#myModalcity" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.StateManual') }}</a>
	      </div>
	               
	        <div class="box-body">
	        	<div class="table-responsive">
	          	<table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
		          	<thead>
			            <tr class="table-heading-row">
			              <th>#</th>
			              <th>{{ __('adminstaticword.State') }}</th>
			              <th>{{ __('adminstaticword.Country') }}</th>
			              <th>{{ __('adminstaticword.Delete') }}</th>
			            </tr>
		          	</thead>
		          	<tbody>
						<?php $i=0;?> 
		                @foreach ($states as $state)

			                <tr>
			                  <?php $i++;?>
			                  <td><?php echo $i;?></td>
			                  <td>{{ $state->name }}</td>
			                  <td>{{ $state->country->nicename }}</td>
			                  
			                  <td><form  method="post" action="{{url('admin/state/'.$state->id)}}" data-parsley-validate class="form-horizontal form-label-left">
			                      {{ csrf_field() }}
			                      {{ method_field('DELETE') }}
			                       <button  type="submit" class="btn btn-danger" onclick="return confirm('Delete This User..?)" ><i class="fa fa-fw fa-trash-o"></i></button>
			                       </form>
			                   </td>
			                      
			                  </td>
			                </tr>
		                @endforeach
		          	</tbody>
		        </table>
		    	</div>
      		</div>
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
            <form id="demo-form2" method="post" action="{{route('state.manual')}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

				<div class="row">
	              <div class="col-md-12">
	              	<label for="exampleInputDetails">{{ __('adminstaticword.ChooseState') }} :<sup class="redstar">*</sup></label>
	                <select style="width: 100%" required class="form-control js-example-basic-single" name="country_id">
	                  <option>{{ __('adminstaticword.ChooseCountry') }}:</option>

	                  @foreach ($country as $cou)
	                    <option value="{{ $cou->country_id }}">{{ $cou->name }}</option>
	                  @endforeach
	                </select>
	              </div>
              	</div>
              	<br>

				<div class="row">
              	  <div class="col-md-12">
	                <label for="exampleInputDetails"> {{ __('adminstaticword.State') }}:<sup class="redstar">*</sup></label>
	                <input type="text" name="name" class="form-control" placeholder="Enter State Name">
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

  

