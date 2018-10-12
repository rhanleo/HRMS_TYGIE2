{{HTML::style("assets/global/plugins/select2/select2.css")}}
{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}

@foreach($mycalendars as $mycalendar)
<div class="form-body">
                

                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">Start Date:</label>
                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                <input class="form-control required" value="{{$mycalendar['start_date']}}" name="start_date" placeholder="select date" readonly="" type="text">
                <span class="input-group-btn">
                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                </span>
                </div>
                <div class="start_date_error"></div>
                </div>
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">End Date:</label>
                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                <input class="form-control required " value="{{$mycalendar['end_date']}}" name="end_date" placeholder="select date" readonly="" type="text">
                <span class="input-group-btn">
                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                </span>

                </div>
                <div class="end_date_error"></div>
                </div>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-12">
                <label class="text-success" style="margin-bottom:6px;">Title</label>
                <textarea class="form-control" value="" name="title" id="reason" rows="3" maxlength="500" style="width:100%">{{$mycalendar['title']}}</textarea>
                </div>
                </div>
                </div>
                </div>
@endforeach
{{-- This is ajax called inside the index page modal  --}}
{{ HTML::script("assets/global/plugins/jquery.min.js") }}
{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
{{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}


{{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
{{ HTML::script("assets/admin/pages/scripts/components-pickers.js")}}

<script>
jQuery(document).ready(function() {

ComponentsPickers.init();

});
</script>

