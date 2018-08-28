@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
    {{HTML::style("assets/global/plugins/typeahead/typeahead.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        @include('admin.common.error')
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet box">
                    <div class="portlet-title has-pad">
                        <div class="title-left">
                            <span class="icon"><i class="fa fa-trophy fa-fw"></i></span>
                            <span>{{trans('core.giveAnAward')}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> {{-- end of .portlet-title --}}
                    <div class="portlet-body form">
                        {{Form::open(array('url'=>"admin/awards",'class'=>'form-horizontal form-bordered','method'=>'POST'))}}
                            <div class="form-body">
                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.awardName')}} <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-6">
                                <input type="text" class="form-control" id="typeahead_example_1" name="awardName" placeholder="{{trans('core.awardName')}}" value="{{ Input::old('awardName') }}">
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.gift')}} <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-6">
                                <input type="text" class="form-control" name="gift" placeholder="{{trans('core.gift')}}" value="{{ Input::old('gift') }}" >
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.cashPrice')}}  {{$setting->currency_symbol}}</label>

                                <div class="col-md-6">
                                <input step="1" min="0" type="number" class="form-control" name="cashPrice" placeholder="{{trans('core.cashPrice')}}" value="{{ Input::old('cashPrice') }}">
                                </div>
                                </div>


                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.employee')}} {{trans('core.name')}}:</label>

                                <div class="col-md-8">
                                {{ Form::select('employeeID', $employees,null,['class' => 'form-control input-xlarge select2me','data-placeholder'=>'Select Employee...']) }}
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">Month:</label>

                                <div class="col-md-3">
                                <select class="form-control  select2me" name="forMonth">
                                <option value="" selected="selected">{{trans('core.month')}}</option>
                                <option value="january"  @if(strtolower(date('F'))=='january')selected='selected'@endif >{{trans('core.jan')}}</option>
                                <option value="february" @if(strtolower(date('F'))=='february')selected='selected'@endif>{{trans('core.feb')}}</option>
                                <option value="march"    @if(strtolower(date('F'))=='march')selected='selected'@endif>{{trans('core.mar')}}</option>
                                <option value="april"    @if(strtolower(date('F'))=='april')selected='selected'@endif>{{trans('core.apr')}}</option>
                                <option value="may"      @if(strtolower(date('F'))=='may')selected='selected'@endif>{{trans('core.may')}}</option>
                                <option value="june"     @if(strtolower(date('F'))=='june')selected='selected'@endif>{{trans('core.june')}}</option>
                                <option value="july"     @if(strtolower(date('F'))=='july')selected='selected'@endif>{{trans('core.july')}}</option>
                                <option value="august"   @if(strtolower(date('F'))=='august')selected='selected'@endif>{{trans('core.aug')}}</option>
                                <option value="september" @if(strtolower(date('F'))=='september')selected='selected'@endif>{{trans('core.sept')}}</option>
                                <option value="october"  @if(strtolower(date('F'))=='october')selected='selected'@endif>{{trans('core.oct')}}</option>
                                <option value="november" @if(strtolower(date('F'))=='november')selected='selected'@endif>{{trans('core.nov')}}</option>
                                <option value="december" @if(strtolower(date('F'))=='december')selected='selected'@endif>{{trans('core.dec')}}</option>
                                </select>
                                </div>

                                <label class="col-md-2 control-label">{{trans('core.year')}}:</label>

                                <div class="col-md-3">
                                {{ Form::selectYear('forYear', 2013, date('Y'),date('Y'),['class' => 'form-control select2me']) }}

                                </div>
                                </div>

                                </div>
                                <div class="btn-panel">
                                    <button type="submit" data-loading-text="{{trans('core.btnSubmitting')}}" class="demo-loading-btn btn btn-1">
                                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                                        <span class="text">{{trans('core.btnSubmit')}}</span>
                                    </button>
                                </div>
                            </div> {{-- end of .form-body --}}
                        {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div> {{-- end of .portlet --}}
            </div>
        </div>
    </div> {{-- end of .content-section --}}
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
{{HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
{{HTML::script("assets/admin/pages/scripts/components-form-tools.js")}}
{{HTML::script("assets/global/plugins/typeahead/typeahead.bundle.min.js")}}

{{HTML::script("assets/admin/pages/scripts/components-form-tools.js")}}
<script>
   var handleTwitterTypeahead = function() {

          // Example #1
          // instantiate the bloodhound suggestion engine
          var numbers = new Bloodhound({
            datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: [
              { num: '{{trans('core.employeeOfMonth')}}' },
              { num: '{{trans('core.workAppreciation')}}' }
            ]
          });

          // initialize the bloodhound suggestion engine
          numbers.initialize();

          // instantiate the typeahead UI

          $('#typeahead_example_1').typeahead(null, {
            displayKey: 'num',
            hint: (Metronic.isRTL() ? false : true),
            source: numbers.ttAdapter()
          });


      }
       handleTwitterTypeahead();
</script>
<!-- END PAGE LEVEL PLUGINS -->
@stop