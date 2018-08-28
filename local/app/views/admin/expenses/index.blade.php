@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
    <div class="content-section">
		<div class="row">
			<div class="col-md-6 margin-bottom-10">
				
			</div>
			<div class="col-md-6 margin-bottom-10 text-right email-notif">
				<span id="load_notification"></span>
				<input  type="checkbox"  onchange="ToggleEmailNotification('expense_notification');return false;" class="make-switch" name="expense_notification" @if($setting->expense_notification==1)checked	@endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
				<strong>{{trans('core.emailNotification')}}</strong><br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box">
					<div class="portlet-title">
						<div class="title-left">
                            <div class="icon"><i class="fa fa-database fa-fw"></i></div>
                            <span>{{trans('core.expenseList')}}</span>                  
                        </div>
						<div class="btn-portlet-right">
							<a href="{{ route('admin.expenses.create')}}" class="btn green">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{trans('core.btnAddExpense')}} {{trans('core.item')}}</span>
							</a>
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="expenses">
							<thead>
								<tr>
    								<th> {{trans('core.id')}}</th>
    								<th> {{trans('core.item')}}</th>
    								<th> {{trans('core.purchaseFrom')}}</th>
    								<th> {{trans('core.date')}}</th>
    								<th> {{trans('core.employee')}}</th>
    								<th>{{trans('core.price')}} (  {{$setting->currency_symbol}} )</th>
    								<th>{{trans('core.status')}}</th>
    								<th style="width: 140px;">{{trans('core.action')}}</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
								<th> {{trans('core.id')}}</th>
								<th> {{trans('core.item')}}</th>
								<th> {{trans('core.purchaseFrom')}}</th>
								<th> {{trans('core.date')}}</th>
								<th> {{trans('core.employee')}}</th>
								<th>{{trans('core.price')}} (  {{$setting->currency_symbol}} )</th>
								<th>{{trans('core.status')}}</th>
								<th style="width: 140px;">{{trans('core.action')}}</th>
								</tr>
							</tfoot>
							<tbody>
								<tr >
								<td>{{-- ID --}}</td>
								<td>{{-- Item Name --}}</td>
								<td>{{-- Purchase Date --}}</td>
								<td>{{-- Purchase Date --}}</td>
								<td>{{-- Purchase Date --}}</td>
								<td>{{-- Purchase From --}}</td>
								<td>{{-- Price --}}</td>
								<td style="width: 140px;">{{-- Action --}} </td>
								</tr>
							</tbody>
						</table>
					</div> {{-- end of .portlet-body --}}
				</div> {{-- end of .portlet --}}
			</div>
		</div>
    </div> {{-- end of .content-section --}}
	@include( 'admin.common.delete' )
@stop



@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
    	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
    	{{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.dataTables.columnFilter.js")}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>


    	var table = $('#expenses').dataTable( {
                    "bProcessing": true,
            {{$datatabble_lang}}
                    "bServerSide": true,
                    "sAjaxSource": "{{ URL::route("admin.ajax_expenses") }}",
                    "aaSorting": [[ 1, "asc" ]],
                    "aoColumns": [
                        { 'sClass': 'center', "bSortable": true  },
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
					"fnInitComplete": function(oSettings, json) {

							 Metronic.init();
							}

         }).columnFilter({
         aoColumns: [ 			null,
         				     { type: "text" },

         				     { type: "text" },
         				     { type: "number" },
         				     { type: "select", values: [ {{$emp}}]  }
         				]

         });



		function del(id,name)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} <strong>'+name+'</strong> ?' );
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

			function changeStatus(id,status){
            			$.ajax({
            			    type: 'POST',
            			    url: "{{route('admin.expense.change_status')}}",
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
            						}else if(status == 'approved'){
            							$('#status'+id).removeClass('label-danger');
            							$('#status'+id).removeClass('label-warning');
            						    $('#status'+id).addClass('label-success');
            						    $('#status'+id).html('Approved');
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
</script>
@stop
	