@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
    {{ HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") }}
    {{ HTML::style("assets/global/plugins/select2/select2.css") }}
    {{ HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") }}
    {{ HTML::style("assets/global/plugins/icheck/skins/all.css") }}
@stop
@section('mainarea')
	<div class="page-banner" style="background-image: url( {{ URL::asset( 'assets/global/img/banners/attendance.png' ) }} );">
		<div class="left-banner">
			<h3 class="page-title">{{$pageTitle}}</h3>
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{route('admin.dashboard.index')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{ route('admin.settings.edit','setting') }}">Settings</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href=""> Setting</a>
				</li>
			</ul>
		</div> {{-- end of .left-banner --}}
		<div class="right-banner">
			<ul>
			    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
			            <span class="label">Notifications:</span>
			            @if(count($pending_applications)>0)
			                <span class="badge badge-default">
			                    {{count($pending_applications)}}
			                </span>
			            @endif
			        </a>
			        <div class="dropdown-menu">
			            <ul>
			                <li class="external">
			                    <h3><span class="bold">{{count($pending_applications)}} pending</span> notifications</h3>
			                </li>
			                @if( count( $pending_applications ) > 0 )
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
			                                        <strong>{{$pending->employeeDetails->fullName}} </strong> has applied for leave on {{date('d-M-Y',strtotime($pending->date))}}
			                                    </span>
			                                </a>
			                            </li>
			                            @endforeach
			                        </ul>
			                    </li>
			                @endif
			            </ul>
			        </div>
			    </li>
			    <li class="dropdown dropdown-language">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
			            <span class="label">Language:</span>
			            <span class="langname">
			            {{$setting->getLangName->language}} </span>
			            <i class="fa fa-angle-down"></i>
			        </a>
			        <ul class="dropdown-menu dropdown-menu-default">
			            @foreach($languages as $lang)
			                @if($lang->locale !=$setting->locale)
			                    <li>
			                        <a href="javascript:;" onclick="changeLanguage('{{$lang->locale}}')">{{ $lang->language }}</a>
			                    </li>
			                @endif
			            @endforeach
			        </ul>
			    </li>
			</ul> {{-- end of #header-notification-bar --}}
		</div>
	</div> {{-- end of .page-banner --}}
	<div class="content-section">
		<div id="load">@include('admin.common.error')</div>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div class="portlet box">
					<div class="portlet-title has-pad">
						<div class="title-left">
							<span class="icon"><i class="fa fa-cogs fa-fw"></i></span>
							<span>Front End Theme</span>
							<div class="tools"></div>
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						{{ Form::model($setting, ['method' => 'PATCH','files' => true, 'route' => ['admin.settings.update', $setting->id],'class'=>'horizontal-form']) }}
							<div class="form-group" style="padding-top: 15px;">
								<div class="row">
									<label class="control-label col-md-2">Select Theme</label>
									<div class="col-md-4">
										<div class="icheck-list">
											<label>
												<input type="radio" name="front_theme" @if($setting->front_theme=='blue') checked @endif class="icheck" value="aqua"> Aqua <span class="btn blue"></span>
											</label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='dark-blue') checked @endif class="icheck" value="dark-blue"> Dark-blue <span class="btn blue-steel"></span> </label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='default') checked @endif class="icheck" value="default"> Default <span class="btn grey-cascade"></span> </label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='brown') checked @endif class="icheck" value="brown"> Brown <span class="btn" style="background-color: saddlebrown;"></span></label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='dark-red') checked @endif class="icheck" value="dark-red"> Dark-red <span class="btn" style="background-color: darkred;"></span></label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='light-green') checked @endif class="icheck" value="light-green"> Light-green <span class="btn" style="background-color: lightgreen;"></span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="icheck-list">
											<label>
											<input type="radio" name="front_theme" @if($setting->front_theme=='light') checked @endif class="icheck" value="light"> Light <span class="btn" style="background-color: #95a5a6"></span></label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='orange') checked @endif class="icheck" value="orange"> Orange <span class="btn" style="background-color: orangered"></span> </label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='purple') checked @endif class="icheck" value="purple"> Purple <span class="btn" style="background-color: #800080;"></span> </label>

											<label><input type="radio" name="front_theme" @if($setting->front_theme=='red') checked @endif class="icheck" value="red"> Red <span class="btn" style="background-color: red;"></span></label>
											<label><input type="radio" name="front_theme" @if($setting->front_theme=='teal') checked @endif class="icheck" value="teal"> Teal <span class="btn" style="background-color: teal;"></span></label>
										</div>
									</div>
								</div>
							</div> {{-- end of .form-group --}}
							<div class="btn-panel">
								<button type="submit" data-loading-text="Updating..." class="demo-loading-btn btn btn-1">
									<span class="icon"><i class="fa fa-check fa-fw"></i></span>
									<span class="text">Submit</span>
								</button>
							</div>
						{{ Form::close() }}
						<div id="front_image" style="padding: 10px;text-align: center">{{ucfirst($setting->front_theme)}}
							{{HTML::image("assets/theme_images/front/$setting->front_theme.png",'Logo',array('class'=>'logo-default img-responsive','height'=>'300px'))}}
						</div>
					</div> {{-- end of .portlet-body --}}
				</div> {{-- end of .portlet --}}
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="portlet box">
					<div class="portlet-title has-pad">
						<div class="title-left">
							<span class="icon"><i class="fa fa-cogs fa-fw"></i></span>
							<span>Admin Panel Theme</span>
							<div class="tools"></div>
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						{{ Form::model($setting, ['method' => 'PATCH','files' => true, 'route' => ['admin.settings.update', $setting->id],'class'=>'horizontal-form']) }}
							<div class="form-group" style="padding-top: 15px;">
								<div class="row">
									<label class="control-label col-md-4">Select Theme</label>
									<div class="col-md-6">
										<div class="icheck-list">
											<label>
											<input type="radio" name="admin_theme" @if($setting->admin_theme=='blue') checked @endif class="icheck" value="blue"> BLUE <span class="btn blue"></span></label>
											<label><input type="radio" name="admin_theme" @if($setting->admin_theme=='darkblue') checked @endif class="icheck" value="darkblue"> Darkblue <span class="btn blue-steel"></span></label>
											<label><input type="radio" name="admin_theme" @if($setting->admin_theme=='default') checked @endif class="icheck" value="default"> Default <span class="btn blue-ebonyclay"></span> </label>
											<label><input type="radio" name="admin_theme" @if($setting->admin_theme=='grey') checked @endif class="icheck" value="grey"> Grey <span class="btn grey-cascade"></span> </label>
											<label><input type="radio" name="admin_theme" @if($setting->admin_theme=='light') checked @endif class="icheck" value="light"> Light <span class="btn" style="background-color: white;"></span></label>
											<label><input type="radio" name="admin_theme" @if($setting->admin_theme=='light2') checked @endif class="icheck" value="light2"> Light2 <span class="btn" style="background-color: rgb(246, 246, 246); border: 1px solid #bbb;"></span></label>
										</div>
									</div>
								</div>
							</div> {{-- end of .form-group --}}
							<div class="btn-panel">
								<button type="submit" data-loading-text="Updating..." class="demo-loading-btn btn btn-1">
									<span class="icon"><i class="fa fa-check fa-fw"></i></span>
									<span class="text">Submit</span>
								</button>
							</div>
						{{ Form::close() }}
						<div id="admin_image" style="padding: 10px;text-align: center">{{ucfirst($setting->admin_theme)}}
							{{HTML::image("assets/theme_images/admin/$setting->admin_theme.png",'Logo',array('class'=>'logo-default img-responsive','height'=>'300px'))}}
						</div>
					</div> {{-- end of .portlet-body --}}
				</div> {{-- end of .portlet --}}
			</div>
		</div>
	</div> {{-- end of .content-section --}}
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{ HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") }}
{{ HTML::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js') }}

{{ HTML::script('assets/global/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}
{{ HTML::script('assets/admin/pages/scripts/components-dropdowns.js') }}
{{ HTML::script('assets/global/plugins/icheck/icheck.min.js') }}




<script>
        jQuery(document).ready(function() {

           ComponentsDropdowns.init();

        });

        $('input[name=admin_theme]').on('ifChecked', function(event){
			$('#admin_image').html('<span class="fa fa-refresh fa-spin"></span>');
			var image = this.value+".png";
			var image_url = '{{HTML::image("assets/theme_images/admin/:image",'Logo',array('class'=>'logo-default img-responsive','height'=>'300px'))}}';
			image_url = image_url.replace(':image',image);
			 $('#admin_image').html(capitalizeFirstLetter(this.value)+" "+image_url);
        });

        $('input[name=front_theme]').on('ifChecked', function(event){
				$('#front_image').html('<span class="fa fa-refresh fa-spin"></span>');
        			var image = this.value+".png";
        			var image_url = '{{HTML::image("assets/theme_images/front/:image",'Logo',array('class'=>'logo-default img-responsive','height'=>'300px'))}}';
        			image_url = image_url.replace(':image',image);
				 $('#front_image').html(capitalizeFirstLetter(this.value)+" "+image_url);
		});

		function capitalizeFirstLetter(string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		}
    </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop