@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
    <div class="content-section">
    	<div class="container-fluid">
			<div class="row">
				<div class="col-md-6"></div>
				<div class="col-md-6 form-group text-right email-notif">
					<span id="load_notification"></span>
					<input  type="checkbox"  onchange="ToggleEmailNotification('award_notification');return false;" class="make-switch" name="award_notification" @if($setting->award_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
					<strong>{{trans('core.emailNotification')}}</strong><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<div class="portlet box">
					<div class="portlet-title">
						<div class="title-left">
							<div class="icon"><i class="fa fa-trophy fa-fw"></i></div>
							<span>{{trans('core.awards')}}</span>
							<div class="tools"></div>
						</div>
						<div class="btn-portlet-right">
							<a class="btn green" data-toggle="modal" href="{{URL::to('admin/awards/create')}}">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{trans('core.btnAddAward')}}</span>
							</a>
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="awards">
							<thead>
								<tr>
									<th>Hidden ID</th>
									<th>{{trans('core.employeeID')}}</th>
									<th>{{trans('core.awardeeName')}}</th>
									<th>{{trans('core.awards')}}</th>
									<th>{{trans('core.gift')}}</th>
									<th>Hidden Month</th>
									<th>{{trans('core.month')}}</th>
									<th>{{trans('core.action')}}</th>
								</tr>
							</thead>
							<tbody>
								<tr >
								<td>{{-- Hidden ID --}}</td>
								<td>{{-- EmployeeID --}}</td>
								<td>{{-- Awardee Name --}}</td>
								<td>{{-- Award --}} </td>
								<td>{{-- Gift --}}</td>
								<td>{{-- HIdden Month --}}</td>
								<td>{{-- Month --}}</td>
								<td>{{-- Action --}} </td>
								</tr>
							</tbody>
						</table>
					</div> {{-- end of .portlet-body --}}
				</div> {{-- end of .portlet --}}

				</div>
			</div>
    	</div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}
			
			<!-- END PAGE CONTENT-->

			{{--DELETE MODAL CALLING--}}
                @include('admin.common.delete')
            {{--DELETE MODAL CALLING END--}}
@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
    {{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>



		$('#awards').dataTable( {
            {{$datatabble_lang}}
                        "bProcessing": true,
                        "bServerSide": true,
                        "sAjaxSource": "{{ route("admin.ajax_awards") }}",
                        "aaSorting": [[ 1, "asc" ]],
                        "aoColumns": [
                            { 'sClass': 'center', "bSortable": true  },
                            { 'sClass': 'center', "bSortable": true  },
                            { 'sClass': 'center', "bSortable": true },
                            { 'sClass': 'center', "bSortable": true },
                            { 'sClass': 'center', "bSortable": true },
                            { 'sClass': 'center', "bSortable": true },
                            { 'sClass': 'center', "bSortable": true },
                            { 'sClass': 'center', "bSortable": false }


                        ],
                        "columnDefs": [
                                    {
                                        "targets": [ 0 ],
                                        "visible": false,
                                        "searchable": false
                                    },{
									  "targets": [ 5 ],
									  "visible": false,
									  "searchable": true
								  }
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



		function del(id,award)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} <strong>'+award+'</strong>?');
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
	