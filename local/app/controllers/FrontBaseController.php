<?php

class FrontBaseController extends Controller {

    protected  $data = array();

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct()
    {

        $this->data['setting']    = Setting::all()->first();
	    $this->data['datatabble_lang'] ='';
	    if (file_exists("assets/global/plugins/datatables/langjson/{$this->data['setting']->locale}.json"))
	    {
		    $url = URL::asset("assets/global/plugins/datatables/langjson/{$this->data['setting']->locale}.json");
		    $this->data['datatabble_lang']  = "'language': {
                    'url': '$url'
                },";
	    }
	    App::setLocale( $this->data['setting']->locale);
	    $this->data['employeeID']  =   Auth::employees()->get()->employeeID;

	    $this->data['leaveTypes']  =    Attendance::leaveTypesEmployees();
	    $this->data['leaveTypeWithoutHalfDay']   =   Attendance::leaveTypesEmployees('halfday');
	    //        Total leaves except
	    $total_leave    =   Leavetype::where('leaveType','<>','half day')->sum('num_of_leave') + Auth::employees()->get()->annual_leave;

	    $this->data['leaveLeft']   =    array_sum(Attendance::absentEmployee($this->data['employeeID'])).'/'.$total_leave;
	    $this->data['employee']    =    Employee::find(Auth::employees()->get()->id);
	    $this->data['holidays']    =    Holiday::orderBy('date','ASC')->remember(10,'holiday_cache')->get();
	    $this->data['awards']      =    Award::select('*')->orderBy('created_at','desc')->get();
	    $this->data['attendance']  =    Attendance::where('employeeID', '=',$this->data['employeeID'])
	                                              ->where(function($query)
	                                              {
		                                              $query->where('application_status','=','approved')
		                                                    ->orWhere('application_status','=',null)
		                                                    ->orWhere('status','=','present');
	                                              })
	                                              ->get();
	    $this->data['attendance_count']   = Attendance::attendanceCount($this->data['employeeID']);

	    $this->data['current_month_birthdays']   = Employee::currentMonthBirthday();
    }


	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


}

