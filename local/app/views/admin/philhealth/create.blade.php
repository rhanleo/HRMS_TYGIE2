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
							<span>{{ (isset($philHealthSettings)) ? 'Edit' : 'New' }} Philhealth Settings</span>
							<div class="tools"></div>
						</div>
					</div> {{-- end of .portlet-title --}}
					<div class="portlet-body">
						{{ Form::open([
							'class' => 'form-horizontal form-bordered',
							'route' => (isset($philHealthSettings)) ? array('admin.philhealth.update', $philHealthSettings->id) : 'admin.philhealth.store',
							'method' => (isset($philHealthSettings)) ? 'PUT' : 'POST'
						]) }}
						<div class="form-body">
							<p><i>Note: Remove comma(",") on inserting data.</i></p>
							<div class="form-group">
								<label class="col-xs-12 col-md-2 control-label">Salary Range</label>
								<div class="col-xs-12 col-md-5">
									<input type="text" class="form-control" id="salary-from" name="salary_from" placeholder="From" autocomplete="off"
										value="{{ isset($philHealthSettings) ? $philHealthSettings->salary_from : Input::old('salary_from') }}"
									/>
								</div>
								<div class="col-xs-12 col-md-5">
									<input type="text" class="form-control" id="salary-to" name="salary_to" placeholder="To" autocomplete="off"
										value="{{ isset($philHealthSettings) ? $philHealthSettings->salary_to : Input::old('salary_to') }}"
									/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-12 col-md-2 control-label">Total Monthly Premium</label>
								<div class="col-xs-12 col-md-5">
									<input type="text" class="form-control" id="monthly-premium" name="total_share" placeholder="Total Monthly Premium" autocomplete="off"
										value="{{ isset($philHealthSettings) ? $philHealthSettings->total_share : Input::old('total_share') }}"
									/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-12 col-md-2 control-label">Employee Share</label>
								<div class="col-xs-12 col-md-5">
									<input type="text" class="form-control" id="employee-share" name="employee_share" placeholder="Employee Share" autocomplete="off"
										value="{{ isset($philHealthSettings) ? $philHealthSettings->employee_share : Input::old('employee_share') }}"
									/>
								</div>
							</div>

							<div class="btn-panel">
								<button type="submit" data-loading-text="{{trans('core.btnSubmitting')}}..." class="demo-loading-btn btn btn-1">
									<span class="icon"><i class="fa fa-plus fa-fw"></i></span>
									<span>{{trans('core.btnSubmit')}}</span>
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