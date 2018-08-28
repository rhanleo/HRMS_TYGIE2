{{Form::open(array('url'=>"",'class'=>'form-horizontal ','method'=>'POST','id'=>'edit_form'))}}

					<div id="error_edit"></div>
					<div class="form-body">

					<div class="form-group">
					<label class="col-md-4 control-label">{{trans('core.name')}}: <span class="required">
					* </span>
						</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="name" placeholder="{{trans('core.name')}}" value="{{$admin->name}}" >
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-4 control-label">{{trans('core.email')}}: <span class="required">
					* </span>
						</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="email" placeholder="{{trans('core.email')}}" value="{{$admin->email}}">
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-4 control-label">{{trans('core.password')}}:
						</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password" placeholder="{{trans('core.password')}}" >
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-4 control-label">{{trans('core.confirmPassword')}}:
						</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password_confirmation" placeholder="{{trans('core.confirmPassword')}}">
						</div>
					</div>


				 </div>
				<div class="btn-panel">
					<button type="submit" id="submitbutton_edit" onclick="updateData({{$admin->id}});return false;"  class=" btn btn-1">{{trans('core.btnSubmit')}}</button>
				</div>				
{{ Form::close() }}