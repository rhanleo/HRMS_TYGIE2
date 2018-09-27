@extends('front.layouts.frontlayout')

@section('head')

{{HTML::style("assets/global/css/components.css")}}
{{HTML::style("assets/global/css/plugins.css")}}
{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}

@stop

@section('mainarea')
            <div class="col-md-9">
				{{-- Error Messages --}}
                    <div id="alert_message">
                        @if(Session::get('success_ca'))
                            <div class="alert alert-success"><i class="fa fa-check"></i> {{ Session::get('success_ca') }}</div>
                        @endif
                    </div>
                {{-- Error Messages --}}
                <!--Profile Body-->
                <div class="profile-body">

					<h2>{{'Cash Advance'}} </h2><hr>
					
					@if(Session::get('success'))
						<div class="row">
								<div class="col-md-12">
									<div class="alert alert-success">
										<span class="fa fa-check">{{Session::get('success')}}</span>
									</div>
								</div>
						</div>
					@endif
   			
				  <div class="row">

				  		<div class="portlet-title">
                            <div class="title-left">
                                <div class="icon"><i class="fa fa-briefcase fa-fw"></i></div>
                                <span>{{'Cash Advance'}}</span>
                                <div class="tools"></div>
                            </div>
                            <div class="btn-portlet-right">
                            <a data-toggle="modal" href=".apply_cashadvance" title="Apply for Cash Advance">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{'APPLY CASH ADVANCE'}}</span>
							</a>
                            
                            </div>
                        </div> {{-- end of .portlet-title --}}
				
						<div class="col-md-12 col-sm-12">
						<table class="table table-striped table-bordered table-hover" id="sample_employees">
							<thead>
							<tr>
								<th>{{'Employee ID'}}</th>
								<th>{{'Name'}}</th>
								<th>{{'Applied On'}}</th>
								<th>{{'Amount'}}</th>
								<th>{{'Status'}}</th>
								<th>{{'Remarks'}}</th>
								<th>{{'Reviewed By'}}</th>
								<th style="width: 110px;">{{trans('core.action')}}</th>
							</tr>
							</thead>
							<tbody>
							@if(count($cashAdvance)>0)
                                    
									@foreach($cashAdvance as $cash)
									 <?php
									 $applied = date_format($cash['created_at'],'Y F d' );
									 $approvedOn = date_format($cash['updated_at'],'Y F d' );
										  
											$admin = Admin::select('name','email')->where('id','=', $cash['approved_by'])->get()->first();
											
									 ?>
										<tr id="row{{ $cash['id'] }}">
											<td>{{ $cash['employeeID'] }}</td>
											<td>
											{{ $cash->getEmployeeDetails->firstName .' '}}
											{{ $cash->getEmployeeDetails->lastName }}
											</td>
											<td>{{$applied}}</td>
											<td>{{ $cash['amount'] }}</td>
											<td>
												@if($cash['status'] == 'rejected')
												<span class='label label-danger'>{{ $cash['status'] }}</span>
												@elseif($cash['status'] == 'approved')
												<span class='label label-success'>{{ $cash['status'] }}</span>
												@elseif($cash['status'] == 'pending')
												<span class='label label-warning'>{{ $cash['status'] }}</span>
												@endif
											</td>
											<td>{{ $cash['remarks']?:'--'  }}</td>
											<td>{{ $admin['name']?:'--' }}</td>
											<td class=" " style="width: 110px;">
												<div class="btn-actions">
												   @if($cash['status'] != 'approved')
														<a class="btn btn-1"  data-toggle="modal" data-target=".edit_cashadvance" href="javascript:;" onclick="showEdit('{{$cash->id}}')"><i class="fa fa-edit fa-fw"></i></a>
														<a class="btn btn-1" href="javascript:;" onclick="del({{$cash->id}},'{{ $cash->employeeID }}')"><i class="fa fa-trash fa-fw"></i></a>
													@else
													<span class=" text-success"><i class="fa fa-check fa-fw"> </i> Approved on {{$approvedOn}}</span>
														
													@endif
												</div>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
								<h2 class="heading-md"></h2>

								
						</table>
						</div>
				

				 </div>
            </div>

</div>

<!-- Modals -->
<div id="edit_static" class="modal fade edit-department" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-edit fa-fw"></i></span>
                        <span>{{ 'Cash Advance'}}</span>
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
                                            <label for="deptName" class="text-success">{{'Cash Advance'}}</label>
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
	
<!-- End Modals -->
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->

	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}


<!-- END PAGE LEVEL PLUGINS -->
<script>


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
                    url : "{{ url('api/delete/cashadvance') }}/" + id,
                    dataType: 'json',
                    })
                    .done(function(response){
                     if(response.success == "deleted"){
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#deleteModal').modal('hide');
                        $('#row'+id).fadeOut(500);
                        showToastrMessage(' {{Lang::get('messages.successDelete')}} ', '{{Lang::get('messages.success')}}', 'success'); 
                        setTimeout(function() {
                            window.location.replace('{{ route('admin.cashadvance.index') }}')
                        }, 1000);           
                    }
                        });
                    })

    			}

			function showEdit(id)
			{

                    var url = "{{ route('front.cashadvance.update',':id') }}";
                    url = url.replace(':id',id);
                    $('#ca-update-form').attr('action',url );

					var get_url = "{{ route('front.cashadvance.edit',':id') }}";
					get_url = get_url.replace(':id',id);

                    $.ajax({

                            type: "GET",
                            url : get_url,

                            data: {"id":id}

                            }).done(function(response)
                              {
								
                                  console.log(response[0]['amount']);
                                        $("#amount").val( response[0]['amount']);
										$("#remarks").val(response[0]['remarks']);
                                       
                             });

			}
           
</script>
@stop