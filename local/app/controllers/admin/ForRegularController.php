<?php

//Admin Dashboard controller

class ForRegularController extends AdminBaseController
{

	public function __construct() {
		parent::__construct();
		$this->data['forRegular'] 	= 'active';
		$this->data['pageTitle']       	= 'ForRegular';
	}

// Dashboard view page   controller
	public function index($id) {
	
		$employee = Employee::where('status','=','active')
		->where('employeeID','=',$id)
		->get();
		$employeeArray = [];
		foreach($employee as $emp){
			$employeeArray = $emp;
		}
	
		$sickLeaveApp = LeaveApplication::where('application_status','=','approved')
									->where('employeeID','=', $id)
									->where('leaveType','=','sick_leave')
									->get();
		$annualLeaveApp = LeaveApplication::where('leaveType','=','annual_leave')
									->where('employeeID','=', $id)
									->where('application_status','=','approved')
									->get();
		
					
		$sickLeave  = DB::table('leave_credits')->where('leaveType','=','sick_leave')
							->get();
		$annualLeave  = DB::table('leave_credits')->where('leaveType','=','annual_leave')
							->get();

		// Sick Leave
		$slArray = [];
		foreach($sickLeave as $sl){
			$slArray = $sl;
		}

		$alArray = [];
		foreach($annualLeave as $al){
			$alArray = $al;
		}

		$slaArray = [];
		if($sickLeaveApp != null){
			
			foreach($sickLeaveApp as $sla){
				$slaArray = $sla;
			}
		}
		$alaArray = [];
		if($annualLeave != null){
			
			foreach($annualLeaveApp as $ala){
				$alaArray = $ala;
			}
		}

		
		$overtimeApp = OvertimeApplication::where('employeeID','=', $id)
									->where('application_status','=','approved')
									->get();
		$otTotal = OvertimeApplication::where('employeeID','=', $id)
									->where('application_status','=','approved')
									->sum('total_overtime');
		
		$award = Award::where('employeeID','=', $id)->get();
		
		$this->data['annualLeave'] = $alArray;
		$this->data['sickLeave'] = $slArray;
		$this->data['sickLeaveApp'] = $slaArray;
		$this->data['annualLeaveApp'] = $alaArray;
		$this->data['overtimeApp'] = $overtimeApp;
		$this->data['otTotal'] = $otTotal;
		$this->data['employee'] = $employeeArray;
		$this->data['awards'] = $award;
	
		return View::make('admin.for_regular.dashboard',$this->data);

	}



/*    Screen lock controller.When screen lock button from menu is cliked this controller is called.
*     lock variable is set to 1 when screen is locked.SET to 0  if you dont want screen variable
*/
	public function screenlock()
	{
		Session::put('lock', '1');		
		return View::make("admin/screen_lock",$this->data);
	}
}