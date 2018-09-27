<?php

class PayrollsController extends \AdminBaseController {

	public function __construct()
	{
		parent::__construct();
		$this->data['pageTitle']        =   'Payroll';
		$this->data['payrollOpen']      =   'active open';
		$this->data['payrollActive']    =   'active';
	}

	public function index()
	{
		$this->data['payrolls'] = Payroll::all();
		$this->data['close_sidebar'] = true;
		return View::make('admin.payrolls.index', $this->data);
	}

	// Datatable ajax request
	public function ajax_payrolls()
	{
		//$result = Payroll::select(DB::raw('`payrolls`.`id`,`payrolls.`employeeID`,`fullName`,`month`,`year`,`net_salary`,`payrolls`.`created_at`'))
		$where_in = array(1,2);
		$settings = DB::table('settings')->first();
		$select_arr = array(
						'payrolls.id',
						'fullName',
						'payrolls.employeeID',
						'payrolls.period',
						'month',
						'year',
						'payrolls.sss_deduction',
						'payrolls.philhealth_deduction',
						'payrolls.pagibig_deduction',
						'payrolls.withholding_tax',
						'payrolls.overtime_pay',
						'net_salary',
						'payrolls.created_at',
					);

		$result = Payroll::select($select_arr)
				  ->join('employees', 'payrolls.employeeID', '=', 'employees.employeeID')
		          ->orderBy('payrolls.created_at','desc');

		return Datatables::of($result)
						->edit_column('created_at',function($row){
							return date('d-M-Y',strtotime($row->created_at));
						})
						->edit_column('period',function($row){
							return $row->period > 1 ? 'Second Period' : 'First Period';
						})
						->edit_column('sss_deduction',function($row){
							return number_format($row->sss_deduction, 2);
						})
						->edit_column('philhealth_deduction',function($row){
							return number_format($row->philhealth_deduction, 2);
						})
						->edit_column('pagibig_deduction',function($row){
							return number_format($row->pagibig_deduction, 2);
						})
						->edit_column('withholding_tax',function($row){
							return number_format($row->withholding_tax, 2);
						})
						->edit_column('month',function($row){
							return date('F', mktime(0, 0, 0, $row->month, 10));
						})
						->edit_column('overtime_pay',function($row){
							return number_format($row->overtime_pay, 2);
						})
						->edit_column('net_salary',function($row){
							return number_format($row->net_salary, 2);
						})
						->add_column('edit', function($row){
							return '<div class="btn-actions">
							<a title="View" class="btn btn-flat btn-1" href="'.route('admin.payrolls.show',$row->id).'"><i class="fa fa-eye"></i></a>
							<a title="Edit" class="btn btn-flat btn-success" href="'.route('admin.payrolls.edit',$row->id).'"><i class="fa fa-pencil"></i></a>
							<a title="Download PDF" class="btn btn-flat btn-warning" href="'.route('admin.payrolls.downloadpdf',$row->id).'"><i class="fa fa-download"></i></a>
							<a title="Delete" class="btn btn-flat btn-danger" href="javascript:;" onclick="del(\''.$row->id.'\')"><i class="fa fa-trash"></i></a>
							</div>';
							})
						->make();
	}


	public function create()
	{
		$this->data['employees'] = Employee::selectRaw('CONCAT(firstName, " ", lastName, " (EmpID:", employeeID,")") as full_name, employeeID')
		                                   ->where('status','=','active')
		                                   ->lists('full_name','employeeID');

		return View::make('admin.payrolls.create',$this->data);
	}

