@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
    {{ HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") }}
    {{ HTML::style("assets/global/plugins/select2/select2.css") }}
    {{ HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") }}
@stop
@section('mainarea')
	<div class="page-banner" style="background-image: url( {{ URL::asset( 'assets/global/img/banners/attendance.png' ) }} );">
		<div class="left-banner">
			<h3 class="page-title">{{$pageTitle}}</h3>
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{route('admin.dashboard.index')}}">{{trans('core.home')}}</a>
					<i class="fa fa-angle-right"></i>
				</li>

				<li>
					<a href="">{{trans('core.emailNotification')}}</a>
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
		</div> {{-- end of .right-banner --}}
	</div> {{-- end of .page-banner --}}
	<div class="content-section">
		<div id="load">
			@include('admin.common.error')
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="portlet box">
					<div class="portlet-title has-pad">
						<div class="title-left">
							<span class="icon"><i class="fa fa-cog fa-fw"></i></span>
							<span>{{trans('core.emailNotification')}}</span>
							<div class="tools"></div>
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						{{ Form::model($setting, ['method' => 'PATCH','files' => true, 'route' => ['admin.notificationSettings.update', $setting->id],'class'=>'form-horizontal form-bordered']) }}
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.awards')}} : </label>
									<div class="col-md-6">
									<input  type="checkbox" value="1"   class="make-switch" name="award_notification" @if($setting->award_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
									</div>
								</div> {{-- end of .form-group --}}
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.attendance')}}:</label>
									<div class="col-md-6">
									<input  type="checkbox" value="1"   class="make-switch" name="attendance_notification" @if($setting->attendance_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
									</div>
								</div> {{-- end of .form-group --}}
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.noticeBoard')}}:</label>
									<div class="col-md-6">
									<input  type="checkbox" value="1"   class="make-switch" name="notice_notification" @if($setting->notice_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
									</div>
								</div> {{-- end of .form-group --}}
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.leaveApplication')}}:</label>
									<div class="col-md-6">
									<input  type="checkbox" value="1"   class="make-switch" name="leave_notification" @if($setting->leave_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
									</div>
								</div> {{-- end of .form-group --}}
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.employeeAdd')}}:</label>
									<div class="col-md-6">
									<input  type="checkbox" value="1"   class="make-switch" name="employee_add" @if($setting->employee_add==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
									</div>
								</div> {{-- end of .form-group --}}
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.expenseClaim')}}:</label>
									<div class="col-md-6">
									<input  type="checkbox" value="1"   class="make-switch" name="expense_notification" @if($setting->expense_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
									</div>
								</div> {{-- end of .form-group --}}
								<div class="btn-panel">
									<button type="submit" data-loading-text="{{trans('core.btnUpdating')}}..." class="demo-loading-btn btn btn-1">
										<span class="icon"><i class="fa fa-check fa-fw"></i></span>
										<span class="text">{{trans('core.btnUpdate')}}</span>
									</button>
								</div>
							</div> {{-- end of .form-body --}}
						{{ Form::close() }}
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
{{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
{{ HTML::script('assets/global/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}
{{ HTML::script('assets/admin/pages/scripts/components-dropdowns.js') }}



<script>
        jQuery(document).ready(function() {
           ComponentsDropdowns.init();
        });

    </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop