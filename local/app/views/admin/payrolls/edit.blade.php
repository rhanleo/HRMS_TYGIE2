<?php
$ot_period = $payroll->period;
$ot_year = $payroll->year;
$ot_month = $payroll->month;
$employeeID = $payroll->employeeDetails->employeeID;
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
  foreach ($overtime_applications as $key => $val) {
  $overtime_details = implode('/', ['admin', 'overtime_applications', 'filter', $ot_year, $ot_month, $ot_period, $employeeID]);
    $overtime_hours += $val->total_overtime;
    $overtime_pay += $val->total_overtime_pay;
  }
}

?>
@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
@stop
@section('mainarea')
  <div class="content-section">
    @include('admin.common.error')
    {{ Form::open( ['route'=>["admin.payrolls.update",$payroll->id],'class'=>'form-horizontal form-bordered','method'=>'PUT', 'id' => 'payroll-form']) }}
      <div id="error"></div>    
      <div class="row">
        <div class="col-md-12">
          <div class="portlet box">
            <div class="portlet-title">
              <div class="caption">Employee info</div>
            </div>
            <div class="portlet-body">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <div class="col-md-9">
                     {{HTML::image("/profileImages/{$payroll->employeeDetails->profileImage}",'ProfileImage',['height'=>'100px'])}}

                      {{--Hidden Values--}}
                      <input type="hidden" value="{{$payroll->employeeDetails->employeeID}}" name="employeeID">
                      <input type="hidden" value="{{$payroll->month}}" name="month">
                      <input type="hidden" value="{{$payroll->year}}" name="year">
                      <input type="hidden" value="{{$payroll->period}}" name="period">
                      {{--Hidden values--}}

                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="col-md-9">
                  <div class="form-group">
                    <ul>
                      <li><p><strong>EmployeeID:</strong> {{$payroll->employeeDetails->employeeID}}</p></li>
                      <li><p><strong>Name:</strong>  {{$payroll->employeeDetails->fullName}}</p></li>
                      <li><p><strong>Payroll for period:</strong> 
                        <?php
                          if ($payroll->period != 0) {
                            if ($payroll->period == 2) {
                              $cutoff_date = '16-'. date('t', mktime(0, 0, 0, $payroll->month, 1, $payroll->year));
                            }
                            else{
                              $cutoff_date = '1-15';
                            }
                          }
                          
                          echo date('F '. $cutoff_date .' Y', mktime(0, 0, 0, $payroll->month, 1, $payroll->year));
                        ?>
                      </p></li>
                    </ul>
                  </div>
                </div>
                <!--/span-->
              </div>
            </div>
          </div>
          
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="portlet box">
            <div class="portlet-title has-pad">
              <div class="title-left">
                <span>Edit Salary info</span>
              </div>
            </div> {{-- end of .portlet-title --}}

            <div class="portlet-body">
              <div class="form-group">
                <label class="control-label col-md-2">Basic Salary ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="basic" name="basic" placeholder="Basic" value="{{ $payroll->basic }}" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2">Expense Claim ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="expense_claim" name="expense" placeholder="Basic" value="{{$payroll->expense}}">
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
                  <input type="text" class="form-control" id="overtime_hours" name="overtime_hours" placeholder="OverTime" value="{{ $payroll->overtime_hours }}">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-4 margin-bottom-10">
                  Total Payment
                </div>
                <div class="col-md-6  margin-bottom-10">
                  <input type="text" class="form-control" id="overtime_pay" name="overtime_pay" placeholder="overtime_pay" value="{{ $payroll->overtime_pay }}">
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
        <div class="col-md-4">
          <div class="portlet box">
            <div class="portlet-title has-pad">
              <div class="title-left">
                <span>Edit Allowances</span>
              </div>
            </div> {{-- end of .portlet-title --}}
            <div class="portlet-body">
              <?php $i=0; ?>
              @foreach(json_decode($payroll->allowances) as $key => $val)
                <div class="form-group" id="allowance{{$i}}">
                  <div class="col-md-6 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" value="{{ $key }}">
                  </div>
                  <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="value" name="allowance[]" value="{{ $val }}">
                  </div>
                  <label class="control-label col-md-1">{{$setting->currency_symbol}}</label>
                  @if($i>0)
                    <div class="col-md-2">
                      <button type="button"  onclick="$('#allowance{{$i}}').remove();" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                      </button>
                    </div>
                  @endif
                  
                </div>
              @endforeach

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
        <div class="col-md-4">
          <div class="portlet box">
            <div class="portlet-title has-pad">
              <div class="title-left">
                <span>Edit Deductions</span>
              </div>
            </div> {{-- end of .portlet-title --}}

            <div class="portlet-body">
              <?php $i=0 ?>

              @foreach(json_decode($payroll->deductions) as $key => $val)
                <div class="form-group">
                  <div class="col-md-6 margin-bottom-10">
                    <input type="text" class="form-control" name="deductionTitle[]" value="{{ $key }}">
                  </div>
                  <div class="col-md-3 margin-bottom-10">
                    <input type="text" class="deduction form-control" name="deduction[]" value="{{ $val }}">
                  </div>            
                  <label class="control-label col-md-1">{{$setting->currency_symbol}}</label>
                  @if( $i > 0 )
                    <div class="col-md-2">
                      <button type="button" onclick="$('#deduction{{$i}}').remove();" class="btn red btn-sm delete">
                           <i class="fa fa-close"></i>
                      </button>
                    </div>
                  @endif
                  <?php $i++; ?>
                </div>
              @endforeach

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
                  <input type="text" class="form-control" id="sss_deduction" name="sss_deduction" placeholder="SSS Deduction" value="{{ round($payroll->sss_deduction, 2) }}">
                </div>
              </div>

              {{-- Philhealth --}}
              <div class="form-group">
                <label class="control-label col-md-2">Philhealth ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="philhealth_deduction" name="philhealth_deduction" placeholder="Philhealth Deduction" value="{{ round($payroll->philhealth_deduction, 2) }}">
                </div>
              </div>

              {{-- Pag-IBIG --}}
              <div class="form-group">
                <label class="control-label col-md-2">Pag-IBIG ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="pagibig_deduction" name="pagibig_deduction" placeholder="Pag-IBIG Deduction" value="{{ round($payroll->pagibig_deduction, 2) }}">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2">Total Allowances ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="total_allowance" name="total_allowance" placeholder="total" value="{{ round($payroll->total_allowance, 2) }}" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2">Total Deductions ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="total_deduction" name="total_deduction" placeholder="total" value="{{ round($payroll->total_deduction, 2) }}" readonly>
                </div>
              </div>

              {{-- With Holding Tax --}}
              <div class="form-group">
                <label class="control-label col-md-2">Withholding Tax: ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="withholding_tax" name="withholding_tax" placeholder="Withholding Tax" value="{{ round($payroll->withholding_tax, 2) }}">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2">Net Salary ( {{$setting->currency_symbol}} )</label>
                <div class="col-md-8 margin-bottom-10">
                  <input type="text" class="form-control" id="net_salary"  name="net_salary" placeholder="total" value="{{ round($payroll->net_salary, 2) }}" readonly>
                </div>
              </div>
            </div> {{-- end of .portlet-body --}}

          </div>
        </div>

       {{--Gross End--}}

        <div class="col-md-12 text-center margin-bottom-30">
          <button type="button" class="btn green" onclick="submitData();return false;" style="width: 150px;">Submit</button><hr>
        </div>
      </div>

    {{ Form::close() }}
  </div> {{-- end of .content-section --}}

  @include('admin.common.payroll-confirm-edit')
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
{{HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
<!-- END PAGE LEVEL PLUGINS -->

<script>
jQuery(document).ready(function($) {
 InitializeAdd();
});

function check() {
  $('#load').html();

  var employeeID = $('#employeeID').val(),
      month = $('#month').val(),
      year = $('#year').val(),
      period = $('#period').val();

  $.ajax({
    type: 'POST',
    url: "{{route('admin.payrolls.check')}}?debug",
    dataType: "JSON",
    data: {
      'employeeID':employeeID,
      'month':month,
      'year':year,
      'period':period
    },
    success: function(response) {
      if(response.success=='fail'){
        $('#load').html(response.content);
        $("#net_salary").val($("#expense_claim").val());
      }
      else{
        $('#confirmBox').appendTo("body").modal('show');
        $('#info').html('Salary Slip for the selected employee month and year already created.Do you want modify it?' );
        $("#show").click(function(){
          $('#load').html(response.content);
          $('#load').append('<input type="hidden" name="type" value="edit">');
          InitializeAdd();
          $("#basic").trigger("change");
        })
      }

      InitializeAdd();
      $("#basic").trigger("change");
    },
    error: function(xhr, textStatus, thrownError) {
    }
  });
}

function submitData(){
  $('#error').html('<div class="alert alert-info"><span class="fa fa-info"></span> Submitting..</div>');
  $('#payroll-form').submit();
}

$(document).on("change", function() {
  var allowance = 0,
      deduc = 0,
      basic = 0,
      expense_claim= 0,
      overtime = 0,
      withholding_tax = parseFloat($("#withholding_tax").val()) || 0,
      sss_deduction = parseFloat($("#sss_deduction").val()) || 0,
      philhealth_deduction = parseFloat($("#philhealth_deduction").val()) || 0,
      pagibig_deduction = parseFloat($("#pagibig_deduction").val()) || 0;

  basic = $("#basic").val();
  expense_claim = $("#expense_claim").val();
  overtime = $("#overtime_pay").val();

  deduc += sss_deduction;
  deduc += philhealth_deduction;
  deduc += pagibig_deduction;

  $(".allowance").each(function() {
    allowance += +$(this).val();
  }); 

  $(".deduction").each(function() {
    deduc += +$(this).val();
  });

  $("#total_allowance").val(allowance.toFixed(2));
  $("#total_deduction").val(deduc.toFixed(2));

  net_salary = (allowance - deduc) + parseFloat(basic) + parseFloat(overtime) +parseFloat(expense_claim) - withholding_tax;
  $("#net_salary").val(net_salary.toFixed(2));
});

function InitializeAdd(){
  var $insertBeforeA = $('#insertBeforeA'),
      i = 2;

  $('#plusButtonA').click(function(){
    i = i+1;
    $('<div class="form-group" id="allowance'+i+'">' +
        '<div class="col-md-6 margin-bottom-10">' +
          '<input type="text" class="form-control" name="allowanceTitle[]" placeholder="Allowance '+i+'">' +
        '</div>' +
        '<div class="col-md-3  margin-bottom-10">' +
          '<input type="text" class="allowance form-control" name="allowance[]" placeholder="value">' +
        '</div>' +
        '<label class="control-label col-md-1">{{$setting->currency_symbol}}</label> '+
        '<div class="col-md-2"> <button type="button" onclick="$(\'#allowance'+i+'\').remove();" class="btn red btn-sm delete">' +
          '<i class="fa fa-close"></i>' +
          '</button></div>' +
      '</div>').insertBefore($insertBeforeA);
  });

  var $insertBeforeD = $('#insertBeforeD'),
      j = 2;
  $('#plusButtonD').click(function(){
    j = j+1;
    $('<div class="form-group" id="deduction'+j+'">' +
      '<div class="col-md-6 margin-bottom-10">' +
        '<input type="text" class="form-control" name="deductionTitle[]" placeholder="Deduction '+j+'">' +
      '</div>' +
      '<div class="col-md-3  margin-bottom-10">' +
        '<input type="text" class="deduction form-control" name="deduction[]" placeholder="value">' +
      '</div>' +
      '<label class="control-label col-md-1">{{$setting->currency_symbol}}</label> '+
      '<div class="col-md-2"> <button type="button" onclick="$(\'#deduction'+j+'\').remove();" class="btn red btn-sm delete">' +
        '<i class="fa fa-close"></i>' +
      '</button></div>' +
    '</div>').insertBefore($insertBeforeD);
  });
}
</script>
@stop