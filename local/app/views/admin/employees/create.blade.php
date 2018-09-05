@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}
    {{HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            @if ( count( $department ) == 0 )
                <div class="note note-warning">{{ Lang::get( 'messages.noDept' ) }}</div>
            @else
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 form-group text-right email-notif">
                        <span id="load_notification"></span>
                        <input  type="checkbox"  onchange="ToggleEmailNotification('employee_add');return false;" class="make-switch" name="employee_add" @if($setting->employee_add==1)checked    @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                        <strong>{{trans('core.emailNotification')}}</strong>
                    </div>
                </div>
                
            @endif
             @include( 'admin.common.error' )
            {{ Form::open( array( 'route'=>"admin.employees.store", 'class' => 'custom-form', 'method'=>'POST', 'files' => true ) ) }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="portlet box">
                            <div class="portlet-title has-pad">
                                <div class="title-left">
                                    <span>{{trans('core.personalDetails')}}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-body">
                                    <div class="form-group ">
                                        <label for="profileImage">{{trans('core.image')}}</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="img-preview">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div> {{-- end of .img-preview --}}
                                            <div class="notes">
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">
                                                    {{trans('core.selectImage')}} </span>
                                                    <span class="fileinput-exists">
                                                    {{trans('core.change')}} </span>
                                                    <input type="file" name="profileImage">
                                                </span>
                                                <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                {{trans('core.remove')}} </a>
                                                <div class="lbl-note">NOTE!</div>
                                                <div>{{trans('messages.imageSizeLimit')}} (872px by 724px)</div>
                                            </div> {{-- end of .notes --}}
                                        </div> {{-- end of .fileinput --}}
                                    </div> {{-- end of .form-group --}}
                                    <hr />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- <label for="fullName">{{trans('core.name')}} <span class="required">* </span></label>
                                                <input type="text" class="form-control" name="fullName" placeholder="{{trans('core.name')}}" value="{{ Input::old('fullName') }}" > -->
                                                <label for="firstName">{{'First Name'}} <span class="required">* </span></label>
                                                <input type="text" class="form-control" name="firstName" placeholder="{{'First Name'}}" value="{{Input::old('firstName')}}" >
                                                <label for="lastName">{{'Last Name'}} <span class="required">* </span></label>
                                                <input type="text" class="form-control" name="lastName" placeholder="{{'last Name'}}" value="{{Input::old('lastName')}}" >
                                                <label for="middleName">{{'Middle Name'}}</label>
                                                <input type="text" class="form-control" name="middleName" placeholder="{{'Middle Name'}}"  value="{{Input::old('middleName')}}">
                                                <label for="suffix">{{'Suffix'}} </label>
                                                <input type="text" class="form-control" name="suffix" placeholder="{{'Suffix'}}"}} value="{{Input::old('suffix')}}">
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="date_of_birth">{{trans('core.dob')}}</label>
                                                <div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" name="date_of_birth" readonly value="{{ Input::old('date_of_birth') }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fatherName">{{trans('core.fatherName')}}</label>
                                                <input type="text" class="form-control" name="fatherName" placeholder="{{trans('core.fatherName')}}" />
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="gender">{{trans('core.gender')}}</label>
                                                {{ Form::select('gender', array('male' => 'Male', 'female' => 'Female'), Input::old('gender'),array('class'=>'form-control')) }}
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobileNumber">{{trans('core.phone')}}</label>
                                                <input type="text" class="form-control phone-number" name="mobileNumber" placeholder="{{trans('core.phone')}}" value="{{Input::old('mobileNumber')}}" />
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="marital_status">Marital Status</label>
                                                {{ Form::select('marital_status', array('single' => 'Single', 'married' => 'Married'), Input::old('marital_status'),array('class'=>'form-control')) }}
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dependent">Dependent</label>
                                                {{ Form::select('dependent', array(0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4), Input::old('dependent'),array('class'=>'form-control')) }}
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="locaAddress">{{'Provincial Address'}}</label>
                                                <textarea class="form-control" name="localAddress">{{Input::old('localAddress')}}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="permanentAddress">{{trans('core.permanentAddress')}}</label>
                                                <textarea class="form-control" name="permanentAddress">{{Input::old('permanentAddress')}}</textarea>
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <hr />
                                    <div class="account-details">
                                        <div class="title">{{trans('core.accountLogin')}}</div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="email">{{trans('core.email')}}<span class="required">* </span></label>
                                                    <input type="text" name="email" class="form-control" value="{{ Input::old('email') }}" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="password">{{trans('core.password')}}<span class="required">* </span></label>
                                                    <input type="hidden" name="oldpassword" />
                                                    <input type="text" name="password" class="form-control" value="{{ Input::old('password') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- end of .form-body --}}
                            </div> {{-- end of .portlet-body --}}
                        </div> {{-- end of .portlet --}}
                        <div class="portlet box">
                            <div class="portlet-title has-pad">
                                <div class="title-left">
                                    <span>{{trans('core.documents')}}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="resume">{{trans('core.resume')}}</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new">
                                                        {{trans('core.selectFile')}} </span>
                                                        <span class="fileinput-exists">
                                                        {{trans('core.change')}} </span>
                                                        <input type="file" name="resume">
                                                        </span>
                                                        <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                        {{trans('core.remove')}} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="offerLetter">Offer Letter</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new">
                                                            {{trans('core.selectFile')}} </span>
                                                            <span class="fileinput-exists">
                                                            {{trans('core.change')}} </span>
                                                            <input type="file" name="offerLetter" />
                                                        </span>
                                                        <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                        {{trans('core.remove')}} </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="joiningLetter">Joining Letter</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new">
                                                        {{trans('core.selectFile')}} </span>
                                                        <span class="fileinput-exists">
                                                        Change </span>
                                                        <input type="file" name="joiningLetter" />
                                                        </span>
                                                        <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                        {{trans('core.remove')}} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="contract">Contract and Agreement</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new">
                                                        {{trans('core.selectFile')}} </span>
                                                            <span class="fileinput-exists">
                                                            Change </span>
                                                            <input type="file" name="contract"/>
                                                        </span>
                                                        <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="IDProof">ID Proof</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new">
                                                        {{trans('core.selectFile')}} </span>
                                                        <span class="fileinput-exists">
                                                        Change </span>
                                                        <input type="file" name="IDProof">
                                                        </span>
                                                        <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- end of .form-body --}}
                            </div> {{-- end of .portlet-body --}}
                        </div> {{-- end of .portlet --}}
                    </div>
                    <div class="col-md-6">
                        <div class="portlet box">
                            <div class="portlet-title has-pad">
                                <div class="title-left">
                                    <span>{{trans('core.companyDetails')}}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="employeeID">{{trans('core.employeeID')}}<span class="required">* </span></label>
                                                <input type="text" class="form-control" name="employeeID" placeholder="{{trans('core.employeeID')}}" value="{{Input::old('employeeID')}}" />
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="deparment">{{trans('core.department')}}</label>
                                                {{ Form::select('department', $department,null,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;']) }}
                                            </div>
                                            <div class="col-md-6">
                                                <label for="designation">{{trans('core.designation')}}</label>
                                                <select  class="select2me form-control" name="designation" id="designation" onchange="Branch();return false;" ></select>
                                               
                                            </div>
                                            <div class="col-md-6 branch_wrapper">
                                                <label for="branch">{{'Branch'}}</label>
                                                <select  class="select2me form-control" name="branch" id="branch" ></select>
                                               
                                            </div>
                                            <div class="col-md-12">
                                            <br/>
                                                <label for="jobTitle">{{'Job Title'}}</label>
                                                <input type="text" class="form-control" name="jobTitle" placeholder="Your current position" value="{{Input::old('jobTitle')}}" />
                                            
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <?php
                                        $leavetypes = DB::table('leavetypes')->get();
                                    ?>
                                    @foreach($leavetypes as $key => $val)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="{{ $val->leaveType }}"> {{ ucfirst( str_replace('_', ' ', $val->leaveType)) }}</label>
                                                    <input type="number" min="0" step="1" name="leave[{{ $val->leaveType }}]" class="form-control" value="{{ $val->num_of_leave }}" />
                                                </div>
                                            </div>
                                        </div> {{-- end of .form-group --}}
                                    @endforeach

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="employment_status">Employment Status</label>
                                                <?php
                                                    $employment_status = array(
                                                            'regular' => 'Regular',
                                                            'freelancer' => 'Freelancer',
                                                        )
                                                ?>
                                                {{ Form::select('employment_status', $employment_status,'regular',['class' => 'form-control select2me','id'=>'employment_status']) }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="joiningDate">{{trans('core.dateOfJoining')}}</label>
                                                <div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" name="joiningDate" readonly value="{{Input::old('joiningDate')}}" />
                                                    <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <label for="basicSalary">{{trans('core.basicSalary')}} {{$setting->currency_symbol}}</label>
                                        <input step="any" min="0" type="number" class="form-control" name="basicSalary" placeholder="{{trans('core.basicSalary')}}" value="0">
                                        <span class="help-block">{{trans('messages.basicSalaryInfo')}} </span>
                                    </div>
                                </div> {{-- end of .form-body --}}
                            </div> {{-- end of .portlet-body --}}
                        </div> {{-- end of .portlet --}}
                        <div class="portlet box">
                            <div class="portlet-title has-pad">
                                <div class="title-left">
                                    <span>{{trans('core.bankDetails')}}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="accountName">{{trans('core.accountHolder')}}</label>
                                                <input type="text" class="form-control" name="accountName" placeholder="{{trans('core.accountHolder')}}" value="{{Input::old('accountName')}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="accountNumber">{{trans('core.accountNumber')}}</label>
                                                <input type="text" class="form-control numeric-only" name="accountNumber" placeholder="{{trans('core.accountNumber')}}" value="{{Input::old('accountNumber')}}" />
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="bank">{{trans('core.bank')}}</label>
                                                <input type="text" class="form-control" name="bank" placeholder="{{trans('core.bank')}}" value="{{Input::old('bank')}}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="branch">{{trans('core.branch')}}</label>
                                                <input type="text" class="form-control" name="branch" placeholder="{{trans('core.branch')}}" value="{{Input::old('branch')}}">
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                </div> {{-- end of .form-body --}}
                            </div> {{-- end of .portlet-body --}}
                        </div> {{-- end of .portlet --}}
                    </div>
                </div>
                <div class="btn-panel btn-add-employee">
                    <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn btn-1">
                        <span class="icon"><i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i></span>
                        <span>{{trans('core.btnSubmit')}}</span>
                    </button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
    {{HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
    {{HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{HTML::script('assets/admin/pages/scripts/components-pickers.js')}}
<!-- END PAGE LEVEL PLUGINS -->




<script>
jQuery(document).ready(function() {

    ComponentsPickers.init();
    dept();
   
    
});
var branch = $('.branch_wrapper');

function dept(){

        $.getJSON("{{ URL::to('admin/departments/ajax_designation/')}}",
        { deptID: $('#department').val() },
        function(data) {
                    
            var model = $('#designation');
           
            model.empty();
            console.log(data);
            model.append("<option> Select </option>");
           
            branch.hide();
            $.each(data, function(index, element) {             
                model.append("<option value='"+element.id+"'>"  + element.designation + "</option>");
            });

        });
       
}

function Branch(){
    var model = $('#branch');
    if(model.value != ''){
        branch.show();
    }
    $.getJSON("{{ URL::to('admin/departments/ajax_branch/')}}",
    { deptID: $('#designation').val() },
    function(data) {           
        
        $.each(data, function(index, element) { 
                        
            model.append("<option value='"+element.id+"'>"  + element.branch + "</option>");
        
            
        });

    });

}



    </script>
@stop
