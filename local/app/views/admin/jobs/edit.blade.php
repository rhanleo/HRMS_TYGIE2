@extends('admin.adminlayouts.adminlayout')
@section('head')
	{{HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css")}}
	{{HTML::style("assets/global/plugins/select2/select2.css")}}
	{{ HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css") }}
	{{HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}
	{{HTML::style("assets/global/plugins/typeahead/typeahead.css")}}
	{{HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css")}}
@stop
@section('mainarea')
	<div class="content-section">
		@include('admin.common.error')
		<div class="row">
			<div class="col-xs-12">
				<div class="portlet box">
					<div class="portlet-title has-pad">
						<div class="title-left">
							<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
							<span>{{Lang::get('core.btnAddJob')}}</span>
							<div class="tools"></div>
						</div>
					</div>
					<div class="portlet-body form">
						{{Form::open(array('route'=>["admin.jobs.update",$job->id],'class'=>'form-horizontal form-bordered','method'=>'PUT'))}}
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.position')}} : <span class="required">
									* </span>
									</label>
									<div class="col-md-6">
									<input type="text" class="form-control" id="typeahead_example_1" name="position" placeholder="{{trans('core.position')}} " value="{{ $job->position }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">{{trans('core.description')}} : <span class="required">
									* </span>
									</label>
									<div class="col-md-6">
										<textarea class="form-control" id="summernote_1" name="description" >{{ $job->description }}</textarea>
									</div>
								</div>
								<div class="form-group">
								<label class="col-md-2 control-label">{{trans('core.postedDate')}} :
								</label>
								<div class="col-md-6">
								<div class="input-group input-medium date date-picker"  data-date-viewmode="years">
								<input type="text" class="form-control" name="posted_date" id="posted_date" data-date-format="dd-mm-yyyy" data-date-viewmode="years" readonly value="{{ $job->posted_date }}" >
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
								</div>

								</div>

								</div>
								<div class="form-group">
								<label class="col-md-2 control-label">{{trans('core.lastDateToApply')}}
								</label>
								<div class="col-md-6">
								<div class="input-group input-medium date2 " >
								<input type="text" class="form-control" name="last_date" id="last_date" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  readonly value="{{ $job->last_date }}">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
								</div>

								</div>
								</div>

								<div class="form-group">
								<label class="col-md-2 control-label">{{trans('core.closeDate')}} :
								</label>
								<div class="col-md-6">
								<div class="input-group input-medium date1" >
								<input type="text" class="form-control" name="close_date" data-date-format="dd-mm-yyyy" data-date-viewmode="years" id="close_date" readonly value="{{ $job->close_date }}">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
								</div>
								</div>
								</div>

								<div class="form-group">
										<label class="col-md-2 control-label">{{trans('core.status')}}</label>
										<div class="col-md-6">

												<label class="radio-inline">
												<input type="radio" name="status"  value="active" @if($job->status=='active') checked="checked" @endif> Active </label>
												<label class="radio-inline">
												<input type="radio" name="status"  value="inactive"  @if($job->status=='inactive') checked="checked" @endif> Inactive </label>


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
					</div>
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
{{HTML::script("assets/global/plugins/typeahead/typeahead.bundle.min.js")}}
{{ HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
 <script>
	$('#summernote_1').summernote({height: 300});
	$('#posted_date').datepicker();
	$('#last_date').datepicker();
	$('#close_date').datepicker();


		var numbers = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.designation); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: {{$designation}}
        });

        // initialize the bloodhound suggestion engine
        numbers.initialize();

        // instantiate the typeahead UI
        if (Metronic.isRTL()) {
          $('#typeahead_example_1').attr("dir", "rtl");
        }
        $('#typeahead_example_1').typeahead(null, {
          displayKey: 'designation',
          hint: (Metronic.isRTL() ? false : true),
          source: numbers.ttAdapter()
        });
 </script>
<!-- END PAGE LEVEL PLUGINS -->
@stop