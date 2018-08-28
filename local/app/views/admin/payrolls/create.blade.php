@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
@stop
@section('mainarea')
	<div class="content-section">
		@include('admin.common.error')
		{{Form::open(array('class'=>'form-horizontal','method'=>'POST','id'=>'salary-form'))}}
			<div id="error"></div>		
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box">
						<div class="portlet-title has-pad">
							<div class="title-left">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>Create a salary slip</span>
								<div class="tools"></div>
							</div>
						</div> {{-- end of .portlet-title --}}
						<div class="portlet-body">
							<div class="horizontal-header">
								<div class="input-section">
									{{ Form::select('employeeID', $employees,null,['class' => 'form-control select2me','data-placeholder'=>'Select Employee...','id'=>'employeeID']) }}
								</div>
								<div class="input-section">
									<select class="form-control  select2me" name="month" id="month">
										<option value="1">{{trans('core.January')}}</option>
										<option value="2">{{trans('core.February')}}</option>
										<option value="3">{{trans('core.March')}}</option>
										<option value="4">{{trans('core.April')}}</option>
										<option value="5">{{trans('core.May')}}</option>
										<option value="6">{{trans('core.june')}}</option>
										<option value="7">{{trans('core.July')}}</option>
										<option value="8">{{trans('core.August')}}</option>
										<option value="9">{{trans('core.September')}}</option>
										<option value="10">{{trans('core.October')}}</option>
										<option value="11">{{trans('core.November')}}</option>
										<option value="12">{{trans('core.December')}}</option>
									</select>
								</div>
								<div class="input-section">
									{{ Form::selectYear('year', 2013, date('Y')+1,date('Y'),['class' => 'form-control select2me','id'=>'year']) }}
								</div>
								@if( $setting->enable_two_payroll_period == 1 )
									<div class="input-section">
										<select name="period" id="period" class="form-control select2me">
											<option value="1">First Period</option>
											<option value="2">Second Period</option>
										</select>
									</div>
								@else
									<input name="period" type="hidden" value="0" id="period">
								@endif
								<div class="btn-panel">
									<button type="button" class="btn green" onclick="check();return false;" style="width: 60px; min-width: auto;">Go</button>
								</div>
							</div> {{-- end of .horizontal-header --}}
						</div> {{-- end of .portlet-body --}}
					</div> {{-- end of .portlet --}}
				</div>
			</div>
			<div id="load"></div>					
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
    		console.log(response)
    		$('#confirmBox').appendTo("body").modal('show');
    		$('#info').html('Salary Slip for the selected employee month and year already created.Do you want modify it?' );
    		$("#show").click(function(){
    			if (response.rdr != '') {
    				window.location.href = response.rdr;
    			}
					// $('#load').html(response.content);
					// $('#load').append('<input type="hidden" name="type" value="edit">');
					// InitializeAdd();
     //      			$("#basic").trigger("change");
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
	$.ajax({
		type: 'POST',
		url: "{{route('admin.payrolls.store')}}?debug",
		dataType: "JSON",
		data: $('#salary-form').serialize(),
		success: function(response) {
			if(response.status == "error"){
		  	$('#error').html('');
				var arr = response.msg,
			 			alert ='';

				$.each(arr, function(index, value){
					if (value.length != 0){
						alert += '<p><span class="fa fa-close"></span> '+ value+ '</p>';
					}
				});

				$('#error').append('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> '+alert+'</div>');
				  $("html, body").animate({ scrollTop: 0 }, "slow");
			  }
			  else{
			  	window.location.href='{{route('admin.payrolls.index')}}'
			  }
			},
		error: function(xhr, textStatus, thrownError) {}
  });
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