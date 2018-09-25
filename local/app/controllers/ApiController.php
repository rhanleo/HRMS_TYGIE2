<?php

class ApiController extends BaseController {

	public function get_appraisal_form(){
		$input = Input::all();
		unset($input['_token']);
		$req = (object) $input;

		$quarter = isset($req->quarter) ? $req->quarter : 1;
		$is_admin = isset(Auth::admin()->get()->id) ? 1 : 0;

		$employee = DB::table('employees')
									->where('employeeID', $req->employee_id)
									->join('designation', 'employees.designation', '=', 'designation.id')
									->join('department', 'designation.deptID', '=', 'department.id')
									->first();

		if ($employee != '') {
			
			$app_for = $employee->designation == 'HOD' ? 1 : 2;		

			if ($is_admin) {
				$current_user_id = Auth::admin()->get()->id;				
			}
			else{
				$current_user_id = Auth::employees()->get()->employeeID;
			}

			$appraisal_done = DB::table('employee_appraisal')
													->where('employeeID', $employee->employeeID)
													->where('for_quarter', $quarter)
													->where('appraised_by', $current_user_id)
													->where('is_admin', $is_admin)
													->get();

			$appraisal_done_ids = array();
			foreach ($appraisal_done as $key => $val) {
				$appraisal_done_ids = array_merge($appraisal_done_ids, [$val->question_id]);
			}

			// var_dump($appraisal_done_ids);

			$appraisal_questions = DB::table('appraisal_questions')
															->where('app_for', $app_for)
															->get();


			return View::make('appraisal-form', [
        'data' => $employee,
        'appraisal_done' => $appraisal_done,
        'appraisal_done_ids' => $appraisal_done_ids,
        'appraisal_questions' => $appraisal_questions,
        'quarter' => $quarter,
      ]);

		}
		return 'Employee not found';
	}
	public function submit_appraisal($employeeID = null, $quarter = 1){

		// var_dump(Auth::admin()->get()->id);
		$status = 'error';
		$msg = 'Saving failed';
		$is_admin = isset(Auth::admin()->get()->id) ? 1 : 0;
		$args = array();

		$employee = DB::table('employees')
									->where('employeeID', $employeeID)
									->join('designation', 'employees.designation', '=', 'designation.id')
									->join('department', 'designation.deptID', '=', 'department.id')
									->first();

		if ($employee != '') {
			
			$app_for = $employee->designation == 'HOD' ? 1 : 2;		

			$input = Input::all();
			$input['employeeID'] = $employee->employeeID;
			$input['for_quarter'] = $quarter;
			
			if ($is_admin) {
				$current_user_id = Auth::admin()->get()->id;
				$input['is_admin'] = 1;
			}
			else{
				$current_user_id = Auth::employees()->get()->employeeID;
			}

			$input['appraised_by'] = $current_user_id;
			unset($input['_token']);
			$req = (object) $input;

			$insert = DB::table('employee_appraisal')->insertGetID($input);		

			if ($insert) {
				$status = 'success';
				$msg = 'Appraisal saved';	
			}
			else{
				$msg = 'Saving failed, please try again.';
			}

			$total_done = DB::table('employee_appraisal')
													->where('employeeID', $employee->employeeID)
													->where('for_quarter', $quarter)
													->where('appraised_by', $current_user_id)
													->where('is_admin', $is_admin)
													->count();

			$total_questions = DB::table('appraisal_questions')
													->where('app_for', $app_for)
													->count();

			$args['total_done'] = $total_done;
			$args['total_questions'] = $total_questions;
		}

		

		return json_encode(['status' => $status, 'msg' => $msg, 'args' => $args]);
	}

