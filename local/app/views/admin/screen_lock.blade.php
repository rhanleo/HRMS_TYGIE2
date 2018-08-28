<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Screen Lock</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
{{HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')}}
{{HTML::style('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}
{{HTML::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}
{{HTML::style('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}
{{HTML::style('assets/global/plugins/uniform/css/uniform.default.css')}}
{{HTML::style('assets/admin/pages/css/lock2.css')}}
{{HTML::style('assets/global/css/components.css')}}
{{HTML::style('assets/global/css/plugins.css')}}
{{HTML::style('assets/admin/layout/css/layout.css')}}
{{HTML::style('assets/admin/layout/css/themes/darkblue.css')}}
{{HTML::style('assets/admin/layout/css/custom.css')}}

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
	<div class="page-logo">
		<a class="brand" href="javascript:;">

		 {{HTML::image("assets/admin/layout/img/logo-big.png",'Logo',array('class'=>'logo-default','height'=>'30px','width'=>'117px'))}}
		</a>
	</div>
	<div class="page-body">

		<div class="page-lock-info">
			<h1>{{ $loggedAdmin->name}}</h1>
			<span class="email">
			{{ $loggedAdmin->email}} </span>
			<span class="locked">
			Locked </span>

			{{ Form::open(array('url' => '','class' =>'form-inline')) }}
			<div id='alert' ></div>

				<div class="input-group input-medium">
					<input type="password" class="form-control" name="password" placeholder="Password">
					<input type="hidden" class="form-control" name="email" value="{{ $loggedAdmin->email}}">
					<span class="input-group-btn">
					<button type="submit" class="btn blue icn-only" onclick="login();return false;" id="submitbutton"><i class="m-icon-swapright m-icon-white"></i></button>
					</span>
				</div>
				<!-- /input-group -->
				<div class="relogin">
					<a href="{{ URL::to('admin/logout')}}">
					Not {{ $loggedAdmin->name}} ? </a>
				</div>
				
			{{ Form::close()}}
		</div>
	</div>
	<div class="page-footer-custom">
		  {{date('Y')}} &copy; {{$setting->website}}
	</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{{HTML::script('assets/global/plugins/respond.min.js')}}
{{HTML::script('assets/global/plugins/excanvas.min.js')}}
<![endif]-->
{{HTML::script('assets/global/plugins/jquery.min.js')}}
{{HTML::script('assets/global/plugins/jquery-migrate.min.js')}}
{{HTML::script('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}
{{HTML::script('assets/global/plugins/jquery.blockui.min.js')}}
{{HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')}}
{{HTML::script('assets/global/plugins/jquery.cokie.min.js')}}
{{HTML::script('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}
{{HTML::script('assets/global/scripts/metronic.js')}}
{{HTML::script('assets/admin/layout/scripts/layout.js')}}
{{HTML::script('assets/admin/layout/scripts/demo.js')}}
{{HTML::script('assets/admin/pages/scripts/lock.js')}}

<script>
jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
    Lock.init();
    Demo.init();
});
 var Lock = function () {

        return {
            //main function to initiate the module
            init: function () {

                 $.backstretch([
                     "{{ URL::asset('assets/admin/pages/media/bg/1.jpg') }}",
                     "{{ URL::asset('assets/admin/pages/media/bg/2.jpg') }}",
                     "{{ URL::asset('assets/admin/pages/media/bg/3.jpg') }}",
                     "{{ URL::asset('assets/admin/pages/media/bg/4.jpg') }}",
    		        ], {
    		          fade: 1000,
    		          duration: 8000
    		      });
            }

        };

    }();
</script>

<script>
function login(){    

    $('#alert').html('<div class="alert alert-info">Submitting..</div>'); 
    $("#submitbutton").prop('disabled', true);
 
       $.ajax({
                      type: "POST",
                      url: " {{ URL::to('/admin/login') }} ",
                      dataType: 'json',
                      data: $('.form-inline').serialize()
                      
              }).done( function( response ) {                       
                                 
                  if(response.status == "success"){

                        
                        $('#alert').html('<div class="alert alert-success ">'+response.msg+'</div>');
                         window.location.href= "{{ URL::to('/admin/dashboard/') }}";
                  }else if(response.status == "error"){   

                      $("#submitbutton").prop('disabled', false);    
                      $('#alert').html('<div class="alert alert-danger">'+response.msg+'</div>');
                 }
              });  
}
    
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>