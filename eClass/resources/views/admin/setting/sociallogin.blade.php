<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		    	<h3 class="panel-title"><i class="fa fa-facebook"></i> {{ __('adminstaticword.FacebookLoginSetting') }}</h3>
		  	</div>
		  	<div class="panel-body">
		  		<form action="{{ route('sl.fb') }}" method="POST">
		  			@csrf
		  			
			  		<label for="">{{ __('adminstaticword.ClientID') }}:</label>
			  		<input type="text" placeholder="enter client ID" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{ $env_files['FACEBOOK_CLIENT_ID'] }}" >
			  		<br>

			  		<div class="row">
			  			<div class="eyeCy col-md-12">
			  				<label for="">{{ __('adminstaticword.ClientSecretKey') }}:</label>

			  				<input type="password" placeholder="enter secret key" class="form-control" id="fb_secret" name="FACEBOOK_CLIENT_SECRET" value="{{ $env_files['FACEBOOK_CLIENT_SECRET'] }}" >
			  				<span toggle="#fb_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
			  			</div>
			  		</div>
			  		
					<br>
			  		<label for="">{{ __('adminstaticword.CallbackURL') }}:</label>
			  		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="https://yoursite.com/public/auth/facebook/callback"></i>
			  		<input type="text" placeholder="https://yoursite.com/public/auth/facebook/callback" name="FACEBOOK_CALLBACK_URL" value="{{ $env_files['FACEBOOK_CALLBACK_URL'] }}" class="form-control" >
			  		<br>
					<label for=""><i class="fa fa-facebook-square"></i> {{ __('adminstaticword.EnableFacebookLogin') }}: </label>
					&nbsp;&nbsp;
					<input {{ $gsetting->fb_login_enable==1 ? 'checked' : '' }} class="tgl tgl-skewed" name="fb_enable" id="fb_enable" type="checkbox"/>
		    		<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="fb_enable"></label>
					<br>
				
					
					<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>  {{ __('adminstaticword.Save') }}</button>
				
		  		</form>
		  	</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-danger">
		  	<div class="panel-heading">
		    	<h3 class="panel-title"><i class="fa fa-google"></i> {{ __('adminstaticword.GoogleLoginSetting') }}</h3>
			</div>
			<div class="panel-body">
			  	<form action="{{ route('sl.gl') }}" method="POST">
		  			@csrf

			  		<label for="">{{ __('adminstaticword.ClientID') }}:</label>
			  		<input name="GOOGLE_CLIENT_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['GOOGLE_CLIENT_ID'] }}">
			  		<br>

			  		<div class="row">
			  			<div class="eyeCy col-md-12">
			  				<label for="">{{ __('adminstaticword.ClientSecretKey') }}:</label>
			  				<input type="password" name="GOOGLE_CLIENT_SECRET" value="{{ $env_files['GOOGLE_CLIENT_SECRET'] }}" placeholder="enter secret key" class="form-control" id="gsecret">
			  				<span toggle="#gsecret" class="fa fa-fw fa-eye field-icon toggle-password3 display-inline-flex"></span>
			  			</div>
			  			
			  		</div>
		  		
					<br>
			  		<label for="">{{ __('adminstaticword.CallbackURL') }}:</label>
			  		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="https://yoursite.com/public/auth/google/callback"></i>
			  		<input type="text" placeholder="https://yoursite.com/public/auth/google/callback" name="GOOGLE_CALLBACK_URL" value="{{ $env_files['GOOGLE_CALLBACK_URL'] }}" class="form-control">
			  		<br>
				    <label for=""><i class="fa fa-google"></i> {{ __('adminstaticword.EnableGoogleLogin') }}: </label>
					&nbsp;&nbsp;
					<input name="google_enable" {{ $setting->google_login_enable ==1 ? 'checked' : "" }} class="tgl tgl-skewed" id="ggl_enable" type="checkbox"/>
					<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="ggl_enable"></label>
					<br>
			
					
					<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>  {{ __('adminstaticword.Save') }}</button>
				
				</form>
			</div>
		</div>
	</div>


	<div class="col-md-6">
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-gitlab"></i> {{ __('adminstaticword.GitLabLoginSetting') }}</h3>
		  </div>
		  <div class="panel-body">
		  	<form action="{{ route('sl.git') }}" method="POST">
	  			@csrf

		  		<label for=""> {{ __('adminstaticword.ClientID') }}:</label>
		  		<input name="GITLAB_CLIENT_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['GITLAB_CLIENT_ID'] }}" input=>
		  		<br>

		  		<div class="row">
		  			<div class="eyeCy col-md-12">
		  				<label for=""> {{ __('adminstaticword.ClientSecretKey') }}:</label>
		  				<input type="password" name="GITLAB_CLIENT_SECRET" value="{{ $env_files['GITLAB_CLIENT_SECRET'] }}" placeholder="enter secret key" class="form-control" id="tsecret">
		  				<span toggle="#tsecret" class="fa fa-fw fa-eye field-icon toggle-password4"></span>
		  			</div>

		  			
		  		</div>
	  		
				<br>
		  		<label for=""> {{ __('adminstaticword.CallbackURL') }}:</label>
		  		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="https://yoursite.com/public/auth/gitlab/callback"></i>
		  		<input type="text" placeholder="https://yoursite.com/public/auth/gitlab/callback" name="GITLAB_CALLBACK_URL" value="{{ $env_files['GITLAB_CALLBACK_URL'] }}" class="form-control">
		  		<br>
			    <label for=""><i class="fa fa-gitlab"></i> {{ __('adminstaticword.EnableGitLabLogin') }}: </label>
				&nbsp;&nbsp;
				<input name="gitlab_enable" {{ $setting->gitlab_login_enable ==1 ? 'checked' : "" }} class="tgl tgl-skewed" id="git_enable" type="checkbox"/>
				<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="git_enable"></label>
				<br>
		
				
				<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>  {{ __('adminstaticword.Save') }}</button>
			
			</form>
		  </div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-amazon"></i> {{ __('adminstaticword.AmazonLoginSetting') }}</h3>
		  </div>
		  <div class="panel-body">
		  	<form action="{{ route('sl.amazon') }}" method="POST">
	  			@csrf

		  		<label for=""> {{ __('adminstaticword.ClientID') }}:</label>
		  		<input name="AMAZON_LOGIN_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['AMAZON_LOGIN_ID'] }}" input=>
		  		<br>

		  		<div class="row">
		  			<div class="eyeCy col-md-12">
		  				<label for=""> {{ __('adminstaticword.ClientSecretKey') }}:</label>
		  				<input type="password" name="AMAZON_LOGIN_SECRET" value="{{ $env_files['AMAZON_LOGIN_SECRET'] }}" placeholder="enter secret key" class="form-control" id="asecret">
		  				<span toggle="#asecret" class="fa fa-fw fa-eye field-icon toggle-password5"></span>
		  			</div>

		  			
		  		</div>
	  		
				<br>
		  		<label for=""> {{ __('adminstaticword.CallbackURL') }}:</label>
		  		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="https://yoursite.com/public/auth/amazon/callback"></i>
		  		<input type="text" placeholder="https://yoursite.com/public/auth/amazon/callback" name="AMAZON_LOGIN_REDIRECT" value="{{ $env_files['AMAZON_LOGIN_REDIRECT'] }}" class="form-control">
		  		<br>
			    <label for=""><i class="fa fa-amazon"></i> {{ __('adminstaticword.EnableAmazonLogin') }}: </label>
				&nbsp;&nbsp;
				<input name="amazon_enable" {{ $setting->amazon_enable ==1 ? 'checked' : "" }} class="tgl tgl-skewed" id="amazon_enable" type="checkbox"/>
				<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="amazon_enable"></label>
				<br>
		
				
				<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>  {{ __('adminstaticword.Save') }}</button>
			
			</form>
		  </div>
		</div>
	</div>


	<div class="col-md-6">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-linkedin"></i> {{ __('adminstaticword.LinkedLoginSetting') }}</h3>
		  </div>
		  <div class="panel-body">
		  	<form action="{{ route('sl.linkedin') }}" method="POST">
	  			@csrf

		  		<label for=""> {{ __('adminstaticword.ClientID') }}:</label>
		  		<input name="LINKEDIN_CLIENT_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['LINKEDIN_CLIENT_ID'] }}" input=>
		  		<br>

		  		<div class="row">
		  			<div class="eyeCy col-md-12">
		  				<label for=""> {{ __('adminstaticword.ClientSecretKey') }}:</label>
		  				<input type="password" name="LINKEDIN_CLIENT_SECRET" value="{{ $env_files['LINKEDIN_CLIENT_SECRET'] }}" placeholder="enter secret key" class="form-control" id="lisecret">
		  				<span toggle="#lisecret" class="fa fa-fw fa-eye field-icon toggle-password6"></span>
		  			</div>

		  			
		  		</div>
	  		
				<br>
		  		<label for=""> {{ __('adminstaticword.CallbackURL') }}:</label>
		  		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="https://yoursite.com/public/auth/linkedin/callback"></i>
		  		<input type="text" placeholder="https://yoursite.com/public/auth/linkedin/callback" name="LINKEDIN_CALLBACK_URL" value="{{ $env_files['LINKEDIN_CALLBACK_URL'] }}" class="form-control">
		  		<br>
			    <label for=""><i class="fa fa-linkedin"></i> {{ __('adminstaticword.EnableLinkedLogin') }}: </label>
				&nbsp;&nbsp;
				<input name="linkedin_enable" {{ $setting->linkedin_enable == 1 ? 'checked' : "" }} class="tgl tgl-skewed" id="linkedin_enable" type="checkbox"/>
				<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="linkedin_enable"></label>
				<br>
		
				
				<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>  {{ __('adminstaticword.Save') }}</button>
			
			</form>
		  </div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-twitter"></i> {{ __('adminstaticword.TwitterLoginSetting') }}</h3>
		  </div>
		  <div class="panel-body">
		  	<form action="{{ route('sl.twitter') }}" method="POST">
	  			@csrf

		  		<label for=""> {{ __('adminstaticword.ClientID') }}:</label>
		  		<input name="TWITTER_CLIENT_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['TWITTER_CLIENT_ID'] }}" input=>
		  		<br>

		  		<div class="row">
		  			<div class="eyeCy col-md-12">
		  				<label for=""> {{ __('adminstaticword.ClientSecretKey') }}:</label>
		  				<input type="password" name="TWITTER_CLIENT_SECRET" value="{{ $env_files['TWITTER_CLIENT_SECRET'] }}" placeholder="enter secret key" class="form-control" id="twsecret">
		  				<span toggle="#twsecret" class="fa fa-fw fa-eye field-icon toggle-password7"></span>
		  			</div>

		  			
		  		</div>
	  		
				<br>
		  		<label for=""> {{ __('adminstaticword.CallbackURL') }}:</label>
		  		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="https://yoursite.com/public/auth/twitter/callback"></i>
		  		<input type="text" placeholder="https://yoursite.com/auth/public/twitter/callback" name="TWITTER_CALLBACK_URL" value="{{ $env_files['TWITTER_CALLBACK_URL'] }}" class="form-control">
		  		<br>
			    <label for=""><i class="fa fa-twitter"></i> {{ __('adminstaticword.EnableTwitterLogin') }}: </label>
				&nbsp;&nbsp;
				<input name="twitter_enable" {{ $setting->twitter_enable == 1 ? 'checked' : "" }} class="tgl tgl-skewed" id="twitter_enable" type="checkbox"/>
				<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="twitter_enable"></label>
				<br>
		
				
				<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>  {{ __('adminstaticword.Save') }}</button>
			
			</form>
		  </div>
		</div>
	</div>


</div>

