@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{ HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css") }}
    {{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
    {{ HTML::style("assets/global/plugins/icheck/skins/all.css") }}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        @include('admin.common.error')
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet box">
                    <div class="portlet-title has-pad">
                        <div class="title-left">
                            <span class="icon"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></span>
                            <span>{{trans('core.edit')}} {{trans('core.item')}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> {{-- end of .portlet-title --}}
                    <div class="portlet-body">
                        {{Form::open(array('route'=>["admin.expenses.update",$expense->id],'class'=>'form-horizontal form-bordered custom-form','method'=>'PATCH','files'=>true))}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{trans('core.item')}}  <span class="required"> * </span></label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="itemName" placeholder="{{trans('core.item')}}" value="{{ $expense->itemName }}">
                                    </div>
                                </div> {{-- end of .form-group --}}
                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.purchaseFrom')}} : </label>
                                <div class="col-md-6">
                                <input type="text" class="form-control" name="purchaseFrom" placeholder="{{trans('core.purchaseFrom')}}" value="{{ $expense->purchaseFrom }}" >
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.date')}}:</label>
                                <div class="col-md-6">
                                <div class="input-group input-medium date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input type="text" class="form-control" name="purchaseDate" readonly value="{{date('d-m-Y',strtotime($expense->purchaseDate));}}">
                                <span class="input-group-btn">
                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                                </div>
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.price')}}:<span class="required">  * </span>   {{$setting->currency_symbol}}</label>
                                <div class="col-md-6">
                                <input step="1" min="0" type="number" class="form-control" name="price" placeholder="Price of Item" value="{{ $expense->price }}">
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.paidBy')}}:<span class="required">  * </span></label>

                                <div class="col-md-6">
                                {{ Form::select('employeeID', $employees,$expense->employeeID,['class' => 'form-control input-xlarge select2me','data-placeholder'=>'Select Employee...']) }}
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Attach Bill:</label>
                                <input type="hidden" name="billhidden" value="{{$expense->bill}}">
                                <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                <span class="fileinput-new">
                                {{trans('core.selectFile')}}  </span>
                                <span class="fileinput-exists">
                                {{trans('core.change')}}  </span>
                                <input type="file" name="bill">
                                </span>
                                <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                {{trans('core.remove')}}  </a>
                                </div>

                                </div>
                                </div>
                                <div class="col-md-4">

                                @if($expense->bill!='')
                                <a href="https://docs.google.com/viewer?url={{URL::to('expense/bills/'.$expense->bill)}}" target="_blank"  class="btn purple">View Bill</a>
                                @endif
                                </div>

                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label"> {{trans('core.status')}} :<span class="required">  * </span></label>

                                <div class="col-md-6">


                                <label><input type="radio" name="status" @if($expense->status=='approved') checked @endif class="icheck" value="approved" > {{trans('core.approved')}} </label>
                                <label><input type="radio" name="status"    @if($expense->status=='pending') checked @endif class="icheck" value="pending"> {{trans('core.pending')}} </label>
                                <label><input type="radio" name="status"    @if($expense->status=='rejected') checked @endif class="icheck" value="rejected"> {{trans('core.rejected')}} </label>

                                </div>
                                </div>
                                <div class="btn-panel">
                                    <button type="submit" data-loading-text=" {{trans('core.btnUpdating')}} " class="demo-loading-btn btn btn-1">
                                        <span class="icon"><i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i></span>
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
{{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
{{ HTML::script("assets/admin/pages/scripts/components-pickers.js") }}
{{ HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") }}
{{ HTML::script('assets/global/plugins/icheck/icheck.min.js') }}
{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
<!-- END PAGE LEVEL PLUGINS -->
<script>
jQuery(document).ready(function() {

           ComponentsPickers.init();


        });
</script>
@stop