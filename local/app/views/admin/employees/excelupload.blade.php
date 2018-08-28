@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    <!-- <form method="post" action="{{route('admin.employees.excelupload')}}" enctype="multipart/form-data"> -->
                    {{Form::open(array('route' => 'admin.employees.excelupload', 'method' => 'post', 'enctype'=>'multipart/form-data'))}}
                        <h3>Select excel file</h3>
                        <div calss="form-control">
                            <input type="file" name="excelFile" required></br>
                            <input class="btn btn-info" type="submit" name="upload" value="Upload" >
                        </div>
                        <div id="load">
                            @include('admin.common.error')
                        </div>
                    {{ Form::close() }}
                    </div> {{-- end of .col-md-4 --}}
                    <div class="col-md-4">
                    
                    </div>
                </div> {{-- end of .col-md-12 --}}
            </div> {{-- end of .row --}}
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
<!-- END PAGE LEVEL PLUGINS -->

	<script>

	function del(id,title) {

        $('#deleteModal').appendTo("body").modal('show');
        $('#info').html('{{Lang::get('messages.deleteConfirm')}}');
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


</script>
@stop
	
