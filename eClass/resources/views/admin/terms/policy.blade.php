@extends('admin.layouts.master')
@section('title', 'Privacy Policy - Admin')
@section('body')
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
    	<div class="box box-primary">
         	<div class="box-header with-border">
          	<h3 class="box-title">{{ __('adminstaticword.PrivacyPolicy') }}</h3>
       		</div>
        	<div class="panel-body">
        		<form action="{{ action('TermsController@update') }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
              <div class="row">
                <div class="col-md-12">
                  <label for="policy">{{ __('adminstaticword.PrivacyPolicy') }}:<sup class="redstar">*</sup></label>
                  <textarea  name="policy" rows="10" cols="80" class="form-control">
                  {{ $items['policy'] }}
                </textarea>

                </div>
              </div>
              <br>
              
              <div class="box-footer">
                <button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
              </div>

            </form>
          </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('scripts')

<script>
(function($) {
  "use strict";
    tinymce.init({selector:'textarea'});
})(jQuery);
</script>
@endsection
