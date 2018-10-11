@extends('admin.adminlayouts.adminlayout')
@section('head')
        {{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
        {{HTML::style("assets/global/plugins/select2/select2.css")}}
        {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
        {{HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")}}
@stop
@section('mainarea')
<style>
.total-summary{
    background: #9d8382;
    color:#520202;
    padding:5px;
}
.total-summary h4{
    padding-left: 15px;
    font-weight: 600;
}
</style>
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
                    
                    <div class="portlet box leave-portlet" >
                        
                        <div class="portlet-body" >
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover attendance-list" id="leave">
                                <thead>
                                    
                                    <tr>
                                        <th>{{'Type'}}</th>
                                        <th>{{'No. day(s)'}}</th>
                                        <th>{{'Date Covered'}}</th>
                                        <th>{{'Status'}}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($leaveApplications) > 0)
                                    @foreach($leaveApplications as $leave)
                                        <tr>
                                            <td> {{$leave->leaveType}}</td>
                                            <td> {{$leave->days}} </td>
                                            <td> {{date('d M Y', strtotime($leave->start_date))}} {{($leave->end_date)?date('- d M Y', strtotime($leave->end_date)):""}} </td>
                                            <td> {{$leave->application_status}} </td>
                                        </tr>
                                        @endforeach
                                        @endif

                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                    <div class="portlet box award-portlet">
                        
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover award-list" id="award">
                                <thead>
                                   
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
                        
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover" id="overtime">
                                <thead>
                                   
                                    <tr>
                                        <th>{{'Type'}}</th>
                                        <th>{{'Reason'}}</th>
                                        <th>{{'Hours'}}
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

                    <div class="portlet box attendance-portlet">
                        
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                            <table class="table table-striped table-bordered table-hover" id="attendance">
                                <thead>
                                   
                                    <tr>
                                        <th>{{'Date'}}</th>
                                        <th>{{'Status'}}</th>
                                        <th>{{'Reason'}}  
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($attendances) > 0)
                                        @foreach($attendances as $attend)
                                            <tr  id="row{{ $attend->employeeID }}">
                                                <td> {{date('d F Y', strtotime($attend->date))}}</td>
                                                <td> {{$attend->status}} </td>
                                                <td> {{$attend->reason}} </td>
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
        $('#leave, #award, #overtime, #attendance').dataTable({

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
            
            window.onload = function(){
                totalAttendance();
                totalOvertime();
                totalAward();
                totalLeave();
            }
           
            
            
            function totalAttendance(){
                var totalAttendance = '<div class="col-md-12 total-summary" >'
                + '<h4>Attendance Summary </h4>'
                + '<div class="col-md-6"> Total Absent: <strong> {{count($totalAbsent)}} {{(count($totalAbsent) > 1)?"days":"day"}}</strong> </div> '
                + '<div class="col-md-6"> Total Present: <strong> {{count($totalPresent)}} {{(count($totalPresent) > 1)?"days":"day"}}</strong> </div>'
                + '</div>';
                $('#attendance_wrapper').prepend(totalAttendance);
             }
             function totalOvertime(){
                var totalOvertime = '<div class="col-md-12 total-summary" >'
                + '<h4>Overtime Summary </h4>'
                + '<div class="col-md-6"> Total Overtime: <strong> {{($otTotal)?$otTotal:0}} {{($otTotal > 1)?"hrs":"hr"}}</strong> </div> '
                + '</div>';
                $('#overtime_wrapper').prepend(totalOvertime);
             }

             function totalAward(){
                var totalAward = '<div class="col-md-12 total-summary" >'
                + '<h4>Award Summary </h4>'
                + '<div class="col-md-6"> Total: <strong> {{count($awards)}} {{(count($awards) > 1)?"awards":"award"}}</strong> </div> '
                + '</div>';
                $('#award_wrapper').prepend(totalAward);
             }
             function totalLeave(){
                var totalLeave = '<div class="col-md-12 total-summary" >'
                + '<h4>Leave Application Summary </h4>'
                + '<div class="col-md-6"> Sick leave: <strong> {{($sickLeaveApp)?$sickLeaveApp:0}} / {{$annualLeave->leave_credit}}</strong> </div> '
                + '<div class="col-md-6"> Annual leave: <strong> {{($annualLeaveApp)?$annualLeaveApp:0}} / {{$sickLeave->leave_credit}}</strong> </div> '
                + '</div>';
                $('#leave_wrapper').prepend(totalLeave);
             }
	</script>
	



      
@stop
