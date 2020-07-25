

<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ route('manifest.update') }}" method="POST">
            @csrf
         
            <div class="form-group">
              <label>Manifest Setting:</label>
              <textarea name="manifest" class="form-control" id="" cols="30" rows="55">{{ $manifest }}</textarea>
            </div>
             <div class="box-footer">
              <button type="submit" class="btn btn-md col-md-2 btn-flat btn-primary">Save
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