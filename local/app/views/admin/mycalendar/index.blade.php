@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
    {{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
    
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
    {{HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div id="load">
                @include('admin.common.error')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="title-left">
                                <div class="icon"><i class="fa fa-briefcase fa-fw"></i></div>
                                <span>{{'Note'}}</span>
                                <div class="tools"></div>
                            </div>
                            <div class="btn-portlet-right">
                            <a class="btn green" data-toggle="modal" href="#static_add" title="Import employee using Excel file">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{'Add Note'}}</span>
							</a>
                            
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_employees">
                                <thead>
                                    <tr>
                                        <th>{{'Title'}}</th>
                                        <th>{{'Start Date'}}</th>
                                        <th>{{'End Date'}}</th>
                                        <th>{{'Date Created'}}</th>
                                        <th>{{'Status'}}</th>
                                        
                                        <th style="width: 110px;">{{trans('core.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($mycalendars)>0)
                                    
                                        @foreach($mycalendars as $mycalendar)
                                         
                                            <tr id="row{{ $mycalendar['id'] }}">
                                                <td>{{ $mycalendar['title'] }}</td> 
                                                <td>{{$mycalendar['start_date']}}</td>
                                                <td>{{ $mycalendar['end_date'] }}</td>
                                                <td>{{ $mycalendar['created_at'] }}</td>
                                                <td>
                                                    @if($mycalendar['status'] == 'ongoing')
                                                    <span class='label label-danger'>{{ $mycalendar['status'] }}</span>
                                                    @elseif($mycalendar['status'] == 'done')
                                                    <span class='label label-success'>{{ $mycalendar['status'] }}</span>
                                                    @endif
                                                </td>
                                                <td class=" " style="width: 110px;">
                                                    <div class="btn-actions">
                                                       
                                                            <a class="btn btn-1"  data-toggle="modal" href="#edit_static" onclick="showEdit('{{$mycalendar->id}}','{{ $mycalendar->title }}')"><i class="fa fa-edit fa-fw"></i></a>
                                                            <a class="btn btn-1" href="javascript:;" onclick="del({{$mycalendar->id}},'{{ $mycalendar->title }}')"><i class="fa fa-trash fa-fw"></i></a>
                                                      
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
        </div>
    </div> {{-- end of .content-section --}}

    {{-- MODALS SECTION --}}
   
    <div id="edit_static" class="modal fade edit-department" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-edit fa-fw"></i></span>
                        <span>{{ 'Edit Note'}}</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div> {{-- end of .modal-header --}}
                <div class="modal-body">
                    <div class="portlet-body form">
                        {{ Form::open( [ 'method' => 'PATCH', 'url' => '', 'class' => 'custom-form' , 'id'=>'edit_form' ] ) }}
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="deptName" class="text-success">{{'Title'}}</label>
                                            <input class="form-control form-control-inline "  id="edit_deptName" type="text" value="" placeholder="{{trans('core.department')}}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="deptresponse"></div>
                                            <div id="insertBefore_edit"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> {{-- end of .form-body --}}
                            <div class="note note-warning">
                                {{ trans( 'core.note' ) }} {{ Lang::get( 'messages.deleteNoteDesignation' ) }}  
                            </div> {{-- end of .note-warning --}}
                            <div class="btn-panel">
                                <button type="submit" data-loading-text="{{trans('core.btnUpdating')}}" class="demo-loading-btn btn btn-1">{{trans('core.btnUpdate')}}</button>
                            </div>
                        {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div> {{-- end of .modal-body --}}
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div> {{-- end of .edit-department --}}
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
    
    @include('admin.common.delete')
@stop

@section('footerjs')
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


             var $insertBefore = $('#insertBefore');
                    var $i = 0;
                    $('#plusButton').click(function(){
                         $i = $i+1;
                        $( '<input class="form-control form-control-inline"  name="branch['+$i+']" type="text"  placeholder="{{trans('core.designation')}} #'+($i+1)+'"/>' ).insertBefore($insertBefore);

                    });

            //-----EDIT Modal

        var $insertBefore_edit = $('#insertBefore_edit');
             var $j = 0;
            $('#plus_edit_Button').click(function(){
              $j = $j+1;
              $( '<input class="form-control form-control-inline"  name="branch['+$j+']" type="text"  placeholder="{{trans('core.designation')}} #'+($j+1)+'"/>' ).insertBefore( $insertBefore_edit );


            });

		function del(id,empId)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('{{Lang::get('messages.deleteConfirm')}} <strong>'+empId+'</strong> ?<br>' +
			 '<br><div class="note note-warning">' +
			  "{{'Are you sure to delete this record ? '}}{{$pageTitle}}"+
              '</div>');
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

			function showEdit(id,empID)
			{

                    $('div[id^="edit_field"]').remove();
                    var url = "{{ route('admin.mycalendar.update',':id') }}";
                    url = url.replace(':id',id);
                    $('#edit_form').attr('action',url );

					var get_url = "{{ route('admin.mycalendar.edit',':id') }}";
					get_url = get_url.replace(':id',id);

			        $("#edit_deptName").val(empID);
			        $("#deptresponse").html('<div class="text-center">{{HTML::image('assets/admin/layout/img/loading-spinner-blue.gif')}}</div>');

                    $.ajax({

                            type: "GET",
                            url : get_url,

                            data: {"id":id}

                            }).done(function(response)
                              {
                                  console.log(response);
                                        $("#deptresponse").html(response);
                                        $j = $('input#designation').length-1;
                             });

			}
           
</script>
<script>
	jQuery(document).ready(function( $ ) {




            // begin first table
        $('#sample_employees').dataTable({

            {{$datatabble_lang}}

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                
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
	</script>
    
@stop
	