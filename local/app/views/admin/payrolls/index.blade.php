<?php $settings = DB::table('settings')->first(); ?>
@extends( 'admin.adminlayouts.adminlayout' )
@section( 'head' )
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.1/css/fixedColumns.dataTables.min.css"/>
	<style>
		th, td { white-space: nowrap; }
		div.dataTables_wrapper {
			width: 100%;
			margin: 0 auto;
		}
		.DTFC_LeftFootWrapper{
			display: none;
		}
		#payroll_filter{
	  	display:none;
	  }
	  .portlet-body table.dataTable thead tr td {
		  background: none !important;
		}
		
	</style>
@stop

@section( 'mainarea' )
    <div class="content-section">
    	<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div id="load">@include('admin.common.error')</div>
					<div class="portlet box">
						<div class="portlet-title">
							<span class="icon">{{$pageTitle}}</span>
							<span></span>
							<div class="tools"></div>
							<div class="btn-portlet-right">
                <a href="{{route('admin.payrolls.create')}}">
                  <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                  <span>Create Payroll</span>
                </a>                
                <a data-toggle="modal" href="#static" style="background: #dfba49;">
                  <span class="icon"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                  <span>Create Bulk Payroll</span>
                </a>
                <a href="{{route('admin.payrolls.export') }}" style="display: none;">
                  <span class="icon"><i class="fa fa-file-excel-o fa-fw"></i></span>
                  <span>{{trans('core.export')}}</span>
                </a>
              </div> {{-- end of .btn-portlet-right --}}
						</div> {{-- end of .portlet-title --}}
						<div class="portlet-body">
							<?php
								$payroll_table_col = array(
										'ID',
										'First Name',
										'Last Name',
										'Employee ID',
										'Period',
										'Month',
										'Year',
										'SSS',
										'Philhealth',
										'Pag-IBIG',
										'Withholding Tax',
										'Overtime Pay',
										'Net Salary',
										'Created On',
									)
							?>
							<table class="table table-striped table-bordered table-hover" id="payroll">
								<thead>					
									<tr>
										@foreach( $payroll_table_col as $key => $val )											
											<td style="width: 150px;">{{ $val }}</td>
										@endforeach	
										<td class="text-center" style="width: 230px;">Actions</td>	
									</tr>						
								</thead>
								<tfoot>									
									<tr>
										@foreach( $payroll_table_col as $key => $val )
											<th></th>
										@endforeach		
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										@foreach( $payroll_table_col as $key => $val )
											<td></td>
										@endforeach		
										<td></td>
									</tr>
								</tbody>
							</table>
						</div> {{-- end of .portlet-body --}}
					</div>
				</div>
			</div> {{-- end of .row --}}
    	</div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}   
  </div> {{-- end of .addNew-modal --}}

  {{-- MODALS SECTION --}}
  <div id="static" class="modal fade add-department" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
            <span>Create Bulk Payroll</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
        </div> {{-- end of .modal-header --}}
        <div class="modal-body">
          <div class="portlet-body form">
            {{ Form::open( array( 'url' => url('admin/payrolls/create_bulk_payroll'), 'class' => 'custom-form','method'=>'POST' ) ) }}
              <div class="form-body">
                <div class="horizontal-header">
									<div class="input-section">
										<select class="form-control  select2me" name="month" id="month">
											<option value="1">{{trans('core.January')}}</option>
											<option value="2">{{trans('core.February')}}</option>
											<option value="3">{{trans('core.March')}}</option>
											<option value="4">{{trans('core.April')}}</option>
											<option value="5">{{trans('core.May')}}</option>
											<option value="6">{{trans('core.june')}}</option>
											<option value="7">{{trans('core.July')}}</option>
											<option value="8">{{trans('core.August')}}</option>
											<option value="9">{{trans('core.September')}}</option>
											<option value="10">{{trans('core.October')}}</option>
											<option value="11">{{trans('core.November')}}</option>
											<option value="12">{{trans('core.December')}}</option>
										</select>
									</div>
									<div class="input-section">
										{{ Form::selectYear('year', 2013, date('Y')+1,date('Y'),['class' => 'form-control select2me','id'=>'year']) }}
									</div>
									@if( $setting->enable_two_payroll_period == 1 )
										<div class="input-section">
											<select name="period" id="period" class="form-control select2me">
												<option value="1">First Period</option>
												<option value="2">Second Period</option>
											</select>
										</div>
									@else
										<input name="period" type="hidden" value="0" id="period">
									@endif
								</div> {{-- end of .horizontal-header --}}
              </div> {{-- end of .form-body --}}
              <div class="btn-panel">
                <button type="submit" data-loading-text="Generating..." class="demo-loading-btn btn btn-1">Generate</button>
              </div>
            {{ Form::close() }}
          </div> {{-- end of .portlet-body --}}
        </div> {{-- end of .modal-body --}}
      </div> {{-- end of .modal-content --}}
    </div> {{-- end of .modal-dialog --}}
  </div> {{-- end of .add-department --}}

 @include('admin.common.delete')
@stop

@section('footerjs')
<!-- BEGIN PAGE LEVEL PLUGINS -->
{{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
{{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.dataTables.columnFilter.js")}}
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.1/js/dataTables.fixedColumns.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
	$(document).ready(function(){
    	// $('.select2me').select2();
		
	});

	$('#payroll').DataTable( {
		order: [[ 0, "desc" ]],
		scrollY: "300px",
	    scrollX: true,
	    scrollCollapse: true,
	    paging: false,
	    fixedColumns: {
	      leftColumns: 2
	    },
	    initComplete: function () {
	      	this.api().columns().every( function (col) {
		      	if ($.inArray(col, [6,7,8,9,10,12]) !== -1) {
		      		return true;
		      	}
		        var column = this;
		        var select = $('<select class="select2me form-control"><option value="">All</option></select>')
			        .appendTo( $(column.footer()).empty() )
			        .on( 'change', function () {
			            var val = $.fn.dataTable.util.escapeRegex(
			              $(this).val()
			            );
			            column
			                .search( val ? '^'+val+'$' : '', true, false )
			                .draw();
			        });

		        column.data().unique().sort().each( function ( d, j ) {
		          select.append( '<option value="'+d+'">'+d+'</option>' )
		        });
      		});
      	},
    	{{$datatabble_lang}}
	    "sAjaxSource": "{{ URL::route("admin.ajax_payrolls") }}",    					     
	    @if($settings->enable_two_payroll_period == 0)
	    // Hide for 1 period per month
		    "columnDefs": [{
				  "targets": [ 2 ],
				  "visible": false,
				  "searchable": false}
				],
			@endif
		});		

	function del(id,title) {

		$('#deleteModal').appendTo("body").modal('show');
		$('#info').html('{{Lang::get('messages.deleteConfirm')}}');
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