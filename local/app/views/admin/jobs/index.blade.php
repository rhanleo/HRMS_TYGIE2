@extends('admin.adminlayouts.adminlayout')
@section('head')
	<!-- BEGIN PAGE LEVEL STYLES -->
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
	<!-- END PAGE LEVEL STYLES -->
@stop
@section('mainarea')
	<div class="content-section">
		<div id="load">
        	@include('admin.common.error')
		</div>
		<div class="row">
			<div class="col-md-6 margin-bottom-10"></div>
			<div class="col-md-6 margin-bottom-10 text-right email-notif">
				<span id="load_notification"></span>
				<input  type="checkbox"  onchange="ToggleEmailNotification('job_notification');return false;" class="make-switch" name="job_notification" @if($setting->job_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
				<strong>{{trans('core.emailNotification')}}</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="portlet box">
					<div class="portlet-title">
						<div class="title-left">
							<span class="icon"><i class="fa fa-clipboard fa-fw"></i></span>
							<span>{{trans('core.jobList')}}</span>
							<div class="tools"></div>
						</div>
						<div class="btn-portlet-right">
							<a class="btn green" data-toggle="modal" href="{{URL::route('admin.jobs.create')}}">		
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{Lang::get('core.btnAddJob')}}</span>
							</a>
						</div>
					</div> <!-- end of .portlet-title -->
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="jobs">
							<thead>
								<tr>
									<th> {{trans('core.id')}} </th>
									<th> {{trans('core.position')}} </th>

									<th> {{trans('core.postedDate')}}  </th>
									<th> {{trans('core.lastDateToApply')}}  </th>
									<th> {{trans('core.closeDate')}}  </th>
									<th> {{trans('core.status')}}  </th>
									<th> {{trans('core.action')}}  </th>
								</tr>
							</thead>
							<tbody>
								<tr >
									<td>{{-- ID --}}</td>
									<td>{{-- Title --}}</td>

									<td>{{-- Status --}}</td>
									<td>{{-- Status --}}</td>
									<td>{{-- Status --}}</td>
									<td>{{-- Created on --}}</td>
									<td>{{-- Action --}} </td>
								</tr>
							</tbody>
						</table>
					</div>
				</div> <!-- end of .portlet -->
			</div>
		</div>
	</div> <!-- end of .content-section -->
	@include('admin.common.delete')
@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>


	$('#jobs').dataTable( {
                "bProcessing": true,
                {{$datatabble_lang}}
                "bServerSide": true,
                "sAjaxSource": "{{ URL::route("admin.ajax_jobs") }}",
                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true },
                    { 'sClass': 'center', "bSortable": true },
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
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} ');
			$("#delete").click(function()
			{
					var url = "{{ route('admin.jobs.destroy',':id') }}";
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
</script>
@stop
	