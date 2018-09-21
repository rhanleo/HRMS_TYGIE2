<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>{{ $setting->website }} | Login</title>
	<link rel="stylesheet" href="{{ url( 'assets/global/plugins/font-awesome/css/font-awesome.min.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/global/plugins/bootstrap/css/bootstrap.min.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/admin/pages/css/login-soft.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/global/css/components.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/admin/layout/css/layout.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/admin/layout/css/themes/darkblue.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/global/plugins/nprogress/nprogress.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/global/css/custom.min.css' ) }}">
	<link rel="stylesheet" href="{{ url( 'assets/global/css/modified.css' ) }}">
</head>
<body>
	
	<div id="login-page">
		<div class="content">
			<div class="form-container">
				<div class="logo-container flex center">{{HTML::image("assets/admin/layout/img/{$setting->logo}",'Logo',array('class'=>'logo-default','height'=>'60px'))}}</div>
				{{ Form::open( [ 'url' => '', 'class' => 'login-form' ] ) }}
					<h3 class="form-title" style="color:rgb(176, 41, 45);">{{ trans( 'messages.loginPageMessage' ) }}</h3>
					<div id="alert"></div>
					<div class="input-panel">
						<div class="form-group">
							<input type="email" name="email" placeholder="{{trans('core.email')}}" />
						</div>
						<div class="form-group">
							<input type="password" name="password" placeholder="{{trans('core.password')}}" />
						</div>
					</div> {{-- end of .input-panel --}}
					<div class="btn-panel">
						<button type="submit" class="btn btn-1" id="submitbutton" onclick="login();return false;">{{trans('core.btnLogin')}}</button>
					</div> {{-- end of btn-panel --}}
				{{ Form::close() }}
				<p class="copyright">{{date( 'Y' ) }} © Tygie PH</p>
			</div> {{-- end of .form-container --}}
		</div> {{-- end of .content --}}
	</div> {{-- end of #login-page --}}

	<script src="{{ url( 'assets/global/plugins/jquery.min.js' ) }}"></script>
	<script src="{{ url( 'assets/global/plugins/bootstrap/js/bootstrap.min.js' ) }}"></script>
	<script src="{{ url( 'assets/global/plugins/backstretch/jquery.backstretch.min.js' ) }}"></script>
	<script src="{{ url( 'assets/global/scripts/metronic.js' ) }}"></script>
	<script src="{{ url( 'assets/global/plugins/nprogress/nprogress.js' ) }}"></script>
	<script>
		// jQuery(document).ready(function() {
		// 	Metronic.init(); // init metronic core components

		// 	// init background slide images
		// 	$.backstretch([
		// 		"{{ url('assets/admin/pages/media/bg/1.jpg') }}",
		// 		"{{ url('assets/admin/pages/media/bg/2.jpg') }}",
		// 		"{{ url('assets/admin/pages/media/bg/3.jpg') }}",
		// 		"{{ url('assets/admin/pages/media/bg/4.jpg') }}"
		// 	], {
		// 		fade: 1000,
		// 		duration: 8000
		// 	}
		// 	);
		// });

		function login(){    

		    $('#alert').html('<div class="alert alert-info"><span class="fa fa-info"></span> {{trans('messages.submitting')}}..</div>');
		   
		    $("#submitbutton").prop('disabled', true);
			    NProgress.start();
		       $.ajax({
						  type: "POST",
						  url: " {{ route('admin.login') }} ",
						  dataType: 'json',
						  data: $('.login-form').serialize()
		              }).done( function( response ) {                       
		                                 
		                  if(response.status == "success"){
		                        $('#alert').html('<div class="alert alert-success"><span class="fa fa-check"></span> '+response.msg+'</div>');
		                         window.location.href= "{{ route('admin.dashboard.index') }}";

		                  }else if(response.status == "error"){
		                      $("#submitbutton").prop('disabled', false);
		                      $('#alert').html('<div class="alert alert-danger"><span class="fa fa-close"></span> '+response.msg+'</div>');
		                 }
		                 NProgress.done();

		              });  
		}
	</script>
</body>
</html>