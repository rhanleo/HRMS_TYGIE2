@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
    <!-- BEGIN THEME STYLES -->
@stop


@section('mainarea')


			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			{{$pageTitle}}
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard.index')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{ route('admin.payrolls.index') }}">payroll</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="">Edit a salary slip</a>
					</li>
				</ul>

			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			{{Form::open(array('class'=>'form-horizontal','method'=>'POST','id'=>'salary-form'))}}
			<div class="row">
			{{--Employee info--}}
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                {{--INLCUDE ERROR MESSAGE BOX--}}
                      <div id="error"></div>
                {{--END ERROR MESSAGE BOX--}}

							<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							Employee info
						</div>
					</div>
					<div class="portlet-body">
							<div class="row">

										<div class="col-md-3">
											<div class="form-group">
												<div class="col-md-9">

												</div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<div class="col-md-9">
												 {{HTML::image("/profileImages/{$payroll->employeeDetails->profileImage}",'ProfileImage',['height'=>'100px'])}}

												</div>
											</div>
										</div>
									<!--/span-->
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-9">
												<ul>
													<li><h4>EmployeeID: {{$payroll->employeeDetails->employeeID}}</h4></li>
													<li><h4>Name:  {{$payroll->employeeDetails->fullName}}</h4></li>
													<li><h4>Month: {{date('F', strtotime($payroll->month . '01'));}}</h4></li>
													<li><h4>Year:  {{$payroll->year}}</h4></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-9">

											</div>

										</div>
									</div>

										<!--/span-->
								</div>
					</div>
				</div>
				</div>

							<div class="col-md-12">
                        					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                                        {{--INLCUDE ERROR MESSAGE BOX--}}
                                              <div id="error"></div>
                                        {{--END ERROR MESSAGE BOX--}}

                        							<div class="portlet box blue-hoki">
                        					<div class="portlet-title">
                        						<div class="caption">
                        						Edit Salary info
                        						</div>
                        					</div>
                        					<div class="portlet-body">


                										<div class="form-group">
                												<label class="control-label col-md-2">OverTime Hours:</label>
                												<div class="col-md-8 margin-bottom-10">
                												<label class="control-label">{{$payroll->overtime_hours}}</label>

                												</div>
                										</div>
                										<div class="form-group">
                												<label class="control-label col-md-2">Overtime Payment ( {{$setting->currency_symbol}} ):</label>
                												<div class="col-md-8 margin-bottom-10">
                												<label class="control-label">{{$payroll->overtime_pay}}</label>

                												</div>
                										</div>
                										<div class="form-group">
                												<label class="control-label col-md-2">Basic Salary ( {{$setting->currency_symbol}} ):</label>
                												<div class="col-md-8 margin-bottom-10">
                												<label class="control-label">{{$payroll->basic}}</label>
                												</div>
                										</div>
														<div class="form-group">
																<label class="control-label col-md-2">Expense Claim( {{$setting->currency_symbol}} ):</label>
																<div class="col-md-8 margin-bottom-10">
																<label class="control-label">{{$payroll->expense}}</label>
																</div>
														</div>
                										<!--/span-->

                        					</div>
                        				</div>
                        				</div>
                			{{--Allowances--}}
                				<div class="col-md-6">
                						<div class="portlet box blue-hoki">
                							<div class="portlet-title">
                								<div class="caption">
                								Edit Allowances
                								</div>
                							</div>
                							<div class="portlet-body">

                							@foreach(json_decode($payroll->allowances) as $index=>$value)

                								<div class="form-group" id="allowance">
                											<label class="control-label col-md-2"></label>
                											<div class="col-md-4 margin-bottom-10">
                												<label class="control-label">{{$index}}  ( {{$setting->currency_symbol}} )</label>

                											</div>
                											<div class="col-md-4  margin-bottom-10">
                												<label class="control-label">{{$value}}</label>

                											</div>


                										</div>
                							@endforeach




                								</div>
                						</div>
                					</div>
                			{{--Allowances End--}}
                			{{--Deductions--}}
                				<div class="col-md-6">
                						<div class="portlet box blue-hoki">
                							<div class="portlet-title">
                								<div class="caption">
                								Edit Deductions
                								</div>
                							</div>
                							<div class="portlet-body">

                							@foreach(json_decode($payroll->deductions) as $index=>$value)

                								<div class="form-group" id="deduction">
                											<label class="control-label col-md-2"></label>
                											<div class="col-md-4 margin-bottom-10">
                												<label class="control-label">{{$index}}  ( {{$setting->currency_symbol}} )</label>

                											</div>
                											<div class="col-md-4  margin-bottom-10">
                												<label class="control-label">{{$value}}</label>
                											</div>

                										</div>
                							@endforeach





                							</div>
                							</div>
                						</div>
                			{{--Deductions End--}}
                			{{--Gross--}}
                				<div class="col-md-12">
                									<div class="portlet box blue-hoki">
                										<div class="portlet-title">
                											<div class="caption">
                											GROSS
                											</div>
                										</div>
                										<div class="portlet-body">


                											<div class="form-group">
                													<label class="control-label col-md-2">Total Allowances ( {{$setting->currency_symbol}} )</label>
                													<div class="col-md-8 margin-bottom-10">
                														<label class="control-label">{{$payroll->total_allowance}}</label>

                													</div>
                											</div>
                											<div class="form-group">
                													<label class="control-label col-md-2">Total Deductions ( {{$setting->currency_symbol}} )</label>
                													<div class="col-md-8 margin-bottom-10">
                														<label class="control-label">{{$payroll->total_deduction}}</label>

                													</div>
                											</div>
                											<div class="form-group">
                													<label class="control-label col-md-2">Net Salary ( {{$setting->currency_symbol}} )</label>
                													<div class="col-md-8 margin-bottom-10">
                														<label class="control-label">{{$payroll->net_salary}}</label>

                													</div>
                											</div>
                										</div>
                								</div>
                			 </div>
                			 {{--Gross End--}}



				</div>

{{ Form::close() }}
	<!-- END FORM-->





			<!-- END PAGE CONTENT-->

@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
{{HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
<!-- END PAGE LEVEL PLUGINS -->


@stop