@extends('admin.adminlayouts.adminlayout')
@section('head')
        {{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
        {{HTML::style("assets/global/plugins/select2/select2.css")}}
        {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
        {{HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-xs-12 col-md-12" >
                    <div class="col-xs-12 col-md-12" style="background: #520202;color: #fff; padding: 10px; margin-bottom: 3%;">
                        <div class="col-xs-12 col-md-3">
                            <strong>Employee ID : </strong> {{$employee->employeeID}}
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <strong>Name : </strong>{{$employee->firstName . ' ' . $employee->lastName }}
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <strong>Department : </strong>{{$employee->getDesignation->designation }}
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <strong>Job title : </strong>{{$employee->jobTitle }}
                        </div>
                    </div>
                    
                </div>   
            </div>
            <div class="row">
            {{-- Left sider --}}
                <div class="col-xs-12 col-md-6">
                    
                    <div class="portlet box leave-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/customer.png' ) }}" /></div>
                                <span>{{'Leave'}}</span> 
                            
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover attendance-list" id="sample_1">
                                <thead>
                                    <tr>
                                    <h3>Leave Details</h3>
                                    </tr>
                                    <tr>
                                        <th>{{'Type'}}</th>
                                        <th>{{'Leave Credits'}}</th>
                                        <th>{{'Used'}}</th>
                                        <th>{{'Remaining'}}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sickLeaveApp != null || $sickLeaveApp != 0)
                                        <tr>
                                            <td> {{'Sick_leave'}}</td>
                                            <td> {{$sickLeave->leave_credit}} </td>
                                            <td> {{($sickLeaveApp)?$sickLeaveApp->days:0}} </td>
                                            <td> {{($sickLeaveApp)?$sickLeave->leave_credit - $sickLeaveApp->days:$sickLeave->leave_credit}} </td>
                                        </tr>
                                        @endif
                                        
                                        @if($annualLeaveApp != null || $annualLeaveApp != 0)
                                        <tr>
                                            <td> {{'Annual_leave'}}</td>
                                            <td> {{$annualLeave->leave_credit}} </td>
                                            <td> {{($annualLeaveApp)?$annualLeaveApp->days:0}} </td>
                                            <td>
                                            {{($annualLeaveApp)?$annualLeave->leave_credit - $annualLeaveApp->days:$annualLeave->leave_credit}} 
                                            </td>
                                        </tr>
                                        @endif
                                    
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                    <div class="portlet box award-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/customer.png' ) }}" /></div>
                                <span>{{'Award'}}</span> 
                            
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover attendance-list" id="sample_1">
                                <thead>
                                    <tr>
                                    <h3>Award Details</h3>
                                    </tr>
                                    <tr>
                                        <th>{{'Award Name'}}</th>
                                        <th>{{'Gift'}}</th>
                                        <th>{{'Cash Amount'}}</th>
                                        <th>{{'Date Awarded'}}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($awards)>  0)
                                        @foreach($awards as $award)
                                        <tr>
                                            <td> {{$award->awardName}}</td>
                                            <td> {{$award->gift}} </td>
                                            <td> {{$award->cashPrice}} </td>
                                            <td> 
                                            {{$award->forMonth . ' ' . $award->forYear}} 
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
                {{-- Right Sider --}}
                <div class="col-xs-12 col-md-6">
                    <div class="portlet box overtime-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/customer.png' ) }}" /></div>
                                <span>{{'Overtime'}}</span> 
                            
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                                <thead>
                                    <tr>
                                    <h3>Overtime Details</h3>
                                    </tr>
                                    <tr>
                                        <th>{{'Type'}}</th>
                                        <th>{{'Reason'}}</th>
                                        <th>{{'Hours'}}  
                                        <strong style="text-align:left;margin-left: 15%;color:#7ecec6;">
                                        Total : {{($otTotal)?$otTotal:0}}
                                        </strong>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($overtimeApp) > 0)
                                        @foreach($overtimeApp as $otApp)
                                            <tr  id="row{{ $otApp->employeeID }}">
                                                <td> {{$otApp->type}}</td>
                                                <td> {{$otApp->reason}} </td>
                                                <td> {{$otApp->total_overtime}} </td>
                                            </tr>
                                            @endforeach
                                        @endif    
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end of .row --}}
        </div>
    </div> {{-- end of .content-section --}}
@stop

@section('footerjs')
    {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
    {{HTML::script("assets/global/plugins/select2/select2.min.js")}}
    {{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
    {{HTML::script("assets/admin/pages/scripts/components-dropdowns.js")}}
    {{HTML::script('assets/admin/pages/scripts/ui-blockui.js')}}
    {{HTML::script("assets/global/plugins/moment.min.js")}}
    {{HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")}}
    {{HTML::script("assets/global/plugins/fullcalendar/lang-all.js")}}
    {{HTML::script("assets/global/plugins/highcharts/highcharts.js")}}
    {{HTML::script("assets/global/plugins/highcharts/exporting.js")}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    {{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}
    {{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}
    {{ HTML::script("assets/admin/pages/scripts/components-pickers.js")}}

<!-- END PAGE LEVEL PLUGINS -->
<script>


            // begin first table
        $('#sample_1, #sample_2').dataTable({

            {{$datatabble_lang}}

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                // "columns": [{
                //     "orderable": true
                // }, {
                //     "orderable": false
                // }, {
                //     "orderable": true
                // }, {
                //     "orderable": true
                // }, {
                //     "orderable": true
                // },{
                //     "orderable": true
                // },{
                //     "orderable": true
                // }
                //     , {
                //         "orderable": true
                //     }, {
                //         "orderable": false
                //     }],
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
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
