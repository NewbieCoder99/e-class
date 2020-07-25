

<section class="content">
  <div class="row">
    <div class="col-xs-12">

        <!-- /.box-header -->
        <div class="box-body">
         <form action="{{ route('icons.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
              
         
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (36x36): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon36x36">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img id="preview1" alt="preview" src="{{ url('/images/icons/icon36x36.png') }}">
                    </div>
                  </div>
            

           
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (48x48): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon48x48">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img id="preview2" alt="preview" src="{{ url('/images/icons/icon48x48.png') }}">
                    </div>
                  </div>
              

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (72x72): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon72x72">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img id="preview3" alt="preview" src="{{ url('/images/icons/icon72x72.png') }}">
                    </div>
                  </div>
               

               
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (96x96): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon96x96">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon96x96.png') }}" class="img-responsive">
                    </div>
                  </div>
              

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (144x144): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon144x144">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon144x144.png') }}" class="img-responsive">
                    </div>
                  </div>
             

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (168x168): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon168x168">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon168x168.png') }}" class="img-responsive">
                    </div>
                  </div>
               

            
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (192x192): <sup class="redstar">*</sup></label>
                        <input type="file" class="form-control" name="icon192x192">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/images/icons/icon192x192.png') }}" class="img-responsive">
                    </div>
                  </div>
               

              
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Icon (256x256): <sup class="redstar">*</sup></label>
                        <input type="file"  class="form-control" name="icon256x256">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <img  src="{{ url('/images/icons/icon256x256.png') }}" class="img-responsive">
                    </div>
                  </div>
                
               
              <div class="box-footer">
                <button type="submit" class="pull-left btn btn-md col-md-2 btn-flat btn-primary">
                    Save 
                  </button>
                  
              </div>
              </form>
        </div>
        <!-- /.box-body -->
     
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>