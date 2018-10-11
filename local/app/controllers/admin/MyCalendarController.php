<?php

class MyCalendarController extends \AdminBaseController {

	public function __construct()
    {
        parent::__construct();
        $this->data['MyCalendarController']    =   'active open';
        $this->data['pageTitle']               =   'MyCalendarController';
    }


	public function index()
	{
		$this->data['myCalendars']   = MyCalendar::all();
dd();
		
		return View::make('admin.mycalendar.index', $this->data);
	}

	public function store(){
		$input = Input::all();
        $title = (isset($input['title'])) ? $input['title'] : null; 

        $status = "ongoing";

        $leaveApp     =  MyCalendar::firstOrCreate([
            'title'    => $title,
            'start_date' => $input['start_date'],
			'end_date' =>  $input['end_date'],
			'status'	=>  $status,
        ]);

        $leaveApp->save();

        Session::flash('success',"Leave Application for Employe ID: ". $title ." successfully created");
		return Redirect::route('admin.dashboard.index');

	}

	public function update($id)
	{
        $this->data['data']              =   Input::all();
		$this->data['updated_by']        =   Auth::admin()->get()->email;

		$leave_application = LeaveApplication::findOrFail($id);

		$this->data['data']['application_status'] = ($this->data['data']['application_status'] =='Approve')?'approved':'rejected';
        $leave_application->update($this->data['data']);

		$start = strtotime($leave_application->start_date);


		if($leave_application->application_status == 'approved'){
			$i=0;
		while($start<strtotime($leave_application->end_date)) {

				$date = strtotime("+".$i." day", $start);
				$attendance = Attendance::firstOrCreate([
					'date' => date('Y-m-d',$date),
					'employeeID' =>$leave_application->employeeID,
				]);

				$attendance->leaveType = $leave_application->leaveType;
				$attendance->halfDayType = $leave_application->halfDayType;
				$attendance->reason = $leave_application->reason;
				$attendance->status = 'absent';
				$attendance->applied_on = $leave_application->applied_on;
				$attendance->updated_by = $this->data['updated_by'];
				$attendance->application_status = 'approved';
				$attendance->save();
				$start = $date;
				$i=1;
			}
		}

        $this->data['leave_applications']   = $leave_application;
        $employee   =   Employee::where('employeeID','=',$leave_application->employeeID)->first();
        $this->data['email']   =   $employee->email;

        if($this->data['setting']->leave_notification==1)
        {
            if ($this->data['data']['application_status'] != 'pending') {
                Mail::send('emails.admin.leave_request', $this->data, function ($message) {

                    $message->from($this->data['setting']->email, $this->data['setting']->name);
                    $message->to($this->data['email'])
                        ->subject('Leave Request - ' . date('d-M-Y', strtotime($this->data['leave_applications']->start_date)) .(isset($this->data['leave_applications']->end_date)?' to '.date('d-M-Y',strtotime($this->data['leave_applications']->end_date)):''). ' - ' . $this->data['data']['application_status']);
                });
            }
        }


        Session::flash('success',"<strong>Success! </strong> Updated successfully");
		return Redirect::route('admin.leave_applications.index');
	}



	public function destroy($id)
	{
		$leave_application = LeaveApplication::findOrFail($id);


		$start = strtotime($leave_application->start_date);
		$i=0;
		while($start<=strtotime($leave_application->end_date)) {


			$date = strtotime("+".$i." day", $start);
			Attendance::where('date','=',date('Y-m-d',$start))->where('employeeID', $leave_application->employeeID)->delete();
			$start = $date;
			$i=1;
		}
		LeaveApplication::destroy($id);
		$output['success']  =   'deleted';
		return Response::json($output, 200);
	}

	


}
