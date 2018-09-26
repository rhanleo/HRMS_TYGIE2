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

					<h2>{{'Rental'}} </h2><hr>
					
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
								<th>Billing Date</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Remarks</th>
								<th>Updated at</th>
							</tr>
							</thead>
							<tbody>
							@if(count($rentals) > 0)
							@foreach($rentals as $rental)
							<tr>
								<td>
									<?php 
										$date = date_create($rental['date_covered']);
										$dateCovered = date_format($date, "F d, Y");
										echo $dateCovered;
									?>
								
								</td>
								<td>{{$rental->amount}}</td>
								<td>{{$rental->status }}</td>
								<td>{{$rental->remarks}}</td>
								<td>
									<?php 
										$update = date_create($rental['updated_at']);
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


@stop