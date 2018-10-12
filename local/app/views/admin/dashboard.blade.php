@extends('admin.adminlayouts.adminlayout')
@section('head')
        {{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
        {{HTML::style("assets/global/plugins/select2/select2.css")}}
        {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
        {{HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")}}
@stop
@section('mainarea')
<style>
.note{
    padding: 2px 5px 2px 5px!important;
    opacity:0.6;
    margin: 0px !important;
    margin-bottom: 1px !important;
}
</style>
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
                    <div class="portlet box probationay-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/customer.png' ) }}" /></div>
                                <span>{{'For Probationary '}}</span> 
                                @if(count($probationary)>0)
                                <span class="badge badge-danger" style="margin-left:10px;"> {{count($probationary)}} </span>
                                @endif
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                 @if(count($probationary)>0)
                                   @foreach($probationary as $probi)
                                      
                                        <li>
                                            
                                        <div class="img-container">
                                                  
                                                  @if($probi->profileImage )
                                                     
                                                     <div class="img-user" style="background-image: url( {{ url( 'profileImages/' . $probi->profileImage ) }} );"></div>
                                                 @else
                                                     
                                                     <div class="img-default" style="background-image: url( {{ URL::asset( 'assets/global/img/profile-img/default.png' ) }} );"></div>
                                                 @endif
                                               </div>
                                               <h3 class="name">{{$probi->firstName . ' ' .$probi->lastName }}</h3>
                                               <p style="color: red;">Having 3 Months on</p>
                                               <h3 class="dob">
                                               
                                                   {{ date('d M Y', strtotime("+3 months", strtotime($probi->joiningDate))) }}
                                                   
                                                   
                                               </h3>
                                               <p>{{ 'Employed on'}}</p>
                                               <h3 class="dob">{{ date( 'd M Y',strtotime( $probi->joiningDate ) ) }}</h3>
                                               
                                               
                                               <?php 
                                                       
                                                           
                                                               $end = date('Y-m-d',strtotime("+3 months", strtotime($probi->joiningDate)));
                                                               $str = date('Y-m-d') ;
                                                               $s = date_create($str);
                                                               $e = date_create($end);
                                                               $res= date_diff($s,$e);
                                                               $result = $res->format("%a");
                                                               // echo $str .'/' .$end .'/'.$result;
                                                               
                                                    
                                                           switch($result){
                                                               case 0:
                                                               echo '<p style="color: green;">Today </p>';
                                                               break;
                                                               case 1:
                                                               echo '<p style="color: red;">1 day to </p>';
                                                               break;
                                                               case 2:
                                                               echo '<p style="color: red;">2 days to go </p>';
                                                               break;
                                                               case 3:
                                                               echo '<p style="color: red;">3 days to go </p>';
                                                               break;
                                                               default:
                                                               echo "<p style='color: red;'>$result days to go </p>";
                                                               
                                                               
                                                           }
   
                                                   ?>
                                                <a href="{{route('admin.regular.index', $probi->employeeID)}}">
                                                <span class="label label-success">View Details</span>
                                                </a>
                                        </li>
                                       
                                    @endforeach
                                    @else
                                        <li class="no-dob">
                                            {{'No Probationary for this day'}}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="portlet box regualar-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/customer.png' ) }}" /></div>
                                <span>{{'For Regular'}}</span>
                                @if(count($forRegular)>0)
                                <span class="badge badge-danger" style="margin-left:10px;"> {{count($forRegular)}} </span>
                                @endif
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                    
                                 @if(count($forRegular)>0)
                                   @foreach($forRegular as $reg)
                                        <li>
                                            
                                               <div class="img-container">
                                                  
                                               @if($reg->profileImage )
                                                  
                                                  <div class="img-user" style="background-image: url( {{ url( 'profileImages/' . $reg->profileImage ) }} );"></div>
                                              @else
                                                  
                                                  <div class="img-default" style="background-image: url( {{ URL::asset( 'assets/global/img/profile-img/default.png' ) }} );"></div>
                                              @endif
                                            </div>
                                            <h3 class="name">{{$reg->firstName . ' ' .$reg->lastName }}</h3>
                                            <p style="color: red;">Having 6 Months on</p>
                                            <h3 class="dob">
                                            
                                                {{ date('d M Y', strtotime("+6 months", strtotime($reg->joiningDate))) }}
                                                
                                                
                                            </h3>
                                            <p>{{ 'Employed on'}}</p>
                                            <h3 class="dob">{{ date( 'd M Y',strtotime( $reg->joiningDate ) ) }}</h3>
                                            
                                            
                                            <?php 
                                                    
                                                        
                                                            $end = date('Y-m-d',strtotime("+6 months", strtotime($reg->joiningDate)));
                                                            $str = date('Y-m-d') ;
                                                            $s = date_create($str);
                                                            $e = date_create($end);
                                                            $res= date_diff($s,$e);
                                                            $result = $res->format("%a");
                                                            // echo $str .'/' .$end .'/'.$result;
                                                            
                                                 
                                                        switch($result){
                                                            case 0:
                                                            echo '<p style="color: green;">Today </p>';
                                                            break;
                                                            case 1:
                                                            echo '<p style="color: red;">1 day to </p>';
                                                            break;
                                                            case 2:
                                                            echo '<p style="color: red;">2 days to go </p>';
                                                            break;
                                                            case 3:
                                                            echo '<p style="color: red;">3 days to go </p>';
                                                            break;
                                                            default:
                                                            echo "<p style='color: red;'>$result days to go </p>";
                                                            
                                                            
                                                        }

                                                ?>
                                                <a href="{{route('admin.regular.index', $reg->employeeID)}}">
                                                <span class="label label-success">View Details</span>
                                                </a>
                                        </li>
                                       
                                        @endforeach
                                    @else
                                        <li class="no-dob">
                                            {{'No Regular for this day'}}
                                        </li>
                                    @endif
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="portlet box birthday-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">
                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/balloons.png' ) }}" /></div>
                                <span>{{date('F')}} {{Lang::get('core.birthdays')}}</span>
                                @if(count($current_month_birthdays)>0)
                                <span class="badge badge-danger" style="margin-left:10px;"> {{count($current_month_birthdays)}} </span>
                                @endif
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div  data-always-visible="1" data-rail-visible="0">
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

                     <div class="portlet box note-portlet">
                        <div class="portlet-title has-pad">
                            <div class="title-left">

                            

                                <div class="icon"><img src="{{ URL::asset( 'assets/global/img/icons/leave.png' ) }}" /></div>
                                <span>{{'My Calendar'}}</span>
                            </div>
                            <div class="btn-portlet-right">
                            <a title="View" class="btn green" href="{{route('admin.mycalendar.index')}}">
                                <span ><i class="fa fa-eye fa-fw"></i>  </span>
                                <span> View note</span>
                            </a> {{"|"}}
 
                                <a class="btn green" data-toggle="modal" href="#static_add">
                                    <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                    <span>Add note</span>
                                </a>
							</div>

                        </div>
                        <div class="portlet-body">
                            <div id="note" class="has-toolbar"></div>
                        </div>
                    </div>
                    
                    <div class="portlet box attendance-portlet">
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

    {{--MODAL SECTION--}}
    <div id="static_add" class="modal fade addNew-modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                        <span>Add Note</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times fa-fw" aria-hidden="true"></i>
                    </button>
                </div> {{-- end of .modal-header --}}
                <div class="modal-body">
                <div class="portlet-body form">
                {{Form::open(['url'=>'admin/mycalendar/store','id'=>'add_note','method'=>'POST', 'class'=>'custom-form'])}}
                <div class="form-body">
                

                <div class="form-group">
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">Start Date:</label>
                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                <input class="form-control required start_date_leave" name="start_date" placeholder="select date" readonly="" type="text">
                <span class="input-group-btn">
                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                </span>
                </div>
                <div class="start_date_error"></div>
                </div>
                <div class="col-md-6">
                <label class="text-success" style="margin-bottom:6px;">End Date:</label>
                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                <input class="form-control required end_date_leave" name="end_date" placeholder="select date" readonly="" type="text">
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
                <textarea class="form-control" name="title" id="reason" rows="3" maxlength="500" style="width:100%"></textarea>
                </div>
                </div>
                </div>
                </div>

                <div class="btn-panel">
                    <button type="submit" data-loading-text="Submitting..." class="btn btn-1">
                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                        <span>Add Note</span>
                    </button>
                    <!-- <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn btn-1">{{trans('core.btnSubmit')}}</button> -->
                </div>
                </div>
                {{Form::close()}}
                </div>
                </div>
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div> {{-- end of .addNew-modal --}}
    {{--END MODAL SECTION--}}
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

    {{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
    {{ HTML::script("assets/admin/pages/scripts/components-pickers.js")}}
 

<script>
jQuery(document).ready(function() {

   Calendar.init();
//   showReport();
   UIBlockUI.init();
   ComponentsDropdowns.init();

   ComponentsPickers.init();

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
                                    title: "{{$em}}",
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
            //------  Notes --------
            $('#note').fullCalendar('destroy'); // destroy the note
            $('#note').fullCalendar({ //re-initialize the calendar
                 lang: '{{Lang::getLocale()}}',
               header: h,
               defaultView: 'month',
                    eventRender: function(event, element) {
                                    if(event.className=="note"){
                                        var start_date = moment(event.start).format('YYYY-MM-DD');
                                       
                                            $('.fc-day[data-start_date="'+start_date+'"]').css({'background':'rgba(255, 224, 205, 0.6)'});
                                            
                                           var link = $('.fc-day[data-start_date="'+start_date+'"]');
                                            console.log( link);
                                            for(var i =0; i< link.length;i++){
                                                $('.fc-event-container .note').attr("href", "{{route('admin.mycalendar.index')}}");
                                                // console.log(link[i]);
                                            }
            
                                    }
                            },
                events: [
                {{--My Notes on Calendar--}}
                @foreach($MyCalendars as $Calendar)
                     {
                         className:"note",
                         title: "{{$Calendar->title}}",
                         start:"{{$Calendar->start_date}}",
                         end: '{{date("Y-m-d", strtotime($Calendar->end_date . "+" . "1 day"))}}',
                         color: 'green'

                     },

                     @endforeach

                    ]
            });
            //------ end Notes --------
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
