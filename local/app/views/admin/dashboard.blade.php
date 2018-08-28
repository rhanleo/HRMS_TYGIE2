@extends('admin.adminlayouts.adminlayout')
@section('head')
        {{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
        {{HTML::style("assets/global/plugins/select2/select2.css")}}
        {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
        {{HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="count-summary">
                <div class="employee count-record">
                    <div class="number">{{$employee_count}}</div>
                    <div class="label">Total Employees</div>
                    <a href="{{route('admin.employees.index')}}" class="view-more">View More ></a>
                </div>
                <div class="department count-record">
                    <div class="number">{{$department_count}}</div>
                    <div class="label">Total Departments</div>
                    <a href="{{route('admin.departments.index')}}" class="view-more">View More ></a>
                </div>
                <div class="awards count-record">
                    <div class="number">{{ $awards_count }}</div>
                    <div class="label">Total Awards</div>
                    <a href="{{route('admin.awards.index')}}" class="view-more">View More ></a>
                </div>
            </div> {{-- end of .count-summary --}}
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <div class="portlet box birthday-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/balloons.png' ) }}" /></div>
                                <span>{{date('F')}} {{Lang::get('core.birthdays')}}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                 @if(count($current_month_birthdays)>0)
                                    @foreach($current_month_birthdays as $birthday)
                                        <li>
                                            <div class="img-container">
                                                @if( $birthday->profileImage )
                                                    <div class="img-user" style="background-image: url( {{ url( 'profileImages/' . $birthday->profileImage ) }} );"></div>
                                                @else
                                                    <div class="img-default" style="background-image: url( {{ URL::asset( 'assets/global/img/profile-img/default.png' ) }} );"></div>
                                                @endif
                                            </div>
                                            <h3 class="name">{{ $birthday->firstName . ' ' .$birthday->lastName }}</h3>
                                            <p>{{ Lang::get( 'core.hasBirthDayOn' ) }}</p>
                                            <h3 class="dob">{{ date( 'd F ',strtotime( $birthday->date_of_birth ) ) }}</h3>
                                        </li>
                                    @endforeach
                                    @else
                                        <li class="no-dob">
                                            {{Lang::get('messages.noBirthdays')}}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet box expenses-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/expenses.png' ) }}" /></div>
                                <span>{{ Lang::get( 'core.expenseReport' ) }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                          <div id="expenseChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7">
                    <div class="portlet box leave-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/leave.png' ) }}" /></div>
                                <span>{{trans('core.attendance')}}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="calendar" class="has-toolbar"></div>
                        </div>
                    </div>
                </div>
            </div> {{-- end of .row --}}
        </div>
    </div> {{-- end of .content-section --}}
@stop

@section('footerjs')
    {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
    {{HTML::script("assets/global/plugins/select2/select2.min.js")}}
    {{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
    {{HTML::script("assets/admin/pages/scripts/components-dropdowns.js")}}
    {{HTML::script('assets/admin/pages/scripts/ui-blockui.js')}}
    {{HTML::script("assets/global/plugins/moment.min.js")}}
    {{HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")}}
    {{HTML::script("assets/global/plugins/fullcalendar/lang-all.js")}}
    {{HTML::script("assets/global/plugins/highcharts/highcharts.js")}}
    {{HTML::script("assets/global/plugins/highcharts/exporting.js")}}
<script>
jQuery(document).ready(function() {

   Calendar.init();
//   showReport();
   UIBlockUI.init();
   ComponentsDropdowns.init();

});


var Calendar = function() {


    return {
        //main function to initiate the module
        init: function() {
            Calendar.initCalendar();


        },

        initCalendar: function() {

            if (!jQuery().fullCalendar) {
                return;
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};


                if ($('#calendar').parents(".portlet").width() <= 720) {

                                    $('#calendar').addClass("mobile");
                                    h = {
                                        left: 'title, prev, next',
                                        center: '',
                                        right: 'today,month'
                                    };
                                } else {
                                    $('#calendar').removeClass("mobile");
                                    h = {
                                        left: 'title',
                                        center: '',
                                        right: 'prev,next,today'
                                    };
                                }

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({ //re-initialize the calendar
                 lang: '{{Lang::getLocale()}}',
               header: h,
               defaultView: 'month',
                    eventRender: function(event, element) {
                                    if(event.className=="holiday"){
                                        var dataToFind = moment(event.start).format('YYYY-MM-DD');
                                            $('.fc-day[data-date="'+dataToFind+'"]').css('background', 'rgba(255, 224, 205, 1)');
                                           }
                            },
                events: [
                {{--Holidays on Calendar--}}
                     @foreach($holidays as $holiday)
                     {
                         className:"holiday",
                         title: "{{$holiday->occassion}}",
                         start:'{{$holiday->date}}',

                         color: 'grey'

                     },

                     @endforeach
                        {{-- Attandance on calendar --}}
                        @foreach($attendance as $index=>$attend)

                            @if($attend[0]!='all present')
                                @foreach($attend as $em)
                                 {
                                    title: "{{Str::words($em,1,'')}}",
                                    start:'{{$index}}',
                                        color: '#e50000'

                                },
                                @endforeach
                            @else
                            {
                                title: '{{Lang::get('core.allPresent')}}',
                                start:'{{$index}}'

                            },
                            @endif

                        @endforeach

                    ]
            });
        }
    };
}();

$(function () {

    $('#expenseChart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '{{Lang::get('core.monthlyExpReport')}} '+new Date().getFullYear()
        },
        xAxis: {
            categories: [
                '{{Lang::get('core.jan')}}',
                '{{Lang::get('core.feb')}}',
                '{{Lang::get('core.mar')}}',
                '{{Lang::get('core.apr')}}',
                '{{Lang::get('core.may')}}',
                '{{Lang::get('core.june')}}',
                '{{Lang::get('core.july')}}',
                '{{Lang::get('core.aug')}}',
                '{{Lang::get('core.sept')}}',
                '{{Lang::get('core.oct')}}',
                '{{Lang::get('core.nov')}}',
                '{{Lang::get('core.dec')}}'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
            useHTML: true,
                text: '{{Lang::get('core.expenseIn')}}( {{$setting->currency_symbol}} )'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} {{$setting->currency_symbol}}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [  {
            name: '{{Lang::get('core.expense')}}',
            data: [{{$expense}}]

        }]
    });
});
</script>
<script>
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
        <!-- END PAGE LEVEL PLUGINS -->
@stop
