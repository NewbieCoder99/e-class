<div class="modal fade" id="myModalinstructor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.BecomeAnInstructor') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              @if(Auth::check())
              <form id="demo-form2" method="post" action="{{ route('apply.instructor') }}" data-parsley-validate 
                class="form-horizontal form-label-left" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  
                  <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">First Name:<sup class="redstar">*</sup></label>
                        <input type="text" class="form-control" name="fname" id="title" placeholder="Please Enter First Name" value="" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lname">Last Name:<sup class="redstar">*</sup></label>
                        <input type="text" class="form-control" name="lname" id="title" placeholder="Please Enter Last Name" value="" required>
                      </div>
                    </div>
                	</div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date">Date of Birth:<sup class="redstar">*</sup></label>
                        <input type="date" class="form-control" name="dob" id="title" value="" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender">Gender:<sup class="redstar">*</sup></label>
                        <select class="form-control" name="gender" required>
                            <option value="none" selected> 
                              Select an Option 
                            </option>
		                        <option value="Male">Male</option>
		                        <option value="Female">Female</option>
		                        <option value="Other">Other</option>
		                    </select>
                      </div>
                    </div>
                	</div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email:<sup class="redstar">*</sup></label>
                        <input type="email" value="{{Auth::User()->email}}" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="contact">Contact No:<sup class="redstar">*</sup></label>
                        <input type="text" class="form-control" name="mobile" id="contact" placeholder="Please Enter Contact No." value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="detail">Detail:<sup class="redstar">*</sup></label>
                        <textarea name="detail" rows="5"  class="form-control" placeholder="" required></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="file">Upload Resume:<sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="file" id="file" value="" required>
                      </div>
		                   <div class="form-group">
                        <label for="image">Upload Image:<sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="image"  id="image" required>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="box-footer">
                   <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('frontstaticword.Submit') }}</button>
                  </div>
              </form>
              @else
                <div class="box-footer">
                  <button type="submit" onclick="window.location.href = '{{ route('login') }}';" class="btn btn-lg col-md-3 btn-primary">{{ __('frontstaticword.Submit') }}</button>
                </div>
              @endif  
            </div>
          </div>
        </div>
      </div>
    </div>
</div>