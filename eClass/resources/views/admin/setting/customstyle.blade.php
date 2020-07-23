<div class="form-group{{ $errors->has('css') ? ' has-error' : '' }}">
    <form action="{{ route('css.store') }}" method="POST">
      {{ csrf_field() }}
        <label for="css">{{ __('adminstaticword.CustomCSS') }}:</label>
        <small class="text-danger">{{ $errors->first('css','CSS Cannot be blank !') }}</small>
        <textarea placeholder="a {
          color:red;
        }" id="he" class="form-control" name="css" rows="10" cols="30">{{ $css }}</textarea>
    	<br>
        <button type="submit" class="btn btn-md btn-primary">
        	<i class="fa fa-save"></i> {{ __('adminstaticword.ADDCSS') }}
        </button>
    </form>
</div>
<br>
<div class="form-group{{ $errors->has('js') ? ' has-error' : '' }}">
    <form action="{{ route('js.store') }}" method="POST">
      {{ csrf_field() }}
        <label for="js">{{ __('adminstaticword.CustomJS') }}:</label>
        <small class="text-danger">{{ $errors->first('js','Javascript Cannot be blank !') }}</small>
        <textarea placeholder="$(document).ready(function{
          //code
        });" class="form-control" name="js" rows="10" cols="30">{{ $js }}</textarea>
    	<br>
        <button type="submit" class="btn btn-md btn-primary">
        	<i class="fa fa-save"></i> {{ __('adminstaticword.ADDJS') }}
        </button>
    </form>
</div>