<div class="portlet-body form">
    <div class="form-group">
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="fullName"><strong>Name</strong></label>
            </div>
            <div class="col-md-9">
                {{$overtime_application->firstName . ' ' . $overtime_application->lastName}}
            </div>
        </div> {{-- end of .row --}}
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="date"><strong>Date</strong></label>
            </div>
            <div class="col-md-9">
                @if(!isset($overtime_application->start_date))
                    {{ date('M d,Y h:i', strtotime($overtime_application->start_date)) }}
                @else
                    {{ date('M d,Y h:i A', strtotime($overtime_application->start_date)) }} to {{date('M d,Y h:i A',strtotime($overtime_application->end_date))}}
                @endif
            </div>
        </div> {{-- end of .row --}}
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="reason"><strong>Reason</strong></label>
            </div>
            <div class="col-md-9">
                {{$overtime_application->reason}}
            </div>
        </div> {{-- end of .row --}}
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="created_at"><strong>Applied on</strong></label>
            </div>
            <div class="col-md-9">
                 {{ date('d-M-Y', strtotime( $overtime_application->ota_created_at )) }}            
            </div>
        </div> {{-- end of .row --}}
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for=""><strong>Status</strong></label>
            </div>
            <div class="col-md-9">
                <?php $status = isset($overtime_application->application_status) ? $overtime_application->application_status : '' ?>
                <select name="application_status" id="select-status" onchange="getRemarks()">
                    <option value="pending">pending</option>
                    <option value="approved" @if ($status == 'approved') selected @endif)>approved</option>
                    <option value="rejected" @if ($status == 'rejected') selected @endif>rejected</option>
                </select>
            </div>
            <div id="remarks_wrapper">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-9">
                <label for=""><strong>Add Remarks</strong></label>
                <textarea style="width:100%" name="remarks" id='remarks' ></textarea>
                </div>
            </div>
        </div> {{-- end of .row --}}
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for=""> <strong> Rate per Hour</strong> </label>
            </div>
            <div class="col-md-9" id="rate_per_hour">
                0.00
            </div>
        </div> {{-- end of .row --}}
        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for=""> <strong> Overtime Pay </strong> <br> <strong id="rph_label"> (Hourly Rate x 125%) </strong> </label>
            </div>
            <div class="col-md-9" id="overtime_pay">
                0.00
            </div>
        </div> {{-- end of .row --}}

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for=""> <strong> Hour per Day </strong> </label>
            </div>
            <div class="col-md-9" id="hour_per_day">
                8.00
            </div>
        </div> {{-- end of .row --}}

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="daily_rate"> <strong> Daily Rate </strong> </label>
            </div>
            <div class="col-md-9">
                <input type="text" name="daily_rate" value="{{ $overtime_application->daily_rate }}" />
            </div>
        </div> {{-- end of .row --}}

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="total_overtime"> <strong> Total Overtime </strong> </label>
            </div>
            <div class="col-md-9" >
                <input type="text" name="total_overtime" value="{{ $overtime_application->total_overtime }}" />
            </div>
        </div> {{-- end of .row --}}

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="total_overtime_pay"> <strong> Total Overtime Pay </strong> </label>
            </div>
            <div class="col-md-9" >
                <?php $total_overtime = isset($overtime_application->total_overtime_pay) ? $overtime_application->total_overtime_pay : 0?>
                <span id="total_overtime_pay">{{ $total_overtime }}</span>
                <input type="hidden" name="total_overtime_pay" value="{{ $total_overtime }}" />
