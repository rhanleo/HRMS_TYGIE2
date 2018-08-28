@extends('admin.adminlayouts.adminlayout')
@section('head')
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
                                <span class="icon"><i class="fa fa-users fa-fw"></i></span>
                                <span>{{trans('core.leaveTypes')}}</span>
                                <div class="tools"></div>
                            </div>
                            <div class="btn-portlet-right">
                                <a class="btn green" data-toggle="modal" href="#static">
                                    <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
                                    <span>{{trans('core.btnAddLeaveType')}}</span>
                                </a>
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                            <p style="display: none;">{{Lang::get('messages.noteLeaveTypes')}}</p>
                            <table class="table table-striped table-bordered table-hover leave-type" >
                                <thead>
                                    <tr>
                                        <th class="sorting">#</th>
                                        <th class="sorting">{{ trans( 'core.leave' ) }}</th>
                                        <th class="sorting">{{ trans( 'core.leaveNumber' ) }}</th>
                                        <th class="sorting" style="width: 110px;">{{ trans( 'core.action' ) }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaveTypes as $leaveType)
                                        <tr id="row{{ $leaveType->id }}">
                                            <td>{{ $leaveType->id }}</td>
                                            <td class="leave-type">{{ str_replace('_', ' ', $leaveType->leaveType) }}</td>
                                            <td>
                                                {{ $leaveType->num_of_leave }}
                                            </td>
                                            <td style="width: 110px;">
                                                <div class="btn-actions">
                                                    <a class="btn btn-1" data-toggle="modal" href="#edit_static" onclick="showEdit({{$leaveType->id}},'{{ $leaveType->leaveType }}','{{ $leaveType->num_of_leave }}')"><i class="fa fa-edit fa-fw"></i></a>
                                                    @if( !in_array( $leaveType->leaveType, ['annual_leave', 'sick_leave']) )
                                                        <a  class="btn btn-1" href="javascript:;"
                                                            onclick="del({{$leaveType->id}},'{{ $leaveType->leaveType }}')"><i class="fa fa-trash fa-fw"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> {{-- end of .portlet-body --}}
                    </div> {{-- end of .portlet-box --}}
                </div> {{-- end of .col-md-12 --}}
            </div> {{-- end of .row --}}
        </div>
    </div> {{-- end of .content-section --}}

    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>{{trans('core.leaveTypes')}}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div> {{-- end of .modal-header --}}
                <div class="modal-body">
                    <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    {{Form::open(array('route'=>"admin.leavetypes.store",'class'=>'form-horizontal ','method'=>'POST'))}}


                    <div class="form-body">

                    <div class="form-group">
                    <div class="col-md-6">
                    <input class="form-control form-control-inline input-medium date-picker" name="leaveType" type="text" value="" placeholder="LeaveType"/>

                    </div>
                    <div class="col-md-6">
                    <input class="form-control form-control-inline input-medium date-picker" name="num_of_leave" type="text" value="" placeholder="Number of leaves in a year"/>

                    </div>
                    </div>



                    </div>

                    <div class="modal-footer">
                        <div class="btn-panel">
                            <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn btn-1"><i class="fa fa-check"></i> {{trans('core.btnSubmit')}}</button>
                        </div>
                    </div> {{-- end of .modal-footer --}}
                    {{ Form::close() }}
                    </div>
                </div> {{-- end of .modal-body --}}
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div> {{-- end of #static --}}

{{--   End Add MODALS --}}


{{-- EDIT MODALS --}}

    <div id="edit_static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('core.edit')}} LeaveTypes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">

                    <!-- BEGIN FORM-->


                    {{ Form::open(['method' => 'PATCH', 'class'=>'form-horizontal','id'=>'edit_form']) }}

                    <div class="form-body">


                    <div class="form-group">
                    <div class="col-md-6">
                    <input class="form-control form-control-inline " name="leaveType" id="edit_leaveType" type="text" value="" placeholder="LeaveType" />
                    <input type="hidden" name="old_leavetype" value="">
                    </div>
                    <div class="col-md-6">
                    <input class="form-control form-control-inline " name="num_of_leave" id="edit_num_of_leave" type="text" value="" placeholder="Number Of Leave" />
                    </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-loading-text="{{trans('core.btnUpdating')}}..." class="demo-loading-btn btn btn-1"><i class="fa fa-edit"></i> {{trans('core.btnUpdate')}}</button>
                    </div>
                    {{ Form::close() }}
                    </div>
                </div> {{-- end of .modal-body --}}
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div>

  {{------------------------EDIT MODALS---------------------}}



			{{--DELETE MODAL CALLING--}}
                            @include('admin.common.delete')
             {{--DELETE MODAL CALLING END--}}

@stop


@section('footerjs')



	<script>
	function del(id,name)
    		{

    			$('#deleteModal').appendTo("body").modal('show');
    			$('#info').html('{{Lang::get('messages.deleteConfirm')}} <strong>'+name+'</strong> ??');
    			$("#delete").click(function()
    			{
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
   function showEdit(id,leaveType,num)
    {
    	var url = "{{ route('admin.leavetypes.update',':id') }}";
    	url = url.replace(':id',id);
//        Change action of the Edit
            $('#edit_form').attr('action',url );
            $("#edit_leaveType").val(leaveType);
            $("input[name=old_leavetype]").val(leaveType);
            if (leaveType == 'sick_leave' || leaveType == 'annual_leave') {
                $("#edit_leaveType").attr('readonly', true);
            }
            else{
                $("#edit_leaveType").attr('readonly', false);
            }
            $("#edit_num_of_leave").val(num);

    }
</script>
@stop
	