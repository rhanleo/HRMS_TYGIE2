<?php

class RentalFrontController extends \FrontBaseController {

	public function __construct()
    {

        parent::__construct();
		$this->data['pageTitle']   =   'Rental';
		$this->data['rentalActive']   =   'active';

    }



	public function index($id)
	{
		$this->data['rentals']      =      Rental::where('employeeID','=',$id)->get();
		return View::make('front.rental.index',$this->data);
	}

	//	show Job  Page
	public function show($id)
	{
		$this->data['jobActive'] =    'active';
		$this->data['jobs']      =      Job::where('status','=','active')->get();
		$this->data['job_detail']       =      Job::find($id);
		
		return View::make('front.jobs.show',$this->data);
	}

	//	show Job  Page
	public function store()
	{
		$this->data['jobActive'] =    'active';
		$this->data['jobs']      =      Job::where('status','=','active')->get();

		$this->data['job_block_color']  = ['brown','light-green','dark'];
		$this->data['job_block_icon']  = ['bell-o','globe','thumbs-o-up'];

		$validator = Validator::make($data = Input::all(), JobApplication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (Input::hasFile('resume')) {

			$path = public_path()."/job_applications/";
			File::makeDirectory($path, $mode = 0777, true, true);

			$file 	= Input::file('resume');
			$extension      = $file->getClientOriginalExtension();
			$name = explode(" ", trim($data['name']));


			$filename	= "resume-{$name['0']}-".rand(1,4000).".$extension";
			Input::file('resume')->move($path, $filename);
			$data['resume'] = $filename;
		}
		$this->data['position']  = Job::select('position')->where('status','=','active')->where('id','=',$data['jobID'])->first()->position;
		$data['status']         =   'pending';
		$data['submitted_by']   = $this->data['employeeID'];
		$this->data['job_application'] = $data;
		JobApplication::create($data);

		$admins = Admin::select('email')->get()->toArray();
		foreach ($admins as $admin){
			Mail::send('emails.job_application', $this->data, function ($message) use ($admin) {
				$message->from(Auth::employees()->get()->email, Auth::employees()->get()->fullName);
				$message->to($admin['email'])
				        ->subject('New Job Application - ' . $this->data['setting']->website);
			});
		}

		return Redirect::route('job_front.index')->with('success',Lang::get('messages.successApplyJob'));
	}


}