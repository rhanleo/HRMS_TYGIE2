@extends('admin.adminlayouts.adminlayout')
@section('head')
  {{HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")}}
  {{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
<style>
label.error{
  color: #cb1717;
}
</style>
    <div class="content-section">
    	<div class="container-fluid">
            <div class="row">
                <div class="col-md-6 margin-bottom-10"></div>
                <div class="col-md-6 text-right email-notif margin-bottom-10">
                    <span id="load_notification"></span>
                     <input  type="checkbox"  onchange="ToggleEmailNotification('leave_notification');return false;" class="make-switch" name="leave_notification" @if($setting->leave_notification==1)checked  @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                    <strong>{{trans('core.emailNotification')}}</strong>
                </div>
            </div>
    		<div class="row">
    			<div class="col-md-12">
					<div id="load">@include('admin.common.error')</div>
					<div class="portlet box">
						<div class="portlet-title">
							<div class="title-left">
                                <span class="icon"><i class="fa fa-rocket fa-fw"></i></span>
                                <span>{{trans('core.leaveApplication')}}</span>
                            </div>
							<div class="btn-portlet-right">
                                <a class="btn green" data-toggle="modal" href="#static_apply">
                                    <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                    <span>Apply for a Leave</span>
                                </a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="applications">
								<thead>
                                    <tr>
                                        <th>{{trans('core.id')}}</th>
                                        <th>{{trans('core.name')}}</th>
                                        <th>{{trans('core.dates')}}</th>
                                        <th>{{trans('core.days')}}</th>
                                        <th>{{trans('core.leaveTypes')}}</th>
                                        <th>{{trans('core.reason')}}</th>
                                        <th>{{trans('core.appliedOn')}}</th>
                                        <th>{{trans('core.status')}}</th>
                                        <th>{{trans('core.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td> {{-- ID from Contoller ajaxload --}} </td>
										<td> {{-- Name from Contoller ajaxload --}} </td>
										<td> {{-- Date from Contoller ajaxload --}} </td>
										<td> {{-- Days from Contoller ajaxload --}} </td>
										<td> {{-- Leavetype from Contoller ajaxload--}} </td>
										<td> {{-- Reason from Contoller ajaxload --}} </td>
										<td> {{-- Applied on from Contoller ajaxload --}} </td>
										<td> {{-- Status from Contoller ajaxload --}} </td>
										<td> {{-- Action from Contoller ajaxload --}} </td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>
    			</div>
    		</div>
    	</div>
    </div>

    {{-- application modals --}}
    {{Form::open( [ 'url'=>'','id'=>'edit_form_application','method'=>'PATCH' ] ) }}
        <div id="static" class="modal fade view-modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{$pageTitle}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                    </div>
                    <div class="modal-body" id="modal-data-application">{{--Ajax data call for form--}}</div>
                </div> {{-- end of .modal-content --}}
            </div> {{-- end of .modal-dialog --}}
        </div> {{-- end of .view-modal --}}
    {{Form::close()}}

    {{Form::open(['url'=>'','id'=>'show_approve','method'=>'PATCH'])}}
        <div id="static_approve" class="modal fade approve-modal" tabindex="-1" data-backdrop="static_approve" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="confirm-message">Are you sure! you want to approve?</div>
                        <div class="note-gray">Note! The action is irreversible</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn-gray">Cancel</button>
                        <input type="submit" name="application_status" data-loading-text="Updating..." class="demo-loading-btn btn-blue" value="Approve">
                    </div>
                </div> {{-- end of .modal-content --}}
            </div> {{-- end of .modal-dialog --}}
        </div> {{-- end of .approve-modal --}}
    {{Form::close()}}

    {{Form::open(['url'=>'','id'=>'show_reject','method'=>'PATCH'])}}
        <div id="static_reject" class="modal fade reject-modal" tabindex="-1" data-backdrop="static_reject" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rejection</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                    </div> {{-- end of .modal-header --}}
                    <div class="modal-body">
                        <div class="confirm-message">Are you sure! you want to reject?</div>
                        <div class="note-gray">Note! The action is irreversible</div>
                    </div> {{-- end of .modal-body --}}
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn-gray">Cancel</button>
                        <input type="submit" name="application_status" data-loading-text="Updating..." class="demo-loading-btn btn-yellow" value="Reject">
                    </div> {{-- end of .modal-footer --}}
                </div> {{-- end of .modal-content --}}
            </div> {{-- end of .modal-dialog --}}
        </div> {{-- end of .reject-modal --}}
    {{Form::close()}}

			{{--DELETE MODAL CALLING--}}
                @include('admin.common.delete')
            {{--DELETE MODAL CALLING END--}}

    <div id="static_apply" class="modal fade addNew-modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                        <span>Apply For A Leave</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times fa-fw" aria-hidden="true"></i>
                    </button>
                </div> {{-- end of .modal-header --}}
                <div class="modal-body">
                <div class="portlet-body form">
                {{Form::open(['url'=>'admin/leave-applications/store/','id'=>'create_leave_application','method'=>'POST', 'class'=>'custom-form'])}}
                <div class="form-body">
                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">Employee Name:</label>
                <select class="form-control required" name="employee_id">
                <option selected="selected" value="">Select Employee</option>
                @foreach($employees as $employee)
                <option value="{{$employee->employeeID}}">{{$employee->fullName}} - ({{$employee->employeeID}})</option>
                @endforeach
                </select>
                </div>
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">Type of Leave:</label>
                <select class="form-control required" name="type_of_leave" id="type_of_leave">
                <option selected="selected" value="">Select Type Of Leave</option>
                @foreach($leavetypes as $leavetype)
                <option value="{{$leavetype->leaveType}}">{{$leavetype->leaveType}}</option>
                @endforeach
                </select>
                </div>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-12 half_day_container" style="display:none">
                <label class="text-success" id="halfDayLabel" style="margin-bottom:6px;">Half Day leave Type:</label>
                {{ Form::select('leaveTypeWithoutHalfDay', $leaveTypeWithoutHalfDay,'',['class' => 'form-control halfLeaveType'] ) }}
                </div>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">Start Date:</label>
                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="form-control required start_date_leave" name="start_date" placeholder="select date" readonly="" type="text">
                <span class="input-group-btn">
                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                </span>
                </div>
                <div class="start_date_error"></div>
                </div>
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">End Date:</label>
                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                <input class="form-control required end_date_leave" name="end_date" placeholder="select date" readonly="" type="text">
                <span class="input-group-btn">
                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                </span>

                </div>
                <div class="end_date_error"></div>
                </div>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-12">
                <label class="text-success" style="margin-bottom:6px;">Reason</label>
                <textarea class="form-control" name="reason" id="reason" rows="3" maxlength="500" style="width:100%"></textarea>
                </div>
                </div>
                </div>
                </div>

                <div class="btn-panel">
                    <button type="submit" data-loading-text="Submitting..." class="btn btn-1">
                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                        <span>Submit Leave Application</span>
                    </button>
                    <!-- <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn btn-1">{{trans('core.btnSubmit')}}</button> -->
                </div>
                </div>
                {{Form::close()}}
                </div>
                </div>
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div> {{-- end of .addNew-modal --}}
@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	  {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    {{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}
    {{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
    {{ HTML::script("assets/admin/pages/scripts/components-pickers.js")}}
    {{ HTML::script("assets/admin/pages/scripts/validate.js")}}
    {{ HTML::script("assets/admin/pages/scripts/moment.js")}}
<!-- END PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->


<script>
  jQuery(document).ready(function() {
    ComponentsPickers.init();

    $(document).on('change', '#type_of_leave', function(){
      selected = $(this).val();
      if(selected == 'half day'){
        $('.half_day_container').slideDown('fast');
      }
      else{
        $('.half_day_container').slideUp('fast');
      }
    });

    $('#create_leave_application').validate({
      errorPlacement: function (error, element) {
        if (element.attr( 'name' ) == 'start_date' ) {
          $( '.start_date_error' ).append( error );
        }
        else if (element.attr( 'name' ) == 'end_date' ) {
          $( '.end_date_error' ).append( error );
        }
        else {
          error.insertAfter(element);
        }
      }
    });

    start = $(document).find('.start_date_leave');
    end = $(document).find('.end_date_leave');
    the_end = end.datepicker({format: 'dd-mm-yyyy'});

    $(document).on('changeDate', start, function (selected) {
      var minDate = new Date(selected.date.valueOf());
        the_end.data('datepicker').setStartDate(minDate);
    });
  });
</script>

<script>
        $('#applications').dataTable( {
            "bProcessing": true,
            {{$datatabble_lang}}
            "bServerSide": true,
            "sAjaxSource": "{{ URL::route('admin.leave_applications') }}",
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass' : 'center',  "bSortable": true },
                { 'sClass': 'center', "bSortable": true },
                { 'sClass': 'center', "bSortable": true },
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


        function del(id)
		{

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

       function show_application(id)
       {
        	$("#modal-data-application").html('<div class="text-center">{{HTML::image('assets/admin/layout/img/loading-spinner-blue.gif')}}</div>');
            $('#edit_form_application').attr('action',"{{ URL::to('admin/leave_applications/"+id+"') }}" );
			var url = "{{ route('admin.leave_applications.show',':id') }}";
			url = url.replace(':id',id);
            $.ajax({
                    type: "GET",
                    url : url

                    }).done(function(response)
                    {
                                $('#modal-data-application').html(response);

                     });
       }
       function show_approve(id)
       {
       	 $('#show_approve').attr('action',"{{ URL::to('admin/leave_applications/"+id+"') }}" );
       }

       function show_reject(id)
	  {
		 $('#show_reject').attr('action',"{{ URL::to('admin/leave_applications/"+id+"') }}" );
	  }
</script>
@stop
