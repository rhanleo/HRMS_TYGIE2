<html><head></head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><body>
<header class="clearfix" style="padding-right: 17px;padding-top: 10px; padding-bottom: 10px; background-color: #F2F2F2;text-align: right;">
<div id="logo">
  {{HTML::image("assets/admin/layout/img/$setting->logo",'Logo',array('class'=>'logo-default','height'=>'40px'))}}
</div>
  <div id="company">
    <h2 class="name">{{$setting->website}}</h2>
    <div>{{$setting->address}}</div>
    <div>{{$setting->contact}}</div>
    <div><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></div>
  </div>
</header>
<div class="container-fluid" style="background-color: #fff">
<style type="text/css">
  .bd{
    width: 100%;
  }
  .banner{
    border-bottom: 2px solid black;
  }
  .banner td{
    border: 0px;
  }
  .banner td p{
    font-size: 16px;
    font-weight: bold;
    margin-left: 10px;
  }
  table{
    font-family: Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
  }
  th{
    padding: 8px 0 8px 5px;
    text-align: left;
    font-size: 13px;
    border: 1px solid black;
    background-color: #F2F2F2;
  }
  td{
    padding: 10px 8px 8px 8px;
    text-align: left;
    font-size: 13px;
    color: black;
    border: 1px solid black;
  }
  .head{
    background-color: #F2F2F2;
    font-size: 14px;
    padding: 15px 5px 8px 15px;
    border-radius: 5px;
  }
  .head tr td{
    text-align: left;
    font-size: 15px;
    border: 0px;
    padding-left: 20px;
  }
  .tbl1{
    /* font-size: 18px;
    border: 0px; */
    background-color: #fff;
    width: 45%;
    float: left;
  }
  .tbl2{
    /* font-size: 18px;
    border: 0px; */
    background-color: #fff;
    width: 45%;
    float: right;
  }
  /* .tbl_total{
    width: 45%;
    float: right;
  } */
  .tbl_total tr td {
    border: 0px;
    padding: 5px 0;
  }
  .tbl_total tr td:last-child {
    padding-left: 10px;
  }
  .tbl_total tr td > strong {
    font-size: 12px;
  }
  .bg td{
    background-color: #F2F2F2;
  }
  .net_salary td{
    font-size: 20px;
  }
