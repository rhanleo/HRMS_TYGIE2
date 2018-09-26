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
                                <span>{{'Rental'}}</span>
                                <div class="tools"></div>
                            </div>
                            <div class="btn-portlet-right">
                            <a class="btn green" data-toggle="modal" href="#add_static" title="Import employee using Excel file">
								<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
								<span>{{'ADD RENTAL'}}</span>
							</a>
                            
                            </div>
                        </div> {{-- end of .portlet-title --}}
                        <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_employees">
                                <thead>
                                    <tr>
                                        <th>{{'Employee ID'}}</th>
                                        <th>{{'Name'}}</th>
                                        <th>{{'Billing Date'}}</th>
                                        <th>{{'Amount'}}</th>
                                        <th>{{'Status'}}</th>
                                        <th>{{'Remarks'}}</th>
                                        <th style="width: 110px;">{{trans('core.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($rentals)>0)
                                    
                                        @foreach($rentals as $rental)
                                         <?php
                                         $dateCovered =  date_format(date_create($rental['date_covered']),'F d, Y' );       
                                         ?>
                                            <tr id="row{{ $rental['id'] }}">
                                                <td>{{ $rental['employeeID'] }}</td>
                                                <td>
                                                {{ $rental->getEmployeeDetails->firstName .' '}}
                                                {{ $rental->getEmployeeDetails->lastName }}
                                                </td>
                                                <td>{{$dateCovered}}</td>
                                                <td>{{ $rental['amount'] }}</td>
                                                <td>
                                                    @if($rental['status'] == 'unpaid')
                                                    <span class='label label-danger'>{{ $rental['status'] }}</span>
                                                    @elseif($rental['status'] == 'paid')
                                                    <span class='label label-success'>{{ $rental['status'] }}</span>
                                                    @elseif($rental['status'] == 'partial')
                                                    <span class='label label-warning'>{{ $rental['status'] }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $rental['remarks'] }}</td>
                                                <td class=" " style="width: 110px;">
                                                    <div class="btn-actions">
                                                       
                                                            <a class="btn btn-1"  data-toggle="modal" href="#edit_static" onclick="showEdit('{{$rental->id}}','{{ $rental->employeeID }}')"><i class="fa fa-edit fa-fw"></i></a>
                                                            <a class="btn btn-1" href="javascript:;" onclick="del({{$rental->id}},'{{ $rental->employeeID }}')"><i class="fa fa-trash fa-fw"></i></a>
                                                      
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
                        <span>{{ 'Rental'}}</span>
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
                                            <label for="deptName" class="text-success">{{' Rental'}}</label>
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
                                {{ 'Note: Empting a field will delete all the Employees associated with it' }}  
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
    <div id="add_static" class="modal fade edit-department" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="icon"><i class="fa fa-edit fa-fw"></i></span>
                        <span>{{ 'Rental'}}</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div> {{-- end of .modal-header --}}
                <div class="modal-body">
                    <div class="portlet-body form">
                        {{ Form::open(array( 'method' => 'POST', 'route' => 'admin.rental.store', 'class' => 'custom-form' , 'id'=>'add_form' ) ) }}
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">

                                            <div calss="form-group row">
                                            
                                                <div class="col-md-12"> 
                                                <h3>{{'Add Rental '}}</h3>
                                                    <label for="deptName" class="text-success">Select Employee</label>
                                                    {{ Form::select('employeeID', $employees,null,['class' => 'form-control input-xlarge select2me','data-placeholder'=>'Select Employee...']) }}
                                                
                                                </div>
                                            </div><br/>
                                            <div calss="form-group row">
                                                <div class="col-md-4">      
                                                    <label for="amount" class="text-success">Amount <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="amount" placeholder="1500" required style="border:1px solid #000;">
                                                </div>
                                            </div>
                                            <div calss="form-group row">
                                                <div class="col-md-4">
                                                    <label for="dateCovered" class="text-success">Date Covered <span class="text-danger">*</span></label>
                                                    <input  type="text" name="date_covered" class="date date-picker form-control" required placeholder=""></br>
                                                </div>
                                            </div>
                                            <div calss="form-group row">
                                                <div class="col-md-4">
                                                    <label for="status" class="text-success">Status <span class="text-danger">*</span></label>
                                                    <select name="status" required style="padding:5px;width:100%;">
                                                        <option value="">Select</option>
                                                        <option value="paid">Paid</option>
                                                        <option value="unpaid">Unpaid</option>
                                                        <option value="partial">Partial</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div calss="form-group row">
                                                <div class="col-md-12">
                                                    <label for="dateCovered" class="text-success">Remarks</label>
                                                    <textarea  type="text" name="remarks" class="form-control"  placeholder=""></textarea><br/>
                                                </div>
                                            </div>
                                            <div calss="form-group row">
                                                <div class="col-md-12">
                                                    <input class="btn btn-info" type="submit" name="add" value="Add" >
                                                </div>
                                            </div>
                                            <div id="load">
                                                @include('admin.common.error')
                                            </div>
                                        
                                    </div>
                                </div>
                                
                            </div> {{-- end of .form-body --}}
                            
                        {{ Form::close() }}
                    </div> {{-- end of .portlet-body --}}
                </div> {{-- end of .modal-body --}}
            </div> {{-- end of .modal-content --}}
        </div> {{-- end of .modal-dialog --}}
    </div> {{-- end of .edit-department --}}
    
    @include('admin.common.delete')
@stop

@section('footerjs')
    {{ HTML::script("assets/global/plugins/select2/select2.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}
    {{ HTML::script("assets/admin/pages/scripts/table-managed.js")}}

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
    {{HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{HTML::script('assets/admin/pages/scripts/components-pickers.js')}}
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {

        ComponentsPickers.init();
    });
</script>

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
                    var url = "{{ route('admin.rental.update',':id') }}";
                    url = url.replace(':id',id);
                    $('#edit_form').attr('action',url );

					var get_url = "{{ route('admin.rental.edit',':id') }}";
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
	