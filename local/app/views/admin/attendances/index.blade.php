@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")}}
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="load">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                    </div>
                    
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span class="icon"><i class="fa fa-users fa-fw"></i></span>
                                <span>Attendance Summary</span>
                                <div class="tools"></div>
                            </div>
                            <div class="btn-portlet-right">
                                <a href="{{route('admin.attendances.create')}}" data-loading-text="Redirecting..." class="demo-loading-btn">
                                    <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                    <span>{{ trans( 'core.markToday' ) }}</span>
                                </a>
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            <div class="attendance-table-header">
                                
                            </div> {{-- end of .attendance-table-header --}}
                            <table class="table table-striped table-bordered table-hover attendance-list" id="sample_1">
                                <thead>
                                    <tr>
                                        <th>EmployeeID</th>
                                        <th class="text-center">{{trans('core.image')}}</th>
                                        <th>{{trans('core.name')}}</th>
                                        <th>{{trans('core.lastAbsent')}}</th>
                                        <th>{{trans('core.leaves')}}</th>
                                        <th>Available Leave</th>
                                        <th>{{trans('core.status')}}</th>
                                        <th style="width: 50px;">{{trans('core.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr id="row{{ $employee->employeeID }}">
                                            <td> {{ $employee->employeeID }}</td>
                                            <td class="text-center"> {{HTML::image("/profileImages/{$employee->profileImage}",'ProfileImage',['height'=>'100px'])}} </td>
                                            <td> {{ $employee->fullName }} </td>
                                            <td> {{ $employee->lastAbsent($employee->employeeID) }} </td>
                                            <td>
                                                <ul style="list-style: none; padding:0">
                                                    <?php 
                                                        $total_leave = $leave_used = 0;
                                                        $leavetypes = DB::table('leavetypes')->get();

                                                        foreach($leavetypes as $key => $val){
                                                            
                                                        }
                                                    ?>
                                                    @if(count($leavetypes) > 0 )
                                                        @foreach( $leavetypes as $key => $val)
                                                            <?php
                                                                $leave_count = 0;
                                                                $query_leave_credit = DB::table('leave_credits')
                                                                                        ->where('employeeID', $employee->employeeID)
                                                                                        ->where('leaveType', $val->leaveType)
                                                                                        ->first(); 

                                                                if ($query_leave_credit != '') {
                                                                    // if (date('Y', strtotime($query_leave_credit->created_at)) == date('Y')) {
                                                                    // }
                                                                    $leave_count += $query_leave_credit->leave_credit;
                                                                }

                                                                $leave_used = DB::table('leave_applications')
                                                                                ->where('employeeID', $employee->employeeID)
                                                                                ->where('leaveType', $val->leaveType)
                                                                                ->where('application_status', 'approved')
                                                                                ->sum('days');
                                                                $total_leave += $leave_count;
                                                            ?>
                                                            <li><strong>({{ $leave_used .'/'. $leave_count }})</strong> {{ ucfirst(  str_replace('leave', '', str_replace('_', ' ', $val->leaveType)) ) }}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>
                                                <ul style="list-style: none; padding:0">
                                                    @if(count($leavetypes) > 0 )
                                                        @foreach( $leavetypes as $key => $val)
                                                            <?php
                                                                $leave_count = 0;
                                                                $query_leave_credit = DB::table('leave_credits')
                                                                                        ->where('employeeID', $employee->employeeID)
                                                                                        ->where('leaveType', $val->leaveType)
                                                                                        ->first(); 

                                                                if ($query_leave_credit != '') {
                                                                    // if (date('Y', strtotime($query_leave_credit->created_at)) == date('Y')) {
                                                                    // }
                                                                    $leave_count += $query_leave_credit->leave_credit;
                                                                }

                                                                $leave_used = DB::table('leave_applications')
                                                                                ->where('employeeID', $employee->employeeID)
                                                                                ->where('leaveType', $val->leaveType)
                                                                                ->where('application_status', 'approved')
                                                                                ->sum('days');
                                                                $total_leave += $leave_count;
                                                            ?>
                                                            <li><strong>({{ $leave_count - $leave_used }})</strong> {{ ucfirst(  str_replace('leave', '', str_replace('_', ' ', $val->leaveType)) ) }}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>
                                                @if($employee->status=='active')
                                                    <span class="label label-sm label-success">{{ $employee->status }}</span>
                                                @else
                                                    <span class="label label-sm label-danger">{{ $employee->status }}</span>
                                                @endif
                                            </td>
                                            <td class="" style="50px;">
                                                <div class="btn-actions">
                                                    <a class="btn btn-1" href="{{route('admin.attendances.show',$employee->employeeID) }}"><i class="fa fa-eye fa-fw"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> {{-- end of .portlet-body --}}
                    </div> {{-- end of .portlet --}}
                </div> {{-- end of .col-md-12 --}}
            </div> {{-- end of .row --}}
        </div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}
     @include('admin.common.delete')
@stop


@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    {{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}
    {{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}
    {{ HTML::script("assets/admin/pages/scripts/components-pickers.js")}}

<!-- END PAGE LEVEL PLUGINS -->

	<script>
	jQuery(document).ready(function() {
        ComponentsPickers.init();
            // begin first table
            $('#sample_1').dataTable({
                 {{$datatabble_lang}}
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "columns": [{
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                },
                    {
                        "orderable": true
                    }, {
                        "orderable": true
                    }, {
                        "orderable": false
                    }],
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

	});
	</script>

@stop
	