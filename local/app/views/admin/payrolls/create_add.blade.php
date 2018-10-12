<?php
// Get Settings
$settings = DB::table('settings')->first();
$ot_period = isset($ot_application['period']) ? $ot_application['period'] : 0;
$ot_year = isset($ot_application['year']) ? $ot_application['year'] : '-1';
$ot_month = isset($ot_application['month']) ? $ot_application['month'] : '-1';

$overtime_applications = DB::table('overtime_applications')
                            ->where('employeeID', $employeeID)
                            ->where('application_status', 'approved')
                            ->where('period', $ot_period)
                            ->where('year', $ot_year)
                            ->where('month', $ot_month)
                            ->get();

$overtime_details = '';
$overtime_hours = $overtime_pay = 0;
if (count($overtime_applications) > 0) {
  $overtime_details = implode('/', ['admin', 'overtime_applications', 'filter', $ot_year, $ot_month, $ot_period, $employeeID]);
  foreach ($overtime_applications as $key => $val) {
    $overtime_hours += $val->total_overtime;
    $overtime_pay += $val->total_overtime_pay;
  }
}

?>


<div class="row">
  <div class="col-md-12">
    <div class="portlet box">
      <div class="portlet-title has-pad">
        <div class="title-left">
          <span>Salary info</span>
        </div>
      </div> {{-- end of .portlet-title --}}

      <div class="portlet-body">

        <div class="form-group" id="daily_salary">
          <label class="control-label col-md-2">Daily Salary</label>
          <div class="col-md-4 margin-bottom-10">
            <input type="text" class="form-control" onkeyup="myDaily()" id="daily" name="daily" placeholder="daily rate" value="" >
          </div>
          <div class="col-md-4 margin-bottom-10">
            <input type="text" class="form-control" onkeyup="myDaily()" id="number_day" name="number_day" placeholder="number of days" value="" >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Basic Salary ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="basic" name="basic" placeholder="Basic" value="{{ $settings->enable_two_payroll_period == 0 ? $basicSalary : $basicSalary / 2 }}" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Expense Claim ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="expense_claim" name="expense" placeholder="Basic" value="{{$expense}}">
          </div>
        </div>
      </div> {{-- end of .portlet-body --}}
    </div>
  </div>
</div>


<div class="row">
  
  {{-- Overtime --}}
    <div class="col-md-4 col-xs-12">
      <div class="portlet box">
        <div class="portlet-title has-pad">
          <div class="title-left">
            <span>Overtime</span>
          </div>
        </div> {{-- end of .portlet-title --}}

        <div class="portlet-body">
          <div class="form-group">
            <div class="col-md-4 margin-bottom-10">
              Total Hrs
            </div>
            <div class="col-md-6  margin-bottom-10">
              <input type="text" class="form-control" id="overtime_hours" name="overtime_hours" placeholder="OverTime" value="{{ $overtime_hours }}">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-4 margin-bottom-10">
              Total Payment
            </div>
            <div class="col-md-6  margin-bottom-10">
              <input type="text" class="form-control" id="overtime_pay" name="overtime_pay" placeholder="overtime_pay" value="{{ $overtime_pay }}">
            </div>
            <label class="control-label col-md-1">{{$setting->currency_symbol}}</label>
          </div>
          <?php $overtime_details = ''; ?>
          @if($overtime_details != '')
            <div class="form-group">
              <div class="col-md-12  margin-bottom-10 text-center">
                <a class="btn btn-sm green form-control-inline" href="{{ url($overtime_details) }}" target="_blank">View Details</a>
              </div>
            </div>
          @endif

        </div> {{-- end of .portlet-body --}}
      </div>
    </div>
  {{-- Overtime --}}
  
  {{--Allowances--}}
  <div class="col-md-4 col-xs-12">
    <div class="portlet box">
      <div class="portlet-title has-pad">
        <div class="title-left">
          <span>Allowances</span>
        </div>
      </div> {{-- end of .portlet-title --}}
      <div class="portlet-body">
        <div class="form-group">
          <div class="col-md-6 margin-bottom-10">
            <input type="text" class="form-control" name="allowanceTitle[]" placeholder="allowance 1" value="Bonus">
          </div>
          <div class="col-md-3  margin-bottom-10">
            <input type="text" class="allowance form-control" placeholder="value" name="allowance[]" value="{{$awardBonus}}">
          </div>
          <label class="control-label col-md-1">{{$setting->currency_symbol}}</label>
        </div>

        <div id="insertBeforeA"></div>
          
        <div class="form-group">
          <div class="col-md-12  margin-bottom-10 text-center">
            <button type="button" id="plusButtonA" class="btn btn-sm green form-control-inline"><i class="fa fa-plus"></i></button>
          </div>
        </div>
      </div> {{-- end of .portlet-body --}}
    </div>
  </div>
  {{--Allowances End--}}

  {{-- DEDUCTIONS --}}
  <div class="col-md-4 col-xs-12">
    <div class="portlet box">
      <div class="portlet-title has-pad">
        <div class="title-left">
          <span>Deductions</span>
        </div>
      </div> {{-- end of .portlet-title --}}

      <div class="portlet-body">
        <div class="form-group">
          <div class="col-md-6 margin-bottom-10">
            <input type="text" class="form-control" name="deductionTitle[]" placeholder="Deduction 1" value="">
          </div>
          <div class="col-md-3  margin-bottom-10">
            <input type="text" class="deduction form-control" placeholder="value" name="deduction[]" value="">
          </div>
          <label class="control-label col-md-1">{{$setting->currency_symbol}}</label>
        </div>

        <div id="insertBeforeD"></div>
        <div class="form-group">
          <div class="col-md-12  margin-bottom-10 text-center">
            <button type="button" id="plusButtonD" class="btn btn-sm green form-control-inline"> <i class="fa fa-plus"></i> </button>
          </div>
        </div>
      </div> {{-- end of .portlet-body --}}

    </div>
  </div>
  {{-- DEDUCTIONS END --}}
