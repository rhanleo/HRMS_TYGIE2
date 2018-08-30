@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}
    {{HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">  
       
            {{ Form::open( array( 'route'=>"admin.schedule.store", 'class' => 'custom-form', 'method'=>'POST', 'files' => true ) ) }}
                
                <div class="row"> <!--rows -->
                    <span><strong> Employee ID:</strong>  {{$employee['employeeID'] }}</span><br/>
                    <span><strong>  Name:</strong>  {{$employee['firstName'] . " " . $employee['lasstName'] }}</span>
                    <hr>
                    <div class="col-md-6"> <!--col -->
                        
                            <input type="hidden" name="employeeID" value="{{$employee['employeeID']}}" >
                            <input type="hidden" name="name" value="{{$employee['firstName'] . $employee['lastName']}}" > 
                        
                        <div class="form-group">
                            <label>Date</label>
                                <span>From</span>
                                <input  type="text"  placeholder="dd-mm-yyyy" style="margin-right: 60px;" name="dateFrom" class=" date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <span>To</span>
                                <input type="text" placeholder="dd-mm-yyyy" name="dateTo" class=" date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                
                        </div>
                        <div class="form-group">
                        <label>Time</label>
                                <span> From</span>
                                <input type="text" style="margin-right: 60px;"   name="timeFrom"  placeholder="9:30 AM">

                                <span>To</span>
                                <input type="text"  name="timeTo" placeholder="6:30 PM">

                        </div>
                        <div class="form-group">
                            <label>Shift</label>
                            <span>Select</span>
                            <select name="shift">
                                <option value="Openning">Openning</option>
                                <option value="Midshift">Midshift</option>
                                <option value="Closing">Closing</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                           
                            <textarea name="remarks" style="width: 90%;"></textarea>
                        </div> 

                            <div class="btn-panel btn-add-employee">
                                <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn btn-1">
                                    <span class="icon"><i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i></span>
                                    <span>{{trans('core.btnSubmit')}}</span>
                                </button>
                            </div>
                    </div> <!-- Endcol -->
                    <div class="col-md-6"> <!--col --> 
                    </div> <!-- Endcol --> 
                </div> <!--end rows -->
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
    });
</script>

@stop
