@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
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
                                <span>{{'Daily Time Records'}}</span>
                                <div class="tools"></div>
                            </div>
                            <div class="btn-portlet-right">
                            <a class="btn green" data-toggle="modal" href="{{URL::to('admin/employees/dtr/create')}}">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{'add Daily Time Record'}}</span>
							</a>
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{'Employee ID'}}</th>
                                        <th>{{'Name'}}</th>
                                        <th>{{'Time In'}}</th>
                                        <th>{{'Time Out'}}</th>
                                        <th>{{'Break Out'}}</th>
                                        <th>{{'Break In'}}</th>
                                        <th>{{'Date'}}</th>
                                        <th>{{'Total Hours'}}</th>
                                        <th style="width: 110px;">{{trans('core.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($DailyTimeRecords)>0)
                                        @foreach ($DailyTimeRecords as $dtr)
                                        <?php 
                                        $timeIn = date_create($dtr->timeIn);
                                        $times['timeIn'] = date_format($timeIn, "H:i A");
                                        $times['timeInCount'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dtr->timeIn, "Asia/Singapore")->format('h:m A');                                      
                                        // $times['timeIn'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timeIn, "Asia/Singapore")->format('h:m A');
                                        // dd($times['timeIn'] );exit;
                                        $timeOut = date_create($dtr->timeOut);
                                        $times['timeOut'] = date_format($timeOut, "H:i A");
                                        $times['timeOutCount'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dtr->timeOut, "Asia/Singapore")->format('h:m A');   
                                        $breakIn = date_create($dtr->breakIn);
                                        $times['breakIn'] = date_format($breakIn, "H:i A");
                                        $breakOut = date_create($dtr->breakOut);
                                        $times['breakOut'] = date_format($breakOut, "H:i A");
                                        $times['date'] = date_format($breakOut, 'd F Y');
                                        $pageTitle = strtolower($pageTitle);
                                        ?>
                                            <tr id="row{{ $dtr->id }}">
                                                <td>{{ $dtr->employeeID }}</td>
                                                <td>
                                                {{ $dtr->getEmployeeDetails->firstName .' '}}
                                                {{ $dtr->getEmployeeDetails->lastName }}
                                                </td>
                                                <td>{{$times['timeIn']}}</td>
                                                <td>{{ $times['timeOut'] }}</td>
                                                <td>{{ $times['breakOut'] }}</td>
                                                <td>{{ $times['breakIn'] }}</td>
                                                <td>{{ $times['date'] }}</td>
                                                <td>{{ $dtr->totalHours($times['timeInCount'], $times['timeOutCount']) }}</td>
                                                <td class=" " style="width: 110px;">
                                                    <div class="btn-actions">
                                                       
                                                            <a class="btn btn-1"  data-toggle="modal" href="#edit_static" onclick="showEdit('{{$dtr->id}}','{{ $dtr->employeeID }}')"><i class="fa fa-edit fa-fw"></i></a>
                                                            <a class="btn btn-1" href="javascript:;" onclick="del({{$dtr->id}},'{{ $dtr->employeeID }}')"><i class="fa fa-trash fa-fw"></i></a>
                                                      
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
    <div id="static" class="modal fade add-department" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                        <span>{{ trans( 'core.new' ) }} {{ 'Branch' }}</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div> {{-- end of .modal-header --}}
                <div class="modal-body">
                    <div class="portlet-body form">
                        {{ Form::open( array( 'route'=>"admin.branches.store", 'class' => 'custom-form','method'=>'POST' ) ) }}
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="deptName" class="text-success">{{trans( 'core.designation' ) }}</label>
                                            <select name="designationID">
                                           
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label for="designation" class="text-success">{{ 'Branch'}}</label>
                                            <input class="form-control form-control-inline" name="" type="text" value="" placeholder="{{'SM Mall of Asia'}}"/>
                                            <div id="insertBefore"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" id="plusButton" class="btn btn-1 form-control-inline">
                                                <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                                <span>Add</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- end of .form-body --}}
                            <div class="btn-panel">
                                <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn btn-1">{{trans('core.btnSubmit')}}</button>
                            </div>
                        {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div> {{-- end of .modal-body --}}
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div> {{-- end of .add-department --}}

    <div id="edit_static" class="modal fade edit-department" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-edit fa-fw"></i></span>
                        <span>{{ 'Daily Time Records'}}</span>
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
                                            <label for="deptName" class="text-success">{{'Daily Time Records'}}</label>
                                            <input class="form-control form-control-inline " name="employeeID" id="edit_deptName" type="text" value="" placeholder="{{trans('core.department')}}" readonly />
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
    
    @include('admin.common.delete')
@stop

@section('footerjs')

<script>

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
                    url : "{{ url('api/delete/' . $pageTitle) }}/" + id,
                    dataType: 'json',
                    })
                    .done(function(response){
                     if(response.success == "deleted"){
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#deleteModal').modal('hide');
                        $('#row'+id).fadeOut(500);
                        showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success'); 
                        setTimeout(function() {
                            window.location.replace('{{ route('admin.'.$pageTitle.'.index') }}')
                        }, 1000);           
                    }
                        });
                    })

    			}

			function showEdit(id,designation)
			{

                    $('div[id^="edit_field"]').remove();
                    var url = "{{ route('admin.dailytimerecord.update',':id') }}";
                    url = url.replace(':id',id);
                    $('#edit_form').attr('action',url );

					var get_url = "{{ route('admin.dailytimerecord.edit',':id') }}";
					get_url = get_url.replace(':id',id);

			        $("#edit_deptName").val(designation);
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
@stop
	