	public function check(){

		$period = Input::get('period');

		$this->data['payrolls'] = Payroll::where('employeeID','=',Input::get('employeeID'))
									->where('period','=',Input::get('period'))
									->where('month','=',Input::get('month'))
									->where('year','=',Input::get('year'))
									->get()
									->first();
		$this->data['employeeID'] = Input::get('employeeID');
		$this->data['ot_application'] = array(
			'period' => Input::get('period'),
			'month' => Input::get('month'),
			'year' => Input::get('year'),
		);
	
		if(count($this->data['payrolls'])>0){

			$output['success'] ='success';
			$output['content'] = View::make('admin.payrolls.create_edit',$this->data)->render();
			$output['rdr'] = route('admin.payrolls.edit',$this->data['payrolls']->id);

		}
		else {

			$employee_id = Input::get('employeeID');
			$employee  = Employee::where('employeeID', Input::get('employeeID'))->first();

			$this->data['expense'] = Expense::selectRaw( 'month(purchaseDate) as month,year(purchaseDate) as year, sum(price) as sum,employeeID')
											->groupBy('month','year','employeeID')
											->orderBy('month', 'desc')
											->where('employeeID','=',Input::get('employeeID'))
											->where('status','=','approved')
											->whereRaw("month(purchaseDate) ='".Input::get('month')."'")
											->whereRaw("year(purchaseDate) ='".Input::get('year')."'")
											->get()
											->first();

			$this->data['expense'] = isset($this->data['expense']->sum) ? $this->data['expense']->sum : 0;
			$monthName = date('F', mktime(0, 0, 0, Input::get('month'), 10)); // March
			$this->data['awardBonus'] = Award::selectRaw('sum(cashPrice) as sum')
											->where('employeeID','=',Input::get('employeeID'))
											->where('forMonth','=',strtolower($monthName))
											->where('forYear','=',Input::get('year'))
											->get()
											->first();

			$this->data['awardBonus'] = isset($this->data['awardBonus']->sum) ? $this->data['awardBonus']->sum : 0;
			$this->data['basicSalary'] = $this->get_employee_salary(Input::get('employeeID'));


      		/** DEFAULT DEDUCTION VALUES */
      		$settings = DB::table('settings')->first();
			/** DEFAULT DEDUCTION VALUES */
			$sss_deduction = $this->get_sss_deduction($this->data['basicSalary']);
			$philhealth_deduction = $this->get_philhealth_deduction($this->data['basicSalary']);
			$pagibig_deduction = $this->get_pagibig_deduction($this->data['basicSalary']);
			// $withholding_tax = $this->get_with_holding_tax($employee_id, $salary);

			/** CHECK IF TWO PAYROLL CUTOFF */
			if ($settings->enable_two_payroll_period == 1) {

				if ($settings->sss_deduction_period != $period) {
					$sss_deduction = 0;
				}

				if ($settings->pagibig_deduction_period != $period) {
					$pagibig_deduction = 0;
				}

				if ($settings->philhealth_deduction_period != $period) {
					$philhealth_deduction = 0;
				}
			}

			/** FORCE NO DEDUDCTION FOR FREELANCERS */
			if ($employee->employment_status == 'freelancer') {
				$sss_deduction = $philhealth_deduction = $pagibig_deduction = 0;
			}

			$this->data['sss_deduction'] =  $sss_deduction;
			$this->data['philhealth_deduction'] = $philhealth_deduction;
			$this->data['pagibig_deduction'] = $pagibig_deduction;

		    /** MANUAL INPUT FOR WITH HOLDING TAX */
		    // $withholding_tax = $this->get_with_holding_tax($employee_id, $this->data['basicSalary']);

		    // if ($period != 0) {
		    // 	$withholding_tax = $withholding_tax / 2;
		    // }

		    // $this->data['withholding_tax'] = $withholding_tax;

			$output['success'] ='fail';
			$output['content'] = View::make('admin.payrolls.create_add',$this->data)->render();

		}


		return Response::json($output,200);
	}
	/**
	 * Store a newly created payroll in storage.
	 *
	 * @return Response
	 */

