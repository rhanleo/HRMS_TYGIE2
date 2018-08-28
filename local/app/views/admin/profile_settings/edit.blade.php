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
            <div class="col-xs-12 col-md-6">
                <div class="portlet box">
                    <div class="portlet-title has-pad">
                        <div class="title-left">
                            <span class="icon"><i class="fa fa-cog fa-fw"></i></span>
                            <span>{{trans('core.loginDetails')}} {{$pageTitle}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> {{-- end of .portlet-title --}}
                    <div class="portlet-body form">
                        {{ Form::model($admin, ['method' => 'PATCH','route' => ['admin.profile_settings.update', $admin->id],'class'=>'form-horizontal form-bordered']) }}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{trans('core.name')}}: <span class="required">
                                    * </span>
                                    </label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Administrator Name" value="{{ $admin->name }}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{trans('core.loginEmail')}}: <span class="required">
                                    * </span>
                                    </label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $admin->email}}" >
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="btn-panel">
                                    <button type="submit" data-loading-text="{{trans('core.btnUpdating')}}..." class="demo-loading-btn btn btn-1">
                                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                                        <span class="text">{{trans('core.btnUpdate')}}</span>
                                    </button>
                                </div> {{-- end of .btn-panel --}}
                            </div>
                        {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div> {{-- end of .portlet --}}
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="portlet box">
                    <div class="portlet-title has-pad">
                        <div class="title-left">
                            <span class="icon"><i class="fa fa-key fa-fw"></i></span>
                            <span>{{trans('core.change')}} {{trans('core.password')}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> {{-- end of .portlet-title --}}
                    <div class="portlet-body">
                    {{ Form::model($admin, ['method' => 'PATCH', 'route' => ['admin.profile_settings.update'],'class'=>'form-horizontal form-bordered']) }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{trans('core.password')}}: <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="{{trans('core.password')}}" >
                                </div>
                            </div> {{-- end of .form-group --}}
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{trans('core.confirmPassword')}}: <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{trans('core.confirmPassword')}}" >
                                </div>
                            </div> {{-- end of .form-group --}}
                            <div class="btn-panel">
                                <button type="submit" data-loading-text="{{trans('core.btnUpdating')}}..." class="demo-loading-btn btn btn-1">
                                    <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                                    <span class="text">{{trans('core.btnUpdate')}}</span>
                                </button>
                            </div>
                        </div> {{-- end of .form-body --}}
                    {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div>
            </div>
        </div>
    </div> {{-- end of .content-section --}}

@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{ HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") }}
{{ HTML::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js') }}

{{ HTML::script('assets/global/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}
{{ HTML::script('assets/admin/pages/scripts/components-dropdowns.js') }}



<script>
        jQuery(document).ready(function() {

           ComponentsDropdowns.init();
        });
    </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop
