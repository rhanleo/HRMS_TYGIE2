<?php

/**
 * Class EmployeesController
 * This Controller is for the all the related function applied on employees
 */

class ScheduleController extends \AdminBaseController {

	/**
	 * Constructor for the Employees
	 */

	public function __construct()
	{
		parent::__construct();
		$this->data['employeesOpen'] =   'active open';
		$this->data['pageTitle']     =   trans('menu.employees');
	}

	public function index()
	{
		$this->data['employees']       =    Employee::all()->sortBy('employeeID');
		$this->data['employeesActive'] =   'active';
		
		return View::make('admin.schedule.index', $this->data);
	}



	/**
	 * Show the form for creating a new employee
	 */
	public function create($id)
	{
		$this->data['employeesActive'] =   'active';
		$this->data['employee']         =   Employee::where('employeeID', '=' ,$id)->get()->first();

		return View::make('admin.schedule.create',$this->data);
	}

	/**
	 * Store a newly created employee in storage
	 */
	public function store()
	{
		$validator = Validator::make($input = Input::all(), Employee::rules('schedule'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		DB::beginTransaction();
		try {

			// dd($input['dateTo']);exit;

			Schedule::create([
				'employeeID'    => $input['employeeID'],
				'dateFrom'   => date('Y-m-d',strtotime($input['dateFrom'])),
				'dateTo'   => date('Y-m-d',strtotime($input['dateTo'])),
				'timeFrom'    => $input['timeFrom'],
				'timeTo'      	=> $input['timeTo'],
				'shift'        => $input['shift'],
				'remarks'         => $input['remarks'],			
			]);


		}catch(\Exception $e)
		{
			DB::rollback();
			dd($e);
		}

		DB::commit();
		$fullName = $input['name'] ;
		return Redirect::route('admin.schedule.index')->with('success',"<strong>{$fullName}</strong> successfully added to the Database");
	}


	/**
	 * Show the form for editing the specified employee
	 */
	public function edit($id)
	{
		$this->data['employeesActive']  =   'active';
		$this->data['schedule']         =   Schedule::where('id', '=' ,$id)->get()->first();
		$empId = $this->data['schedule']['employeeID'];
		$this->data['employee']         =   Employee::where('employeeID', '=' ,$empId)->get()->first();
		
		if(count($this->data['schedule'])==0){
			return Response::view('admin.errors.500', array(), 404);
		}

		$dateFrom = date_create($this->data['schedule']['dateFrom']);
		$dateTo = date_create($this->data['schedule']['dateTo']);
		$this->data['dateFrom']  = date_format($dateFrom, "d-m-Y");
		$this->data['dateTo']  = date_format($dateTo, "d-m-Y");
		return View::make('admin.schedule.edit', $this->data);
	}



	/**
	 * Update the specified employee in storage.
	 */
	public function update($id)
	{
		try {
			
		
				$validator = Validator::make($input = Input::all(), Employee::rules('schedule'));

				if ($validator->fails())
				{
					$output['status']   =   'error';
					$output['msg']      =   $validator->getMessageBag()->toArray();

				}else{
					$schedule = Schedule::find($id);

					// $schedule->employeeID   = Input::get('employeeID');
					$schedule->dateFrom     = date('Y-m-d',strtotime($input['dateFrom']));
					$schedule->dateTo       = date('Y-m-d',strtotime($input['dateTo']));
					$schedule->timeFrom     = Input::get('timeFrom');
					$schedule->timeTo       = Input::get('timeTo');
					$schedule->shift        = Input::get('shift');
					$schedule->remarks      = Input::get('remarks');
					$schedule->save();

				}

				return Redirect::route('admin.schedule.index')->with('success',"<strong>schedule</strong> successfully updated.");
		
		} catch (\Exception $e) {
			dd($e);
		}
	}





	public function destroy($id)
	{
		Schedule::where('id', '=', $id)->delete();
		return Redirect::route('admin.schedule.index')->with('success',"<strong>schedule</strong> successfully deleted.");
		
	}


}
