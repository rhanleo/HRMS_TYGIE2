{{-- Apply Leave  MODALS --}}
    <div class="modal fade apply_modal in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title">
                        {{Lang::get('menu.applyLeave')}}
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="portlet-body form">
                        <div class="tab-v1 margin-bottom-40">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#button-1" data-toggle="tab">  {{Lang::get('core.singleDateLeave')}}</a></li>
                                <li class=""><a href="#button-2" data-toggle="tab">  {{Lang::get('core.multipleDateleave')}}</a></li>
                            </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="button-1">
                                <div class="clearfix margin-bottom-10"></div>
                                
                                    <div id="error_leave"></div>
                      
                                    {{Form::open(array('route'=>"front.leave_store",'class'=>'sky-form','id'=>'single_leaves_form','method'=>'POST'))}}
            							<input type="hidden" name="days_single" id="days_single" value="1">
            							<input type="hidden" name="leaveformType" id="leaveformType" value="single_leaves">

                                        <div class="row">
                                            <div class="col-md-3 ">
                                                <label class="input">
                                                    <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" class="margin-bottom-10" name="date[0]" id="leave" placeholder="{{trans('core.leaveDate')}}">
                                                </label>
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::select('leaveType[0]', $leaveTypes,null,['class' => 'form-control leaveType margin-bottom-10','id'=>'leaveType0','onchange'=>'halfDayToggle(0,this.value)'] ) }}
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::select('halfleaveType[0]', $leaveTypeWithoutHalfDay,null,['class' => 'form-control margin-bottom-10 halfLeaveType margin-bottom-10','id'=>'halfLeaveType0'] ) }}
                                            </div>

                                            <div class="col-md-5">
                                                <input class="form-control form-control-inline margin-bottom-10"  type="text" name="reason[0]" placeholder="{{trans('core.reason')}}"/>
                                            </div>
                                        </div>

                                        <div id="insertBefore"></div>

                                        <button type="button" id="plusButton" class="btn-u btn-u-green margin-bottom-10">
                                           {{Lang::get('core.addMore')}} <i class="fa fa-plus"></i>
                                        </button>

                                        <div class="row">
                                           <div class="col-md-offset-4 col-md-8">
                                               <button type="submit" class="btn-u btn-u-sea" onclick="submitLeaves('single_leaves');return false;"><i class="fa fa-check" ></i> {{trans('core.btnSubmit')}}</button>
                                           </div>
                                        </div>

                                    {{ Form::close() }}
                                </div>

                            <div class="tab-pane fade" id="button-2">
                            <div class="clearfix margin-bottom-10"></div>
                            <div id="error_date_range"></div>
                  
                            {{Form::open(array('route'=>"front.leave_store",'class'=>'form-horizontal sky-form','id'=>'date_range_form','method'=>'POST'))}}
                                <input type="hidden" name="days" id="days" value="0">
                                <input type="hidden" name="leaveformType" id="leaveformType" value="date_range">

                    			<div class="form-group">

                    				    <label for="inputEmail1" class="col-lg-2 control-label">{{trans('core.dateRange')}}</label>

                                        <section class="col col-4">
                                            <label class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="start_date" id="start_date" placeholder="{{trans('core.startDate')}}">
                                            </label>
                                        </section>

                                        <section class="col col-4">
                                            <label class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="end_date" id="end_date" placeholder="{{trans('core.endDate')}}">
                                            </label>
                                        </section>
                                </div>

            					<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">{{trans('core.selectedDays')}} </label>
            						<div class="col-lg-2" style="margin-top: 6px;">
            							<span id="daysSelected" class="badge rounded-2x badge-red">0</span>
            						</div>
                            	</div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">{{trans('core.leaveTypes')}}</label>
                                    <div class="col-lg-6">
                                        {{ Form::select('leaveType', $leaveTypeWithoutHalfDay,null,['class' => 'form-control','id'=>'date_range_leaveType'] ) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">{{trans('core.reason')}}</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="reason" ></textarea>
                                    </div>
                                </div>

                				<div class="form-group">
                					<div class="col-lg-offset-2 col-lg-10">
                						<button type="submit" class="btn-u btn-u-green" id="submitbutton_date_range" onclick="submitLeaves('date_range');return false;">{{trans('core.btnSubmit')}}</button>
                					</div>
                				</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info"><strong>{{trans('messages.note')}}!</strong> {{trans('messages.dateRangeNote')}}</div>
        </div>
    </div>
    </div>
    </div>
    

{{-- END Leave MODALS --}}
{{-- APPLY OVERTIME MODAL --}}
    <div class="modal fade apply_overtime in" tabindex="-1" role="dialog" aria-labelledby="myOvertimeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Apply Overtime</h4>
                </div>

                <div class="modal-body">
                    <div class="portlet-body form">
                        <div class="tab-v1 margin-bottom-40">
                            <div class="tab-content">
                                <!--<div class="alert alert-info"><p>Note: Time format in 24hrs.</p></div>-->
                                <div class="tab-pane fade active in" id="button-1">
                                    <div class="clearfix margin-bottom-10"></div>

                                    {{Form::open( ['route'=>"front.overtime_store",'class'=>'form-horizontal sky-form', 'id' => 'overtime-form', 'method'=>'POST'] )}}
                                        <div class="append-ot-time">

                                            <div class="row margin-bottom-10" id="ot_row_0">
                                                <div class="col-md-4 col-xs-11">
                                                    <label for="">Time Start:</label>
                                                    <input type="text" class="form-control ot-time-in required" name="ot_time_in[0]">
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    <label for="">Time End:</label>
                                                    <input type="text" class="form-control ot-time-out required" name="ot_time_out[0]">
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    <label for="">Reason</label>
                                                    <textarea class="form-control required" name="ot_reason[0]"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    <span id="otplusButton" class="btn-u btn-u-green margin-bottom-10">Add More <i class="fa fa-plus"></i></span>
                                    <button type="submit" class="btn-u btn-u-sea"><i class="fa fa-check"></i> Submit</button>
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
{{-- END OVERTIME MODAL --}}
{{-- APPLY CASH ADVANCE MODAL --}}
    <div class="modal fade apply_cashadvance in" tabindex="-1" role="dialog" aria-labelledby="myOvertimeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Apply Cash Advance</h4>
                </div>

                <div class="modal-body">
                    <div class="portlet-body form">
                        <div class="tab-v1 margin-bottom-40">
                            <div class="tab-content">
                                <!--<div class="alert alert-info"><p>Note: Time format in 24hrs.</p></div>-->
                                <div class="tab-pane fade active in" id="button-1">
                                    <div class="clearfix margin-bottom-4"></div>

                                    {{Form::open( ['route'=>"front.cashadvance.store",'class'=>'form-horizontal sky-form', 'id' => 'overtime-form', 'method'=>'POST'] )}}
                                        <div class="append-ot-time">

                                            <div class="row">      
                                                <div class="col-md-4 col-xs-12">
                                                    <label for="">Amount</label>
                                                    <input type="number" class="form-control required" name="amount" placeholder="1500">
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                    
                                                    <label for="purpose">Purpose</label>
                                                    <textarea class="form-control required" name="purpose"></textarea>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <br/>
                                    <button type="submit" class="btn-u btn-u-sea form-control"><i class="fa fa-check"></i> Submit</button>
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
{{-- END EDIT CASH ADVANCE MODAL --}}
<div class="modal fade edit_cashadvance in" tabindex="-1" role="dialog" aria-labelledby="myOvertimeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Apply Cash Advance</h4>
                </div>

                <div class="modal-body">
                    <div class="portlet-body form">
                        <div class="tab-v1 margin-bottom-40">
                            <div class="tab-content">
                                <!--<div class="alert alert-info"><p>Note: Time format in 24hrs.</p></div>-->
                                <div class="tab-pane fade active in" id="button-1">
                                    <div class="clearfix margin-bottom-4"></div>

                                    {{Form::open( ['route'=>"front.cashadvance.update",'class'=>'form-horizontal sky-form', 'id' => 'ca-form', 'method'=>'PATCH'] )}}
                                        <div class="append-ot-time">

                                            <div class="row">      
                                                <div class="col-md-4 col-xs-12">
                                                    <label for="">Amount</label>
                                                    <input type="number" class="form-control required" id="amount" name="amount" placeholder="1500">
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                    
                                                    <label for="">Purpose</label>
                                                    <textarea class="form-control required" id="remarks" name="remarks"></textarea>
                                                    <input name="employeeID" type="hidden" value"<?php echo Auth::employees()->get()->employeeID;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                    <button type="submit" class="btn-u btn-u-sea form-control"><i class="fa fa-check"></i> Update</button>
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
{{-- END Edit CASH ADVANCE MODAL --}}

{{--------------------------Change Password  MODALS-----------------------------}}
            <div class="modal fade change_password_modal in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                             <h4  class="modal-title">
                                 {{Lang::get('menu.changePassword')}}
                                 </h4>
                        </div>
                        <div class="modal-body" id="change_password_modal_body">
							{{--Load with Ajax call--}}

                        </div>
                    </div>
                </div>
            </div>
{{--Change Password  MODALS--}}