@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
    {{ HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") }}
    {{ HTML::style("assets/global/plugins/select2/select2.css") }}
    {{ HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") }}
@stop
@section('mainarea')
    <div class="content-section">
        <div id="load">
            @include('admin.common.error')
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet box">
                    <div class="portlet-title has-pad">
                        <div class="title-left">
                            <span class="icon"><i class="fa fa-cogs fa-fw"></i></span>
                            <span>{{trans('core.edit')}} {{$pageTitle}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> <!-- end of .portlet-title -->
                    <div class="portlet-body form">
                        {{ Form::model($setting, ['method' => 'PATCH','files' => true, 'route' => ['admin.settings.update', $setting->id],'class'=>'form-horizontal form-bordered']) }}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('core.companyLogo')}}</label>
                                    <div class="col-md-6">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                        {{HTML::image('assets/admin/layout/img/'.$setting->logo)}}

                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                        <span class="btn default btn-file">
                                        <span class="fileinput-new">
                                        Change Logo </span>
                                        <span class="fileinput-exists">
                                        {{trans('core.change')}} </span>
                                        <input type="file" name="logo">
                                        </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        {{trans('core.remove')}} </a>
                                        </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                        <span class="label label-danger">
                                        NOTE!</span> Image Size must be height 40px
                                        </div>
                                    </div>
                                </div> {{-- end of .form -group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.companyName')}}: <span class="required">
                                    * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="website" placeholder="Website Title" value="{{ $setting->website }}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.companyAddress')}}:</label>
                                    <div class="col-md-6">
                                    <textarea class="form-control" name="address" placeholder="Company Address" >{{$setting->address}}</textarea>
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.phone')}}:
                                    </label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="contact"  value="{{ $setting->contact }}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.email')}}: <span class="required">
                                    * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="email"  value="{{ $setting->email}}" >
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Name: <span class="required">  * </span></label>

                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $setting->name}}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="control-label col-md-2">Currency</label>
                                    <div class="col-md-6">
                                    <select class="select2me form-control" data-show-subtext="true" name="currency">
                                        @foreach($countries as $country)
                                        <option  value="{{$country->currency_symbol}}:{{$country->currency_code}}" @if($setting->currency==$country->currency_code) selected @endif>{{$country->currency_code}} {{$country->currency_symbol}} </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div> {{-- end of .form-group --}}

                                <div class="form-group">
                                    <label class="control-label col-md-2">Enable 2 Payroll Periods</label>
                                    <div class="col-md-6">
                                        <input onchange="toggle_enable_two_payroll_period(this)" type="checkbox" class="make-switch" name="enable_two_payroll_period" @if( $setting->enable_two_payroll_period == 1 ) checked  @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                                    </div>
                                </div> {{-- end of .form-group --}}

                                <div class="form-group" id="deduction_period">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">SSS Deduction Period</label><br>
                                            <input type="checkbox" class="make-switch" name="sss_deduction_period" @if( $setting->sss_deduction_period == 1 ) checked  @endif data-on-color="success" data-on-text="1st" data-off-text="2nd" data-off-color="primary">
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Pag-IBIG Period</label><br>
                                            <input type="checkbox" class="make-switch" name="pagibig_deduction_period" @if( $setting->pagibig_deduction_period == 1 ) checked  @endif data-on-color="success" data-on-text="1st" data-off-text="2nd" data-off-color="primary">
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="control-label">Phil Health</label><br>
                                            <input type="checkbox" class="make-switch" name="philhealth_deduction_period" @if( $setting->philhealth_deduction_period == 1 ) checked  @endif data-on-color="success" data-on-text="1st" data-off-text="2nd" data-off-color="primary">
                                        </div>
                                    </div>
                                   
                                </div> {{-- end of .form-group --}}


                                <div class="btn-panel">
                                    <button type="submit" data-loading-text="{{trans('core.btnUpdating')}}..." class="demo-loading-btn btn btn-1">
                                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                                        <span class="text">{{trans('core.btnUpdate')}}</span>
                                    </button>
                                </div> {{-- end of .btn-panel --}}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end of .content-section -->
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{ HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") }}
{{ HTML::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js') }}
{{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
{{ HTML::script('assets/global/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}
{{ HTML::script('assets/admin/pages/scripts/components-dropdowns.js') }}

    <script>
        jQuery(document).ready(function() {
            ComponentsDropdowns.init();
            toggle_enable_two_payroll_period('input[name=enable_two_payroll_period]');
        });

        function toggle_enable_two_payroll_period(checkbox){
            if ($(checkbox).is(':checked')) {
                $('#deduction_period').slideDown();
            }
            else{
                $('#deduction_period').slideUp();
            }
        }
    </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop