<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>{{$setting->website}} - {{$pageTitle}} </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- CSS Global Compulsory -->
        {{ HTML::style('front_assets/plugins/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('front_assets/css/style.css')}}
        <!-- CSS Implementing Plugins -->

        {{ HTML::style('front_assets/plugins/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css') }}

        {{ HTML::style('front_assets/plugins/scrollbar/src/perfect-scrollbar.css') }}
        {{ HTML::style('front_assets/plugins/fullcalendar/fullcalendar.css') }}
        {{ HTML::style('front_assets/plugins/fullcalendar/fullcalendar.print.css',array('media' => 'print')) }}


        <!-- CSS Page Style -->
        {{ HTML::style('front_assets/css/pages/profile.css') }}



        <!-- CSS Theme -->
        {{ HTML::style("front_assets/css/theme-colors/$setting->front_theme.css") }}
        <!-- CSS Customization -->
        {{ HTML::style('front_assets/css/custom.css') }}
        @yield('head')
	<style>
    .xdsoft_datetimepicker.xdsoft_noselect.xdsoft_ {
        z-index: 99999 !important;
    }
		ul {
    /*width: 800px;*/
    margin: 0 auto;
    padding: 0px;
    list-style: none;
    text-align: center;
}

ul li {
    display: inline;
    font-size: 16px;
    color:white !important;
    text-align: center;
 /*   font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;*/
    /*text-shadow: 0 0 5px #00c6ff;*/
}
	</style>
</head>

<body>
<div class="wrapper">
    <!--=== Header ===-->
    <div class="header">
        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('dashboard')}}">
                    {{HTML::image("assets/admin/layout/img/". $setting->logo,'Logo',array('class'=>'logo-default','id'=>'logo-header','height'=>'30px'))}}


                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">

                        <!-- Home -->
                        <li class="{{$homeActive or ''}}">
                            <a href="{{ route('dashboard.index')}}">
                                {{Lang::get('menu.home')}}
                            </a>
                        </li>
                        <!-- End Home -->

						<!-- Leave -->
                        <li class="dropdown {{$leaveActive or ''}}">
                            <a href="" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"  >
                                 {{Lang::get('menu.leave')}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="" data-toggle="modal" data-target=".apply_modal"> {{Lang::get('menu.applyLeave')}}</a></li>
                                <li><a href="{{route('front.leave')}}"> {{Lang::get('menu.myLeave')}}</a></li>
                            </ul>
                        </li>
                        <!-- End Leave -->

                        <!-- Overtime!!! -->
                        <li class="dropdown {{$overtimeActive or ''}}">
                            <a href="" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"  >
                                 Overtime
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="" data-toggle="modal" data-target=".apply_overtime"> Apply Overtime</a></li>
                                <li><a href="{{route('front.overtime')}}"> My Overtime</a></li>
                            </ul>
                        </li>
                        <!-- end overtime!!! -->

						<!-- Salary -->
						<li class="{{$salaryActive or ''}}">
							<a href="{{ route('front.salary')}}">
								{{Lang::get('menu.salarySlip')}}
							</a>
						</li>
						<!-- End Salary -->
                        <!-- Appraisal -->
                        <li class="{{$appraisalActive or ''}}">
                            <a href="{{ route('front.appraisal')}}">
                                Appraisal
                            </a>
                        </li>
                        <!-- Appraisal -->
                        <!-- Schedule -->
                        <li class="{{$jobActive or ''}}">
                            <a href="{{ route('schedule.index',Auth::employees()->get()->employeeID)}}">
                                {{'Schedule'}}
                            </a>
                        </li>
                        <!-- end Schedule -->
                        <!-- Job -->
                        <li class="{{$jobActive or ''}}">
                            <a href="{{ route('jobs.index')}}">
                                {{Lang::get('menu.job')}}
                            </a>
                        </li>
                        <!-- End Job -->


						<!-- My Account -->
                        <li class="dropdown {{$accountActive or ''}}">
                            <a href="" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                             {{Lang::get('menu.myAccount')}}
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="" data-toggle="modal" data-target=".change_password_modal" id="change_password_link"> {{Lang::get('menu.changePassword')}}</a></li>
                                <li><a href="{{route('front.expenses.index')}}" > {{Lang::get('menu.expenseFront')}}</a></li>

                                <!-- Logout -->
                                @if(Auth::employees()->check())
                                <li>
                                    <a href="{{route('front.logout')}}">
                                        {{Lang::get('menu.logout')}}
                                    </a>

                                </li>
                                @endif
                                <!-- End Logout -->

                            </ul>
                        </li>
                        <!-- End Leave -->

                    </ul>
                </div><!--/navbar-collapse-->
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header ===-->

    <!--=== Profile ===-->
    <div class="profile container content">
            	<div class="row">
                        <!--Left Sidebar-->
                        <div class="col-md-3 md-margin-bottom-40">
                          {{HTML::image("/profileImages/{$employee->profileImage}",'ProfileImage',['class'=>"img-responsive profile-img margin-bottom-20",'style'=>'border:1px solid #ddd;margin:0 auto'])}}
                            {{--<img class="img-responsive profile-img margin-bottom-20" src="front_assets/img/team/5.jpg" alt="">--}}
            				<p>
            				<h3 style="text-align: center">{{$employee->fullName}}</h3>
            				<h6 style="text-align: center">{{$employee->getDesignation->designation}}</h6>
            				<h6  class="service-block-u" style="text-align: center;padding: 10px;"><strong>{{Lang::get('core.atWorkFor')}} : </strong>{{$employee->workDuration($employee->employeeID)}}</h6>
            				</p>
                            <hr>
            				<div class="service-block-v3 service-block-u">
            						<!-- STAT -->
            							<div class="row profile-stat">
            								<div class="col-sm-6 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="{{date('F')}}">
            									<div class="uppercase profile-stat-title">
            										 {{$attendance_count}}
            									</div>
            									<div class="uppercase profile-stat-text">
            										 {{Lang::get('core.attendance')}}
            									</div>
            								</div>
            								<div class="col-sm-6 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="{{Lang::get('core.totalAwardsWon')}}">
            									<div class="uppercase profile-stat-title">
            										{{count($employee->getAwards)}}
            									</div>
            									<div class="uppercase profile-stat-text">
            										 {{Lang::get('core.awards')}}
            									</div>
            								</div>
            							</div>
            							<!-- END STAT -->
                            </div>

			<div class="panel-heading overflow-h service-block-u">
                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i>Leave Credits</h2>
            </div>

            <div class="service-block-v3 service-block-u">
                <div class="row profile-stat">

                    <?php $leavetypes = DB::table('leavetypes')->get(); ?>
                    @foreach($leavetypes as $key => $val)
                        <?php
                            $leave_count = 0;
                            $query_leave_credit = DB::table('leave_credits')
                                                    ->where('employeeID', $employee->employeeID)
                                                    ->where('leaveType', $val->leaveType)
                                                    ->first(); 
                            if ($query_leave_credit != '') {
                                // if (date('Y', strtotime($query_leave_credit->created_at)) == date('Y')) {
                                // }
                                $leave_count += $query_leave_credit->leave_credit;
                            }

                            $leave_used = DB::table('leave_applications')
                                ->where('employeeID', $employee->employeeID)
                                ->where('leaveType', $val->leaveType)
                                ->where('application_status', 'approved')
                                ->sum('days');
                        ?>
                        
                        <div class="col-md-4 col-xs-12">
                            <div class="uppercase profile-stat-title">
                                {{ $leave_used .'/'. $leave_count }}
                            </div>
                            <div class="uppercase profile-stat-text">
                                {{ ucfirst( str_replace('_', ' ', $val->leaveType)) }}
                            </div>
                        </div>
                        
                    @endforeach
                </div>
            </div>

            <!-- Time In/Out -->
			<div class="service-block-v3 service-block-u">
            						<!-- STAT -->
            							<div class="row profile-stat">

									@if ($employee->a_status == '1')
									<div>Time In: {{$timein[0]->created_at}}</div>
									<a  class="btn red" href="{{route('front.timeout',['id' => $employee->employeeID, 'aid' => $timein[0]->id])}}" style="background-color:red;color:white;font-weight:bold;"><span class="fa fa-clock-o">&nbsp;Time Out</a>
									@else
									<div>
									<a class="btn green" href="{{route('front.timein',$employee->employeeID)}}" style="background-color:green;color:white;font-weight:bold;"><span class="fa fa-clock-o">&nbsp;Time In</span></a>
									</div>
									@endif
						</div>
            							<!-- END STAT -->
                            </div>
				                            <!--Notification-->
                    @if(count($current_month_birthdays)>0)

                        <div class="panel-heading overflow-h service-block-u">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-birthday-cake"></i> Birthdays</h2>
                        </div>

                        <div class="service-block-v3 service-block-u">
                            @foreach($current_month_birthdays as $birthday)
                                <div class="row profile-stat">
                                        <div class="col-sm-4 col-xs-12">
                                            <img src="{{ url(implode('/', ['profileImages', $birthday->profileImage])) }}" alt="" width="100%">
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <div class="overflow-h">
                                                <span><strong>{{$birthday->firstName . ' ' . $birthday->lastName }}</strong>  {{Lang::get('core.hasBirthDayOn')}}</span>
                                                <strong>{{date('d F',strtotime($birthday->date_of_birth))}}</strong>
                                            </div>
                                        </div>
                                        
                                    </div>
                            @endforeach
                        </div>
                    @endif
                            <!--End Notification-->


                            <div class="margin-bottom-50"></div>
                        </div>
                        <!--End Left Sidebar-->

                        {{--------------------Main Area----------------}}
                               @yield('mainarea')
                        {{---------------Main Area End here------------}}


                    </div><!--/end row-->


    </div>
    <!--=== End Profile ===-->

    <!--=== Footer Version 1 ===-->
    <div class="footer-v1">

        <div class="copyright">
            <div class="container">
                <div class="row">
				<div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p style="text-align: center;">
                            {{date('Y')}} &copy; {{$setting->website}}

                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="col-md-4">

                    </div>
                    <!-- End Social Links -->
                </div>
            </div>
        </div><!--/copyright-->
    </div>
    <!--=== End Footer Version 1 ===-->


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
{{-- Apply Leave MODALS --}}

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
{{-- APPLY OVERTIME MODAL --}}

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



</div><!--/wrapper-->


<!-- JS Global Compulsory -->
{{HTML::script('front_assets/plugins/jquery/jquery.min.js')}}
{{HTML::script('front_assets/plugins/jquery/jquery-migrate.min.js')}}
{{HTML::script('front_assets/plugins/bootstrap/js/bootstrap.min.js')}}

<!-- JS Implementing Plugins -->
{{HTML::script('front_assets/plugins/back-to-top.js')}}

<!-- Scrollbar -->
{{HTML::script('front_assets/plugins/scrollbar/src/jquery.mousewheel.js')}}
{{HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js')}}
<!-- JS Customization -->
{{HTML::script('front_assets//plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js')}}
{{HTML::script('front_assets/plugins/sky-forms/version-2.0.1/js/jquery.form.min.js')}}
<!-- JS Page Level -->
{{HTML::script('front_assets/plugins/lib/moment.min.js')}}
{{HTML::script('front_assets/plugins/fullcalendar/fullcalendar.min.js')}}
{{HTML::script("front_assets/global/plugins/fullcalendar/lang-all.js")}}
{{ HTML::style('assets/global/plugins/datetimepicker-master/jquery.datetimepicker.css') }}
{{HTML::script("assets/global/plugins/datetimepicker-master/jquery.datetimepicker.min.js")}}


@yield('footerjs')

<script>
    Date.parseDate = function( input, format ){
        if (format == "H:i"){
            format = "HH:mm";
        }

        return moment(input,format).toDate();
    };
    Date.prototype.dateFormat = function (format) {
        
        if (format == "H:i"){
            return moment(this).format("HH:mm");
        }

        return moment(this).format(format);
    };
    
    function init_datetimepicker(){
            var allow_time = [];
            for (var i = 0; i <= 23; i++) {
                allow_time.push( i + ':00');
                allow_time.push( i + ':30');
            }

            $('.ot-time-in').datetimepicker({
                format: 'YYYY/MM/DD h:mm A',
                formatDate: 'YYYY/MM/DD h:mm A',
                formatTime: 'h:mm A', 
                datepicker: true,
                timepicker: true,
                allowTimes: allow_time,
                hours12: true,
            });

            $('.ot-time-out').datetimepicker({
                onShow: function(ct, input){
                    var minDate = new Date();
                    if( $(input).closest('.row').find('.ot-time-in').val() ){
                        minDate = moment( $(input).closest('.row').find('.ot-time-in').val() );
                    }

                    this.setOptions({
                        // minDate: $(input).closest('.row').find('.ot-time-in').val() ? $(input).closest('.row').find('.ot-time-in').val() : new Date(),
                        minDate: minDate,
                    });
                },
                format: 'YYYY/MM/DD h:mm A',
                formatTime: 'h:mm A', 
                // format: 'YYYY/MM/DD H:mm',
                // formatDate: 'YYYY/MM/DD H:mm',
                datepicker: true,
                timepicker: true,
                allowTimes: allow_time,
            });
        }
    
    jQuery(document).ready(function ($) {
        "use strict";
        
        init_datetimepicker();

        $('#overtime-form').on('submit', function(e){
            var proceed = true;
            $(this).find('.required').each(function(){
                if ($(this).val().length == 0 || $(this).val() == '') {
                    alert('Field required');
                    $(this).focus();
                    proceed = false;
                    return false;
                }
            })

            if (proceed) {
                return true;
            }
            return false;
        })

        $('.contentHolder').perfectScrollbar();
// Date range
	        $('#start_date').datepicker({
	            dateFormat: 'dd/mm/yy',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            // minDate: 0,

	            onSelect: function( selectedDate )
	            {

	            	 var diff = ($("#end_date").datepicker("getDate") -
								$("#start_date").datepicker("getDate")) /
							   1000 / 60 / 60 / 24 + 1; // days
					if($("#end_date").datepicker("getDate")!=null)	{
					 		$('#daysSelected').html(diff);
					 		$('#days').val(diff);
					 }
	                 $('#end_date').datepicker('option', 'minDate', selectedDate);
	            }
	        });
	        $('#end_date').datepicker({
	            dateFormat: 'dd/mm/yy',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function( selectedDate )
	            {

	                $('#start_date').datepicker('option', 'maxDate', selectedDate);

                        var diff = ($("#end_date").datepicker("getDate") -
                                    $("#start_date").datepicker("getDate")) /
                                   1000 / 60 / 60 / 24 + 1; // days
                         if($("#start_date").datepicker("getDate")!=null)	{
								$('#daysSelected').html(diff);
								$('#days').val(diff);
						 }

	            }
	        });

    });
</script>


<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<!--[if lt IE 9]>
    {{HTML::script('front_assets/plugins/respond.js')}}
    {{HTML::script('front_assets/plugins/html5shiv.js')}}
<![endif]-->
<script>
{{'';$j=0;}}
        $('#leave').datepicker({
				prevText: '<i class="fa fa-angle-left"></i>',
				nextText: '<i class="fa fa-angle-right"></i>',
				dateFormat: 'dd/mm/yy',
				// minDate: 0


        }
        );
        $('.halfLeaveType').hide();
            var $insertBefore = $('#insertBefore');
            var $i = 0;

        $('#otplusButton').click(function(){
            $i = $i+1;

            var append_text = '<div class="row margin-bottom-10" id="ot_row_' + $i + '">' +
                                    '<div class="col-md-4 col-xs-12">' +
                                        '<label for="">Time Start:</label>' +
                                        '<input type="text" class="form-control ot-time-in required" name="ot_time_in['+$i+']">' +
                                        '<a onclick="remove_ot_field(this)"><i class="fa fa-times"></i> Remove</a>' + 
                                    '</div>' +
                                    '<div class="col-md-4 col-xs-12">' +
                                        '<label for="">Time End:</label>' +
                                        '<input type="text" class="form-control ot-time-out required" name="ot_time_out['+$i+']">' +
                                    '</div>' +
                                    '<div class="col-md-4 col-xs-12">' +
                                        '<label for="">Reason</label>' +
                                        '<textarea class="form-control required" name="ot_reason['+$i+']"></textarea>' +
                                    '</div>' +
                                '</div>';
            $('.append-ot-time').append(append_text);
            init_datetimepicker();
        })

		 $('#plusButton').click(function(){

              $i = $i+1;

              $(' <div class="row" id="row'+$i+'"> ' +
               	'<div class="col-md-3"><label class="input"><i class="icon-append fa fa-calendar"></i><input type="text" class="margin-bottom-10" name="date['+$i+']" id="leave'+$i+'" placeholder="Leave Date"></label></div>' +
                '<div class="col-md-2">{{ Form::select('leaveType[]', $leaveTypes,null,['class' => 'form-control margin-bottom-10 leaveType','id'=>'leaveType','onchange'=>'halfDayToggle(0,this.value)'] ) }}</div>'+
                '<div class="col-md-2">{{ Form::select('halfleaveType[]', $leaveTypeWithoutHalfDay,null,['class' => 'form-control margin-bottom-10 halfLeaveType','id'=>'halfLeaveType'] ) }}</div>'+
                '<div class="col-md-5"><input class="form-control margin-bottom-10" name="reason['+$i+']" type="text" value="" placeholder="Reason"/></div></div>').insertBefore($insertBefore);

			 $("#row"+$i+" .leaveType").attr('id','leaveType'+$i);
			 $("#row"+$i+" .halfLeaveType").hide();
			 $("#row"+$i+" .halfLeaveType").attr('id','halfLeaveType'+$i);
			 $("#row"+$i+" .leaveType").attr('onchange','halfDayToggle('+$i+',this.value)');

              $('#leave'+$i).datepicker({
              	            prevText: '<i class="fa fa-angle-left"></i>',
              	            nextText: '<i class="fa fa-angle-right"></i>',
                			dateFormat: 'dd/mm/yy',
						    minDate: 0,
					   });
            });

		 function halfDayToggle(id,value)
		 {
				if(value	==	'half day')
				{
					$('#halfLeaveType'+id).show(100);
				}else{
					$('#halfLeaveType'+id).hide(100);
				}
		 }

// Show change password modal body
		$('#change_password_link').click(function(){

			$('#change_password_modal_body').css("padding", "100px");
			$('#change_password_modal_body').html('{{HTML::image('front_assets/img/loading-spinner-blue.gif')}}');
			$('#change_password_modal_body').attr('class','text-center');

			$.ajax({
            			    type: 'POST',
            			    url: "{{route('front.change_password_modal')}}",

            			    data: {

            			    },
            			    success: function(response) {

            			    	$('#change_password_modal_body').css("padding", "0px");
            			    	$('#change_password_modal_body').removeClass('text-center');
            			    	$('#change_password_modal_body').html(response);
            			    },

            			    error: function(xhr, textStatus, thrownError) {
								$('#change_password_modal_body').html('<div class="alert alert-danger">Error Fetching data</div>');
            			    }
            			});

			});


		 

		function submitLeaves(type){
		if(type=='date_range'){
			$('#error_date_range').html('<div class="alert alert-info"><span class="fa fa-check"></span> Submitting..</div>');
		}else{
			$('#error_leave').html('<div class="alert alert-info"><span class="fa fa-check"></span> Submitting..</div>');
		}
			$.ajax({
			    type: 'POST',
			    url: "{{route('front.leave_store')}}",
			    dataType: "JSON",
			   data: $('#'+type+'_form').serialize(),
			    success: function(response) {
			if(response.status=='success')
						{
							if(type=='date_range'){
								$('#error_date_range').html('<div class="alert alert-success"><span class="fa fa-check"></span> '+response.msg+'</div>');
							}else{
								$('#error_leave').html('<div class="alert alert-success"><span class="fa fa-check"></span> '+response.msg+'</div>');
							}

							$('#date_range_form').hide();
						    window.location.href ='{{route('front.leave')}}';

						}else if(response.status == "error")
						 {

							 var arr = response.msg;
							 var alert='';
							if(type=='date_range'){
							 	$("#submitbutton_date_range").prop('disabled', false);
							 }else{
							    $("#submitbutton_date_range").prop('disabled', false);
							 }

							 $.each(arr, function(index, value)
							 {
								 if (value.length != 0)
								 {
									 alert += '<p><span class="fa fa-warning"></span> '+ value+ '</p>';

								 }
							 });
						if(type=='date_range'){
							 $('#error_date_range').html('<div class="alert alert-danger alert-dismissable">'+alert+'</div>');
						}else{
							 $('#error_leave').html('<div class="alert alert-danger alert-dismissable">'+alert+'</div>');
						}

						 }
			    },
			    error: function(xhr, textStatus, thrownError) {

			    }
			});
		}
		
		function change_password(){
    		$("#submitbutton").prop('disabled', true);
    
    		$('#error').html('{{HTML::image('front_assets/img/loading-spinner-blue.gif')}}');
    		$('#error').attr('class','text-center');
    
    		$.ajax({
    			type:'POST',
    			url:'{{route('front.change_password')}}',
    			dataType: 'json',
    			data: $('#change_password_form').serialize()
    		})
    		.done(function( response ) {
    			if(response.status=='success'){
    				$('.field').hide();
    				$('#error').html('<div class="alert alert-success"><span class="fa fa-check"></span> '+response.msg+'</div>');
    
    				setTimeout( function(){
                      $('.change_password_modal').modal('hide');
    				}, 2000)
    
    				var arr = response.msg,
    					alert='';
    				
    				$('#error').attr('class','');
    				$("#submitbutton").prop('disabled', false);
    
    				$.each(arr, function(index, val) {
    					if (val.length != 0) {
    						alert += '<p><span class="fa fa-warning"></span> '+ val+ '</p>';
    					}
    				});
    
    				$('#error').html('<div class="alert alert-danger alert-dismissable">'+alert+'</div>');
    
    
    			}
    		})
    
    	}

        

        function remove_ot_field(btn){
            $(btn).closest('.row').remove();
        }
</script>
</body>
</html>
