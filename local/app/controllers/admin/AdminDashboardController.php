<?php

//Admin Dashboard controller

class AdminDashboardController extends AdminBaseController
{

	public function __construct() {
		parent::__construct();
		$this->data['dashboardActive'] 	= 'active';
		$this->data['pageTitle']       	= 'Dashboard';
	}

// Dashboard view page   controller
	public function index() {
	
		//  date('Y-m-d', strtotime(' + 5 days')) plus day on current date
		$probationary = Employee::select('firstName', 'lastName', 'employeeID','joiningDate','profileImage')
		->where('status','=','active')
		->orderBy('joiningDate','asc')
		->get();
		$forProbi = [];
		foreach($probationary as $key => $pro){
			$effectiveDatePro  = date('Y-m-d', strtotime("+3 months", strtotime($pro['joiningDate'])));
		// echo $effectiveDatePro;
			if($effectiveDatePro == date('Y-m-d') || 
			$effectiveDatePro == date('Y-m-d', strtotime("+1 day")) ||
			$effectiveDatePro == date('Y-m-d', strtotime("+2 days")) ||
			$effectiveDatePro == date('Y-m-d', strtotime("+3 days")) ){
				$forProbi[$key] = $pro;
			}

		}
		$this->data['probationary'] = $forProbi;

		$regular = Employee::select('firstName', 'lastName', 'employeeID','joiningDate','profileImage')
		->where('status','=','active')
		->orderBy('joiningDate','asc')
		->get();
		$forReg = [];
		foreach($regular as $key => $reg){
		
			$effectiveDateReg  = date('Y-m-d', strtotime("+6 months", strtotime($reg['joiningDate'])));
			
			if($effectiveDateReg == date('Y-m-d') || 
			$effectiveDateReg == date('Y-m-d', strtotime("+1 day")) ||
			$effectiveDateReg == date('Y-m-d', strtotime("+2 days")) ||
			$effectiveDateReg == date('Y-m-d', strtotime("+3 days")) ){
				$forReg[$key] = $reg;
			}
					
	
		}
		$this->data['forRegular'] = $forReg;
				

		$this->data['holidays'] =   Holiday::all();
		$attendance   = Attendance::where(function($query)
                                    {
                                        $query->where('application_status','=','approved')
                                              ->orwhere('application_status','=',null)
                                              ->orwhere('status','=','present');
                                    })->get();


		$at =   array();
		$final = array();
		foreach($attendance as $attend)
		{
			$at[$attend->date]['status'][]  =   $attend->status;
			$at[$attend->date]['employee'][]  =   $attend->employeeDetails->fullName;
		}

		foreach($at as $index=>$att){

			if(in_array('absent',$att['status'])) {
				foreach ($att['employee'] as $index_emp=>$employee){
					if($att['status'][$index_emp]=='absent')
					$final[$index][] = $employee;
				}

			}else
			{
				$final[$index][] = 'all present';
			}

		}

		$this->data['attendance']   = $final;


		//Expense Calculation
		$expense = DB::select( DB::raw("SELECT sum(price) as sum,m.month,u.status
     FROM (
           SELECT 1 AS MONTH
           UNION SELECT 2 AS MONTH
           UNION SELECT 3 AS MONTH
           UNION SELECT 4 AS MONTH
           UNION SELECT 5 AS MONTH
           UNION SELECT 6 AS MONTH
           UNION SELECT 7 AS MONTH
           UNION SELECT 8 AS MONTH
           UNION SELECT 9 AS MONTH
           UNION SELECT 10 AS MONTH
           UNION SELECT 11 AS MONTH
           UNION SELECT 12 AS MONTH
           UNION SELECT 'approved' AS STATUS

          ) AS m
LEFT JOIN `expenses` u
ON m.month = MONTH(purchaseDate)
   AND YEAR(purchaseDate) = YEAR(CURDATE())
   AND YEAR(purchaseDate) = YEAR(CURDATE())
GROUP BY m.month
HAVING u.status='approved'
ORDER BY month ;"));

		foreach($expense as $ex){
			$expensevalue[$ex->month] = isset($ex->sum)?$ex->sum:"''";
		}

		for($i=1;$i<=12;$i++){
			$expensevalue[$i] = isset($expensevalue[$i])?$expensevalue[$i]:"''";
		}
		ksort($expensevalue);

		$this->data['expense'] = implode(',',$expensevalue);

		$this->data['employee_count']    =   Employee::all()->count();
		$this->data['awards_count']      =    Award::all()->count();
		$this->data['department_count']      =    Designation::all()->count();
		$this->data['current_month_birthdays']   = Employee::currentMonthBirthday();
		$this->data['awards']      =    Award::select('*')->orderBy('created_at','desc')->get();
		$this->data['awards_color']=[
			'0' =>  'success',
			'1' =>  'danger',
			'2' =>  'warning',
			'3' =>  'info'
		];

		return View::make('admin/dashboard',$this->data);

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