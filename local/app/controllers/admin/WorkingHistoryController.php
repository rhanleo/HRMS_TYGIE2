<?php

/**
 * Class WorkingHistoryController
 * This Controller is for the all the related function applied on employees
 */

class WorkingHistoryController extends \AdminBaseController {

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
		// $this->data['data'] = Employee::select('fullName', 'date_of_birth')
		// ->where('date_of_birth', '=', '1970-01-01')->get();
		// $data = Employee::join('designation', 'employees.designation', '=', 'designation.id')
		// 					->select('designation.designation','employees.employeeID','employees.fullName', 'employees.date_of_birth')->orderBy('employeeID','asc')->get();

		// echo "<pre>";
		// dd($this->data);exit;
		// echo "</pre>";
		return View::make('admin.employee_work_history.index', $this->data);
	}

	public function view($id)
	{
		$this->data['employeesActive']  =   'active';
		$this->data['department']       =   Department::lists('deptName','id');
		$this->data['employee']         =   Employee::where('employeeID', '=' ,$id)->get()->first();
		// echo '<pre>';
		// dd($this->data['employee']);
		// echo '</pre>';
		if(count($this->data['employee'])==0){
			return Response::view('admin.errors.500', array(), 404);
		}
		return View::make('admin.employee_work_history.view', $this->data);
	}

}
