@extends("admin/layouts.master")
@section('title','Add Cities')
@section("body")

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.City') }}</h3>
          <div class="panel-heading">
            <a href=" {{url('admin/city')}} " class="btn btn-success pull-right owtbtn">< {{ __('adminstaticword.Back') }}</a> 
          </div>   
               
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/city')}}" data-parsley-validate class="form-horizontal form-label-left">
              {{csrf_field()}}
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
               {{ __('adminstaticword.Add') }} {{ __('adminstaticword.City') }}<span class="redstar">*</span>
              </label>
              
              
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select required class="form-control js-example-basic-single" name="state_id">
                  <option>{{ __('adminstaticword.ChooseState') }}:</option>

                  @foreach ($states as $state)
                    <option value="{{ $state->state_id }}">{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="box-footer">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-primary">{{ __('adminstaticword.Save') }}</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
</section>
@endsection