	public function store()
	{
		$output     =   [];
		$deductions =   [];
		$allowances =   [];
		$validator = Validator::make($input = Input::all(), Payroll::$rules);

		if ($validator->fails())
		{
			$output['status']   =   'error';
			$output['msg']      =    $validator->getMessageBag()->toArray();
			return Response::json($output, 200);
		}
		$employee_id = $input['employeeID'];
		// Allowances
		$i=0;
		foreach ($input['allowanceTitle'] as $title) {
			if($title!='') {
				$allowances[ $title ] = $input['allowance'][ $i ];
			}
			$i++;
		}

		// Deductions
		$i=0;
		foreach ($input['deductionTitle'] as $title) {
			if($title!='') {
				$deductions[ $title ] = $input['deduction'][ $i ];
			}
			$i++;
		}

		$payroll  =  Payroll::firstOrCreate([
			'employeeID'        => $input['employeeID'],
			'month'             => $input['month'],
			'year'              => $input['year'],
			'period'			=> $input['period'],
		]);

		$period = $input['period'];
		$salary = $input['basic'];

		$payroll->basic                = $input['basic'];
		$payroll->overtime_hours       = $input['overtime_hours'];
		$payroll->overtime_pay         = $input['overtime_pay'];
		$payroll->allowances           = json_encode($allowances);
		$payroll->deductions           = json_encode($deductions);
		$payroll->total_deduction      = $input['total_deduction'];
		$payroll->expense              = $input['expense'];
		$payroll->total_allowance      = $input['total_allowance'];
		$payroll->net_salary           = $input['net_salary'];
		$payroll->sss_deduction        = $input['sss_deduction'];
		$payroll->philhealth_deduction = $input['philhealth_deduction'];
		$payroll->pagibig_deduction    = $input['pagibig_deduction'];
		$payroll->withholding_tax      = $input['withholding_tax'];
		$payroll->save();
		if(isset($input['type']))
			Session::flash('success', 'Updated Successfully');
		else
			Session::flash('success',  'Salary slip successfully created');
		return Response::json($output, 200);
	}


	/**
	 * Display the specified payroll.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$this->data['payroll']    = Payroll::findOrFail($id);

		return View::make('admin.payrolls.show_pdf', $this->data);
	} 

	/**
	 * Show the form for editing the specified payroll.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$this->data['payroll']    = Payroll::find($id);
		
		$this->data['employeeID'] = Input::get($id);
		$this->data['ot_application'] = array(
			'period' => $this->data['payroll']->period,
			'month' => $this->data['payroll']->month,
			'year' => $this->data['payroll']->year,
		);


		return View::make('admin.payrolls.edit', $this->data);
	}

	public function downloadPdf($id){
		$this->data['payroll']    = Payroll::findOrFail($id);
		return PDF::loadView("admin.payrolls.pdfview", $this->data)
		          ->download($this->data['payroll']->employeeID."-".date('F', mktime(0, 0, 0, $this->data['payroll']->month, 10))."-".$this->data['payroll']->year .".pdf");

	}

	/**
	 * Update the specified payroll in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$payroll = Payroll::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Payroll::$rules);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$deductions = array();
		$allowances = array();

		// Allowances
		$i=0;
		if (isset($data['allowanceTitle'])) {
			foreach (	$data['allowanceTitle'] as $title) {
				if($title!='') {
					$allowances[ $title ] = $data['allowance'][ $i ];
				}
				$i++;
			}
		}

		// Deductions
		$i=0;
		if (isset($data['deductionTitle'])) {
			foreach ($data['deductionTitle'] as $title) {
				if($title!='') {
					$deductions[ $title ] = $data['deduction'][ $i ];
				}
				$i++;
			}
		}


		$data['allowances'] = json_encode($allowances);
		$data['deductions'] = json_encode($deductions);

		unset($data['_method']);
		unset($data['_token']);
		unset($data['allowanceTitle']);
		unset($data['deductionTitle']);
		unset($data['allowance']);
		unset($data['deduction']);

		$period = $data['period'];
		$salary = $data['basic'];

		if ($period != 0) {
			$salary = $salary * 2;
		}
		
    // Get Settings
		$settings = DB::table('settings')->first();

    // $withholding_tax = $this->withholding_tax($employee_id, $salary);

    // if ($period != 0) {
    // 	$withholding_tax = $withholding_tax / 2;
    // }

    // $data['withholding_tax'] = $withholding_tax;

		$payroll->update($data);

		Session::flash('success',"<strong>Payroll</strong> updated successfully");
		return Redirect::route('admin.payrolls.edit', $id);
	}

	/**
	 * Remove the specified payroll from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Payroll::destroy($id);

		$output['success']  =   'deleted';
		return Response::json($output,200);
	}


	public function create_bulk_payroll(){
		$input = Input::all();
		$employees = DB::table('employees')
						->where('status', 'active')
						->get();

		if ($employees != '') {
			foreach ($employees as $key => $val) {
				$employee_id = $val->employeeID;
				$check_exists = DB::table('payrolls')
								->where('employeeID', $employee_id)
								->where('month', $input['month'])
								->where('period', $input['period'])
								->where('year', $input['year'])
								->first();
				$insert = '';
				if ($check_exists == '') {
					/** NOT YET EXISTS, CREATE NEW PAYROLL */
					$expense = Expense::selectRaw( 'month(purchaseDate) as month,year(purchaseDate) as year, sum(price) as sum,employeeID')
                               ->groupBy('month','year','employeeID')
                               ->orderBy('month', 'desc')
								->where('employeeID','=', $employee_id)
								->where('status','=','approved')
                               ->whereRaw("month(purchaseDate) ='".$input['month']."'")
                               ->whereRaw("year(purchaseDate) ='".$input['year']."'")
                               ->get()
                               ->first();

