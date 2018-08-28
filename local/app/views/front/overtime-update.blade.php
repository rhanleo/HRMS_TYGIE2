@extends('front.layouts.frontlayout')

@section('head')
{{HTML::style("assets/global/css/components.css")}}
{{HTML::style("assets/global/css/plugins.css")}}
{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop

@section('mainarea')
    <div class="col-md-9">
        <!--Profile Body-->
        <div class="profile-body">
            <div class="row margin-bottom-20">
                <!--Profile Post-->
                <div class="col-sm-12">
                {{-- Error Messages --}}
                    <div id="alert_message">
                        @if(Session::get('success_overtime'))
                            <div class="alert alert-success"><i class="fa fa-check"></i> {{ Session::get('success_overtime') }}</div>
                        @endif
                        
                        @if(Session::get('error_overtime'))
                            <div class="alert alert-danger"><i class="fa fa-times"></i> {{ Session::get('error_overtime') }}</div>
                        @endif
                    </div>
                {{-- Error Messages --}}

                    <div class="panel">
                        <div class="panel-heading service-block-u">
                            <h3 class="panel-title"><i class="fa fa-tasks"></i> Update overtime</h3>
                        </div>

                        <div class="panel-body">
                            {{Form::open( ['url' => route('front.overtime.update', $overtime_application->id),'class'=>'form-horizontal sky-form', 'id' => 'overtime-form', 'method'=>'POST'] )}}
                                <div class="append-ot-time">

                                    <div class="row margin-bottom-10" id="ot_row_0">
                                        <div class="col-md-4 col-xs-11">
                                            <label for="">Time Start:</label>
                                            <input type="text" class="form-control ot-time-in required" name="ot_time_in[0]" value="{{ $overtime_application->start_date }}">
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label for="">Time End:</label>
                                            <input type="text" class="form-control ot-time-out required" name="ot_time_out[0]" value="{{ $overtime_application->end_date }}">
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label for="">Reason</label>
                                            <textarea class="form-control required" name="ot_reason[0]">{{ $overtime_application->reason }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            <button type="submit" class="btn-u btn-u-green"><i class="fa fa-check"></i> Update</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div><!--/end row-->
        </div>
    </div><!--End Profile Body-->
</div>


{{-- Show Notice MODALS --}}


<div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myLargeModalLabel" class="modal-title">
                Overtime Application
                </h4>
            </div>
            <div class="modal-body" id="modal-data">
                {{--Notice full Description using Javascript--}}
            </div>
        </div>
    </div>
</div>


  {{-- END Notice MODALS --}}

@stop

@section('footerjs')
{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    
    <script>

        init_datetimepicker();

        @if (Session::get('error_leave'))
            $("html, body").animate({ scrollTop: $('#applications').height()+600 }, 2000);
        @endif


    </script>


@stop