<!-- 
                @if ($overtime_application->total_overtime_pay != null || $overtime_application->total_overtime_pay != 0)
                    <span id="total_overtime_pay">{{ $overtime_application->total_overtime_pay }}</span>
                    <input type="hidden" name="total_overtime_pay" value="{{ $overtime_application->total_overtime_pay }}" />
                @else
                    <span id="total_overtime_pay">{{ $overtime_application->total_overtime_pay }}</span>
                    <input type="hidden" name="total_overtime_pay" value="" />
                @endif -->
            </div>
        </div> {{-- end of .row --}}

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                <label for="status">
                    <strong>Type</strong>
                </label>
            </div>
            <div class="col-md-9">
                <?php
                    $types = array('ordinary','restday','regular_holiday','regular_holiday_restday');
                    $overtime_type = $overtime_application->type != '' ? $overtime_application->type : 'ordinary';
                ?>
                @foreach($types as $key => $val)
                    <label>
                        <input type="radio" name="type" value="{{ $val }}" {{ $overtime_type == $val ? 'checked' : '' }}/> {{ ucfirst(str_replace('_', ' ', $val)) }}
                    </label>
                @endforeach
            </div>
        </div> {{-- end of .row --}}
        <br>

        <p>This Overtime will be paid on:</p>
        <div class="horizontal-header">
            <div class="input-section">
                <?php
                    $month_selection = array(
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December',
                    );
                    if ($overtime_application->month != '') {
                        $s_month = $overtime_application->month;
                    }
                    else{
                        $s_month = date('n', strtotime($overtime_application->start_date));
                    }
                ?>
                
                <select class="form-control  select2me" name="month" id="month">
                    @foreach($month_selection as $key => $val)
                        <option value="{{ $key }}" {{ $s_month == $key ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-section">
                <select class="form-control select2me" name="year" id="year">
                    <?php
                        $cur_year = date('Y');

                        if ($overtime_application->month != '') {
                            $s_year = $overtime_application->year;
                        }
                        else{
                            $s_year = date('Y', strtotime($overtime_application->start_date));
                        }
                    ?>
                    @for($i = $cur_year; $i <= ($cur_year + 1); $i++)
                        <option value="{{ $i }}" {{ $s_year == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <?php $date = date("d", strtotime($overtime_application->created_at)); ?>
            <?php $period = $overtime_application->period; ?>

            @if ($period != null)
                @if( $setting->enable_two_payroll_period == 1 )
                    <div class="input-section">
                        <select name="period" id="period" class="form-control select2me">
                            <option value="1" <?php if ($period == 1) { echo "selected"; } ?> >First Period</option>
                            <option value="2" <?php if ($period > 1) { echo "selected"; } ?> >Second Period</option>
                        </select>
                    </div>
                @else
                    <input name="period" type="hidden" value="0" id="period">
                @endif
            @else
                @if( $setting->enable_two_payroll_period == 1 )
                    <div class="input-section">
                        <select name="period" id="period" class="form-control select2me">
                            <option value="1" <?php if ($date <= 15) { echo "selected"; } ?> >First Period</option>
                            <option value="2" <?php if ($date > 15) { echo "selected"; } ?> >Second Period</option>
                        </select>
                    </div>
                @else
                    <input name="period" type="hidden" value="0" id="period">
                @endif
            @endif
        </div> {{-- end of .horizontal-header --}}
        
    </div> {{-- end of .form-group --}}
    
    <!-- PERCENTAGE TO BE MULTIPLIED TO RATE PER HOUR -->
    <input type="hidden" value="1.25" id="hour_rate_percentage" />
        <div class="modal-footer">
            <!-- <input type="submit" name="application_status" data-loading-text="Updating..." class="demo-loading-btn btn-blue" value="Approve" />
            <input type="submit" name="application_status" data-loading-text="Updating..." class="demo-loading-btn btn-yellow" value="Reject" /> -->
            <input type="submit" data-loading-text="Updating..." class="demo-loading-btn btn-blue" value="Update" id="update-overtime"/>
        </div>



</div>
{{ HTML::script("assets/global/plugins/jquery.min.js") }}
<script>
$('document').ready(function(){
    getRemarks();
})
    var remarks = $("#remarks_wrapper");  
       
    function getRemarks(){
        
        var selectStats = $('#select-status').val();
       
        if(selectStats == 'rejected'){
            remarks.show();
            if($('#remarks').val() == ""){
                $('#remarks').prop("required", true);
               return false;
              
            }
        }else if(selectStats == 'approved'){
            $('#remarks').prop("required", false);
            remarks.hide();
           
        }
    }
</script>


 {{-- end of .portlet-body --}}