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
                {{-- Error Messages --}}
                    <div id="alert_message">
                        @if(Session::get('success_overtime'))
                            <div class="alert alert-success"><i class="fa fa-check"></i> {{ Session::get('success_overtime') }}</div>
                        @endif
                    </div>
                {{-- Error Messages --}}

                    <div class="panel">
                        <div class="panel-heading service-block-u">
                            <h3 class="panel-title"><i class="fa fa-tasks"></i> My Overtime Applications</h3>
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="applications">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Status</th>
                                        <th>Applied</th>
                                        <th>Total Hours</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--/end row-->
        </div>
    </div><!--End Profile Body-->
</div>


{{-- Show Notice MODALS --}}


<div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myLargeModalLabel" class="modal-title">
                Overtime Application
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
{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    
    <script>

        $('#applications').dataTable({
        	"responsive":true,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{ URL::route("front.overtime_applications") }}",
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
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

        function ot_show_application(id){
            $('#modal-data').html('<div class="text-center">{{HTML::image('front_assets/img/loading-spinner-blue.gif')}}</div>');
            $.ajax({
                type: "GET",
                url : "{{ URL::to('overtime/show/"+id+"') }}"

            }).done(function(response) {
                $('#modal-data').html(response);
            });
        }
        
        function ot_edit_application(id){
            console.log('here');
            $('#modal-data').html('<div class="text-center">{{HTML::image('front_assets/img/loading-spinner-blue.gif')}}</div>');
            $.ajax({
                type: "GET",
                url : "{{ URL::to('overtime/edit/"+id+"') }}"

            }).done(function(response) {
                $('#modal-data').html(response);
            });
        }

        @if (Session::get('error_leave'))
            $("html, body").animate({ scrollTop: $('#applications').height()+600 }, 2000);
        @endif


    </script>


@stop