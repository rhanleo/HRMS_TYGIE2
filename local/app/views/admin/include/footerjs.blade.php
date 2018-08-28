<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>

{{ HTML::script("assets/global/plugins/respond.min.js") }}
{{ HTML::script("assets/global/plugins/excanvas.min.js") }}

<![endif]-->
{{ HTML::script("assets/global/plugins/jquery.min.js") }}
{{ HTML::script("assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js") }}
{{ HTML::script("assets/global/plugins/bootstrap/js/bootstrap.min.js") }}
{{ HTML::script("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js") }}
{{ HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") }}

{{ HTML::script('assets/global/plugins/jquery.blockui.min.js') }}
{{ HTML::script("assets/global/scripts/metronic.js") }}
{{ HTML::script("assets/admin/layout/scripts/layout.js")}}
{{ HTML::script('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}
{{ HTML::script('assets/js/commonjs.js') }}



<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function($) {
 Metronic.setAssetsPath("{{ URL::asset("assets") }}/");
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
    $('.demo-loading-btn')
                       .click(function () {
                         var btn = $(this)
                         btn.button('loading')
                         setTimeout(function () {
                           btn.button('reset')
                         }, 8000)
                     });
    $('.demo-loading-btn-ajax')
                           .click(function () {
                             var btn = $(this)
                             btn.button('loading')
                             setTimeout(function () {
                               btn.button('reset')
                             }, 500)
                         });

    


});

     function ToggleEmailNotification(type){
			 if ($('[name='+type+']').is(':checked')){
			  var value = 1;
			 }
			 else {
			  var value = 0;
			 }
			 $('#load_notification').html('{{HTML::image('assets/admin/layout/img/loading-spinner-blue.gif')}}');


			 $.ajax({
				 type: 'POST',
				 url: "{{route('admin.ajax_update_notification')}}",
				 dataType: "JSON",
				 data: {'value':value,'id':'{{ $setting->id}}','type':type
				 },
				 success: function(response) {
					if(response.success=='success'){
						$('#load_notification').html('<span style="color:dodgerblue" class="fa fa-check"></span>');
					}
				 },
				 error: function(xhr, textStatus, thrownError) {
					alert('Data Fetching error');
				 }
			 });

     }

     @if(Session::get('success'))
          showToastrMessage('{{ Session::get('success') }}', '{{Lang::get('messages.success')}}', 'success');
     @endif
     @if ($errors->has())
     	showToastrMessage('{{ Lang::get('messages.errorTitle') }}', '{{Lang::get('messages.error')}}', 'error');
     @endif
</script>

@yield('footerjs')
