<?php
use App\Models\Overtime;

class OvertimeApplications extends \AdminBaseController {

	public function __construct()
    {
        parent::__construct();
        $this->data['overtimeApplicationOpen']    =   'active open';
        $this->data['pageTitle']               =   'Overtime Application';
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['leave_applications']   = Attendance::all();

		$this->data['employees']       =    Employee::all();
		$this->data['leavetypes']       =    Leavetype::all();
        $this->data['leaveTypeWithoutHalfDay']   =   Attendance::leaveTypesEmployees('half day');
		// $this->data['overtime_application']    =   DB::table('overtime_applications')->select("*")->get();
		// $OTapplication = [];
		// foreach($this->data['overtime_application'] as $OTapp ){
		// 	$OTapplication[] = $OTapp->total_overtime;
		// }
		// $this->data['OTapps'] = $OTapplication;
		
		return View::make('admin.overtime_applications.index', $this->data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$this->data['overtime_application']    =   DB::table('overtime_applications')
														->select("*", "overtime_applications.created_at AS ota_created_at")
														->where("overtime_applications.id", $id)
														->join("employees", "overtime_applications.employeeID", "=", "employees.employeeID")
														->first();
        return View::make('admin.overtime_applications.show',$this->data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$input = Input::all();
	
		unset($input['_method']);
		unset($input['_token']);

		$input['updated_at'] = date("Y-m-d H:i:s");
		$input['updated_by'] = Auth::admin()->get()->email;
		
		// if ($input['application_status'] == "Approve") {
		// 	$input['application_status'] = "approved";
		// }
		// else {
		// 	$input['application_status'] = "rejected";
		// }

		DB::table("overtime_applications")
		  ->where("id", $id)
		  ->update($input);
		
		Session::flash('success',"<strong>Success! </strong> Updated successfully");
		return Redirect::route('admin.overtime_applications.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function ajaxApplications()
    {
	    //$result1 =  Attendance::
		 //   select('attendance.id','employees.fullName','attendance.date','attendance.leaveType','attendance.reason','attendance.applied_on','attendance.application_status','attendance.halfDayType')
	    //    ->join('employees', 'employees.employeeID', '=', 'attendance.employeeID')
		 //   ->whereNotNull('attendance.application_status')
		 //   ->orderBy('attendance.applied_on','desc');

		$result = DB::table('overtime_applications')
					->select('overtime_applications.id', 'employees.firstName', 'employees.lastName', 'overtime_applications.start_date',
					'overtime_applications.total_overtime','overtime_applications.end_date','overtime_applications.reason','overtime_applications.created_at',
					'overtime_applications.application_status')
					->join('employees', 'employees.employeeID', '=', 'overtime_applications.employeeID')
					->whereNotNull('overtime_applications.application_status')
					->orderBy('overtime_applications.created_at', 'desc');


        return Datatables::of($result)

            ->edit_column('start_date',function($row){
                $dates = date('d-M-Y',strtotime($row->start_date)).' ' .(isset($row->end_date)?' to '.date('d-M-Y',strtotime($row->end_date)):'');
                return $dates;
            })
            ->edit_column('created_at',function($row){
                return date('d-M-Y', strtotime($row->created_at));
			})
			->edit_column('total_overtime',function($row){
                return $row->total_overtime;
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
	            // if ( $row->application_status == 'pending') {
	            // 	$string .= '<a class="btn btn-1 tooltips" href="#static_approve" data-toggle="modal" onclick="show_approve('.$row->id.');return false;" data-original-title="Approve"><i class="fa fa-check fa-fw"></i></a>';
	            // 	$string .= '<a class="btn btn-1 tooltips" href="#static_reject" data-toggle="modal" onclick="show_reject('.$row->id.');return false;" data-original-title="Reject"><i class="fa fa-close fa-fw"></i></a>';
	            // }
                  
                  $string .= '<a class="btn btn-1 tooltips" data-toggle="modal" href="#static" onclick="show_application(\''.$row->id.'\');return false;" data-original-title="Edit"><i class="fa fa-edit fa-fw"></i></a>';
                //   $string .= '<a href="javascript:;" onclick="del(\''.$row->id.'\');return false;" class="btn btn-1 tooltips" data-original-title="Delete"> <i class="fa fa-trash fa-fw"></i></a>';
                  $string .= '</div>';

	            return $string;
            })

            ->make();
    }

    public function overtimeFilter($year, $month, $period, $id){

    }

}
