<div class="portlet-body form">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="fullName"><strong>Name</strong></label>
            </div>
            <div class="col-md-8">
                {{$leave_application->employeeDetails->fullName}}
            </div>
        </div> {{-- end of .row --}}
        <div class="row">
            <div class="col-md-4">
                <label for="leave_type"><strong>Leave Type</strong></label>
            </div>
            <div class="col-md-8">
                @if($leave_application->leaveType == 'half day')
                    {{ucfirst($leave_application->leaveType)}} - {{$leave_application->halfDayType}}
                @else
                    {{ucfirst($leave_application->leaveType)}}
                @endif
            </div>
        </div> {{-- end of .row --}}
        <div class="row">
            <div class="col-md-4">
                <label for="date"><strong>Date</strong></label>
            </div>
            <div class="col-md-8">
                @if(!isset($leave_application->end_date))
                    {{date('d-M-Y',strtotime($leave_application->start_date))}}
                @else
                    {{date('d-M-Y',strtotime($leave_application->start_date))}} to  {{date('d-M-Y',strtotime($leave_application->end_date))}}
                @endif
            </div>
        </div> {{-- end of .row --}}
        <div class="row">
            <div class="col-md-4">
                <label for="leave_days"><strong>Leave Days</strong></label>
            </div>
            <div class="col-md-8">
                {{$leave_application->days}}
            </div>
        </div> {{-- end of .row --}}
        <div class="row">
            <div class="col-md-4">
                <label for="reason"><strong>Reason</strong></label>
            </div>
            <div class="col-md-8">
                {{$leave_application->reason}}
            </div>
        </div> {{-- end of .row --}}
        <div class="row">
            <div class="col-md-4">
                <label for="applied_on"><strong>Applied on</strong></label>
            </div>
            <div class="col-md-8">
                {{date('d-M-Y',strtotime($leave_application->applied_on))}}
            </div>
        </div> {{-- end of .row --}}
        <div class="row">
            <div class="col-md-4">
                <label for="status"><strong>Status</strong></label>
            </div>
            <div class="col-md-8">
                {{$leave_application->application_status }}
            </div>
        </div> {{-- end of .row --}}
    </div> {{-- end of .form-group --}}
    @if( $leave_application->application_status == 'pending')
        <div class="modal-footer">
            <input type="submit" name="application_status" data-loading-text="Updating..." class="demo-loading-btn btn-blue" value="Approve" />
            <input type="submit" name="application_status" data-loading-text="Updating..." class="demo-loading-btn btn-yellow" value="Reject" />
        </div>
    @endif
</div> {{-- end of .portlet-body --}}