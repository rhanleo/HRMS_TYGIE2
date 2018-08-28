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


                        {{------------------Error Messages----------}}
						<div id="alert_message">
                                     @if(Session::get('success_leave'))
                                            <div class="alert alert-success"><i class="fa fa-check"></i> {{ Session::get('success_leave') }}</div>
                                     @endif

                                      @if (Session::get('error_leave'))
                                            <div class="alert alert-danger alert-dismissable ">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                 @foreach (Session::get('error_leave') as $error)
                                                     <p><strong><i class="fa fa-warning"></i></strong> {{ $error }}</p>
                                                 @endforeach
                                            </div>
                                      @endif
						</div>
                        {{------------------Error Messages----------}}


                    <div class="panel ">
                                                <div class="panel-heading service-block-u">
                                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> {{trans('core.myLeaveApp')}}</h3>
                                                </div>
                                                <div class="panel-body">

                                                    <table class="table table-striped table-bordered table-hover" id="applications">
                                                         <thead>
                                                        <tr>
                                                            <th>{{trans('core.id')}}</th>
                                                            <th>{{trans('core.date')}}</th>
                                                            <th class="text-center">{{trans('core.days')}}</th>
                                                            <th>{{trans('core.type')}}</th>

                                                            <th>{{trans('core.reason')}}</th>
                                                            <th>{{trans('core.appliedOn')}}</th>
                                                            <th>{{trans('core.status')}}</th>
                                                            <th>{{trans('core.action')}}</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                             <td> {{-- ID from Contoller ajaxload------}} </td>
                                                             <td class="text-center"> {{-- Date from Contoller ajaxload----}} </td>
                                                             <td> {{-- Days from Contoller ajaxload----}} </td>
                                                             <td> {{-- Leavetype from Contoller ajaxload--}} </td>
                                                             <td> {{-- Reason from Contoller ajaxload----}} </td>
                                                             <td> {{-- Applied on from Contoller ajaxload---}} </td>
                                                             <td> {{-- Status from Contoller ajaxload----}} </td>
                                                             <td> {{-- Action from Contoller ajaxload----}} </td>
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


{{--------------------------Show Notice MODALS-----------------}}


                        <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 id="myLargeModalLabel" class="modal-title">
                                        Leave Application
                                        </h4>
                                    </div>
                                    <div class="modal-body" id="modal-data">
                                        {{--Notice full Description using Javascript--}}
                                    </div>
                                </div>
                            </div>
                        </div>


  {{------------------------END Notice MODALS---------------------}}

@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}


<!-- END PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->





 <script>

        $('#applications').dataTable(
        {
        	"responsive":true,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{ URL::route("front.leave_applications") }}",
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
            "sPaginationType": "full_numbers",
            "language": {
           				 "lengthMenu": 		"Display _MENU_ records per page",
                         "info": 			"Showing page _PAGE_ of _PAGES_",
                         "emptyTable": 		"{{trans('messages.noDataTable')}}",
                         "infoFiltered":	 "(filtered from _MAX_ total records)",
                         "search":       	"{{trans('core.search')}}:"
						},
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                var row = $(nRow);
                row.attr("id", 'row'+aData['0']);
            }

        });





       function show_application(id)
       {
			$('#modal-data').html('<div class="text-center">{{HTML::image('front_assets/img/loading-spinner-blue.gif')}}</div>');
            $.ajax({
                    type: "GET",
                    url : "{{ URL::to('dashboard/"+id+"') }}"

                    }).done(function(response)
                    {
                                $('#modal-data').html(response);
//
				 	});
       }

        @if (Session::get('error_leave'))
        	$("html, body").animate({ scrollTop: $('#applications').height()+600 }, 2000);
       @endif


    </script>


@stop