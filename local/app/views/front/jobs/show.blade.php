@extends('front.layouts.frontlayout')

@section('head')

{{HTML::style("assets/global/css/components.css")}}
{{HTML::style("assets/global/css/plugins.css")}}
{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}

@stop

@section('mainarea')
            <div class="col-md-9">

                <!--Profile Body-->
                <div class="profile-body">
                <h2>{{trans('core.jobVacancy')}}</h2><hr>
            <div class="row">

			   @foreach($jobs as $job)
					<div class="col-md-4 col-sm-6">
						<a href="{{route('jobs.show',$job->id)}}">
							<div class="service-block  service-block-{{$job_block_color[$job->id%count($job_block_color)]}}">
								<i class="icon-2x color-light fa fa-{{$job_block_icon[$job->id%count($job_block_icon)]}}"></i>
								<h2 class="heading-md">{{$job->position}}</h2>

							</div>
						</a>
					</div>
				@endforeach

				</div><hr>
				<div class="row">
				 <div class="col-md-12">
				 		<div class="headline"><h2>{{$job_detail->position}}</h2></div>
				 </div>

					 <div class="col-md-6">
					 	{{$job_detail->description}}
					 	<hr>
					 	{{--<p><strong>Last Date to Apply:</strong> {{date('d M Y',strtotime($job_detail->last_date))}}</p>--}}
					 	</div>

					<div class="col-md-6">
					<button type="submit" class="btn-u field btn-block" id="apply_button" onclick="ShowApplyForm();return false;">{{trans('core.applyNow')}}</button>
                                            <!-- Reg-Form -->
                                             {{Form::open(array('route'=>'jobs.store','class'=>'sky-form','id'=>'apply_job_form','style'=>'display: none','files'=>true))}}

										 @if ($errors->has())
												<div class="alert alert-danger alert-dismissable ">
											   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
													@foreach ($errors->all() as $error)
														<p><strong><i class="fa fa-warning"></i></strong> {{ $error }}</p>
													@endforeach
												</div>
										 @endif
                                             <input type="hidden" name="jobID" value="{{$job_detail->id}}">
                                                <header>{{trans('core.applicationForm')}}</header>

                                                <fieldset>
                                                    <section>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" placeholder="{{trans('core.name')}}" value="{{ Input::old('name') }}">
                                                            <b class="tooltip tooltip-bottom-right">Name of applicant</b>
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-envelope"></i>
                                                            <input type="email" name="email" placeholder="{{trans('core.email')}}" value="{{ Input::old('email') }}">
                                                            <b class="tooltip tooltip-bottom-right">Email of applicant</b>
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-phone"></i>
                                                            <input type="text" name="phone" placeholder="{{trans('core.phone')}}" id="phone" value="{{ Input::old('phone') }}">
                                                            <b class="tooltip tooltip-bottom-right">Phone number of applicant</b>
                                                        </label>
                                                    </section>

                                                    <section>

															<label class="textarea">
																<textarea rows="3" name="cover_letter" placeholder="{{trans('core.coverLetter')}}">{{ Input::old('cover_letter') }}</textarea>
															</label>

														</section>

														  <section>
														  <label class="label">{{trans('core.resume')}}</label>
															<label for="file" class="input input-file">
																<div class="button"><input type="file" name="resume" onchange="this.parentNode.nextSibling.value = this.value">{{trans('core.browse')}}</div><input type="text" placeholder="{{trans('core.includeSomeFile')}}" readonly>
															</label>
														</section>
                                                </fieldset>


                                                <footer>
                                                    <button type="submit" class="btn-u">{{trans('core.btnSubmit')}}</button>
                                                </footer>
                                            </form>
                                            <!-- End Reg-Form -->
                                        </div>

				</div>
            </div>

</div>


@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->

	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}


<!-- END PAGE LEVEL PLUGINS -->
<script>
	function ShowApplyForm(){
		$('#apply_button').hide();
		$('#apply_job_form').fadeIn();
	}
     @if(Session::get('success') || $errors->has())
     	   ShowApplyForm();
     @endif
</script>

@stop