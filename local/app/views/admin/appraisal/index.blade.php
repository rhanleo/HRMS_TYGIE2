@extends('admin.adminlayouts.adminlayout')
@section('head')
  {{ HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") }}
  {{ HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") }}
  {{ HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") }}
  {{ HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css") }}
  <style>
    .appraise-btn.active {
      background: #267b34;
      color: #fff;
    }
    button.appraise-btn {
      padding: 5px;
      display: inline-block;
      width: auto;
      font: normal 13px/18px 'Open Sans';
      margin: 5px auto;
    }
    button.appraise-btn span{
      display: block;
      font-size: 10px;
    }
  </style>
@stop
@section('mainarea')
  <div class="content-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <div id="load">@include('admin.common.error')</div>
        <div class="portlet box">
          <div class="portlet-title">
            <div class="title-left">
              <div class="icon"><i class="fa fa-file-text-o fa-fw"></i></div>
              <span>Appraisal List</span>
            </div>
            <div class="btn-portlet-right">
              {{-- <a class="btn green" data-toggle="modal" href="#static_apply">
                <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                <span>Create Appraisal</span>
              </a> --}}
            </div>
          </div>
          <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="employees-table">
              <thead>
                <tr>
                  <th>{{trans('core.id')}}</th>
                  <th>{{trans('core.name')}}</th>
                  <th>{{trans('core.department')}}</th>
                  <th>{{trans('core.levelPosition')}}</th>
                  <th class="text-center" style="width: 300px;">{{trans('core.action')}}</th>
                </tr>
              </thead>
                <tbody>
                  @foreach( $employees as $key => $val)
                    <?php $val = (object) $val; ?>
                    <tr>
                      <td>{{ $val->employeeID }}</td>
                      <td>{{ $val->fullName }}</td>
                      <td>{{ $val->getDesignation->department->deptName or ''}}</td>
                      <td>{{ $val->getDesignation->designation or ''}}</td>
                      <td class="text-center">
                        @for($i = 1; $i <= 4; $i++)
                          <?php

                            $appraisal_done = $appraisal_questions = 0;
                            $app_for = isset($val->getDesignation->designation) && $val->getDesignation->designation == 'HOD' ? 1 : 2;   
                            $is_admin = isset(Auth::admin()->get()->id) ? 1 : 0;
                            if ($is_admin) {
                              $current_user_id = Auth::admin()->get()->id;        
                            }
                            else{
                              $current_user_id = Auth::employees()->get()->employeeID;
                            }

                            $appraisal_done = DB::table('employee_appraisal')
                                                ->where('employeeID', $val->employeeID)
                                                ->where('for_quarter', $i)
                                                ->where('appraised_by', $current_user_id)
                                                ->where('is_admin', $is_admin)
                                                ->count();

                            $appraisal_questions = DB::table('appraisal_questions')
                                                    ->where('app_for', $app_for)
                                                    ->count();

                            $current = floor((date('n') - 1) / 3);

                            $year = date('y');
                            $quarters = array();

                            $q = (($current)%4) + 1;
                          ?>
                          
                          <button data-employee_id="{{ $val->employeeID }}" data-quarter="{{ $i }}" onclick="action_appraise(this)" class="btn appraise-btn {{ $i <= $q ? ($appraisal_done < $appraisal_questions ? 'active' : '') : 'disabled'}}">
                            Qtr: {{ $i }}
                            <span class="appraise-btn-span">
                              @if($appraisal_done >= $appraisal_questions)
                                <i class="fa fa-check"></i> Done
                              @else
                                ({{ $appraisal_done }}/{{ $appraisal_questions }})
                              @endif
                            </span>
                          </button>
                          
                        @endfor
                      </td>
                    </tr>
                  @endforeach                
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

  <div id="modal_appraisal_wrapper" class="modal fade addNew-modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 1250px;">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
              <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
              <span>Team Member Appraisal</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times fa-fw" aria-hidden="true"></i>
            </button>
        </div> {{-- end of .modal-header --}}
        <div class="modal-body form">
          <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
        </div>{{-- end of .modal-body --}}
      </div> {{-- end of .modal-content --}}
    </div> {{-- end of .modal-dialog --}}
  </div> {{-- end of .addNew-modal --}}
@stop

@section('footerjs')
<!-- BEGIN PAGE LEVEL PLUGINS -->
  {{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
  {{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
  {{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
  {{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
  {{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}
<!-- END PAGE LEVEL PLUGINS -->
  <script>
    jQuery(document).ready(function($) {
      $('#employees-table').dataTable({
        {{$datatabble_lang}}
        "bStateSave": true,
        "columns": [{
          "orderable": true
          }, {
            "orderable": true
          }, {
            "orderable": true
          }, {
            "orderable": true
          }, {
            "orderable": false
          },
        ],
        "lengthMenu": [
          [5, 15, 20, -1],
          [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,
        "sPaginationType": "full_numbers",
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [0]
        }, {
            "searchable": false,
            "targets": [0]
        }],
        "order": [
            [1, "asc"]
        ] // set first column as a default sort by asc
      });
    });

    function action_appraise(btn){

      $('#employees-table').find('button.appraise-btn').removeClass('modal-appraise-active');
      $(btn).addClass('modal-appraise-active');

      var employee_id = $(btn).data('employee_id'),
          quarter = $(btn).data('quarter'),
          modal_body = $('#modal_appraisal_wrapper').find('.modal-body');
      
      $('#modal_appraisal_wrapper').modal('show');
      $(modal_body).html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading...');

      $.ajax({
        url: '{{ url('api/get_appraisal_form') }}',
        type: 'POST',
        dataType: 'html',
        data: {
          _token: '{{ csrf_token() }}',
          employee_id: employee_id, 
          quarter: quarter,
        },
      })
      .done(function(e) {
        $(modal_body).html(e);
        console.log("success");
      })
      .fail(function() {
        $(modal_body).html('Sorry something went wrong, please try again.');
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    }
  </script>
@stop