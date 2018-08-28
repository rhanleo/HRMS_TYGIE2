@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
    {{HTML::style("assets/global/plugins/select2/select2.css")}}
    {{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
    {{HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css")}}
@stop
@section('mainarea')
  <div class="content-section">
    @include('admin.common.error')
    <div class="row">
      <div class="col-md-12">
        <div class="portlet box">
          <div class="portlet-title has-pad">
            <div class="title-left">
              <span class="icon"><i class="fa fa-plus fa-fw"></i></span>
              <span>{{trans('core.new')}} {{trans('core.notice')}}</span>
              <div class="tools"></div>
            </div>
          </div> {{-- end of .portlet-title --}}
          <div class="portlet-body">
            {{Form::open(array('route'=>["admin.noticeboards.update",$notice->id],'class'=>'form-horizontal form-bordered','method'=>'PATCH'))}}
            <div class="form-body">
              <div class="form-group">
                <label class="col-md-2 control-label">{{trans('core.title')}}: <span class="required">
                * </span>
                </label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="title" placeholder="{{trans('core.title')}}" value="{{$notice->title}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">{{trans('core.description')}}: <span class="required">
                * </span>
                </label>
                <div class="col-md-6">
                <textarea class="form-control" id="summernote_1" name="description" >{{$notice->description}}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">{{trans('core.status')}}: <span class="required">* </span></label>
                <div class="col-md-6">
                    <select class="form-control" name="status">
                      <option value="active" @if($notice->status=='active')selected @endif >Active</option>
                      <option value="inactive" @if($notice->status=='inactive')selected @endif>Inactive</option>
                   </select>      
                 </div>
              </div>
              <div class="btn-panel">
                <button type="submit" data-loading-text="Updating..." class="demo-loading-btn btn btn-1">
                  <span class="icon"><i class="fa fa-check fa-fw"></i></span>
                  <span>Update</span>
                </button>
              </div>
            </div> {{-- end of .form-body --}}
            {{ Form::close() }}
          </div> {{-- end of .portlet-body --}}
        </div> {{-- end of .portlet --}}
      </div>
    </div>
  </div> {{-- end of .content-section --}}
@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js")}}
{{HTML::script("assets/global/plugins/select2/select2.min.js")}}
{{HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}
{{HTML::script("assets/global/plugins/bootstrap-summernote/summernote.min.js")}}
 <script>
  $('#summernote_1').summernote({height: 300});

 </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop