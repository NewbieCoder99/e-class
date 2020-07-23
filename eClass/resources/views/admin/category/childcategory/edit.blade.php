@extends('admin/layouts.master')
@section('title', 'Edit Childcategory - Admin')
@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.ChildCategory') }}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
       
          <div class="box-body">
            <div class="form-group">
            <form id="demo-form" method="post" action="{{url('childcategory/'.$cate->id)}}" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputSlug">{{ __('adminstaticword.SelectCategory') }}</label>
                  <select name="category_id" id="category_id" class="form-control js-example-basic-single">
                    @php
                      $category = App\Categories::all();
                    @endphp  
                    @foreach($category as $caat)
                      <option {{ $cate->category_id == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
                    @endforeach 
                  </select>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputSlug">{{ __('adminstaticword.SelectSubCategory') }}</label>
                  <select name="subcategory_id" id="upload_id" class="form-control js-example-basic-single">
                    @php
                      $subcategory = App\SubCategory::all();
                    @endphp  
                    @foreach($subcategory as $caat)
                      <option {{ $cate->subcategory_id == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
                    @endforeach 
                  </select>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="title">{{ __('adminstaticword.Title') }}:<span class="redstar">*</span></label>
                  <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{$cate->title}}">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="icon">{{ __('adminstaticword.Icon') }}:<span class="redstar">*</span></label>
                  <input type="text" class="form-control icp-auto icp" name="icon" id="exampleInputTitle" value="{{$cate->icon}}">
                </div>
              </div>
              <br>
              
              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">              
                      <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $cate->status == '1' ? 'checked' : '' }} >
                      <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                    </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>
              </div>
              <br>

              <div class="box-footer">
              <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
              </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 
@endsection



@section('scripts')

<script>
(function($) {
  "use strict";
  
  $(function() {
    var urlLike = '{{ url('admin/dropdown') }}';
    $('#category_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val();    
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

})(jQuery);
</script> 

@endsection