<?php

class JobApplicationsController extends AdminBaseController {

	public function __construct()
	{
		parent::__construct();
		$this->data['pageTitle']        =   trans('core.jobApplications');
		$this->data['jobsOpen']         =   'active open';
		$this->data['jobsApplicationActive']    =   'active';

	}
	public function index()
	{
		$this->data['job_applications'] = JobApplication::all();

		return View::make('admin.job_applications.index', $this->data);
	}

	public function ajax_jobs_applications()
	{
		$result = JobApplication::select('job_applications.id','jobs.position','name','job_applications.email',
									'job_applications.phone','job_applications.created_at','fullName','job_applications.status')
					->join('jobs', 'jobs.id', '=', 'job_applications.jobID')
					->join('employees', 'employees.employeeID', '=', 'job_applications.submitted_by')
		             ->orderBy('job_applications.id','desc');

		return Datatables::of($result)


		                 ->edit_column('status',function($row)
		                 {
			                 $color = [
				                 'selected'   =>  'success',
				                 'rejected'   =>  'danger',
				                 'pending'    =>  'warning'
			                 ];

			                 $string="<span  id='status{$row->id}' class='margin-bottom-10 label label-{$color[$row->status]}'>".trans('core.'.($row->status))."</span><br><br>";

			                 return $string;
		                 })
		                 ->add_column('edit', function($row){
			                 $string ='';
			                 $display_accept    =   '';
			                 $display_reject    =   '';

			                  if($row->status=='rejected'){
				                  $display_reject = 'style="display:none"';

			                  }

			                 elseif($row->status=='selected') {
				                 $display_accept= 'style="display:none"';

			                 }
			                 $accept ='<a '.$display_accept.' id="accept'.$row->id.'"  data-container="body" data-placement="top" data-original-title="Approve" href="javascript:;" onclick="changeStatus('.$row->id.',\'selected\');return false;" class="btn green btn-sm tooltips margin-bottom-10"><i class="fa fa-check"></i></a>';
			                 $reject ='<a '.$display_reject.' id="reject'.$row->id.'" data-placement="top" data-original-title="Reject"  href="javascript:;" onclick="changeStatus('.$row->id.',\'rejected\');return false;" class="btn red btn-sm tooltips margin-bottom-10"><i class="fa fa-close"></i></a>';

			                 $string.='<p>'.$accept.$reject.'</p>';

			                 $string.='
						 			<a  class="btn bg-blue-ebonyclay btn-sm margin-bottom-10"  href="javascript:;" onclick="showView('.$row->id.');return false;" ><i class="fa fa-eye"></i> '.trans('core.btnView').'</a>
	                  	 			<a   href="javascript:;" onclick="del('.$row->id.');return false;" class="btn red btn-sm margin-bottom-10">
                        			<i class="fa fa-trash"></i> '.trans('core.btnDelete').'</a>';
			                 return $string;
		                 })
		                 ->make();
	}

	public function change_status(){

		$input  = Input::all();
		$job_application = JobApplication::findOrFail($input ['id']);
		$job_application->status = $input['status'];
		$job_application->save();

		$output['status'] = 'success';

		$output['msg']    = 'Updated Successfully';

		return Response::json($output, 200);
	}
	public function create()
	{
		return View::make('admin.job_applications.create');
	}

	/**
	 * Store a newly created JobApplication in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), JobApplication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		JobApplication::create($data);

		return Redirect::route('admin.job_applications.index');
	}


	public function show($id)
	{
		$this->data['job_application'] = JobApplication::findOrFail($id);
		$this->data['color'] = [
			'selected'   =>  'success',
			'rejected'   =>  'danger',
			'pending'    =>  'warning'
		];

		return View::make('admin.job_applications.show', $this->data);
	}

	public function getDownload($resume){
		//PDF file is stored under project/public/download/info.pdf
		$file= public_path(). "/job_applications/".$resume;

		return Response::download($file);
	}

	public function edit($id)
	{
		$jobapplication = JobApplication::find($id);

		return View::make('admin.job_applications.edit', compact('jobapplication'));
	}

	/**
	 * Update the specified JobApplication in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jobapplication = JobApplication::findOrFail($id);

		$validator = Validator::make($data = Input::all(), JobApplication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jobapplication->update($data);

		return Redirect::route('admin.job_applications.index');
	}

	/**
	 * Remove the specified jobapplication from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

			JobApplication::destroy($id);
			$output['success'] = 'deleted';
			return Response::json($output, 200);

	}

}
