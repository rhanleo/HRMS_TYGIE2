@extends('front.layouts.frontlayout')

@section('head')

{{HTML::style("assets/global/css/components.css")}}
{{HTML::style("assets/global/css/plugins.css")}}
{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}

@stop

@section('mainarea')
            <div class="col-md-9">

                <!--Profile Body-->
                <div class="profile-body">

					<h2>{{'Scheduled'}} </h2><hr>
					
					@if(Session::get('success'))
						<div class="row">
								<div class="col-md-12">
									<div class="alert alert-success">
										<span class="fa fa-check">{{Session::get('success')}}</span>
									</div>
								</div>
						</div>
					@endif
   			
				  <div class="row">
				
						<div class="col-md-12 col-sm-12">
						<table class="table table-striped table-bordered table-hover" id="sample_employees">
							<thead>
							<tr>
								<th>Duration Date</th>
								<th>TIme</th>
								<th>Shift</th>
								<th>Remarks</th>
								<th>Updated at</th>
							</tr>
							</thead>
							<tbody>
							@if(count($schedule) > 0)
							@foreach($schedule as $sched)
							<tr id="row{{$sched['id']}}">
								<td>
									<?php 
										$dateFrom = date_create($sched['dateFrom']);
										$dateTo = date_create($sched['dateTo']);
										$dFrom = date_format($dateFrom, "F d, Y");
										$dTo = date_format($dateTo, "F d, Y");
										echo $dFrom . ' - ' . $dTo;
									?>
								
								</td>
								<td>{{$sched->timeFrom . ' ' . $sched->timeTo}}</td>
								<td>{{$sched->shift }}</td>
								<td>{{$sched->remarks}}</td>
								<td>
									<?php 
										$update = date_create($sched['updated_at']);
										
										$updateAt = date_format($update, "F d, Y h:i A");
										echo $updateAt;
									?>
								</td>
							</tr>
								@endforeach
							@else 
							<tr>
								<strong class="text-danger">No schedule found.</strong>
							</tr>
							@endif
							</tbody>
								<h2 class="heading-md"></h2>

								
						</table>
						</div>
				

				 </div>
            </div>

</div>


@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->

	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}


<!-- END PAGE LEVEL PLUGINS -->
<script>
// Datatable
$('#sample_employees').dataTable({

{{$datatabble_lang}}

	"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

	
	"lengthMenu": [
		[5, 15, 20, -1],
		[5, 15, 20, "All"] // change per page values here
	],
	set the initial value
	"pageLength": 5,
	"sPaginationType": "full_numbers",
	"columnDefs": [{  // set default column settings
		'orderable': false,
		'targets': [0]
	}, {
		"searchable": false,
		"targets": [0]
	}],
	"order": [
		[1, "asc"]
	] // set first column as a default sort by asc
});
</script>

@stop