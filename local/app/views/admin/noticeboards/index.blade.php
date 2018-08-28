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
			<div class="col-md-12">
				<div class="portlet box">
					<div class="portlet-title">
						<div class="title-left">
							<span class="icon"><i class="fa fa-clipboard fa-fw"></i></span>
							<span>{{trans('core.noticeList')}}</span>
							<div class="tools"></div>
						</div>
						<div class="btn-portlet-right">
							<a class="btn btn-1" data-toggle="modal" href="{{URL::route('admin.noticeboards.create')}}">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{trans('core.btnAddNotice')}}</span>
							</a>
						</div>
					</div> <!-- end of .portlet-title -->
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="notices">
							<thead>
								<tr>
									<th> {{trans('core.id')}} </th>
									<th> {{trans('core.title')}} </th>
									<th> {{trans('core.description')}} </th>
									<th> {{trans('core.status')}} </th>
									<th> {{trans('core.createdOn')}} </th>
									<th> {{trans('core.action')}} </th>
								</tr>
							</thead>
							<tbody>
								<tr >
									<td>{{-- ID --}}</td>
									<td>{{-- Title --}}</td>
									<td>{{-- Description --}}</td>
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
@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>


	$('#notices').dataTable( {
                "bProcessing": true,
                 {{$datatabble_lang}}
                "bServerSide": true,
                "sAjaxSource": "{{ URL::route("admin.ajax_notices") }}",
                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
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
			$("#delete").click(function(){
                $.ajax({
                    type: "POST",
                    url : "{{ url('api/delete/' . $slug) }}/" + id,
                    dataType: 'json',
                })
                .done(function(response){
                    if(response.success == "deleted"){
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#deleteModal').modal('hide');
                        $('#row'+id).fadeOut(500);
                        showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success'); 
                        setTimeout(function() {
                            window.location.replace('{{ route('admin.'.$slug.'.index') }}')
                        }, 1000);           
                    }
                });
            })

			}
</script>
@stop
	