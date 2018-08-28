<div class="tabbable-custom ">
		<ul class="nav nav-tabs ">
			<li class="active">
				<a href="#details" data-toggle="tab" aria-expanded="true">
				{{trans('core.applicantDetails')}} </a>
			</li>
			<li class="">
				<a href="#resume" data-toggle="tab" aria-expanded="false">
				{{trans('core.resume')}} </a>
			</li>

		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="details">
				<p>
					{{trans('core.applicantDetails')}}
				</p>
				<div class="table-responsive">
						<table class="table table-striped table-hover">

						<tbody>
						<tr>
								<td><strong>{{trans('core.position')}}:</strong></td>
								<td>{{$job_application->job->position}}</td>

						</tr>
						<tr>
							<td><strong>{{trans('core.name')}}:</strong></td>
							<td>{{$job_application->name}}</td>

						</tr>
						<tr>
							<td><strong>{{trans('core.email')}}:</strong></td>
							<td> {{$job_application->email}}</td>
						</tr>
						<tr>
							<td><strong>{{trans('core.phone')}}:</strong></td>
							<td> {{$job_application->phone}}</td>
						</tr>
						<tr>
							<td><strong>{{trans('core.submittedBy')}}:</strong></td>
							<td> {{$job_application->employeeDetails->fullName}}</td>
						</tr>
						<tr>
							<td><strong>{{trans('core.appliedOn')}}:</strong></td>
							<td> {{$job_application->created_at}}</td>
						</tr>

							<tr>
							<td><strong>{{trans('core.status')}}</strong></td>
							<td> <span  class='margin-bottom-10 label label-{{$color[$job_application->status]}}'>{{trans('core.'.$job_application->status)}}</span></td>
						</tr>

						</tbody>
						</table>
					</div>
			</div>
			<div class="tab-pane" id="resume">
				<p><strong>{{trans('core.coverLetter')}}:</strong></p>
				<p>
					{{$job_application->cover_letter or ''}}
				</p>
				<p>
				<a href="https://docs.google.com/viewer?url={{URL::to('job_application/resume/'.$job_application->resume)}}" target="_blank" class="btn green btn-sm">{{trans('core.btnView')}} {{trans('core.resume')}}</a>

				  <a class="bg-blue-ebonyclay btn btn-sm" href="{{route('admin.job_applications.get_download',$job_application->resume)}}" ><i class="fa fa-download"></i> {{trans('core.btnDownload')}} {{trans('core.resume')}}</a>
				</p>
			</div>

		</div>
</div>