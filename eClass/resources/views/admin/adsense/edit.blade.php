@extends('admin.layouts.master')
@section('title', 'Adsense Setting - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-xs-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.AdsenseSetting') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('AdsenseController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}


		                <div class="form-group">
			                <label for="policy">{{ __('adminstaticword.EnterYourAdsenseScript') }}:<sup class="redstar">*</sup></label>
			                <textarea id="status" name="code" rows="10" class="form-control" required>
			                  {{ $ad['code'] }}
			                </textarea>
			            </div>
			            <br>


			            <div class="row">
    						<div class="col-md-4">
    							<div class="form-group">
					            	<label for="">{{ __('adminstaticword.Status') }}: </label>
									<li class="tg-list-item">              
							            <input class="tgl tgl-skewed" id="statuss" type="checkbox" name="status" {{ $ad['status'] == 1 ? 'checked' : '' }} >
							            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="statuss"></label>
							        </li>
					            </div>
					            <br>
    						</div>
    						<div class="col-md-4">
    							<div class="form-group">
					            	<label for="">{{ __('adminstaticword.VisibleonHome') }}: </label>
									<li class="tg-list-item">              
							            <input class="tgl tgl-skewed" id="ishome" type="checkbox" name="ishome" {{ $ad['ishome'] == 1 ? 'checked' : '' }} >
							            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="ishome"></label>
							        </li>
					            </div>
					            <br>
    						</div>
    						<div class="col-md-4">
    							<div class="form-group">
					            	<label for="">{{ __('adminstaticword.VisibleonCart') }}: </label>
									<li class="tg-list-item">              
							            <input class="tgl tgl-skewed" id="iscart" type="checkbox" name="iscart" {{ $ad['iscart'] == 1 ? 'checked' : '' }} >
							            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="iscart"></label>
							        </li>
					            </div>
					            <br>
    						</div>
    						<div class="col-md-4">
    							<div class="form-group">
					            	<label for="">{{ __('adminstaticword.VisibleonWishlist') }}: </label>
									<li class="tg-list-item">              
							            <input class="tgl tgl-skewed" id="iswishlist" type="checkbox" name="iswishlist" {{ $ad['iswishlist'] == 1 ? 'checked' : '' }} >
							            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="iswishlist"></label>
							        </li>
					            </div>
					            <br>
    						</div>
    						<div class="col-md-4">
    							<div class="form-group">
					            	<label for="">{{ __('adminstaticword.VisibleonDetail') }}: </label>
									<li class="tg-list-item">              
							            <input class="tgl tgl-skewed" id="isdetail" type="checkbox" name="isdetail" {{ $ad['isdetail'] == 1 ? 'checked' : '' }} >
							            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="isdetail"></label>
							        </li>
					            </div>
					            <br>
    						</div>
    						<div class="col-md-4 display-none">
    							<div class="form-group">
					            	<label for="">{{ __('adminstaticword.VisibleonAll') }}: </label>
									<li class="tg-list-item">              
							            <input class="tgl tgl-skewed" id="isviewall" type="checkbox" name="isviewall" {{ $ad['isviewall'] == 1 ? 'checked' : '' }} >
							            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="isviewall"></label>
							        </li>
					            </div>
					            <br>
    						</div>
    					</div>




						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-md col-md-1 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		              	

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection


@section('script')



@endsection


