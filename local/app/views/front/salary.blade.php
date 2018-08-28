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
                    <div class="row margin-bottom-20">
                        <!--Profile Post-->
                        <div class="col-sm-12">





                    <div class="panel ">
								<div class="panel-heading service-block-u">
									<h3 class="panel-title"><i class="fa fa-tasks"></i> My Salary Slips</h3>
								</div>
								<div class="panel-body">

									<table class="table table-striped table-bordered table-hover" id="payroll">
											<thead>
											<tr>
												<th>ID</th>
                                                <th>Period</th>
												<th>Month</th>
												<th>Year</th>
												<th>Net Salary</th>
												<th class="text-center"> {{trans('core.action')}} </th>
											</tr>
											</thead>
											<tbody>


											<tr >
												<td>{{-- ID --}}</td>
												<td>{{-- Month --}}</td>
												<td>{{-- Year --}}</td>
												<td>{{-- Net --}}</td>
												<td>{{-- created On --}}</td>
												<td>{{-- Action --}} </td>
											</tr>



											</tbody>
									</table>
								</div>
							</div>


                        <!--End Profile Post-->


                    </div><!--/end row-->

                    <hr>



                </div>
                <!--End Profile Body-->
            </div>

</div>


{{-- Show Notice MODALS --}}


                        <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">
                                        My Salary Slip
                                        </h4>
                                    </div>
                                    <div class="modal-body" id="modal-data">
                                        {{--Notice full Description using Javascript--}}
                                    </div>
                                </div>
                            </div>
                        </div>


  {{-- END Notice MODALS --}}

@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}


<!-- END PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->





 <script>

     $('#payroll').dataTable( {
                     "bProcessing": true,
                     "bServerSide": true,
                      {{$datatabble_lang}}
                     "sAjaxSource": "{{ URL::route("front.ajax_payrolls") }}",
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


	// $('.show_notice').on('shown.bs.modal',function(e){
 //        // console.log(e.relatedTarget);
	// 	show_salary_slip($(e.relatedTarget).data('sid'));
	// });

       function show_salary_slip(id)
       {
            $('.show_notice').modal('show');

			$(document).find('#modal-data').html('<div class="text-center">{{HTML::image('front_assets/img/loading-spinner-blue.gif')}}</div>');
            $.ajax({
                type: "GET",
                url : "{{ URL::to('salary_slip/"+id+"') }}"
            /*alert(url);*/
            }).done(function(response){
                // console.log(response);
                $(document).find('#modal-data').html(response);
//
		 	});
       }




    </script>


@stop
