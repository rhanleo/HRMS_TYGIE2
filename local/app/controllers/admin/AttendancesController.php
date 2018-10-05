<?php
/*
 * Attendance Controller of Admin Panel
 */
class AttendancesController extends \AdminBaseController {


    public function __construct()
    {
        parent::__construct();
        $this->data['attendanceOpen'] ='active open';
        $this->data['pageTitle'] =      trans('core.attendance');
    }


/*
 * This is the view page of attendance.
 */
	public function index()
	{
		$this->data['attendances']          =   Attendance::all();
        $this->data['viewAttendanceActive'] =   'active';

        $this->data['date']     = date('Y-m-d');
        $this->data['employees']            =   Employee::where('status','=','active')->get();
        $this->data['leaves'] = Attendance::absentEveryEmployee();
		return View::make('admin.attendances.index', $this->data);
	}


/*
 * This method is called when we mark the attendance and redirects to edit page.
 */
	public function create() {
            $date = (Input::get('date')!='')?Input::get('date'):date('Y-m-d');
           
            $date   =   date('Y-m-d',strtotime($date));
            $this->data['date'] = $date;
            $attendance_count           = Attendance::where('date','=',$date)->count();
            $employee_count             = Employee::where('status','=','active')->count();

            if($employee_count  ==  $attendance_count) {
                if(!Session::get('success'))
                    Session::flash('success',"<strong>Attendance already marked</strong>");
            } else {
                Session::forget('success');
            }
           
            return Redirect::route('admin.attendances.edit',$date );
    }
    
   


	/**
	 * Display the specified attendance
	 */
	public function show($id)
    {
        $this->data['viewAttendanceActive'] = 'active';

        $this->data['employee']     = Employee::where('employeeID', '=', $id)->get()->first();
        $this->data['attendance']   = Attendance::where('employeeID', '=', $id)
                                            ->where(function($query)
                                            {
                                                $query->where('application_status','=','approved')
                                                      ->orwhere('application_status','=',null)
                                                      ->orwhere('status','=','present');
                                            })->get();
        $this->data['holidays']     = Holiday::all();
        $this->data['employeeslist'] = Employee::select('employeeID', DB::raw("CONCAT(firstName, ' ', lastName) as fullName"))
        ->lists('fullName', 'employeeID');
      
		return View::make('admin.attendances.show', $this->data);
	}

	/**
	 * Show the form for editing the specified attendance.
	 */
	public function edit( $date ) {
       
        $attendanceArray = array();
        $this->data['attendance']   = Attendance::where('date','=',$date)->get()->toArray();
        

        $this->data['todays_holidays'] = Holiday::where('date','=',$date)->get()->first();
        
        foreach($this->data['attendance'] as $attend)
        {
            $attendanceArray[$attend['employeeID']] = $attend;
        }

        $this->data['date']             =   $date;
        $this->data['attendanceArray']  =   $attendanceArray;



        $this->data['leaveTypes']  =    Attendance::leaveTypesEmployees();
        $this->data['leaveTypeWithoutHalfDay']   =   Attendance::leaveTypesEmployees('half day');
        $this->data['employees']    =   Employee::where('status','=','active')->get();

        return View::make('admin.attendances.edit', $this->data);
	}

	/**
	 * Update the specified attendance in storage.
	 */
	public function update( $date )
    {
         // dd( $date);
		$date   =   date('Y-m-d',strtotime($date));
		$validator = Validator::make($input = Input::all(), Attendance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        foreach ($input['employees'] as $employeeID)
        {

            $user     =  Attendance::firstOrCreate([
                'employeeID'    => $employeeID,
                'date'          => $date,
            ]);
			if($user->application_status !='approved' || ($user->application_status =='approved' && isset($input['checkbox'][$employeeID])=='on'))
			{
				$update = Attendance::find($user->id);
				$update->status     = (isset($input['checkbox'][$employeeID])=='on')?'present':'absent';
				$update->leaveType  = (isset($input['checkbox'][$employeeID])=='on')?null:$input['leaveType'][$employeeID];
				$update->halfDayType  = ( (!isset($input['checkbox'][$employeeID])=='on') && ($input['leaveType'][$employeeID]=='half day'))?$input['leaveTypeWithoutHalfDay'][$employeeID]:null;
				$update->reason     = (isset($input['checkbox'][$employeeID])=='on')?'':$input['reason'][$employeeID];
				$update->application_status     = null;
				$update->updated_by     = Auth::admin()->get()->email;
				$update->save() ;
			}

        }
		$this->data['date'] = date('d M Y',strtotime($date));

        if($this->data['setting']->attendance_notification==1) {

            $employees = Employee::select('email','fullName')->where('status', '=', 'active')->get();
            foreach ($employees as $employee) {
                $email = "{$employee->email}";
				$this->data['employee_name'] = $employee->fullName;
	            //  Send Email to All active users
	            Mail::send('emails.admin.attendance', $this->data, function ($message) use ($email) {
	                $message->from($this->data['setting']->email, $this->data['setting']->name);
	                $message->to($email)
	                    ->subject('Attendance marked - ' . $this->data['date']);
	            });
            }
        }

        Session::flash('success',date('d M Y',strtotime($date)). " successfully Updated");
		return Redirect::route('admin.attendances.edit',$date);
	}

    public function report()
    {

        $month          =   Input::get('month');
        $year           =   Input::get('year');
        $employeeID     =   Input::get('employeeID');

        $firstDay       =   $year.'-'.$month.'-01';


        $presentCount   =   Attendance::countPresentDays($month,$year,$employeeID);

        $totalDays      =  date('t',strtotime($firstDay));

        $holidaycount   =   count(DB::select( DB::raw("select * from holidays where MONTH(date)=".$month )));
        $workingDays    =   $totalDays - $holidaycount;


        $percentage     =   ($presentCount/$workingDays)*100;
        $output['success']  =   'success';
        $output['presentByWorking']    =   "{$presentCount}/$workingDays";

        $output['attendancePerReport']    =   number_format((float)$percentage, 2, '.', '');
        return Response::json($output, 200);



    }
	/**
	 * Remove the specified attendance from storage.
	 */
	public function destroy($id)
	{

		Attendance::destroy($id);

		return Redirect::route('admin.attendances.index');
	}

}
