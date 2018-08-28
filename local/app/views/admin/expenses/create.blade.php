@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{ HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css") }}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
    {{ HTML::style("assets/global/plugins/icheck/skins/all.css") }}
@stop
@section('mainarea')
    <div class="content-section">
        @include('admin.common.error')
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box">
                    <div class="portlet-title has-pad">
                        <div class="title-left">
                            <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                            <span>{{trans('core.add')}} {{trans('core.new')}} {{trans('core.item')}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> {{-- end of .portlet-title --}}
                    <div class="portlet-body form">
                        {{Form::open(array('route'=>"admin.expenses.store",'class'=>'form-horizontal form-bordered','method'=>'POST','files'=>true))}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.item')}} {{trans('core.name')}}: <span class="required">
                                    * </span>
                                    </label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="itemName" placeholder="{{trans('core.item')}} {{trans('core.name')}}" value="{{ Input::old('itemName') }}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.purchaseFrom')}}
                                    </label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="purchaseFrom" placeholder="{{trans('core.purchaseFrom')}}" value="{{ Input::old('purchaseFrom') }}" >
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.date')}}:
                                    </label>
                                    <div class="col-md-6">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control" name="purchaseDate" readonly >
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                    </div>
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.price')}}:<span class="required">  * </span>   {{$setting->currency_symbol}}</label>

                                    <div class="col-md-6">
                                    <input step="1" min="0" type="number" class="form-control" name="price" placeholder="{{trans('core.price')}}" value="{{ Input::old('price') }}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.paidBy')}}:<span class="required">  * </span></label>
                                    <div class="col-md-6">
                                    {{ Form::select('employeeID', $employees,null,['class' => 'form-control input-xlarge select2me','data-placeholder'=>'Select Employee...']) }}
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Attach Bill:</label>
                                    <div class="col-md-6">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                    </span>
                                    </div>
                                    <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new">
                                    {{trans('core.selectFile')}} </span>
                                    <span class="fileinput-exists">
                                    {{trans('core.change')}}  </span>
                                    <input type="file" name="bill">
                                    </span>
                                    <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                    {{trans('core.remove')}}  </a>
                                    </div>
                                    </div>
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        {{trans('core.status')}}:<span class="required">  * </span></label>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="radio" name="status"  class="icheck" value="approved" checked="checked" />
                                                    <span class="text">{{trans('core.approved')}} </span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="radio" name="status"  class="icheck" value="pending" />
                                                    <span class="text">{{trans('core.pending')}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="btn-panel">
                                    <button type="submit" data-loading-text="{{trans('core.btnSubmitting')}}" class="demo-loading-btn btn btn-1">
                                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                                        <span>{{trans('core.add')}}</span>
                                    </button>
                                </div>
                            </div> {{-- end of .form-body --}}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- end of .content-section --}}
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
{{ HTML::script("assets/admin/pages/scripts/components-pickers.js") }}
{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{ HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") }}
{{ HTML::script('assets/global/plugins/icheck/icheck.min.js') }}
<!-- END PAGE LEVEL PLUGINS -->
<script>
jQuery(document).ready(function() {

           ComponentsPickers.init();


        });
</script>
@stop