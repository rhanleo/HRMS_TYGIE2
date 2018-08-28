@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div id="load">@include('admin.common.error')</div>
            <div class="row">
                <div class="col-md-3">
                    <div class="portlet box">
                        <div class="portlet-title has-pad">
                            <div class="title-left">{{ date( 'Y' ) }}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="month-list">
                                <ul>
                                    @foreach($months as $month)
                                        <li @if($month == $currentMonth) class="active" @endif >
                                            <a data-toggle="tab" href="#{{ $month }}">{{ trans('core.'.$month.'') }}</a>
                                            <span class="after"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div> {{-- end of .portlet --}}
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        @foreach($months as $month)
                            <div id="{{$month}}" class="tab-pane @if($month == $currentMonth) active @endif">
                                <div class="portlet box">
                                    <div class="portlet-title">
                                        <div class="title-left">
                                            <span>Holiday Schedule</span>
                                        </div>
                                        <div class="btn-portlet-right">
                                            <a class="btn green" data-toggle="modal" href="#static">
                                                <span class="icon"><i class="fa fa-plus"></i></span>
                                                <span>{{trans('core.btnAddHoliday')}}</span>
                                            </a>
                                        </div>
                                    </div> {{-- end of .portlet-title --}}
                                    <div class="portlet-body">
                                        <div class="check-holidays">
                                            <div class="month">{{ trans('core.'.$month.'') }}</div>
                                            <div class="days">
                                                <div class="label">Mark All Holidays</div>
                                                <ul>
                                                    <li>
                                                        {{-- @if($number_of_fridays!=$number_of_fri_db)
                                                            <a class="btn green" href="{{URL::to('admin/holidays/mark_friday ')}}">
                                                            {{trans('core.markAll')}}  {{trans('core.friday')}} {{trans('core.holiday')}}
                                                            <i class="fa fa-check"></i> </a>
                                                        @endif --}}
                                                        <label>
                                                            <input type="checkbox" name="friday" />
                                                            <span>Friday</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        {{-- @if($number_of_saturdays!=$number_of_sat_db)
                                                            <a class="btn green" href="{{URL::to('admin/holidays/mark_saturday ')}}">
                                                            {{trans('core.markAll')}}  {{trans('core.saturday')}} {{trans('core.holiday')}}
                                                            <i class="fa fa-check"></i> </a>
                                                        @endif --}}
                                                        <label>
                                                            <input type="checkbox" name="saturday" />
                                                            <span>Saturday</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        {{-- @if($number_of_sundays!=$number_of_sun_db)
                                                            <a class="btn green" href="{{URL::to('admin/holidays/mark_sunday ')}}">
                                                            {{trans('core.markAll')}}  {{trans('core.sunday')}} {{trans('core.holiday')}}
                                                            <i class="fa fa-check"></i> </a>
                                                        @endif --}}
                                                        <label>
                                                            <input type="checkbox" name="sunday" />
                                                            <span>Sunday</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="table-scrollable">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('core.date')}}</th>
                                                        <th>{{trans('core.occasion')}}</th>
                                                        <th>{{trans('core.day')}}</th>
                                                        <th style="width: 110px;">{{trans('core.action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($holidaysArray[$month]))
                                                        @for($i=0;$i<count($holidaysArray[$month]['date']);$i++)
                                                            <tr id="row{{ $holidaysArray[$month]['id'][$i] }}">
                                                                <td> {{($i+1)}} </td>
                                                                <td> {{ $holidaysArray[$month]['date'][$i] }} </td>
                                                                <td> {{ $holidaysArray[$month]['ocassion'][$i] }} </td>
                                                                <td> {{ $holidaysArray[$month]['day'][$i] }} </td>
                                                                <td style="width: 110px;">
                                                                    <div class="btn-actions">
                                                                        <a href="#" class="btn btn-1 tooltips" data-original-title="View"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>
                                                                        <button type="button" data-container="body" data-placement="top" data-original-title="{{trans('core.btnDelete')}}" onclick="del('{{ $holidaysArray[$month]['id'][$i] }}',' {{ $holidaysArray[$month]['date'][$i] }}')" href="#" class="btn btn-1 tooltips"><i class="fa fa-trash fa-fw"></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> {{-- end of .portlet-body --}}
                                </div> {{-- end of .portlet --}}
                            </div>
                        @endforeach
                    </div> {{-- end of .tab-content --}}
                </div>
            </div> {{-- end of .row --}}
        </div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}
    @include('admin.common.delete')
    <div id="static" class="modal fade addNew-modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>{{trans('core.holiday')}}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        {{Form::open(array('route'=>"admin.holidays.store",'class'=>'form-horizontal ','method'=>'POST'))}}
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" name="date[0]" type="text" value="" placeholder="{{trans('core.date')}}"/>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline"  type="text" name="occasion[0]" placeholder="{{trans('core.occasion')}}"/>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="plusButton" class="btn btn-1 form-control-inline" style="margin: 0;">
                                            <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                            <span>{{trans('core.add')}} {{trans('core.more')}}</span>
                                        </button>
                                    </div>
                                </div>
                                <div id="insertBefore"></div>
                            </div> {{-- end of .form-body --}}
                            <div class="btn-panel">
                                <button type="submit" data-loading-text="{{trans('core.btnSubmitting')}}..." class="demo-loading-btn btn btn-1">
                                    <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                                    <span>{{trans('core.btnSubmit')}}</span>
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div> {{-- end of .modal-body --}}
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div>
@stop

@section('footerjs')

  {{--Page Level JS--}}
    {{HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}
    {{HTML::script("assets/admin/pages/scripts/components-pickers.js")}}
  {{--Page Level js end--}}
    <script>
            jQuery(document).ready(function() {

               ComponentsPickers.init();
            });

            var $insertBefore = $('#insertBefore');
            var $i = 0;
            $('#plusButton').click(function(){
              $i = $i+1;
              $(' <div class="form-group"> ' +
               '<div class="col-md-4"><input class="form-control form-control-inline date-picker'+$i+'" name="date['+$i+']" type="text" value="" placeholder="{{trans('core.date')}}"/></div>' +
               '<div class="col-md-4"><input class="form-control form-control-inline" name="occasion['+$i+']" type="text" value="" placeholder="{{trans('core.occasion')}}"/></div>' +
                '</div>').insertBefore($insertBefore);
				$.fn.datepicker.defaults.format = "dd-mm-yyyy";
                 $('.date-picker'+$i).datepicker();
            });

function del(id,date)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} <strong>'+date+'</strong> ??');
			$("#delete").click(function(){
                $.ajax({
                    type: "POST",
                    url : "{{ url('api/delete/' . $slug) }}/" + id,
                    dataType: 'json',
                })
                .done(function(response){
                    if(response.success == "deleted"){
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#deleteModal').modal('hide');
                        $('#row'+id).fadeOut(500);
                        showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success'); 
                        setTimeout(function() {
                            window.location.replace('{{ route('admin.'.$slug.'.index') }}')
                        }, 1000);           
                    }
                });
            })

		}

        </script>
@stop
