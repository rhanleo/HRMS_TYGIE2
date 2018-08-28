<?php

class LeaveApplicationsController extends \AdminBaseController {

	public function __construct()
    {
        parent::__construct();
        $this->data['leaveApplicationOpen']    =   'active open';
        $this->data['pageTitle']               =   trans('core.leaveApplication');
    }


	public function index()
	{
		$this->data['leave_applications']   = Attendance::all();

		$this->data['employees']       =    Employee::all();
		$this->data['leavetypes']       =    Leavetype::all();
        $this->data['leaveTypeWithoutHalfDay']   =   Attendance::leaveTypesEmployees('half day');

		return View::make('admin.leave_applications.index', $this->data);
	}


//  Datatable ajax request
    public function ajaxApplications()
    {
	    //$result1 =  Attendance::
		 //   select('attendance.id','employees.fullName','attendance.date','attendance.leaveType','attendance.reason','attendance.applied_on','attendance.application_status','attendance.halfDayType')
	    //    ->join('employees', 'employees.employeeID', '=', 'attendance.employeeID')
		 //   ->whereNotNull('attendance.application_status')
		 //   ->orderBy('attendance.applied_on','desc');
	    $result =  LeaveApplication::
	    select('leave_applications.id','employees.fullName','leave_applications.start_date','leave_applications.end_date','leave_applications.days','leave_applications.leaveType','leave_applications.reason','leave_applications.applied_on','leave_applications.application_status','leave_applications.halfDayType')
	                         ->join('employees', 'employees.employeeID', '=', 'leave_applications.employeeID')
	                         ->whereNotNull('leave_applications.application_status')
	                         ->orderBy('leave_applications.created_at','desc');


        return Datatables::of($result)

            ->edit_column('start_date',function($row){
                $dates = date('d-M-Y',strtotime($row->start_date)).' ' .(isset($row->end_date)?' to '.date('d-M-Y',strtotime($row->end_date)):'');
                return $dates;
            })
            ->edit_column('applied_on',function($row){
                return date('d-M-Y',strtotime($row->applied_on));
            })
	        ->edit_column('leaveType',function($row){
		        $leave = ($row->leaveType=='half day')?$row->leaveType.'-'.$row->halfDayType:$row->leaveType;
		        return $leave;
	        })
            ->edit_column('reason',function($row){
	            return   strip_tags(Str::limit($row->reason,50));

            })
            ->edit_column('application_status',function($row)
            {
                $color = [
                    'pending'   =>  'warning',
                    'approved'  =>  'success',
                    'rejected'  =>  'danger'
                ];

                    return "<span class='label label-{$color[$row->application_status]}'>".trans('core.'.$row->application_status)."</span>";
            })
	        ->remove_column('halfDayType')
	        ->remove_column('end_date')
            ->add_column('edit',function($row){
	    //         if ( $row->application_status == 'pending' ) {
					// $string = 
					// '
					// 	<div class="btn-col-2">
					// 		<button class="btn-blue" data-toggle="modal" href="#static_approve" onclick="show_approve('.$row->id.');return false;">'.trans('core.btnApprove').'</button>
					// 		<button class="btn-yellow" data-toggle="modal" href="#static_reject" onclick="show_reject('.$row->id.');return false;" >'.trans('core.btnReject').'</button>
					// 	</div>
					// 	<hr/>
					// 	<div class="btn-col-2">
					// 		<button class="btn-green" data-toggle="modal" href="#static" onclick="show_application('.$row->id.');return false;" ><i class="fa fa-edit"></i> '.trans('core.btnView').'</button>
					// 		<a  href="javascript:;" onclick="del('.$row->id.');return false;" class="btn-darkGreen">
     //                    <i class="fa fa-trash"></i> '.trans('core.btnDelete').'</a>
					// 	</div>
					// ';
	    //         } else {
		   //          $string = '<p><button style="width: 74px;" class="btn purple btn-sm" data-toggle="modal" href="#static" onclick="show_application('.$row->id.');return false;" ><i class="fa fa-eye"></i> '.trans('core.btnView').'</button></p>
     //                      <p><a  href="javascript:;" onclick="del('.$row->id.');return false;" class="btn red btn-sm">
     //                    <i class="fa fa-trash"></i> '.trans('core.btnDelete').'</a></p>';
	    //         }
	    //         return $string;
	            $string = '<div class="btn-actions">';
	            if ( $row->application_status == 'pending') {
	            	$string .= '<a class="btn btn-1 tooltips" href="#static_approve" data-toggle="modal" onclick="show_approve('.$row->id.');return false;" data-original-title="Approve"><i class="fa fa-check fa-fw"></i></a>';
	            	$string .= '<a class="btn btn-1 tooltips" href="#static_reject" data-toggle="modal" onclick="show_reject('.$row->id.');return false;" data-original-title="Reject"><i class="fa fa-close fa-fw"></i></a>';
	            }
                  
                  $string .= '<a class="btn btn-1 tooltips" data-toggle="modal" href="#static" onclick="show_application(\''.$row->id.'\');return false;" data-original-title="Edit"><i class="fa fa-edit fa-fw"></i></a>';
                  $string .= '<a href="javascript:;" onclick="del(\''.$row->id.'\');return false;" class="btn btn-1 tooltips" data-original-title="Delete"> <i class="fa fa-trash fa-fw"></i></a>';
                  $string .= '</div>';

	            return $string;
            })

            ->make();
    }




    public function show($id)
    {
        $this->data['leave_application']    =   LeaveApplication::find($id);
        return View::make('admin.leave_applications.show',$this->data);
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

	public function store(){
		$input = Input::all();


		$employeeID = $input['employee_id'];
		$leaveType = $input['type_of_leave'];


		$halfDayLeaveType = null;
		if($leaveType == "half day"){
	        $halfDayLeaveType = isset($input['leaveTypeWithoutHalfDay']) ? $input['leaveTypeWithoutHalfDay'] : null; 
		}



		$i_start_date = $input['start_date'];
		$i_end_date = $input['end_date'];


        $sgtimestamp   = new DateTimeZone('Asia/Singapore');
        $start_date = DateTime::createFromFormat('d-m-Y', $i_start_date);
        $start_date->setTimezone($sgtimestamp);

        $end_date = DateTime::createFromFormat('d-m-Y', $i_end_date);
        $end_date->setTimezone($sgtimestamp);

        $interval = $end_date->diff($start_date);
        $days = $interval->days;

        $applied_on = new DateTime();
        $updated_by = new DateTime();

        $reason = (isset($input['reason'])) ? $input['reason'] : null; 

        $application_status = "pending";


        $leaveApp     =  LeaveApplication::firstOrCreate([
            'employeeID'    => $employeeID,
            'start_date' => $start_date->format("Y-m-d"),
            'end_date' => $end_date->format("Y-m-d"),
            'applied_on'          => $applied_on->format("Y-m-d"),
        ]);

        $leaveApp->leaveType = $leaveType;
        $leaveApp->halfDayType = $halfDayLeaveType;
        $leaveApp->start_date = $start_date->format("Y-m-d");
        $leaveApp->end_date = $end_date->format("Y-m-d");
        $leaveApp->days = $days;

        $leaveApp->updated_by = Auth::admin()->get()->email;
        $leaveApp->reason = $reason;
        $leaveApp->application_status = $application_status;
        $leaveApp->save();

        Session::flash('success',"Leave Application for Employe ID: ". $employeeID ." successfully created");
		return Redirect::route('admin.leave_applications.index');

	}


}
