@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
	<div class="page-banner" style="background-image: url( {{ URL::asset( 'assets/global/img/banners/attendance.png' ) }} );">
		<div class="left-banner">
			<h3 class="page-title">{{$pageTitle}}</h3>
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home fa-fw"></i>
					<a href="{{route('admin.dashboard.index')}}">{{trans('core.home')}}</a>
					<i class="fa fa-angle-right fa-fw"></i>
				</li>
				<li>
					<a href="#">admins</a>
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
		<div id="load">@include('admin.common.error')</div>
		<div class="row">
			<div class="col-xs-12 col-md-6 margin-bottom-10"></div>
			<div class="col-xs-12 col-md-6 margin-bottom-10 email-notif text-right">
				<span id="load_notification"></span>
				 <input  type="checkbox"  onchange="ToggleEmailNotification('admin_add');return false;" class="make-switch" name="admin_add" @if($setting->admin_add==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
				 <strong>{{trans('core.emailNotification')}}</strong>
			</div>
		</div> {{-- end of .row --}}
		<div class="row">
			<div class="col-xs-12">
				<div class="portlet box">
					<div class="portlet-title">
						<div class="title-left">
							<span class="icon"><i class="fa fa-users fa-fw"></i></span>
							<span>Admin List</span>
							<div class="tools"></div>
						</div> {{-- end of .title-left --}}
						<div class="btn-portlet-right">
						
							<a class="btn green" data-toggle="modal" href="#static" >
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span class="text">{{trans('core.btnAddAdmin')}}</span>
							</a>
					
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="admins">
							<thead>
								<tr>
									<th> {{trans('core.id')}} </th>
									<th> {{trans('core.name')}} </th>
									<th> {{trans('core.email')}} </th>
									<th> {{trans('core.createdOn')}} </th>
									<th class="text-center"> {{trans('core.action')}} </th>
								</tr>
							</thead>
							<tbody>
								<tr >
									<td>{{-- ID --}}</td>
									<td>{{-- EmployeeID --}}</td>
									<td>{{-- Name --}}</td>
									<td>{{-- created On --}}</td>
									<td>{{-- Action --}} </td>
								</tr>
							</tbody>
						</table>
					</div> {{-- end of .portlet-body --}}
				</div>
			</div>
		</div>
	</div> {{-- end of .content-section --}}
	@include('admin.common.delete')
	<div id="static" class="modal fade addNew-modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="icon"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></span>
					<span>{{trans('core.new')}} Admin  {{Auth::admin()->get()->level}}</span>
				</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
				
				
			</div>
			<div class="modal-body">
			<div class="portlet-body form">

			<!-- BEGIN FORM-->
			{{Form::open(array('route'=>"admin.admin_users.store",'class'=>'form-horizontal ','method'=>'POST','id'=>'add_form'))}}

			<div id="error"></div>
			<div class="form-body">

			<div class="form-group">
			<label class="col-md-4 control-label">{{trans('core.name')}}: <span class="required">
			* </span>
			</label>
			<div class="col-md-8">
			<input type="text" class="form-control" name="name" placeholder="{{trans('core.name')}}" >
			</div>
			</div>
			<div class="form-group">
			<label class="col-md-4 control-label">{{trans('core.email')}}: <span class="required">
			* </span>
			</label>
			<div class="col-md-8">
			<input type="text" class="form-control" name="email" placeholder="{{trans('core.email')}}">
			</div>
			</div>
			<div class="form-group">
			<label class="col-md-4 control-label">{{trans('core.password')}}: <span class="required">
			* </span>
			</label>
			<div class="col-md-8">
			<input type="password" class="form-control" name="password" placeholder="{{trans('core.password')}}" >
			</div>
			</div>
			<div class="form-group">
			<label class="col-md-4 control-label">{{trans('core.confirmPassword')}}: <span class="required">
			* </span>
			</label>
			<div class="col-md-8">
			<input type="password" class="form-control" name="password_confirmation" placeholder="{{trans('core.confirmPassword')}}">
			</div>
			</div>
			<div class="form-group">
			<label class="col-md-4 control-label">{{'Level'}}: <span class="required">
			* </span>
			</label>
			<div class="col-md-8">
			<select name="level">
				<option value="0">0 - Super Admin</option>
				<option value="1">1 - HRS Admin</option>
				<option value="2">2 - Finance Admin</option>
				
			</select>
			</div>
			</div>


			</div>

				<div class="btn-panel">
					<button type="submit" id="submitbutton_add" onclick="addAdminSubmit();return false;"  class="btn btn-1">{{trans('core.btnSubmit')}}</button>
				</div>
			{{ Form::close() }}
			<!-- END FORM-->
			</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
			</div>

		</div>
	</div> {{-- end of .addNew-modal --}}



<div id="static_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="icon"><i class="fa fa-edit"></i></span>
					<span>{{trans('core.edit')}} Admin</span>
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
			</div>
			<div class="modal-body">
			<div class="portlet-body form" id="edit-form-body">
			</div>
			</div>
		</div> {{-- end of .modal-content --}}
	</div> {{-- end of .modal-dialog --}}
</div> {{-- end of #static_edit --}}
@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>


	$('#admins').dataTable( {
                {{$datatabble_lang}}
                "bProcessing": true,

                "bServerSide": true,
                "sAjaxSource": "{{ URL::route("admin.ajax_admin_users") }}",
                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true },

                    { 'sClass': 'center', "bSortable": true },
                    { 'sClass': 'center', "bSortable": true },

                    { 'sClass': 'center', "bSortable": false }
                ],
                "lengthMenu": [
								[5, 15, 20, -1],
								[5, 15, 20, "All"] // change per page values here
							],
                "sPaginationType": "full_numbers",
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var row = $(nRow);
                    row.attr("id", 'row'+aData['0']);
                }

     });





		function del(id)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} ?');
			$("#delete").click(function()
			{
					var url = "{{ route('admin.admin_users.destroy',':id') }}";
						url = url.replace(':id',id);
					 $.ajax({

		                type: "DELETE",
		                url : url,
		                dataType: 'json',
		                data: {"id":id}

		            	}).done(function(response)
		           		  {

		               	 	 if(response.success == "deleted")
		                 	 {
		                 	 		$("html, body").animate({ scrollTop: 0 }, "slow");
		                  	   		$('#deleteModal').modal('hide');
		                 	  		$('#row'+id).fadeOut(500);
		                 	  		showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success');
		                  	 }
		           		 });
				})

			}
			function addAdminSubmit(){
			$("#error").html('<div class="alert alert-info">{{trans('messages.submitting')}}..</div>');
			$("#submitbutton_add").prop('disabled', true);

				$.ajax({
				    type: 'POST',
				    url: "{{route('admin.admin_users.store')}}",
				    dataType: "JSON",
				    data: $('#add_form').serialize(),
				    success: function(response) {
						 if(response.status == "error")
							  {
							  showToastrMessage('{{ Lang::get('messages.errorTitle') }}', '{{Lang::get('messages.error')}}', 'error');
								$('#error').html('');
								 var arr = response.msg;
								 var alert ='';
								 $.each(arr, function(index, value)
								 {
									 if (value.length != 0)
									 {
										alert += '<p><span class="fa fa-close"></span> '+ value+ '</p>';
									 }
								 });

								 $('#error').html('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> '+alert+'</div>');
								  $("#submitbutton_add").prop('disabled', false);
							  }else{
									window.location.href='{{route('admin.admin_users.index')}}'
							  }

						 },
				    error: function(xhr, textStatus, thrownError) {

				    }
				});
			}

		function showEdit(id)
		{
				$('#static_edit').modal('show');
				var get_url = "{{ route('admin.admin_users.edit',':id') }}";
				get_url = get_url.replace(':id',id);

				$("#edit-form-body").html('<div class="text-center">{{HTML::image('assets/admin/layout/img/loading-spinner-blue.gif')}}</div>');

				$.ajax({
					type: "GET",
					url : get_url,
					data: {}
					}).done(function(response)
					  {
						$("#edit-form-body").html(response);
				 });
		}
		function updateData(id){
				var get_url = "{{ route('admin.admin_users.update',':id') }}";
				get_url = get_url.replace(':id',id);
				$("#error_edit").html('<div class="alert alert-info">{{trans('messages.submitting')}}..</div>');
				$("#submitbutton_edit").prop('disabled', true);

			$.ajax({
			    type: 'PUT',
			    url: get_url,
			    dataType: "JSON",
			    data: $('#edit_form').serialize(),
			    success: function(response) {
				 if(response.status == "error")
					  {
					  	showToastrMessage('{{ Lang::get('messages.errorTitle') }}', '{{Lang::get('messages.error')}}', 'error');
						$('#error').html('');
						 var arr = response.msg;
						 var alert ='';
						 $.each(arr, function(index, value)
						 {
							 if (value.length != 0)
							 {
								alert += '<p><span class="fa fa-close"></span> '+ value+ '</p>';
							 }
						 });
						$('#error_edit').html('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> '+alert+'</div>');
					  	$("#submitbutton_edit").prop('disabled', false);
					  }else{
							window.location.href='{{route('admin.admin_users.index')}}'
					  }

				 },
			    error: function(xhr, textStatus, thrownError) {

			    }
			});
		}
</script>
@stop
