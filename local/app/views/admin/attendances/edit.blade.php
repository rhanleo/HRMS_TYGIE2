@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
    {{HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.common.error')
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="portlet box">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <span>Select Date</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            {{Form::open(['route'=>["admin.attendances.create"],'method'=>'GET'])}}
                                <div id="mark-attendance"></div>
                                <div class="btn-panel">
                                    <button type='submit' class="btn btn-1">{{trans('core.btnSubmit')}}</button>
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>
                    {{Form::open(['route'=>["admin.attendances.create"],'method'=>'GET'])}}
                        <div class="col-md-3 form-group">
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input type="text" class="form-control" name="date" placeholder="select date" readonly >
                                <span class="input-group-btn">
                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 form-group"> <button  class=" btn blue" type="submit"> </button></div>
                    {{Form::close()}}
                </div>
                <div class="col-md-9">
                    <div class="portlet box">
                        <div class="portlet-title has-pad">
                        
                            <div class="title-left">
                            
                                @if(isset($todays_holidays->date))
                                    {{trans('core.holiday')}} , {{date('d M Y',strtotime($todays_holidays->date))}}
                                 @else
                                    {{trans('core.markAttendance')}}
                                @endif
                            </div>
                        </div>
                        <div class="portlet-body form">                            
                            @if( isset($todays_holidays->date) )
                                <div class="note note-info">
                                    <h4 class="block">{{date('D', strtotime($todays_holidays->date))}}</h4>
                                    <p>Holiday on the occassion of {{ $todays_holidays->occassion }}</p>
                                </div>
                            @elseif(count($employees)==0)
                                <hr>
                                <div class="note note-warning">
                                    <h4 class="block">Employees Missing</h4>
                                    <p>Please add some employees to the database</p>
                                </div>
                                <hr>
                            @else
                            <!-- BEGIN FORM-->
                                {{Form::open(['route'=>["admin.attendances.update",$date],'class'=>'form-horizontal','method'=>'PATCH'])}}
                                    <div class="form-body">
                                        <div class="attendance-title">
                                            <h3 class="attendance-title">{{ date( 'l, d M Y',strtotime( $date ) ) }}</h3>
                                            <div class="notif-bar email-notif">
                                                <span id="load_notification"></span>
                                                 <input  type="checkbox"   onchange="ToggleEmailNotification('attendance_notification');return false;" class="make-switch" name="attendance_notification" @if($setting->attendance_notification==1)checked  @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                                                <strong>{{trans('core.emailNotification')}}</strong>
                                            </div>
                                        </div>
                                        <div class="custom-table">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting">Emp ID #</th>
                                                        <th class="sorting">Name</th>
                                                        <th class="sorting">Status</th>
                                                        <th class="sorting">Type of leave</th>
                                                        <th class="sorting">Reason</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach( $employees as $employee )
                                                        <tr>
                                                            <td>{{$employee->employeeID}}</td>
                                                            <td>{{$employee->firstName . ' ' . $employee->lastName}}</td>
                                                            <td>
                                                                <input type="checkbox"  id="checkbox{{$employee->employeeID}}" onchange="showHide('{{$employee->employeeID}}');return false;" class="make-switch" name="checkbox[{{$employee->employeeID}}]" checked data-on-color="success" data-on-text="P" data-off-text="A" data-off-color="danger">
                                                                <input type="hidden"  name="employees[]" value="{{$employee->employeeID}}">
                                                            </td>
                                                            <td>
                                                                @if( isset($attendanceArray[ $employee->employeeID ][ 'leaveType' ] ) )
                                                                {{ Form::select('leaveType['.$employee->employeeID.']', $leaveTypes,$attendanceArray[$employee->employeeID]['leaveType'],['class' => 'form-control leaveType','onchange'=>'halfDayToggle('.$employee->employeeID.',this.value)','id'=>'leaveType'.$employee->employeeID.''] ) }}
                                                                @else
                                                                {{ Form::select('leaveType['.$employee->employeeID.']', $leaveTypes,null,['class' => 'form-control leaveType','onchange'=>'halfDayToggle('.$employee->employeeID.',this.value)','id'=>'leaveType'.$employee->employeeID.''] ) }}
                                                                @endif
                                                                @if(isset($attendanceArray[$employee->employeeID]['leaveType']))
                                                                {{ Form::select('leaveTypeWithoutHalfDay['.$employee->employeeID.']', $leaveTypeWithoutHalfDay,$attendanceArray[$employee->employeeID]['halfDayType'],['class' => 'form-control halfLeaveType','id'=>'halfLeaveType'.$employee->employeeID.''] ) }}
                                                                @else
                                                                {{ Form::select('leaveTypeWithoutHalfDay['.$employee->employeeID.']', $leaveTypeWithoutHalfDay,null,['class' => 'form-control halfLeaveType','id'=>'halfLeaveType'.$employee->employeeID.''] ) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                 <input type="text" class="form-control reason" id="reason{{$employee->employeeID}}" name="reason[{{$employee->employeeID}}]" placeholder="Absent Reason" value="{{ $attendanceArray[$employee->employeeID]['reason'] or ''}}" />
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="btn-attendance btn-panel">
                                            <button type="submit" data-loading-text="{{trans('core.btnSubmitting')}}" class="demo-loading-btn btn btn-1">{{trans('core.btnSubmit')}}</button>
                                        </div>
                                    </div> {{-- end of .form-body --}}
                                {{ Form::close() }}
                            @endif
                        </div> {{-- end of .portlet-body --}}
                    </div>
                </div>
            </div>
        </div>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                {{--INLCUDE ERROR MESSAGE BOX--}}
                
                {{--END ERROR MESSAGE BOX--}}

                   <div class="row">
                            
                               <div class="col-md-3 form-group">

                                 @if($date!=date('Y-m-d'))
                                     <a href="{{route('admin.attendances.create')}}" data-loading-text="Redirecting..." class="demo-loading-btn btn green">
                                       {{trans('core.markToday')}} <i class="fa fa-plus"></i>
                                     </a>
                                @endif


                                </div>
                                 <div class="col-md-4 form-group text-right">

								


								</div>



                   </div>

                <hr>
					
					<!-- END EXAMPLE TABLE PORTLET-->
					
			</div>
	</div>
			<!-- END PAGE CONTENT-->



@stop

@section('footerjs')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
        {{HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}
        {{HTML::script("assets/admin/pages/scripts/components-pickers.js")}}

        <!-- END PAGE LEVEL PLUGINS -->

<script>
	jQuery(document).ready(function() {
        ComponentsPickers.init();
        
        //inline calendar
        $( function() {
            $( '#mark-attendance' ).datepicker();
        });
	});
	</script>
 <script>

        $('.leaveType').hide();
        $('.reason').hide();
        $('.halfLeaveType').hide();



       @foreach($attendanceArray as $attend)
       {
        @if($attend['status']=='absent')
            $('#leaveTypeLabel').show(100);
            $('#reasonLabel').show(100);

            @if($attend['leaveType']=='half day')
             	$("#halfLeaveType{{$attend['employeeID']}}").show();
			@endif
				@if($attend['halfDayType']	!=null)
					$('#halfDayLabel').show(100);
				@endif

            $("#checkbox{{$attend['employeeID']}}").bootstrapSwitch('state',false);

        @else
             $("#reason{{$attend['employeeID']}}").hide();
             $("#leaveType{{$attend['employeeID']}}").hide();
             $("#halfLeaveType{{$attend['employeeID']}}").hide();
        @endif

       }
       @endforeach
     function showHide(id){
                $('#leaveTypeLabel').show(100);
                $('#reasonLabel').show(100);


            if($('#checkbox'+id+':checked').val() == 'on') {
                    $('#leaveType'+id).hide(1000);
                    $('#reason'+id).hide(1000);
                    $('#halfLeaveType'+id).hide(100);

                 } else {
                     $('#leaveType'+id).show(100);


					var leaveType = $('#leaveType'+id).val();
					if(leaveType == 'half day'){
                    	 $('#halfLeaveType'+id).show(100);
                    }

                     $('#reason'+id).show(500);
                 }
     }

     function halfDayToggle(id,value){

		if(value	==	'half day')
		{
			$('#halfDayLabel').show(100);
			$('#halfLeaveType'+id).show(100);
		}else{
			$('#halfLeaveType'+id).hide(100);
		}


     }





 </script>
@stop