					$expense = isset($expense->sum) ? $expense->sum : 0;

					$monthName = date('F', mktime(0, 0, 0, $input['month'], 10)); // March
					
					$award_bonus = Award::selectRaw('sum(cashPrice) as sum')
										->where('employeeID','=', $employee_id)
										->where('forMonth','=',strtolower($monthName))
										->where('forYear','=', $input['year'])
										->get()
										->first();

					$award_bonus = isset($award_bonus->sum) ? $award_bonus->sum : 0;

					$payroll = Payroll::firstOrCreate([
						'employeeID'        => $employee_id,
						'month'             => $input['month'],
						'year'              => $input['year'],
						'period'			=> $input['period'],
					]);

					$period = $input['period'];
					$salary = $this->get_employee_salary($employee_id);
					
			    	// Get Settings
			    	/** DEFAULT DEDUCTION VALUES */
		      		$settings = DB::table('settings')->first();

					$sss_deduction = $this->get_sss_deduction($salary);
					$philhealth_deduction = $this->get_philhealth_deduction($salary);
					$pagibig_deduction = $this->get_pagibig_deduction($salary);
					$withholding_tax = 0;
					// $withholding_tax = $this->get_with_holding_tax($employee_id, $salary);

					/** CHECK IF TWO PAYROLL CUTOFF */
					if ($settings->enable_two_payroll_period == 1) {

						if ($settings->sss_deduction_period != $period) {
							$sss_deduction = 0;
						}

						if ($settings->pagibig_deduction_period != $period) {
							$pagibig_deduction = 0;
						}

						if ($settings->philhealth_deduction_period != $period) {
							$philhealth_deduction = 0;
						}
					}

					/** FORCE NO DEDUDCTION FOR FREELANCERS */
					if ($val->employment_status == 'freelancer') {
						$sss_deduction = $philhealth_deduction = $pagibig_deduction = 0;
					}

					$allowances = array();
					$deductions = array();

					$allowances['Bonus'] = $award_bonus;

					if ($period != 0) {
						$salary = $salary / 2;
					}

					$total_deduction = $sss_deduction + $philhealth_deduction + $pagibig_deduction;
					$net_salary = ($award_bonus + $salary + $expense) - ($withholding_tax + $total_deduction); 

