
<div class="portlet-body form">

    <div class="row">
        <label class="control-label col-md-3"><strong>Leave Type</strong></label>
        <div class="col-md-9">

            @if($leave_application->leaveType == 'half day')
                {{ucfirst($leave_application->leaveType)}} - {{$leave_application->halfDayType}}
            @else
                {{ucfirst($leave_application->leaveType)}}
            @endif
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Date</strong></label>
        <div class="col-md-9">
          	@if(!isset($leave_application->start_date))
				 {{date('d-M-Y',strtotime($leave_application->start_date))}}
			   @else
				 {{date('d-M-Y',strtotime($leave_application->start_date))}} to  {{date('d-M-Y',strtotime($leave_application->end_date))}}
			   @endif
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Reason</strong></label>
        <div class="col-md-9">
            {{$leave_application->reason}}
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Applied on</strong></label>
        <div class="col-md-9">
            {{date('d-M-Y',strtotime($leave_application->applied_on))}}
        </div>
    </div>
    <br>



</div>