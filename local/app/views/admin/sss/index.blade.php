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
							<span>SSS Settings</span>
							<div class="tools"></div>
						</div>
						<div class="btn-portlet-right">
							<a class="btn btn-1" data-toggle="modal" href="{{URL::route('admin.sss_settings.create')}}">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>Add New</span>
							</a>
						</div>
					</div> <!-- end of .portlet-title -->
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="sss">
							<thead>
								<tr>
									<th>ID</th>
									<th>Salary Range</th>
									<th>EC</th>
									<th>Employee Share</th>
									<th>Employer Share</th>
									<th>Total Share</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if( $sssSettings > 0 )
									@foreach ($sssSettings as $sssSetting)
										<tr id="row{{ $sssSetting->id }}">
											<td>{{ $sssSetting->id }}</td>
											<td>{{ $setting->currency_symbol }} {{ number_format($sssSetting->salary_from, 2) }} - {{ $setting->currency_symbol }} {{ number_format($sssSetting->salary_to, 2) }}</td>
											<td>{{ $setting->currency_symbol }} {{ number_format($sssSetting->employer_ec, 2) }}</td>
											<td>{{ $setting->currency_symbol }} {{ number_format($sssSetting->employee_share, 2) }}</td>
											<td>{{ $setting->currency_symbol }} {{ number_format($sssSetting->total_share - $sssSetting->employee_share + $sssSetting->employer_ec, 2) }}</td>
											<td>{{ $setting->currency_symbol }} {{ number_format($sssSetting->total_share + $sssSetting->employer_ec, 2) }}</td>
											<td>
												<div class="btn-actions">
                          <a class="btn btn-1" href="{{ route('admin.sss_settings.edit', $sssSetting->id) }}"><i class="fa fa-edit fa-fw"></i></a>
                          <a class="btn btn-1" href="javascript:;" onclick="del({{$sssSetting->id}})"><i class="fa fa-trash fa-fw"></i></a>
	                      </div>
		                  </td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end of .content-section -->
	@include('admin.common.delete')
@stop



@section( 'footerjs' )

	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.dataTables.columnFilter.js")}}

	<script>
		$( document ).ready( function() {
			$( '#sss' ).dataTable();
		})

		function del(id)
  		{
  			$('#deleteModal').appendTo("body").modal('show');
  			$('#info').html('{{Lang::get('messages.deleteConfirm')}} this?');
  			$("#delete").click(function()
  			{
  				var url = "{{ route('admin.sss_settings.destroy',':id') }}";
					url = url.replace(':id',id);

  					 $.ajax({
		                type: "DELETE",
		                url : url,
  		            	}).done(function(response)
  		           		  {
  		               	 	if(response.success)
  		                 	{
  		                 		$("html, body").animate({ scrollTop: 0 }, "slow");
                  	   		$('#deleteModal').modal('hide');
	                 	  		$('#row'+id).closest('tr').remove();
	                 	  		toastr.success(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success');
	                  	 	} else {
	                  	 		$("html, body").animate({ scrollTop: 0 }, "slow");
                  	   		$('#deleteModal').modal('hide');
	                  	 		toastr.error('Delete Failed', 'error');
	                  	 	}
  		           		});
  				})
  		}
	</script>

@stop