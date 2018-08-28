<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="javascript:;">
                {{HTML::image("assets/admin/layout/img/{$setting->logo}",'Logo',array('class'=>'logo-default','height'=>'30px'))}}

            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                					<i class="icon-bell"></i>

                					@if(count($pending_applications)>0)
										<span class="badge badge-default">
											{{count($pending_applications)}}
										</span>
									@endif

                					</a>


                					<ul class="dropdown-menu">
                						<li class="external">
                							<h3><span class="bold">{{count($pending_applications)}} pending</span> notifications</h3>

                						</li>
                						@if(count($pending_applications)>0)
                						<li>
                							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                								@foreach($pending_applications as $pending)
                								<li>
                									<a  data-toggle="modal" href="#static_leave_requests" onclick="show_application_notification({{ $pending->id }});return false;">
                									<span class="time">{{date('d-M-Y',strtotime($pending->created_at))}}</span>
                									<span class="details">
                									<span class="label label-sm label-icon label-success">
                									<i class="fa fa-bell-o"></i>
                									</span>
                									 <strong>{{$pending->employeeDetails->fullName}} </strong> has applied for leave on {{date('d-M-Y',strtotime($pending->date))}}</span>
                									</a>
                								</li>
                								@endforeach

                							</ul>
                						</li>
                						@endif
                					</ul>
                				</li>
							<!-- BEGIN LANGUAGE BAR -->
            				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            				<li class="dropdown dropdown-language">
            					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            					<img alt="" src="{{URL::asset("assets/global/img/flags/{$setting->locale}.png")}}">
            					<span class="langname">
            								{{$setting->getLangName->language}} </span>
            					<i class="fa fa-angle-down"></i>
            					</a>
            					<ul class="dropdown-menu dropdown-menu-default">
            					@foreach($languages as $lang)
            					 @if($lang->locale !=$setting->locale)

            						<li>
            							<a href="javascript:;" onclick="changeLanguage('{{$lang->locale}}')">
            							<img alt="" src="{{URL::asset("assets/global/img/flags/{$lang->locale}.png")}}"> {{$lang->language}}
                                        </a>
            						</li>
            					@endif
            					@endforeach
            					</ul>
            				</li>
            				<!-- END LANGUAGE BAR -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    {{--{{HTML::image("assets/admin/layout/img/avatar3_small.jpg",'small image',array('class'=>'img-circle'))}}--}}

                    <span class="username username-hide-on-mobile">
                  {{ $loggedAdmin->name }}</span>
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{route('admin.profile_settings.edit',Auth::admin()->get()->id)}}">
                            <i class="icon-user"></i> {{trans('menu.myProfile')}}</a>
                        </li>

                        <li class="divider">
                        </li>
                        <li>
                            <a href="{{ URL::to('screenlock') }} ">
                            <i class="icon-lock"></i> {{trans('menu.lockScreen')}} </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('admin.logout') }} ">
                             <i class="icon-logout"></i> {{trans('menu.logout')}} </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->



{{--Leave Application view MODALS--}}
{{Form::open(['url'=>'','id'=>'edit_form_leave','method'=>'PATCH'])}}
<div id="static_leave_requests" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<span class="caption-subject font-red-sunglo bold uppercase">Leave Application</span>
					</div>
					<div class="modal-body" id="modal-data-leave">
						{{--Ajax data call for form--}}
					</div>
				</div>

			</div>
		</div>
</div>
{{Form::close()}}
{{--Leave Modal Close--}}

<script>
function show_application_notification(id)
       {
       		$("#modal-data-leave").html('<div class="text-center">{{HTML::image('assets/admin/layout/img/loading-spinner-blue.gif')}}</div>');
            $('#edit_form_leave').attr('action',"{{ URL::to('admin/leave_applications/"+id+"') }}" );
            $.ajax({
                    type: "GET",
                    url : "{{ URL::to('admin/leave_applications/"+id+"') }}"

                    }).done(function(response)
                    {
                                $('#modal-data-leave').html(response);
//
                     });
       }
       
function changeLanguage(lang){
	$.ajax({
	    type: 'GET',
	    url: "{{route('admin.change_language')}}",
	    dataType: "JSON",
	    data: { 'locale':lang
	    },
	    success: function(response) {
	    	if(response.success=='success'){
	    		window.location.reload();
	    	}

	    },
	    error: function(xhr, textStatus, thrownError) {
	        
	    }
	});
}       
</script>
