@extends("admin/layouts.master")
@section('title','Edit Country')
@section("body")

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Country</h3>
        </div> 
        <div class="panel-heading">
          <a href=" {{url('admin/country')}} " class="btn btn-success pull-right owtbtn">< Back</a> 
        </div>   
        <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/country/'.$countries->id)}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{ method_field('PUT') }}

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Country Name <span class="redstar">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control js-example-basic-single" name="country">
                <option>Choose Country:</option>

                @foreach ($allcountry as $c)
                  <option value="{{ $c->id }}" {{ $countries->country_id == $c->id ? 'selected' : ''}}>{{ $c->nicename }}
                  </option>
                @endforeach
              </select>
                
              </div>
            </div>
                 
          <div class="box-footer">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
  
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>

@endsection
