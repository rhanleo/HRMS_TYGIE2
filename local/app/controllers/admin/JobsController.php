<?php

class JobsController extends \AdminBaseController {

	public function __construct()
	{
		parent::__construct();
		$this->data['pageTitle']        =   trans('core.job');
		$this->data['jobsOpen']         =   'active open';
		$this->data['jobsPostedActive']    =   'active';
		$this->data['designation']    =   Designation::select('designation')->get()->toJson();
		$this->data['designation']      =   str_replace('"designation"',"designation",$this->data['designation']);
	}
	
	public function index()
	{
		$this->data['jobs'] = Job::all();

		return View::make('admin.jobs.index', $this->data);
	}

	//Datatable ajax request
	public function ajax_jobs()
	{
		$result = Job::select('id','position','posted_date','last_date','close_date','status')
		                     ->orderBy('created_at','desc');

		return Datatables::of($result)

		                 ->edit_column('status',function($row)
		                 {
			                 $color = [
				                 'active'   =>  'success',
				                 'inactive'  =>  'danger'
			                 ];
			                 return "<span class='label label-{$color[$row->status]}'>{$row->status}</span>";
		                 })
		                 // ->add_column('edit', '
                   //   <a  class="btn purple btn-sm margin-bottom-10"  href="{{ route(\'admin.jobs.edit\',$id)}}" ><i class="fa fa-edit"></i> {{trans("core.btnViewEdit")}} </a>
	                  //  <a  style="width: 94px;" href="javascript:;" onclick="del(\'{{ $id }}\');return false;" class="btn red btn-sm margin-bottom-10">
                   //      <i class="fa fa-trash"></i> {{trans("core.btnDelete")}} </a>')
                        
				            ->add_column('edit',function($row){
				            	$string = '<div class="btn-actions">';
				            	$string .= '<a class="btn btn-1" href="'. route('admin.jobs.edit', $row->id).'"><i class="fa fa-edit fa-fw"></i></a>';
				              $string .= '<a href="javascript:;" onclick="del(\''.$row->id.'\');return false;" class="btn btn-1"> <i class="fa fa-trash fa-fw"></i></a>';
				              $string .= '</div>';
				              return $string;
				            })
		                 ->make();
	}

	/**
	 * Show the form for creating a new job
	 *
	 * @return Response
	 */
	public function create()
	{

		//print_r($this->data['designation']  );die;
		return View::make('admin.jobs.create',$this->data);
	}

	/**
	 * Store a newly created job in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Job::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Job::create($data);
		if($this->data['setting']->job_notification==1)
		{
			//        Send email to all Employees
			$employees = Employee::select('email')->where('status', '=', 'active')->get();
			foreach ($employees as $employee) {
				$email = "{$employee->email}";

				$this->data['employee_name'] = $employee->fullName;

				//Send Email to All active users
				Mail::send('emails.admin.noticeboard', $this->data, function ($message) use ($email) {
					$message->from($this->data['setting']->email, $this->data['setting']->name);
					$message->to($email)
					        ->subject('New Job Vacancy - ' . $this->data['setting']->website);
				});
			}
		}
		Session::flash('success', Lang::get('messages.successAdd'));

		return Redirect::route('admin.jobs.index');
	}


	public function show($id)
	{
		$job = Job::findOrFail($id);

		return View::make('admin.jobs.show', compact('job'));
	}

	/**
	 * Show the form for editing the specified job.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$this->data['job'] = Job::find($id);

		return View::make('admin.jobs.edit',$this->data);
	}

	/**
	 * Update the specified job in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$job = Job::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Job::$rules);


		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$job->update($data);
		Session::flash('success', Lang::get('messages.successUpdate'));
		return Redirect::route('admin.jobs.index');
	}

	/**
	 * Remove the specified job from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Job::destroy($id);
		$output['success'] = 'deleted';

		return Response::json($output, 200);
	}

}
