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
          <label class="control-label col-md-2">OverTime Hours</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="overtime_hours" name="overtime_hours" placeholder="OverTime" value="{{$payrolls->overtime_hours}}">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Overtime Payment ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="overtime_pay" name="overtime_pay" placeholder="overtime_pay" value="{{$payrolls->overtime_pay}}">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Basic Salary ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="basic" name="basic" placeholder="Basic" value="{{ $payrolls->basic }}" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Expense Claim ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="expense_claim" name="expense" placeholder="Basic" value="{{$payrolls->expense}}">
          </div>
        </div>
      </div> {{-- end of .portlet-body --}}
    </div>
  </div>
</div>

<div class="row">
  {{--Allowances--}}
  <div class="col-md-6">
    <div class="portlet box">
      <div class="portlet-title has-pad">
        <div class="title-left">
          <span>Edit Allowances</span>
        </div>
      </div> {{-- end of .portlet-title --}}
      <div class="portlet-body">
      	<?php 
          $i=0;
          $p_allowance = json_decode($payrolls->allowances); 
        ?>
        @if(count($p_allowance) > 0)
        	@foreach($p_allowance as $key => $val)
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
        @endif

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
  <div class="col-md-6">
    <div class="portlet box">
      <div class="portlet-title has-pad">
        <div class="title-left">
          <span>Edit Deductions</span>
        </div>
      </div> {{-- end of .portlet-title --}}

      <div class="portlet-body">
      	<?php 
          $i=0;
          $p_deductions = json_decode($payrolls->deductions);
        ?>
        @if(count($p_deductions) > 0 )

        	@foreach($p_deductions as $key => $val)
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
        @endif

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
            <input type="text" class="form-control" id="sss_deduction" name="sss_deduction" placeholder="SSS Deduction" value="{{ round($payrolls->sss_deduction, 2) }}">
          </div>
        </div>

        {{-- Philhealth --}}
        <div class="form-group">
          <label class="control-label col-md-2">Philhealth ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="philhealth_deduction" name="philhealth_deduction" placeholder="Philhealth Deduction" value="{{ round($payrolls->philhealth_deduction, 2) }}">
          </div>
        </div>

        {{-- Pag-IBIG --}}
        <div class="form-group">
          <label class="control-label col-md-2">Pag-IBIG ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="pagibig_deduction" name="pagibig_deduction" placeholder="Pag-IBIG Deduction" value="{{ round($payrolls->pagibig_deduction, 2) }}">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Total Allowances ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="total_allowance" name="total_allowance" placeholder="total" value="{{ round($payrolls->total_allowance, 2) }}" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Total Deductions ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="total_deduction" name="total_deduction" placeholder="total" value="{{ round($payrolls->total_deduction, 2) }}" readonly>
          </div>
        </div>

        {{-- With Holding Tax --}}
        <div class="form-group">
          <label class="control-label col-md-2">Withholding Tax: ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="withholding_tax" name="withholding_tax" placeholder="Withholding Tax" value="{{ round($payrolls->withholding_tax, 2) }}">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Net Salary ( {{$setting->currency_symbol}} )</label>
          <div class="col-md-8 margin-bottom-10">
            <input type="text" class="form-control" id="net_salary"  name="net_salary" placeholder="total" value="{{ round($payrolls->net_salary, 2) }}" readonly>
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