@extends('admin.adminlayouts.adminlayout')
@section('head')
	<!-- BEGIN PAGE LEVEL STYLES -->
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
	{{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
	<!-- END PAGE LEVEL STYLES -->
@stop
@section('mainarea')
	<div class="content-section">
		<div id="load">
			@include('admin.common.error')
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="portlet box">
					<div class="portlet-title has-pad">
						<div class="title-left">
							<span class="icon"><i class="fa fa-clipboard fa-fw"></i></span>
							<span>{{$pageTitle}} List</span>
							<div class="tools"></div>
						</div>
					</div> <!-- end of .portlet-title -->
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="jobs">
							<thead>
								<tr>
									<th> {{trans('core.id')}} </th>
									<th> {{trans('core.position')}} </th>
									<th> {{trans('core.name')}} </th>
									<th> {{trans('core.email')}} </th>
									<th> {{trans('core.phone')}} </th>
									<th> {{trans('core.appliedOn')}} </th>
									<th> {{trans('core.submittedBy')}} </th>
									<th> {{trans('core.status')}} </th>
									<th> {{trans('core.action')}} </th>
								</tr>
							</thead>
							<tbody>
								<tr >
									<td>{{-- ID --}}</td>
									<td>{{-- Title --}}</td>

									<td>{{-- Status --}}</td>
									<td>{{-- Status --}}</td>
									<td>{{-- Status --}}</td>
									<td>{{-- Status --}}</td>
									<td>{{-- Status --}}</td>
									<td>{{-- Created on --}}</td>
									<td>{{-- Action --}} </td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end of .content-section -->
	@include('admin.common.delete')
	<div id="jobModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{$pageTitle}}</h4>
                </div>
                <div class="modal-body" id="job_info">
                            {{--Ajax replace content--}}
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn default">{{trans('core.btnCancel')}}</button>

                </div>
            </div>
       </div>
    </div>
@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}

	{{ HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
	{{--{{ HTML::script("assets/admin/pages/scripts/components-dropdowns.js")}}--}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>


	$('#jobs').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::route("admin.ajax_jobs_applications") }}",
                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true },
                    { 'sClass': 'center', "bSortable": true },
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
					 Metronic.init();
                    var row = $(nRow);
                    row.attr("id", 'row'+aData['0']);

                },
                "language": {
                					  "emptyTable": "No Jobs application Exists."
                					},
                "fnInitComplete": function(oSettings, json) {

                					 Metronic.init();
                				}
     });





		function del(id)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} ');
			$("#delete").click(function()
			{
					var url = "{{ route('admin.job_applications.destroy',':id') }}";
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

		function changeStatus(id,status){
			$.ajax({
			    type: 'POST',
			    url: "{{route('admin.job_applications.change_status')}}",
			    dataType: "JSON",
			    data: { 'status':status,'id':id},
			    success: function(response) {
					if(response.status=='success'){
						if(status == 'rejected'){
							$('#status'+id).removeClass('label-success');
							$('#status'+id).removeClass('label-warning');
							$('#status'+id).addClass('label-danger');
							$('#status'+id).html('Rejected');
							$('#reject'+id).hide();
							$('#accept'+id).show();
						}else if(status == 'selected'){
							$('#status'+id).removeClass('label-danger');
							$('#status'+id).removeClass('label-warning');
						    $('#status'+id).addClass('label-success');
						    $('#status'+id).html('Selected');
						    $('#accept'+id).hide();
						    $('#reject'+id).show();
						}
						showToastrMessage(status, '{{Lang::get('messages.statusChanged')}}', 'success');
					}
			    },
			    error: function(xhr, textStatus, thrownError) {

			    }
			});
		}

	function showView(id){
	$('#jobModal').appendTo("body").modal('show');
		var get_url = "{{ route('admin.job_applications.show',':id') }}";
		get_url = get_url.replace(':id',id);

		$.ajax({
		    type: 'GET',
		    url: get_url,

		    data: {'id':id},
		    success: function(response) {
				$('#job_info').html(response);
		    },
		    error: function(xhr, textStatus, thrownError) {

		    }
		});
	}


</script>
@stop
	