</style>

  <div class="bd">
    <div id="payment_receipt">
      <div style="width: 100%; border-bottom: 2px solid black;">
        <table style="width: 100%; vertical-align: middle;">
          
          
        </table>
      </div>
      <br><br>

      <div style="width: 100%;">
        <div align="center">
          <table class="head">
            
              <tr>
                <?php
                  if ($payroll->period != 0) {
                    if ($payroll->period == 2) {
                      $cutoff_date = '16-'. date('t', mktime(0, 0, 0, $payroll->month, 1, $payroll->year));
                    }
                    else{
                      $cutoff_date = '1-15';
                    }
                  }
                  $payroll_period = date('F '. $cutoff_date .' Y', mktime(0, 0, 0, $payroll->month, 1, $payroll->year));
                ?>
                <td colspan="3" style="text-align: center; font-size: 18px; padding-bottom: 18px;"><strong>Payslip <br>Payroll Period: {{ $payroll_period }}</strong> </td>
              </tr>
              <tr>
                <td><strong>Employee ID:</strong> {{$payroll->employeeID}}</td>
                <td><strong>Name:</strong> {{$payroll->employeeDetails->firstName . ' ' .$payroll->employeeDetails->lastName .' '.$payroll->employeeDetails->suffix  }}</td>
                <td><strong>Payslip No:</strong> {{$payroll->id}}</td>
              </tr>
              <tr>
                <td><strong>Department:</strong>  {{ $payroll->employeeDetails->getDesignation->designation }}</td>
                <td><strong>Job Title:</strong> {{ $payroll->employeeDetails->jobTitle}}</td>
                <td><strong>Joining Date:</strong> {{date('d-M,Y',strtotime($payroll->employeeDetails->joiningDate))}}</td>
              </tr>
            
          </table>
          <br><br>
        </div>

      <br>
        
        <table width="100%">
          <tr>
            <td style="border: none;width: 50%;padding: 10px;vertical-align: top;">
              <table width="100%">
                
                  <tr>
                    <td colspan="2" style="border: 0px; font-size: 20px;padding-left:0px;"><strong>Earnings</strong></td>
                  </tr>
                  <tr>
                    <th>Pay Type</th>
                    <th>Amount</th>
                  </tr>
                  <tr>
                    <td style="text-align: right"><strong>Basic</strong></td>
                    <td> &nbsp; {{$setting->currency_symbol}} {{ number_format($payroll->basic, 2) }}</td>
                  </tr>
                  <tr>							  
                    <td style="text-align: right"><strong>Overtime</strong></td>
                    <td> &nbsp; {{$setting->currency_symbol}} {{ number_format($payroll->overtime_pay, 2)}}</td>
                  </tr>
                  <tr>
                    <td style="text-align: right"><strong>Expense Claim</strong></td>
                    <td> &nbsp; {{$setting->currency_symbol}} {{ number_format( $payroll->expense, 2 )}}</td>
                  </tr>

                  @foreach(json_decode($payroll->allowances) as $index=>$value)
                    <tr>
                      <td style="text-align: right"><strong>{{$index}}</strong></td>
                      <td>&nbsp; {{$setting->currency_symbol}} {{ number_format($value, 2)}}</td>
                    </tr>
                  @endforeach
                
              </table>
            </td>
            <td style="border: none;width: 50%;padding: 10px;vertical-align: top;">
              <table width="100%">
                
                  <tr>
                    <td colspan="2" style="border: 0px; font-size: 20px;padding-left:0px;"><strong>Deduction</strong></td>
                  </tr>
                  <tr>
                    <th>Type of Pay</th>
                    <th>Amount</th>
                  </tr>                
                  @foreach( json_decode( $payroll->deductions ) as $index=>$value)
                    <tr>
                      <td style="text-align: right"><strong>{{$index}}</strong></td>
                      <td>&nbsp; {{ $setting->currency_symbol }} {{ number_format($value, 2) }}</td>
                    </tr>
                  @endforeach                
                  <tr>
                    <td style="text-align: right"><strong>SSS</strong></td>
                    <td>&nbsp; {{$setting->currency_symbol}} {{ number_format($payroll->sss_deduction, 2)}}</td>
                  </tr>
                  <tr>
                    <td style="text-align: right"><strong>Philhealth</strong></td>
                    <td>&nbsp; {{$setting->currency_symbol}} {{ number_format($payroll->philhealth_deduction, 2)}}</td>
                  </tr>
                  <tr>
                    <td style="text-align: right; width: 55%;"><strong>Pag-IBIG</strong></td>
                    <td>&nbsp; {{$setting->currency_symbol}} {{ number_format($payroll->pagibig_deduction, 2)}}</td>
                  </tr>
                
              </table>
            </td>
          </tr>
          <tr>
            <td style="border: none;width: 50%;padding: 10px;vertical-align: top;"></td>
            <td style="border: none;width: 50%;padding: 10px;vertical-align: top;">
              <table width="100%" class="tbl_total">
                <tr>
                  <td colspan="2" style="border: 0px; font-size: 20px;padding-left:0px;"><strong>Total Details</strong></td>
                </tr>                
                <tr>
                  <td style="text-align: right;"><strong>Total Allowances  :  </strong></td>
                  <td>{{$setting->currency_symbol}} {{ number_format($payroll->total_allowance, 2)}}</td>
                </tr>
                <tr>
                  <td style="text-align: right;"><strong>Total Deductions  :  </strong></td>
                  <td>{{$setting->currency_symbol}} {{number_format($payroll->total_deduction, 2)}}</td>
                </tr>                
                <tr>
                  <td style="text-align: right;"><strong>Withholding Tax :  </strong></td>
                  <td>{{$setting->currency_symbol}} {{number_format($payroll->withholding_tax, 2)}}</td>
                </tr>
                <tr class="bg net_salary">
                  <td style="text-align: right; font-weight: bold"><strong>Net Salary :  </strong></td>
                  <td style="font-weight: bold; font-size: 18px; padding: 0; padding: 0 10px;">{{$setting->currency_symbol}} {{number_format($payroll->net_salary, 2)}}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body></html>
