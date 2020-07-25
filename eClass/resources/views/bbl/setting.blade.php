@extends('admin/layouts.master')
@section('title', 'Update Big Blue Settings')
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box">
    <div class="box-header with-border">
      <div class="box-title">
        Update BigBlue Button Salt Key and Server URL : 
      </div>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('bbl.update.setting') }}" method="POST">
            @csrf

            <div class="form-group">
              <div class="eyeCy">
                <label>BBL SALT KEY:</label>

                <input required id="password" value="{{ env('BBB_SECURITY_SALT') }}" type="password" name="BBB_SECURITY_SALT" class="form-control" placeholder="enter bigbluebutton salt key">
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                
              </div>
            </div>

            <div class="form-group">
              <label>BBB SERVER BASE URL:</label>
              <input class="form-control" type="text" value="{{ env('BBB_SERVER_BASE_URL') }}" name="BBB_SERVER_BASE_URL" required="" placeholder="enter your BigBlue Button server URL">
            </div>

            <div class="form-group">
              <button class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> Save
              </button>
            </div>
          </form>
        </div>

        
      </div>
    </div>
  </div>
</section>
@endsection


@section('script')
  <script>
     $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
      });

     $(".toggle-password").on('click', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if(input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
  </script>
@endsection