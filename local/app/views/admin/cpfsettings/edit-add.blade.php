@extends('admin.adminlayouts.adminlayout')

@section('head')

{{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
{{ HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") }}
{{ HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") }}
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
<div class="page-banner" style="background-image: url( {{ URL::asset( 'assets/global/img/banners/departments.png' ) }} );">
  <div class="left-banner">
    <h3 class="page-title">CPF Settings</h3>
    <ul class="page-breadcrumb">
      <li>
        <i class="fa fa-home"></i>
        <a href="{{route('admin.dashboard.index')}}">{{trans('core.home')}}</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="{{route('admin.cpf_settings.index')}}">{{trans('core.cpf')}}</a>        
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="javascript:;">{{ isset($cpf_settings) ? 'Edit' : 'Add' }}</a>
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
          {{ Form::open([ 'url' => url('admin/cpf_settings/' . (isset($cpf_settings) ? $cpf_settings->id : '') ), 'class' => 'form-horizontal', 'method' => (isset($cpf_settings) ? 'PUT' : 'POST')  ]) }}
            <div class="row">
              <div class="col-md-12">
                <div class="portlet box">
                  <div class="portlet-title">
                    <div class="title-left">
                      <div class="icon"><i class="fa fa-briefcase fa-fw"></i></div>
                      <span>{{trans('core.cpf')}}</span>
                      <div class="tools"></div>
                    </div>
                    <div class="btn-portlet-right">
                      @if(isset($cpf_settings))
                        <a href="{{route('admin.cpf_settings.create')}}">
                            <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                            <span>Add settings</span>
                        </a>
                      @endif
                      <a  href="https://www.cpf.gov.sg/eSvc/Web/Miscellaneous/ContributionCalculator/Index?isFirstAndSecondYear=0&isMember=1" target="_blank" style="text-decoration: none;">CPF Contribution Calculator</a>
                    </div>
                  </div> {{-- end of .portlet-title --}}

                  <div class="portlet-body form">
                    <div class="form-body">

                      <div class="row" style="margin-bottom: 30px;">
                        <div class="col-sm-6">
                          <label for="age_from" class="control-label">Age From<span class="required"> *</span></label>
                          <input type="number" id="age_from" name="age_from" min="0" value="{{ isset($cpf_settings) ? $cpf_settings->age_from : Input::old('age_from') }}" class="form-control" />
                        </div>
                        <div class="col-sm-6">
                          <label for="age_to" class="control-label">Age to<span class="required"> *</span></label>
                          <input type="number" id="age_to" name="age_to" min="0" value="{{ isset($cpf_settings) ? $cpf_settings->age_to : Input::old('age_to') }}" class="form-control" />
                        </div>
                      </div>                      
                    </div>

                    <table class="table bordered">
                      <thead>
                        <tr>
                          <th>Employee’s total wages <br> for the calendar month</th>
                          <th>Total CPF contributions <br> (Employer’s &amp; Employee’s share)</th>
                          <th>Employee’s share <br>of CPF contributions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $total_cpf = array();
                          $employee_percentage = array();
                          $wage_ranges = array('≤ $50', '> $50 to $500', '> $500 to < $750', '≥ $750');
                          
                          if (isset($cpf_settings)) {
                            $total_cpf = json_decode($cpf_settings->total_cpf);
                            $employee_percentage = json_decode($cpf_settings->employee_percentage);
                          }

                         ?>
                        @foreach($wage_ranges as $key => $val)
                          <tr>
                            <td>{{ $val }}</td>
                            <td>
                              <span class="input-prefix" data-prefix="%">
                                <input class="form-control" step="any" min="0" type="number" name="total_cpf[{{$key}}]" value="{{ isset($total_cpf[$key]) ? $total_cpf[$key] : Input::old('total_cpf['.$key.']' ) }}">                                
                              </span>
                            </td>
                            <td>
                              <span class="input-prefix" data-prefix="%">
                                <input class="form-control" step="any" min="0" type="number" name="employee_percentage[{{$key}}]" value="{{ isset($employee_percentage[$key]) ? $employee_percentage[$key] : Input::old('employee_percentage['.$key.']') }}">
                              </span>
                            </td>
                          </tr>
                        @endforeach

                        <tr>
                          <td>Max Contribution {{$setting->currency_symbol}} :</td>
                          <td>
                            <span class="input-prefix" data-prefix="{{$setting->currency_symbol}}">
                              <input class="form-control" step="any" min="0" type="number" name="total_max_contribution" value="{{ isset($cpf_settings) ? $cpf_settings->total_max_contribution : Input::old('total_max_contribution') }}">
                            </span>
                          </td>
                          <td>
                            <span class="input-prefix" data-prefix="{{$setting->currency_symbol}}">
                              <input class="form-control" step="any" min="0" type="number" name="employee_max_contribution" value="{{ isset($cpf_settings) ? $cpf_settings->employee_max_contribution : Input::old('employee_max_contribution') }}">
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="btn-panel">
                      <button type="submit" class="btn btn-1">
                        <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                        {{ isset($cpf_settings) ? 'Save' : 'Add' }}
                      </button>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div> {{-- end of .content-section --}}


<!-- <iframe src="https://www.talenox.com.sg/cpf-calculator" width="600" height="200"></iframe> -->
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
	{{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
  {{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
<!-- END PAGE LEVEL PLUGINS -->
@stop
