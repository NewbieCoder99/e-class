@extends('admin/layouts.master')
@section('title', 'Language - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Admin Static Word Translation of  {{ $findlang->name }} ({{ $findlang->local }})</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        
          <form action="{{ route('admin.static.update',$findlang->local) }}" method="POST">
            @csrf
            
            <textarea name="transfile" class="form-control" id="" cols="100" rows="20">{{ $file }}</textarea>
          

     
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-md btn-flat">
                <i class="fa fa-save"></i> Save Changes
              </button>

              <a href="{{ route('show.lang') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
              </a>
            </div>

            
          </form>
         
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection