@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}
    {{HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span>{{trans('core.personalDetails')}}</span>
                            </div>
                            <div class="actions btn-portlet-right">
                                <a href="javascript:;"  onclick="$('#personal_details_form').submit();" data-loading-text="Updating..."  class="demo-loading-btn btn btn-sm btn-default ">
                                    <span class="icon"><i class="fa fa-save fa-fw" ></i></span>
                                    <span>{{trans('core.btnSave')}}</span>
                                </a>
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            {{Form::open(['method' => 'PATCH','route'=> ['admin.employees.update', $employee->employeeID],'class'   =>  'custom-form','id'  =>  'personal_details_form','files'=>true ])}}
                                <input type="hidden" name="updateType" class="form-control" value="personalInfo">
                                @if (Session::get('errorPersonal'))
                                    <div class="alert alert-danger alert-dismissable ">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        @foreach (Session::get('errorPersonal') as $error)
                                            <p><strong><i class="fa fa-warning"></i></strong> {{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="form-body">
                                    <div class="form-group ">
                                        <label for="profileImage">{{trans('core.image')}}</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="img-preview">
                                                <div class="fileinput-new thumbnail">
                                                    {{HTML::image("/profileImages/{$employee->profileImage}",'ProfileImage')}}
                                                    <input type="hidden" name="hiddenImage" value="{{$employee->profileImage}}">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div>
                                            <div class="notes">
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">{{trans('core.selectImage')}}</span>
                                                    <span class="fileinput-exists">{{trans('core.change')}}</span>
                                                    <input type="file" name="profileImage">
                                                </span>
                                                <a href="#" class="btn remove fileinput-exists" data-dismiss="fileinput">{{trans('core.remove')}}</a>
                                                <div class="lbl-note">NOTE!</div>
                                                <div>{{trans('messages.imageSizeLimit')}} (872px by 724px)</div>
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                               
                                                <label for="firstName">{{'First Name'}}  </label>
                                                <input type="text" name="firstName" class="form-control" value="{{$employee->firstName}}">
                                                <label for="lastName">{{'Last Name'}}  </label>
                                                <input type="text" name="lastName" class="form-control" value="{{$employee->lastName}}">
                                                <label for="middleName">{{'Middle Name'}}   </label>
                                                <input type="text" name="middleName" class="form-control" value="{{$employee->middleName}}">
                                                <label for="suffix">{{'Suffix'}} </label>
                                                <input type="text" name="suffix" class="form-control" value="{{$employee->suffix}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="date_of_birth">{{trans('core.dob')}}</label>
                                                <div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" name="date_of_birth" readonly value="@if(empty($employee->date_of_birth))@else{{date('d-m-Y',strtotime($employee->date_of_birth))}}@endif" >
                                                    <span class="input-group-btn">
                                                    <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fatherName">{{trans('core.fatherName')}}</label>
                                                <input type="text" name="fatherName" class="form-control" value="{{$employee->fatherName}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="gender">{{trans('core.gender')}}</label>
                                                <select class="form-control" name="gender">
                                                    <option value="male" @if($employee->gender=='male') selected @endif>Male</option>
                                                    <option value="female"  @if($employee->gender=='female') selected @endif>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobileNumber">{{trans('core.phone')}}</label>
                                                <input type="text" name="mobileNumber" class="form-control phone-number" value="{{$employee->mobileNumber}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="marital_status">Marital Status</label>
                                                <?php $marital_status = array('single' => 'Single', 'married' => 'Married') ?>
                                                <select name="marital_status" id="" class="form-control">
                                                    @foreach($marital_status as $key => $val)
                                                        <option value="{{ $key }}" {{ ($employee->marital_status == $key ? 'selected' : '') }}>{{ $val }}</option>
                                                    @endforeach                                                    
                                                </select>                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dependent">Dependent</label>
                                                <select name="dependent" id="" class="form-control">
                                                    @for($i = 0; $i <= 4; $i++)
                                                        <option value="{{ $i }}" {{ ($employee->dependent == $i ? 'selected' : '') }}>{{ $i }}</option>
                                                    @endfor                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div> {{-- end of .form-group --}}

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="localAddress">{{'Provincial Address'}}</label>
                                                <textarea name="localAddress" class="form-control" rows="3">{{$employee->localAddress}}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="permanentAddress">{{trans('core.permanentAddress')}}</label>
                                                <textarea name="permanentAddress" class="form-control">{{$employee->permanentAddress}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="account-details">
                                        <div class="title">{{trans('core.accountLogin')}}</div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="email">{{trans('core.email')}}<span class="required">* </span></label>
                                                    <input type="text" name="email" class="form-control" value="{{$employee->email}}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="password">{{trans('core.password')}}</label>
                                                    <input type="hidden" name="oldpassword" value="{{$employee->password}}">
                                                    <input type="text" name="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- end of .form-body --}}
                            {{Form::close()}}
                        </div> {{-- end of .portlet-body --}}
                    </div> {{-- end of .portlet --}}
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span>{{trans('core.documents')}}</span>
                            </div>
                            <div class="actions btn-portlet-right">
                                <button onclick="$('#documents_details_form').submit();"  data-loading-text="Updating..."  class="demo-loading-btn btn btn-sm btn-default ">
                                    <span class="icon"><i class="fa fa-save fa-fw"></i></span>
                                    <span>{{trans('core.btnSave')}}</span>
                                </button>
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            {{ Form::open( [ 'method' => 'PATCH','route'=> [ 'admin.employees.update', $employee->employeeID ],'class'   =>  'custom-form','id'  =>  'documents_details_form','files'=>true ] ) }}
                                <input type="hidden" name="updateType" class="form-control" value="documents">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label form="resume">{{trans('core.resume')}}</label>
                                        @if ( !isset( $documents[ 'resume' ] ) )
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
                                            </div> {{-- end of .fileinput --}}
                                        @else
                                            <a href="https://docs.google.com/viewer?url={{URL::to('employee_documents/resume/'.$documents['resume'])}}" target="_blank" class="btn blue"><span class="glyphicon">&#xe142;View Resume</span></a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="offer_letter">Offer Letter</label>
                                                @if ( !isset( $documents[ 'offerLetter' ] ) )
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
                                                                <input type="file" name="offerLetter">
                                                            </span>
                                                            <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                            {{trans('core.remove')}} </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="https://docs.google.com/viewer?url={{URL::to('employee_documents/offerLetter/'.$documents['offerLetter'])}}" target="_blank" class="btn blue"><span class="glyphicon">&#xe142;View Offer Letter</span></a>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="joining_letter">Joining Letter</label>
                                                @if ( !isset( $documents[ 'joiningLetter' ] ) )
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
                                                                <input type="file" name="joiningLetter">
                                                            </span>
                                                            <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                            {{trans('core.remove')}} </a>
                                                        </div>
                                                    </div> {{-- end of .fileinput --}}
                                                @else
                                                    <a href="https://docs.google.com/viewer?url={{URL::to('employee_documents/joiningLetter/'.$documents['joiningLetter'])}}" target="_blank" class="btn blue"><span class="glyphicon">&#xe142;View Joining Letter</span></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="contract_agreement">Contract and Agreement</label>
                                                @if(!isset($documents['contract']))
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
                                                                <input type="file" name="contract">
                                                            </span>
                                                            <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                            {{trans('core.remove')}} </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="https://docs.google.com/viewer?url={{URL::to('employee_documents/contract/'.$documents['contract'])}}" target="_blank"  class="btn blue"><span class="glyphicon">&#xe142;View Contract</span></a>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_proof">ID Proof</label>
                                                @if( !isset( $documents[ 'IDProof' ] ) )
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
                                                                <input type="file" name="IDProof">
                                                            </span>
                                                            <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                            {{trans('core.remove')}} </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="https://docs.google.com/viewer?url={{URL::to('employee_documents/IDProof/'.$documents['IDProof'])}}" target="_blank"  class="btn blue"><span class="glyphicon">&#xe142;View ID Proof</span></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div> {{-- end of .portlet-body --}}
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span>{{trans('core.companyDetails')}}</span>
                            </div>
                            <div class="actions btn-portlet-right">
                                <a href="javascript:;" onclick="UpdateDetails('{{$employee->employeeID}}','company');return false" data-loading-text="Updating..." class="demo-loading-btn-ajax btn btn-sm btn-default ">
                                    <span class="icon"><i class="fa fa-save fa-fw"></i></span>
                                    <span>{{trans('core.btnSave')}}</span>
                                </a>
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            {{Form::open(['class'   =>  'custom-form','id'  =>  'company_details_form'])}}
                                <input type="hidden" name="updateType" class="form-control" value="company">
                                <div id="alert_company">
                                {{--INLCUDE ERROR MESSAGE BOX--}}
                                @include('admin.common.error')
                                {{--END ERROR MESSAGE BOX--}}
                                </div>
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="employeeID">{{trans('core.employeeID')}}<span class="required">*</span></label>
                                                <input type="text" name="employeeID" class="form-control" readonly value="{{$employee->employeeID}}">
                                            </div>
                                        </div>
                                    </div>
                                    @if( count( $department ) == 0 )
                                         <div class="note note-warning">{{ Lang::get( 'messages.noDept' ) }}</div>
                                    @endif
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="department">{{trans('core.department')}}<span class="required">* </span></label>
                                                @if(isset($department) && isset($designation->deptID))
                                                    {{ Form::select('department', $department,$designation->deptID,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;']) }}
                                                @else
                                                    {{ Form::select('department', $department,null,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;']) }}
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="designation">{{trans('core.designation')}}<span class="required">* </span></label>
                                                <select  class="select2me form-control" name="designation" id="designation" ></select>
                                            </div>
                                            <div class="col-md-12">
                                            <br/>
                                           
                                                <label for="jobTitle">{{'Job Title'}}</label>
                                                <input type="text" class="form-control" name="jobTitle"  value="{{$employee->jobTitle}}" />
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $leavetypes = DB::table('leavetypes')->get();
                                    ?>
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
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="{{ $val->leaveType }}"> {{ ucfirst( str_replace('_', ' ', $val->leaveType)) }}</label>
                                                    <input type="number" min="0" step="1" name="leave[{{ $val->leaveType }}]" class="form-control" value="{{ ( $leave_count != '' ? $leave_count : 0) }}" />
                                                </div>
                                            </div>
                                        </div>
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
                                                {{ Form::select('employment_status', $employment_status, $employee->employment_status ,['class' => 'form-control select2me','id'=>'employment_status']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <label for="joiningDate">{{trans('core.dateOfJoining')}}</label>
                                                <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" name="joiningDate" readonly value="@if(empty($employee->joiningDate))00-00-0000 @else {{date('d-m-Y',strtotime($employee->joiningDate))}} @endif">
                                                    <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <label for="exit_date">{{trans('core.exitDate')}}</label>
                                                <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" name="exit_date" readonly value="@if(empty($employee->exit_date)) @else {{date('d-m-Y',strtotime($employee->exit_date))}} @endif">
                                                    <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="status">{{trans('core.status')}}</label>
                                                <input  type="checkbox" value="active" onchange="remove_exit();" class="make-switch" name="status" @if($employee->status=='active')checked   @endif data-on-color="success" data-on-text="Active" data-off-text="Inactive" data-off-color="danger" />
                                                <div>(<strong>Note:</strong>Status active will remove the exit date)</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="salary">SALARY ({{$setting->currency_symbol}})</label>
                                            </div>
                                        </div>
                                        @foreach( $employee->getSalary as $salary )
                                            <div id="salary-{{$salary->id}}" class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="type[{{$salary->id}}]" @if(($salary->type=='basic'))readonly @endif value="{{$salary->type}}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input step="any" min="0" type="number" class="form-control" name="salary[{{$salary->id}}]" value="{{$salary->salary}}">
                                                </div>
                                                @if( $salary->type != 'basic')
                                                    <div class="col-md-2">
                                                        <a class="delete-salary" onclick="del('{{$salary->id}}','{{$salary->type}}', this)"><i class="fa fa-trash"></i> </a>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                        <div class="add-salary" style="display: none">
                                            <a class="btn-red" data-toggle="modal" href="#static"><i class="fa fa-plus fa-fw"></i>Add Salary</a>
                                        </div>
                                    </div>
                                    
                                </div> {{-- end of .form-body --}}
                            {{Form::close()}}
                        </div> {{-- end of .portlet-body --}}
                    </div> {{-- end of .portlet --}}
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span>{{trans('core.bankDetails')}}</span>
                            </div>
                            <div class="actions btn-portlet-right">
                                <a href="javascript:;" onclick="UpdateDetails('{{$employee->employeeID}}','bank');return false" data-loading-text="Updating..."  class="demo-loading-btn-ajax btn btn-sm btn-default ">
                                    <span class="icon"><i class="fa fa-save fa-fw"></i></span>
                                    <span>{{trans('core.btnSave')}}</span>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            {{Form::open( [ 'id'  =>  'bank_details_form', 'class' => 'custom-form' ] )}}
                                <input type="hidden" name="updateType" class="form-control" value="bank">
                                <div id="alert_bank"></div>
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="accountName">{{trans('core.accountHolder')}}</label>
                                                <input type="text" name="accountName" class="form-control" value="{{$bank_details->accountName or ''}}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="accountNumber">{{trans('core.accountNumber')}}</label>
                                                <input type="text" name="accountNumber" class="form-control numeric-only" value="{{$bank_details->accountNumber or ''}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="bank">{{trans('core.bank')}}</label>
                                                <input type="text" name="bank" class="form-control" value="{{$bank_details->bank or ''}}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="branch">{{trans('core.branch')}}</label>
                                                <input type="text" name="branch" class="form-control" value="{{$bank_details->branch or '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- end of .form-body --}}
                            {{Form::close()}}
                        </div>
                    </div> {{-- end of .portlet --}}

                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span>Deduction Details</span>
                            </div>                            
                        </div>
                        <div class="portlet-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        @if($employee->employment_status == 'freelancer')
                                            <div class="col-md-12">
                                                <p>No deduction for freelancers.</p>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <label for="sss">SSS</label>
                                                <input type="text" class="form-control" name="sss" value="{{ number_format($sssContribution, 2) }}" readonly />
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pagibig">Pag-IBIG</label>
                                                <input type="text" class="form-control" name="pagibig" value="{{ number_format($pagIbigContribution, 2) }}" readonly />
                                            </div>                                        
                                            <div class="col-md-4">
                                                <label for="bank">PhilHealth</label>
                                                <input type="text" class="form-control" name="philhealth" value="{{ number_format($philHealthContribution, 2) }}" readonly />
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div> {{-- end of .form-body --}}
                        </div>
                    </div> {{-- end of .portlet --}}
                </div>
            </div>
        </div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}

                         {{-- DELETE MODAL CALLING --}}
                            @include('admin.common.delete')
                        {{-- DELETE MODAL CALLING END --}}

                        {{-- NEW SALARY ADD MODALS --}}

                <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><strong>New Salary</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="portlet-body form">

                            {{-- BEGIN OF FORM --}}
                                {{Form::open(array('route'=>"admin.salary.store",'class'=>'form-horizontal ','method'=>'POST'))}}
                                <input   type="hidden" name="employeeID" value="{{$employee->employeeID}}"/>

                                    <div class="form-body">

                                        <div class="form-group">
                                             <div class="col-md-6">
                                                <input class="form-control form-control-inline" name="type" type="text" value="" placeholder="Type"/>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                            <div class="col-md-6">
                                                <input class="form-control form-control-inline"  type="text" name="salary" placeholder="Salary"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" data-loading-text="Updating..."  class="demo-loading-btn btn green"><i class="fa fa-check"></i> Submit</button>

                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                 <!-- -----------END FORM-------->
                                </div>
                             </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
                        </div>

                        </div>
                    </div>
                </div>

 {{------------------------------------END NEW SALARY ADD MODALS--------------------------------------}}

@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
    {{ HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
    {{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{ HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    {{ HTML::script('assets/admin/pages/scripts/components-pickers.js')}}

<!-- END PAGE LEVEL PLUGINS -->




<script>
        jQuery(document).ready(function() {
           ComponentsPickers.init();
            dept();

        });

 @if(Session::get('successDocuments'))
         showToastrMessage('{{ Session::get('successDocuments') }}', '{{Lang::get('messages.success')}}', 'success');

 @endif

 @if(Session::get('errorDocuments'))
    showToastrMessage('{{ Session::get('errorDocuments') }}', '{{Lang::get('messages.success')}}', 'error');
 @endif


  @if(Session::get('successPersonal'))
    showToastrMessage('{{ Session::get('successPersonal') }}', '{{Lang::get('messages.success')}}', 'success');
  @endif

      function dept(){

                  $.getJSON("{{ route('admin.departments.ajax_designation')}}",
                  { deptID: $('#department').val() },
                  function(data) {
                       var model = $('#designation');
                             model.empty();
                       var selected='';
                       var match= {{ $employee->designation}};
                      $.each(data, function(index, element) {
                          if(element.id==match)selected='selected';
                          else selected='';
                          model.append("<option value='"+element.id+"' "+selected+">" + element.designation + "</option>");
                      });

                 });


            }

// Javascript function to update the company info and Bank Info
       function UpdateDetails(id,type){

           var  form_id = '';
           var alert_div = '';

            if(type=='bank')
            {

                form_id     = '#bank_details_form';
                alert_div   =  '#alert_bank'

            }else
            {
                form_id     = '#company_details_form';
                alert_div   =   '#alert_company';
            }

                    var url = "{{ route('admin.employees.update',':id') }}";
                    url = url.replace(':id',id);
                    console.log(url);
                     Metronic.blockUI({
                                        target: form_id,
                                        boxed: true
                                    });
              $.ajax({
                             type: "PATCH",
                             url : url,
                             dataType: 'json',
                             data: $(form_id).serialize()

                     }).done( function( response ) {
            console.log(response);       
                  $(alert_div).html('');
                         if(response.status == "success")
                         {
                                 showToastrMessage(response.msg, '{{Lang::get('messages.success')}}', 'success');
//                               $(alert_div).html('<div class="alert alert-success alert-dismissable"><button class="close" data-close="alert"></button><span class="fa fa-check"></span> '+response.msg+'</div>');

                         }else if(response.status == "error")
                         {
                             var arr = response.msg;
                             var alert ='';
                             $.each(arr, function(index, value)
                             {
                                 if (value.length != 0)
                                 {
                                    alert += '<p><span class="fa fa-warning"></span>'+ value+ '</p>';

                                 }
                             });

                             $(alert_div).append('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> '+alert+'</div>');
                         }
                         Metronic.unblockUI(form_id);
                     }).error(function (d) { 
            console.log(d); 
             });
       }

function del(id,type,this_btn)
        {

            var alert_div   =   '#alert_company';
            $('#deleteModal').appendTo("body").modal('show');
            $('#info').html('Are you sure ! You want to delete <strong>'+type+'</strong> Salary??.');
            $("#delete").click(function()
            {
                // NProgress.start();
                var url = "{{ route('admin.salary.destroy',':id') }}";
                url = url.replace(':id',id);


            $.ajax({
                type: "POST",
                url : "{{ url('api/delete/salary') }}/" + id,
                dataType: 'json',
                })
                .done(function(response){
                 if(response.success == "deleted"){
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#deleteModal').modal('hide');
                    $('#row'+id).fadeOut(500);
                    showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success'); 
                    $(this_btn).closest('.row').remove();
                }
                    });
                })

            }

    function remove_exit()
    {
        if($("input[name=status]:checked").val() == "active"){
            $("input[name=exit_date]").val("");
        }
    }


    $("input[name=exit_date]").change(function () {
      $("input[name=status]").bootstrapSwitch('state',false);

    });
    </script>

@if(Session::get('successDocuments'))
    {{--Move to bottom of page if success comes from documents--}}
    <script>
            $("html, body").animate({ scrollTop: $(document).height() }, 2000);
    </script>
 @endif

@stop