					$payroll->basic                = $salary;
					$payroll->overtime_hours       = 0;
					$payroll->overtime_pay         = 0;
					$payroll->allowances           = json_encode($allowances);
					$payroll->deductions           = json_encode($deductions);
					$payroll->total_deduction      = $total_deduction;
					$payroll->expense              = $expense;
					$payroll->total_allowance      = $award_bonus;
					$payroll->net_salary           = $net_salary;
					$payroll->sss_deduction        = $sss_deduction;
					$payroll->philhealth_deduction = $philhealth_deduction;
					$payroll->pagibig_deduction    = $pagibig_deduction;
					$payroll->withholding_tax      = $withholding_tax;
					$payroll->save();
				}
			}

			Session::flash('success',"Generating payrolls done.");
		}
		
		return Redirect::route('admin.payrolls.index');
	}

	private function get_employee_salary($employee_id = null){
		$employee_salary = 0;
		if ($employee_id != null) {
			// SALARY
		  try{
				$employee_salary = DB::table('salary')
									->where('employeeID', $employee_id)
									->where('type', 'basic')
									->pluck('salary');
			}catch (Exception $e){
				$employee_salary = 0;
			}
		}
		return $employee_salary;
	}

	private function get_sss_deduction($salary = 0){

		try {
			$sss_deduction = DB::table('sss_settings')
								->where('salary_from', '<=', $salary)
								->where('salary_to', '>=', $salary)
								->pluck('employee_share');
		} catch (Exception $e) {
			$sss_deduction = 0;
		}

		return ( $salary != 0 ? $sss_deduction : 0);
	}

	private function get_philhealth_deduction($salary = 0){
		
		try {
			$philhealth_deduction = DB::table('philhealth_settings')
									->where('salary_from', '<=', $salary)
									->where('salary_to', '>=', $salary)
									->pluck('employee_share');
		} catch (Exception $e) {
			$philhealth_deduction = 0;
		}

		return ( $salary != 0 ? $philhealth_deduction : 0);
	}

	private function get_pagibig_deduction($salary = 0){
		return ( $salary != 0 ? 100 : 0);
	}

	private function get_with_holding_tax($employee_id = null, $salary = 0){
		
		if ($employee_id != '') {		
			$benefits = $total_tax_with_held = 0;		
		  $status = array(0.32, 0.30, 0.25, 0.20, 0.15, 0.10, 0.05);
		  $exemption = array(10416.67, 4166.67, 1875.00, 708.33, 208.33, 41.67, 0);

			// DEPENDENT
			try {
				$dependent = Employee::where('employeeID', $employee_id)->first()->dependent;			
				// MIN 0 Dependent
				$dependent = $dependent >= 0 ? $dependent : 0;
				// MAX 4 Dependents
				$dependent = $dependent <= 4 ? $dependent : 4;

			} catch (Exception $e) {
				$dependent = 0;	
			}
			
		  
			// SSS DEDUCTION
			$sss_deduction = $this->get_sss_deduction($salary);
			// PHILHEALTH DEDUCTION
			$philhealth_deduction = $this->get_philhealth_deduction($salary);
			// Pag-IBIG DEDUCTION
			$pagibig_deduction = $this->get_pagibig_deduction($salary);

			$benefits = $sss_deduction + $philhealth_deduction + $pagibig_deduction;

			// DEPENDENT SALARY RANGE
			$dependent_salary_range = array(
					0 => array(45833, 25000, 15833, 10000, 6667, 5000, 4167, 0), // No Dependent
					1 => array(47917, 27083, 17917, 12083, 8750, 7083, 6250, 0), // 1 Dependent
					2 => array(50000, 29167, 20000, 14167, 10833, 9167, 8333, 0), // 2 Dependent
					3 => array(52083, 31250, 22083, 16250, 12917, 11250, 10417, 0), // 3 Dependent
					4 => array(54167, 33333, 24167, 18333, 15000, 13333, 12500, 0), // 4 Dependent
				);

			if ( isset($dependent_salary_range[$dependent]) && is_array($dependent_salary_range[$dependent]) ) {
				foreach ($dependent_salary_range[$dependent] as $key => $val) {
	        if($salary >= $val && $val != 0) {
	          $total_tax_with_held = ( ( ($salary - $val) - $benefits) * $status[$key] ) + $exemption[$key];
	          break;
	        }
	      }
			}

			return $total_tax_with_held;
		}	
		return 0;
	}


  public function export(){
		// $employee   =   Employee::join('designation', 'employees.designation', '=', 'designation.id')
		//                         ->join('department', 'department.id', '=', 'designation.deptID')
		//                         ->leftJoin('bank_details', 'bank_details.employeeID', '=', 'employees.employeeID')
		//                         ->select('employees.id','employees.employeeID',
		// 	                        'employees.fullName','department.deptName as Department',
		// 	                        'designation.designation as Designation','employees.fatherName','employees.mobileNumber','employees.date_of_birth',
		// 	                        'employees.joiningDate','employees.localAddress','employees.permanentAddress','employees.status',
		// 	                        'employees.exit_date','employees.permanentAddress',
		// 	                        'bank_details.accountName','bank_details.accountNumber','bank_details.bank','bank_details.pan','bank_details.branch',
		// 	                        'bank_details.ifsc'
		//                         )->orderBy('id','asc')
		//                         ->get()->toArray();

		// $data = $employee;

		// Excel::create('employees'.time(), function($excel) use($data) {

		// 	$excel->sheet('Employees', function($sheet) use($data) {

		// 		$sheet->fromArray($data);

		// 	});

		// })->store('xls')->download('xls');
		return 'On working';


	}


}