</div>

{{-- GROSS --}}
<div class="row">
  {{--Allowances--}}
  <div class="col-md-12">
    <div class="portlet box">
      <div class="portlet-title has-pad">
        <div class="title-left">
          <span>Gross</span>
        </div>
      </div> {{-- end of .portlet-title --}}

      <div class="portlet-body">       


        {{-- SSS --}}
        <div class="form-group">
          <label class="control-label col-md-2">SSS ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="sss_deduction" name="sss_deduction" placeholder="SSS Deduction" value="{{ round($sss_deduction, 2) }}">
          </div>
        </div>

        {{-- Philhealth --}}
        <div class="form-group">
          <label class="control-label col-md-2">Philhealth ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="philhealth_deduction" name="philhealth_deduction" placeholder="Philhealth Deduction" value="{{ round($philhealth_deduction, 2) }}">
          </div>
        </div>

        {{-- Pag-IBIG --}}
        <div class="form-group">
          <label class="control-label col-md-2">Pag-IBIG ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="pagibig_deduction" name="pagibig_deduction" placeholder="Pag-IBIG Deduction" value="{{ round($pagibig_deduction, 2) }}">
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-2">Total Allowances ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="total_allowance" name="total_allowance" placeholder="total" value="0" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Total Deductions ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="total_deduction" name="total_deduction" placeholder="total" value="0" readonly>
          </div>
        </div>

        {{-- With Holding Tax --}}
        <div class="form-group">
          <label class="control-label col-md-2">Withholding Tax: ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="withholding_tax" name="withholding_tax" placeholder="Withholding Tax" value="0">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Net Salary ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="net_salary"  name="net_salary" placeholder="total" value="0" readonly>
          </div>
        </div>
      </div> {{-- end of .portlet-body --}}

    </div>
  </div>

 {{--Gross End--}}

  <div class="col-md-12 text-center margin-bottom-30">
    <button type="button" class="btn green" onclick="submitData();return false;" style="width: 150px;">Submit</button><hr>
  </div>

  <script type="text/javascript">
  
 
  function myDaily(){
    var basic, result, daily, number_day;
        number_day = document.getElementById('number_day');
        daily = document.getElementById('daily');
        basic = document.getElementById('basic');
        result = daily.value * number_day.value;
        basic.value= result;
    }
  
 
  </script>