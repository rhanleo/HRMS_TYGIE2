<?php

class MyCalendarController extends \AdminBaseController {

	public function __construct()
    {
        parent::__construct();
        $this->data['MyCalendar']    =   'active open';
        $this->data['pageTitle']               =   'MyCalendar';
    }


	public function index()
	{
		$this->data['mycalendars']   = MyCalendar::all();

		$this->data['employees'] = Employee::selectRaw('CONCAT(firstName, " ", lastName, " (EmpID:", employeeID,")") as full_name, employeeID')
	                                        ->where('status','=','active')
	                                        ->lists('full_name','employeeID');
		return View::make('admin.mycalendar.index', $this->data);
	}

		/**
	 * Show the form for editing the specified award.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $this->data['mycalendars']    = MyCalendar::where('id','=',$id)->get();
      
		return View::make('admin.mycalendar.edit', $this->data);
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
		$myCalendar = MyCalendar::findOrFail($id);
		$data = Input::all();
		$myCalendar->update($data);
        Session::flash('success',"<strong>Success! </strong> Updated successfully");
		return Redirect::route('admin.mycalendar.index');
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