	public function cpf_calculator($birth_date = null, $salary = 0, $allowance = 0){
		
		$status = 'error';
		$data = array();
		if ($birth_date != null) {

			$total_wage = $salary + $allowance;

			$age = date_diff(date_create(date('Y-m-d', strtotime($birth_date))), date_create('today'))->y;
			$cpf_settings = DB::table('cpf_settings')
											->where('age_from', '<=', $age)
											->where('age_to', '>=', $age)
											->first();

			if ($cpf_settings != '') {				

				// $wage_ranges = array(
				// 		0 => '≤ $50', 
				// 		1 => '> $50 to $500', 
				// 		2 => '> $500 to < $750', 
				// 		3 => '≥ $750'
				// );				
				if ($total_wage >= 750) {
					$wage_range = 3;
				}
				elseif($total_wage > 500 && $total_wage < 750){
					$wage_range = 2;
				}
				elseif($total_wage > 50 && $total_wage <= 500){
					$wage_range = 1;
				}
				else{
					$wage_range = 0;
				}					

				$total_cpf_arr = json_decode($cpf_settings->total_cpf);
				$employee_percentage_arr = json_decode($cpf_settings->employee_percentage);

				$employer = $total_cpf_arr[$wage_range] / 100;
				$employee = $employee_percentage_arr[$wage_range] / 100;

				if ($age >= 60) {
					$cpf_total = round($total_wage * ($employer / 100));
					$cpf_employee = $total_wage * ($employee / 100);
				}
				else{
					$cpf_total = round($total_wage * $employer);
					$cpf_employee = $total_wage * $employee;
				}

				$cpf_employer = round($cpf_total) - round($cpf_employee);

				/** FIX MAXIMUM CONTRIBUTION */
				if ($cpf_total >= $cpf_settings->total_max_contribution) {
					$cpf_total = $cpf_settings->total_max_contribution;
					$cpf_employee = $cpf_settings->employee_max_contribution;
					$cpf_employer = $cpf_total - $cpf_settings->employee_max_contribution;
				}

				$data['cpf']['employee'] = number_format($cpf_employee, 2);
				$data['cpf']['employer'] = number_format($cpf_employer, 2);
				$data['cpf']['total'] = number_format($cpf_total, 2);

				$status = 'success';	
				/** DETAILS */
				$data['details']['birth_date'] = $birth_date;
				$data['details']['age'] = $age;
				$data['details']['salary'] = number_format($salary, 2);
				$data['details']['allowance'] = number_format($allowance, 2);			
				$data['details']['employee_percent_share'] = $employee * 100;			
				$data['details']['employer_percent_share'] = $employer * 100;			
			}
			else{
				$data['message'] = 'CPF Settings has no settings for your age';
			}
		}
		else{
			$data['message'] = 'Date of birth required';
		}

		return json_encode(['status' => $status, 'data' => $data]);
	}

	// public public function get_timeintimeout_form(){
	// 	$input = Input::all();
	// 	unset($input['_token']);
	// 	$req = (object) $input;
	// }

	public function get_payroll_dac_form(){
		$input = Input::all();
		unset($input['_token']);
		$req = (object) $input;

		$employee = DB::table('employees')
									->where('employeeID', $req->employee_id)
									->join('designation', 'employees.designation', '=', 'designation.id')
									->join('department', 'designation.deptID', '=', 'department.id')
									->first();

		return View::make('dac-form', [
        'data' => $employee,
      ]);
	}

	/** CUSTOM DELETE FIX */
	public function delete_record($table = null, $id){
		if ( $table != null && $id != null) {

			if ($table == 'departments') {
				$table = 'department';
			}
			if ($table == 'branches') {
				$table = 'branch';
			}
			if ($table == 'dailytimerecord') {
				$table = 'daily_time_records';
			}
			
			if ($table == 'cashadvance') {
				$table = 'cash_advance';
			}
			
			$record = DB::table($table)
								->where('id', $id)
								->first();

			if ($record != '') {		

				if ($table == 'department') {
					/** TRANSFER EMPLOYEES TO DEFAULT DEPT. */
					$default_designation = DB::table('designation')
											->where('deptID', 1)
											->pluck('id');

					$designations = DB::table('designation')
									->where('deptID', $id)
									->get();


					if (count($designations) > 0) {
						foreach ($designations as $designation_key => $designation_val) {
							$employees_lists = DB::table('employees')
												->where('designation', $designation_val->id)
												->get();

							if (count($employees_lists) > 0) {
								foreach ($employees_lists as $employee_key => $employee_val) {
									DB::table('employees')
										->where('id', $employee_val->id)
										->update([
											'designation' => $default_designation,
										]);
								}
							}
						}
					}

					DB::table('designation')
						->where('deptID', $id)
						->delete();
				}
				

				DB::table($table)
				->where('id', $id)
				->delete();	
				
				$output['success'] = 'deleted';
			}
			else{
				$output['error'] = 'error';	
			}
			return Response::json($output,200);
		}
	}
}

