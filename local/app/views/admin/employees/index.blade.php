@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <div class="icon"><i class="fa fa-users fa-fw"></i></div>
                                <span>{{Lang::get('menu.employees')}}</span>
                            </div>
                            <div class="btn-portlet-right">
                            <a href="{{route('admin.employees.excelview')}}">
                                    <span class="icon"><i class="fa fa-file-excel-o fa-fw"></i></span>
                                    <span>{{'Import'}}</span>
                                </a>
                                <a href="{{route('admin.employees.create')}}">
                                    <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                    <span>{{Lang::get('core.btnAddEmployee')}}</span>
                                </a>
                                <a  href="{{route('admin.employees.export') }}">
                                    <span class="icon"><i class="fa fa-file-excel-o fa-fw"></i></span>
                                    <span>{{trans('core.export')}}</span>
                                </a>
                            </div> {{-- end of .btn-portlet-right --}}
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                             <table class="table table-striped table-bordered table-hover" id="sample_employees">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{trans('core.eID')}}</th>
                                        <th class="text-center">{{trans('core.image')}}</th>
                                            <th style="text-align: center">{{trans('core.name')}}</th>
                                        <th class="text-center">{{trans('core.desigDept')}}</th>
                                        <th class="text-center">{{'Position'}}</th>
                                        <th class="text-center">{{trans('core.atWork')}}</th>
                                        <th class="text-center">Leave Credits</th>
                                        <th class="text-center">{{trans('core.status')}}</th>
                                        <th class="text-center">{{trans('core.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($employees as $employee)
                                    <tr id="row{{ $employee->employeeID }}">
                                        <td>{{ $employee->employeeID }}</td>
                                        <td class="text-center">
                                            {{HTML::image("/profileImages/{$employee->profileImage}",'ProfileImage',['height'=>'80px'])}}
                                        </td>
                                        <td>
                                        {{ $employee->firstName }}
                                        {{ $employee->lastName }}
                                        {{ $employee->middleName }}
                                        {{ $employee->suffix }}
                                        </td>
                                        
                                        <td>
                                            
                                            <p>Department: <strong>{{ $employee->getDesignation->department->deptName or ''}}</strong></p>
                                            <p>Designation: <strong>{{ $employee->getDesignation->designation or ''}}</strong></p>
                                            <p>Work Pass Type: <strong>{{ $employee->workpass_type }}</strong></p>
                                        </td>
                                        <td>{{ $employee->jobTitle }}</td>
                                        <td class="text-center">{{ $employee->workDuration($employee->employeeID) }}</td>
                                        <td class="text-center">
                                            <?php $leavetypes = DB::table('leavetypes')->get(); ?>
                                            @if( count($leavetypes) > 0)
                                                @foreach($leavetypes as $key => $val)
                                                    <?php
                                                        $leave_count = DB::table('leave_credits')
                                                                        ->where('employeeID', $employee->employeeID)
                                                                        ->where('leaveType', $val->leaveType)
                                                                        ->pluck('leave_credit'); 
                                                                    
                                                    ?>
                                                    <ul class="text-left" style="padding: 0;list-style:none;">
                                                        <li style="font-size: 13px;">({{ ( $leave_count != '' ? $leave_count : 0) }}) {{ ucfirst( str_replace('_', ' ', $val->leaveType)) }}</li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($employee->status=='active')
                                                <span class="label label-sm label-success"> {{ $employee->status }} </span>
                                            @else
                                                <span class="label label-sm label-danger"> {{ $employee->status }} </span>
                                            @endif
                                        </td>
                                        <td class="" style="width: 112px;">                                            
                                            <div class="btn-actions">
                                                <a class="btn btn-1" href="{{ route('admin.employees.edit',$employee->employeeID)  }}"><i class="fa fa-edit fa-fw"></i></a>
                                                <a class="btn btn-1" href="javascript:;" onclick="del('{{$employee->id}}','{{ addslashes($employee->fullName) }}')"><i class="fa fa-trash fa-fw"></i></a>
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
<!-- END PAGE LEVEL PLUGINS -->

	<script>
	jQuery(document).ready(function( $ ) {




            // begin first table
        $('#sample_employees').dataTable({

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



	});
	</script>
	<script>

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
	
