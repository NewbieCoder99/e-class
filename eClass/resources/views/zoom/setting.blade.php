@extends('admin/layouts.master')
@section('title', 'Update Zoom Setting')
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box">
    <div class="box-header with-border">
      <div class="box-title">
        Update Zoom Token and email : 
      </div>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('updateToken') }}" method="POST">
            @csrf
            

            <div class="form-group">
              <div class="eyeCy">
                <label>Zoom Email:</label>

                <input id="password" value="{{ Auth::user()->zoom_email }}" type="password" name="zoom_email" class="form-control" placeholder="user@example.com">
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                
              </div>
            </div>

            <div class="form-group">
              <label>Zoom JWT Token:</label>
              <textarea name="jwt_token" class="form-control" rows="5" cols="30" placeholder="Enter your JWT Token here">{{ Auth::user()->jwt_token }}</textarea>
            </div>

            <div class="form-group">
              <button class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> Save
              </button>
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <h4 style="color: black"><i class="fa fa-question-circle"></i> How to get JWT Token and Email : </h4>
          <hr>
          <div class="panel panel-default">
            <div class="panel-body">
              <ul>
                <li>• First Sign up or Sign in here : <a href="https://marketplace.zoom.us/" target="_blank">Zoom Market Place Portal</a></li>
                 <li>• Click on Top right side menu and click on build app : <a href="https://marketplace.zoom.us/develop/create" target="_blank">Create app</a></li>
                 <li>• Choose JWT App and Continue...</li>
                 <li>• After filling details click on credtional tab and bottom you will see <b>JWT Token</b> change token expiry accroding to your setting.</li>
                 <li>• Paste your zoom email account id and JWT token here and create,edit meetings here.</li>
              </ul>
            </div>
          </div>
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