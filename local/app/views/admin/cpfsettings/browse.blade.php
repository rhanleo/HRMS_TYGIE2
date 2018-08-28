@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
    {{HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}
    <style>
      .input-prefix{
        position: relative;
        display: block;
      }
      .input-prefix > input {
        padding-left: 20px;
      }
      .input-prefix:before{
        display: block;
        content: attr(data-prefix);
        position: absolute;
        top: 0;
        bottom: 0px;
        left: 5px;
        color: #ccc;
        font: normal 16px/20px 'Open Sans';
        margin: auto 0;
        height: 18px;
      }
    </style>
@stop
@section('mainarea')
    <div class="page-banner" style="background-image: url( {{ URL::asset( 'assets/global/img/banners/employees.png' ) }} );">
        <div class="left-banner">
            <h3 class="page-title">{{$pageTitle}}</h3>
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{route('admin.dashboard.index')}}">{{trans('core.home')}}</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">{{trans('core.cpf')}}</a>
                    <i class="fa "></i>
                </li>
            </ul>
        </div> {{-- end of .left-banner --}}
        <div class="right-banner">
            <ul>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="label">Notifications:</span>
                        @if(count($pending_applications)>0)
                            <span class="badge badge-default">
                                {{count($pending_applications)}}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu">
                        <ul>
                            <li class="external">
                                <h3><span class="bold">{{count($pending_applications)}} pending</span> notifications</h3>
                            </li>
                            @if( count( $pending_applications ) > 0 )
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        @foreach($pending_applications as $pending)
                                        <li>
                                            <a  data-toggle="modal" href="#static_leave_requests" onclick="show_application_notification({{ $pending->id }});return false;">
                                                <span class="time">{{date('d-M-Y',strtotime($pending->created_at))}}</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-success">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span>
                                                    <strong>{{$pending->employeeDetails->fullName}} </strong> has applied for leave on {{date('d-M-Y',strtotime($pending->date))}}
                                                </span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-language">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="label">Language:</span>
                        <span class="langname">
                        {{$setting->getLangName->language}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        @foreach($languages as $lang)
                            @if($lang->locale !=$setting->locale)
                                <li>
                                    <a href="javascript:;" onclick="changeLanguage('{{$lang->locale}}')">{{ $lang->language }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul> {{-- end of #header-notification-bar --}}
        </div> {{-- end of .right-banner --}}
    </div> {{-- end of .page-banner --}}
    <div class="content-section">        
        <div class="container-fluid">

            <div id="load">@include('admin.common.error')</div>        
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <span>{{trans('core.cpf')}}</span>
                            </div>
                            <div class="btn-portlet-right">
                                <a href="{{route('admin.cpf_settings.create')}}">
                                    <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                    <span>Add settings</span>
                                </a>
                                <a href="https://www.cpf.gov.sg/eSvc/Web/Miscellaneous/ContributionCalculator/Index?isFirstAndSecondYear=0&isMember=1" target="_blank" style="text-decoration: none;">CPF Contribution Calculator</a>
                            </div> {{-- end of .btn-portlet-right --}}
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            <table id="cpf-settings-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                       <th class="text-center">Age (Years)</th>
                                       <th class="text-center">Employee's Max Contribution</th>
                                       <th class="text-center">Total MAX Contribution <br> (Employer’s &amp; Employee’s share)</th>
                                       <th class="text-center" width="130px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($cpf_settings) > 0)
                                        @foreach($cpf_settings as $key => $val)
                                            <tr>
                                                <td><span style="white-space: nowrap;">{{ $val->age_from }} - {{ $val->age_to }}</span></td>
                                                <td>{{ $setting->currency_symbol }} {{ number_format($val->employee_max_contribution, 2) }}</td>
                                                <td>{{ $setting->currency_symbol }} {{ number_format($val->total_max_contribution, 2) }}</td>
                                                <td>
                                                    <div class="btn-actions">
                                                        <a class="btn btn-1" href="{{ url('admin/cpf_settings/' . $val->id . '/edit') }}"><i class="fa fa-edit fa-fw"></i></a>
                                                        <a class="btn btn-1" href="javascript:;" onclick="del({{$val->id}})"><i class="fa fa-trash fa-fw"></i></a>
                                                    </div>                                            
                                                </td>                                         
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div> {{-- end of .portlet-body --}}
                    </div> {{-- end of .portlet --}}
                </div> {{-- end of .col-md-12 --}}
            </div> {{-- end of .row --}}

            @if(count($cpf_settings) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-title has-pad">
                                <div class="title-left">
                                    <span>Test CPF Computation</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row form-group">
                                    <div class="col-xs-4">
                                        <label for="date_of_birth">{{trans('core.dob')}}</label>
                                        <div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years" data-date-end-date="-1y">
                                            <input type="text" class="form-control" id="dob" readonly value="">
                                            <span class="input-group-btn">
                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="salary">Salary</label>
                                        <span class="input-prefix" data-prefix="{{$setting->currency_symbol}}">
                                            <input id="salary" type="number" class="form-control">
                                        </span>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="allowance">Allowance</label>
                                        <span class="input-prefix" data-prefix="{{$setting->currency_symbol}}">
                                            <input id="allowance" type="number" class="form-control">
                                        </span>
                                    </div>
                                </div>

                                <div class="btn-panel">
                                  <button id="test-cpf-button" class="btn btn-1">Compute</button>
                                </div>  

                                <div id="cpf-result"></div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}
    @include('admin.common.delete')
@stop


@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    {{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}
    {{ HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    {{ HTML::script('assets/admin/pages/scripts/components-pickers.js')}}
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function($) {
        $( '.date-picker' ).datepicker();
        $('#cpf-settings-table').dataTable({
            {{$datatabble_lang}}
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "columns": [{
                    "orderable": false
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                },{
                    "orderable": false
                }
                ],
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "sPaginationType": "full_numbers",
                "columnDefs": [ {
                    "searchable": false,
                    "targets": [0]
                }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });

        $('#test-cpf-button').on('click', function(e){
            $('#cpf-result').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
            var dob = $('#dob').val() || '',
                salary = $('#salary').val() || 0,
                allowance = $('#allowance').val() || 0;

            if (dob == '') {
                showToastrMessage('', 'Date of birth required', 'error');
                return false;
            }
            else{
                
                
                $.ajax({
                    url: '{{ url('api/cpf_calculator/') }}' + '/' + dob + '/' + salary + '/' + allowance,
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(res) {
                    if(res.status == 'success'){

                        var append_txt = '<div style="border: 1px solid #ccc; padding: 0 10px; background: #f9eed2;max-width: 450px; width: 100%; display: block;">' +
                                            '<h3>Results:</h3>' +
                                            '<ul>' +
                                                '<li>Total CPF: <strong class="pull-right">{{ $setting->currency_symbol }}'+ res.data.cpf.total +'</strong></li>' +    
                                                '<li>Employer share: <strong class="pull-right">{{ $setting->currency_symbol }}'+ res.data.cpf.employer +' <small>('+res.data.details.employer_percent_share+'%)</small></strong></li>' +
                                                '<li>Employee share: <strong class="pull-right">{{ $setting->currency_symbol }}'+ res.data.cpf.employee +' <small>('+res.data.details.employee_percent_share+'%)</small></strong></li>' +
                                            '</ul>' +
                                            '<h3>Employee Details:</h3>' +
                                            '<ul>' +
                                                '<li>Date of Birth: <strong class="pull-right">'+ res.data.details.birth_date +'</strong></li>' +    
                                                '<li>Age: <strong class="pull-right">'+ res.data.details.age +'</strong></li>' +
                                                '<li>Salary: <strong class="pull-right">{{ $setting->currency_symbol }}'+ res.data.details.salary +'</strong></li>' +
                                                '<li>Allowance: <strong class="pull-right">{{ $setting->currency_symbol }}'+ res.data.details.allowance +'</strong></li>' +
                                            '</ul>' +
                                        '</div>';

                        $('#cpf-result').html(append_txt);
                    }
                    else{
                        showToastrMessage('', res.message, 'error');
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }           
            
        })

        });
        function del(id){
            console.log(id);
            showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success');
        }


</script>

@stop
	
