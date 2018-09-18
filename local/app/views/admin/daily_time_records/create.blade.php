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
                            <span>{{'Add daily time record '}}</span>
                            <div class="tools"></div>
                        </div>
                    </div> {{-- end of .portlet-title --}}
                    <div class="portlet-body form">
                        {{Form::open(array('url'=>"admin/employees/dtr/store",'class'=>'form-horizontal form-bordered','method'=>'POST'))}}
                            <div class="form-body">

                                <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('core.employee')}} {{trans('core.name')}}:</label>
                                <div class="col-md-8">
                                {{ Form::select('employeeID', $employees,null,['class' => 'form-control input-xlarge select2me','data-placeholder'=>'Select Employee...']) }}
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">{{'Time In'}} <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-4">
                                <input type="text" class="form-control ot-time-in required"  id="typeahead_example_1" name="timeIn" placeholder="2018/09/17 12:30 PM" >
                                <input type="hidden" class="form-control"  id="typeahead_example_1" name="status"  value="1">
                                
                                </div>
                               
                                <label class="col-md-2 control-label">{{'Time Out'}} <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-4">
                                <input type="text" class="form-control ot-time-in required" name="timeOut" placeholder="2018/09/17 21:30 PM" >
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <label class="col-md-2 control-label">{{'Break Out'}} <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-4">
                                <input type="text" class="form-control ot-time-in required" id="typeahead_example_1" name="breakOut" placeholder="2018/09/17 13:00 PM" >
                                </div>
                               
                                <label class="col-md-2 control-label">{{'Break In'}} <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-4">
                                <input type="text" class="form-control ot-time-in required" name="breakIn" placeholder="2018/09/17 14:00 PM"  >
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
                format: 'YYYY/MM/DD HH:mm A',
                formatDate: 'YYYY/MM/DD HH:mm A',
                formatTime: 'HH:mm A', 
                datepicker: true,
                timepicker: true,
                allowTimes: allow_time,
                hours12: false,
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
                formatTime: 'HH:mm A', 
                // format: 'YYYY/MM/DD H:mm',
                // formatDate: 'YYYY/MM/DD H:mm',
                datepicker: true,
                timepicker: true,
                allowTimes: allow_time,
                hours12: false,
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
<!-- END PAGE LEVEL PLUGINS -->
@stop