<?php

class DashboardController extends \FrontBaseController {

	public function __construct()
    {

        parent::__construct();
        $this->data['pageTitle']   =   Lang::get('core.dashboardTitle');

        $this->data['employeeID']  =   Auth::employees()->get()->employeeID;

	    $this->data['leaveTypes']  =    Attendance::leaveTypesEmployees();
	    $this->data['leaveTypeWithoutHalfDay']   =   Attendance::leaveTypesEmployees('halfday');
//        Total leaves except
	    $total_leave    =   Leavetype::where('leaveType','<>','half day')->sum('num_of_leave');

        $this->data['leaveLeft']   =    array_sum(Attendance::absentEmployee($this->data['employeeID'])).'/'.$total_leave;
        $this->data['leaves'] = Attendance::absentEveryEmployee();
        //die($this->data['leaveLeft']);
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
	$this->data['timein'] = Attendance::where('employeeID','=',$this->data['employeeID'])->orderBy('date','DESC')->take(1)->get();
	//var_dump($this->data['timein']);
        $this->data['attendance_count']   = Attendance::attendanceCount($this->data['employeeID']);

        $this->data['current_month_birthdays']   = Employee::currentMonthBirthday();



    }



	public function index()
	{
        $this->data['homeActive']         =    'active';

        $this->data['noticeboards']       =     Noticeboard::where('status','=','active')->orderBy('created_at','DESC')->get();

        $this->data['holiday_color']      = ['info','error','success','pending',''];
        $this->data['holiday_font_color'] = ['blue','red','green','yellow','dark'];


        return View::make('front.employeeDashboard',$this->data);
	}
	public function updatePersonal($id)
	{
		$employee   =   Employee::where('employeeID','=',$id)->get()->first();
	
		$employee->mobileNumber = Input::get('mobileNumber');
		$employee->save();

		return Redirect::to('dashboard');
	}

//	show leave Page
	public function leave()
	{
        $this->data['leaveActive'] =    'active';
       return View::make('front.leave',$this->data);
	}

	public function overtime()
	{
        $this->data['overtimeActive'] =    'active';
       return View::make('front.overtime',$this->data);
	}

	public function timein($id)
	{
		//$employee = Employee_detail::firstOrNew(['employeeID'=>$id]);
		$employee   =   Employee::where('employeeID','=',$id)->get()->first();
		$employee->a_status = '1';
		$employee->save();
		$date   =   date('Y-m-d');
		$user     =  Attendance::firstOrCreate([
                'employeeID'    => $id,
                'date'          => $date,
            	]);
		//if($user->application_status !='approved' || ($user->application_status =='approved' && isset($input['checkbox'][$employeeID])=='on'))
		//{
			$update = Attendance::find($user->id);
			$update->status     = 'present'; //(isset($input['checkbox'][$employeeID])=='on')?'present':'absent';
			$update->leaveType  = null; //(isset($input['checkbox'][$employeeID])=='on')?null:$input['leaveType'][$employeeID];
			$update->halfDayType  = null; //( (!isset($input['checkbox'][$employeeID])=='on') && ($input['leaveType'][$employeeID]=='half day'))?$input['leaveTypeWithoutHalfDay'][$employeeID]:null;
			$update->reason     = null; //(isset($input['checkbox'][$employeeID])=='on')?'':$input['reason'][$employeeID];
			$update->application_status     = null;
			$update->updated_by     = 'skubbs.dev@gmail.com'; //Auth::admin()->get()->email;
			$update->save() ;
		//}

		return Redirect::to('dashboard'); //$this->index();
	}

	public function timeout($id)
	{
		//$employee = Employee_detail::firstOrNew(['employeeID'=>$id]);
		$employee   =   Employee::where('employeeID','=',$id)->get()->first();
		$employee->a_status = '0';
		$employee->save();
		$date   =   date('Y-m-d');
		$user     =  Attendance::firstOrCreate([
                'employeeID'    => $id,
                'date'          => $date,
            	]);
		//if($user->application_status !='approved' || ($user->application_status =='approved' && isset($input['checkbox'][$employeeID])=='on'))
		//{
			$update = Attendance::find($user->id);
			$update->status     = 'present'; //(isset($input['checkbox'][$employeeID])=='on')?'present':'absent';
			$update->leaveType  = null; //(isset($input['checkbox'][$employeeID])=='on')?null:$input['leaveType'][$employeeID];
			$update->halfDayType  = null; //( (!isset($input['checkbox'][$employeeID])=='on') && ($input['leaveType'][$employeeID]=='half day'))?$input['leaveTypeWithoutHalfDay'][$employeeID]:null;
			$update->reason     = null; //(isset($input['checkbox'][$employeeID])=='on')?'':$input['reason'][$employeeID];
			$update->application_status     = null;
			$update->updated_by     = 'skubbs.dev@gmail.com'; //Auth::admin()->get()->email;
			$update->save() ;
		return Redirect::to('dashboard'); //$this->index();
	}
	//	show Salary  Page
	public function salary()
	{
		$this->data['salaryActive'] =    'active';
		return View::make('front.salary',$this->data);
	}
  // show appraisal page
  public function appraisal()
  {
    $this->data['appraisalActive'] = 'active';
    $this->data['employeeQuestions'] = DB::table('appraisal_questions')->get();
    $this->data['employees'] = Employee::all();

    return View::make('front.appraisal.index',$this->data);

  }

  public function store_appraisal() {
    $input = Input::all();

    $employeeID = $input['employeeId'];
    $question_id = $input['question_id'];
    $for_quarter = $input['appraisal_quarter'];
    $rating = $input['appraisal_rating'];
    $remarks = $input['remarks'];
    $appraised_by = $input['appraisedById'];

    $data = [];

    for($i = 0; $i <= count($question_id); $i++) {
      if(isset($for_quarter[$i])) {
        $data[] = array(
          'employeeID' => $employeeID,
          'for_quarter' => $for_quarter[$i],
          'question_id' => $question_id[$i],
          'rating' => $rating[$i],
          'remarks' => $remarks[$i],
          'appraised_by' => $appraised_by
        );
      }
    }

    $inserted_id = DB::table('employee_appraisal')->insert($data);
  }

  public function get_form($id) {
    $employee = DB::table('employees')
                  ->where('employeeID', $id)
                  ->first();
    if ($employee != '') {
      return View::make('front.appraisal.form', [
          'data' => $employee,
          'employeeQuestions' => DB::table('appraisal_questions')->get(),
        ]);
    }

    return json_encode(['status' => 'error']);
  }
  // public function tae()
  // {
  //   $this->data['appraisalActive'] = 'active';
  //   $this->data['questions'] = DB::table('appraisal_questions')
  //                                 ->where('app_for', '2')
  //                                 ->select(['question'])
  //                                 ->get();
  //   $this->data['employees'] = Employee::all();

  //   return json_encode($this->data);

  // }

	public function salary_show($id)
	{
		/*$this->data['payroll']    = Payroll::findOrFail($id);
		//echo 'test';
		return View::make('admin.payrolls.pdfview', $this->data);
		*/
		try {
			$aw = 0;
			if(isset($id)&&!empty($id)) {
			$this->data['payroll']    = Payroll::findOrFail($id);
			$allowances = json_decode($this->data['payroll']['allowances']);
			$acpf = json_decode($this->data['payroll']['acpf']);
			if(is_array($allowances)) {
				foreach($allowances as $at => $av)
				{
					if($acpf[$at] != '0') {
						if($av != '0')
							$aw = $aw + $av;
					}
				}
			}
			$age = date_diff(date_create($this->data['payroll']->employeeDetails->date_of_birth), date_create('today'))->y;
			//dd($age);
			$salary = $this->data['payroll']->basic;

			if($this->data['payroll']->ecpf == 'y')
				$salary = $salary + $this->data['payroll']->expense;
			//dd($salary);
			if($salary > 6000)
			{
				$salary = 6000;
			}
			if($age <= '55')
			{
				$employer = '.17';
				$employee = '.20';
			}
			elseif($age > '55' && $age < '60')
			{
				$employer = '.13';
				$employee = '.13';
			}
			elseif($age > '60' && $age < '65')
			{
				$employer = '.09';
				$employee = '.075';
			}
			else
			{
				$employer = '.075';
				$employee = '.05';
			}
			$this->data['cpf_employer'] = $salary * $employer; //$this->data['payroll']->net_salary * $employer;
			$this->data['cpf_employee'] = $salary * $employee; //$this->data['payroll']->net_salary * $employee;
			$this->data['cpf_total'] = $this->data['cpf_employer'] + $this->data['cpf_employee'];
			//dd($this->data);
			$this->data['cpf_aw_employer'] = 0;
			$this->data['cpf_aw_employee'] = 0;
			//$this->data['cpf_aw_total'] = 0;
			if($aw > 0)
			{
				$awc = 102000 - ($salary * 12);
				if($aw > $awc)
					$aw = $awc;
				$this->data['cpf_aw_employer'] = $aw * $employer;
				$this->data['cpf_aw_employee'] = $aw * $employee;
			}
			//dd($this->data);
			$this->data['pending_applications']   = LeaveApplication::where('application_status','=','pending')->get();
			$this->data['cpf_aw_total'] = $this->data['cpf_aw_employer'] + $this->data['cpf_aw_employee'];
			return View::make('admin.payrolls.pdfview', $this->data);
			}
		} catch ( \Exception $e ) {
			dd($e);
		}
	}

	public function downloadPdf($id){
		/*$this->data['payroll']    = Payroll::findOrFail($id);

		return PDF::loadView("admin.payrolls.pdfview", $this->data)
			->download(date('F', mktime(0, 0, 0, $this->data['payroll']->month, 10)) ."-".$this->data['payroll']->year .".pdf");
		*/
		try {

		$aw = 0;
			if(isset($id)&&!empty($id)) {
			$this->data['payroll']    = Payroll::findOrFail($id);
			$allowances = json_decode($this->data['payroll']['allowances']);
			foreach($allowances as $at => $av)
			{
				if($av != '0')
					$aw = $aw + $av;
			}
			$age = date_diff(date_create($this->data['payroll']->employeeDetails->date_of_birth), date_create('today'))->y;
			//dd($age);
			$salary = $this->data['payroll']->net_salary;
			if($salary > 6000)
			{
				$salary = 6000;
			}
			if($age <= '55')
			{
				$employer = '.17';
				$employee = '.20';
			}
			elseif($age > '55' && $age < '60')
			{
				$employer = '.13';
				$employee = '.13';
			}
			elseif($age > '60' && $age < '65')
			{
				$employer = '.09';
				$employee = '.075';
			}
			else
			{
				$employer = '.075';
				$employee = '.05';
			}
			$this->data['cpf_employer'] = $salary * $employer; //$this->data['payroll']->net_salary * $employer;
			$this->data['cpf_employee'] = $salary * $employee; $this->data['payroll']->net_salary * $employee;
			$this->data['cpf_total'] = $this->data['cpf_employer'] + $this->data['cpf_employee'];
			//dd($this->data);
			$this->data['cpf_aw_employer'] = 0;
			$this->data['cpf_aw_employee'] = 0;
			//$this->data['cpf_aw_total'] = 0;
			if($aw > 0)
			{
				$awc = 102000 - ($salary * 12);
				if($aw > $awc)
					$aw = $awc;
				$this->data['cpf_aw_employer'] = $aw * $employer;
				$this->data['cpf_aw_employee'] = $aw * $employee;
			}
			$this->data['cpf_aw_total'] = $this->data['cpf_aw_employer'] + $this->data['cpf_aw_employee'];

		return PDF::loadView("admin.payrolls.pdfview", $this->data)
		          ->download($this->data['payroll']->employeeID."-".date('F', mktime(0, 0, 0, $this->data['payroll']->month, 10))."-".$this->data['payroll']->year .".pdf");
                }
		} catch ( \Exception $e) { dd($e); }
	}

	// Datatable ajax request
	public function ajax_payrolls()
	{
		// $result = Payroll::select('payrolls.id','month','year','net_salary','payrolls.created_at')
		//                  ->join('employees', 'payrolls.employeeID', '=', 'employees.employeeID')
		// 	             ->where('payrolls.employeeID','=',$this->data['employeeID'])
		//                  ->orderBy('payrolls.created_at','desc');

		// return Datatables::of($result)

		//                  ->edit_column('month',function($row){

		// 	                 return date('F', mktime(0, 0, 0, $row->month, 10));
		//                  })
		//                  ->add_column('edit', '
		//                        <a  data-toggle="modal" data-target=".show_notice" class="btn bg-blue-madison btn-sm margin-bottom-10"  data-sid="{{$id}}" href="{{ route(\'front.salary_slip\',$id)}}" ><i class="fa fa-eye"></i> View</a>
		//                        <a class="bg-blue-ebonyclay btn btn-sm margin-bottom-10"  href="{{ route(\'front.payrolls.downloadpdf\',$id)}}" ><i class="fa fa-download"></i> Download PDF</a>
	 //                   ')
		//                  ->make();

		$where_in = array(1,2);
		$settings = DB::table('settings')->first();
		$select_arr = array(
						'payrolls.id',
						'payrolls.period',
						'month',
						'year',
						'net_salary',
					);

		$result = Payroll::select($select_arr)
				  ->join('employees', 'payrolls.employeeID', '=', 'employees.employeeID')
				  ->where('payrolls.employeeID','=',$this->data['employeeID'])
		          ->orderBy('payrolls.created_at','desc');

		return Datatables::of($result)
						->edit_column('period',function($row){
							return $row->period > 1 ? 'Second Period' : 'First Period';
						})
						->edit_column('sss_deduction',function($row){
							return number_format($row->sss_deduction, 2);
						})
						->edit_column('net_salary',function($row){
							return number_format($row->net_salary, 2);
						})
						->edit_column('month',function($row){
							return date('F', mktime(0, 0, 0, $row->month, 10));
						})
						 ->add_column('edit', '
		                       <a onclick="show_salary_slip({{$id}}); return false;" class="btn bg-blue-madison btn-sm margin-bottom-10"  data-sid="{{$id}}" href="{{ route(\'front.salary_slip\',$id)}}" ><i class="fa fa-eye"></i> View</a>
		                       <a class="bg-blue-ebonyclay btn btn-sm margin-bottom-10"  href="{{ route(\'front.payrolls.downloadpdf\',$id)}}" ><i class="fa fa-download"></i> Download PDF</a>
	                   ')
						->make();
	}


	public function  notice_ajax($id)
	{
        $notice                   =    Noticeboard::find($id);
        $output['title']          =   $notice->title;
        $output['description']    =   $notice->description;

        return Response::json($output,200);
	}


    //Datatable ajax request
    public function ajaxApplications()
    {

        $result = LeaveApplication::select('id','start_date','end_date','days','leaveType','reason','applied_on','application_status','halfDayType')
            ->where('employeeID','=',$this->data['employeeID'])
            ->whereNotNull('application_status')
            ->orderBy('created_at','desc');

        return Datatables::of($result)
            ->edit_column('start_date',function($row){
                return date('d/m/Y',strtotime($row->start_date)).(isset($row->end_date)?"<br>to<br>".date('d/m/Y',strtotime($row->end_date)):'');
            })
            ->edit_column('applied_on',function($row){
                return date('d-M-Y',strtotime($row->applied_on));
            })
	        ->edit_column('leaveType',function($row){
		        $leave = ($row->leaveType=='half day')?$row->leaveType.'-'.$row->halfDayType:$row->leaveType;
		        return $leave;
	        })
            ->edit_column('reason',function($row){
	            return    strip_tags(Str::limit($row->reason,50));

            })
            ->edit_column('application_status',function($row)
            {
                $color = [
                    'pending'   =>  'warning',
                    'approved'  =>  'success',
                    'rejected'  =>  'danger'
                ];

                return "<span class='label label-{$color[$row->application_status]}'>{$row->application_status}</span>";
            })
	        ->remove_column('halfDayType')
	        ->remove_column('end_date')
            ->add_column('edit', '

                        <button  class="btn-u btn-u-xs btn-u-blue" data-toggle="modal" data-target=".show_notice" onclick="show_application({{ $id }});return false;" ><i class="fa fa-eye"></i></button>
                         ')
            ->make();
    }

	public  function changePasswordModal()
	{
		return View::make('front.change_password_modal',$this->data);
	}


    public function change_password()
    {

        $validator = Validator::make($input = Input::all(), Employee::rules('password'));

        if ($validator->fails())
        {
            $output['status']   =   'error';
            $output['msg']      =   $validator->getMessageBag()->toArray();

        }else{

            $employee = Employee::find(Auth::employees()->get()->id);
            $employee->password =   Hash::make($input['password']);
            $employee->save();
            //        Send change password email
            Mail::send('emails.changePassword', $this->data, function($message)
            {
                $message->from($this->data['setting']->email, $this->data['setting']->name);

                $message->to(Auth::employees()->get()->email, Auth::employees()->get()->fullName)
                    ->subject('Change Password - '.$this->data['setting']->website);
            });

            $output['status']   =   'success';
            $output['msg']      =   '<strong>Success ! </strong>Password changed successfully';
        }


        return Response::json($output,200);


    }
	public function leave_store() {

		if(Input::get('leaveformType')=='date_range') {
			$validator = Validator::make($input = Input::all(), LeaveApplication::$rules);

			if ($validator->fails()) {
				$output['status'] = 'error';
				$output['msg'] = $validator->getMessageBag()
				                           ->toArray();
				return Response::json($output,200);

			}
			else {

				LeaveApplication::create(
					['employeeID'                   => $this->data['employeeID'],
                     'start_date'                   => $input['start_date'],
                     'end_date'                     => $input['end_date'],
                     'days'                         => $input['days'],
                     'leaveType'                    => $input['leaveType'],
                     'halfDayType'                  => ($input['leaveType'] =='half day') ? $input['halfDayType'] : null,
                     'reason'                       => $input['reason'],
                     'application_status'           => 'pending',
                     'applied_on'                   => date('Y-m-d', time())
					]);

				//For email
				$this->data['emailType']  = 'date_range';
				$this->data['dates']      = $input['start_date']. ' to '.$input['end_date'];
				$this->data['days']       = $input['days'];
				$this->data['leaveType']  = $input['leaveType'];
				$this->data['reason']     = $input['reason'];
			}

		}
		// Single Date Leave
		else{
			$input = Input::all();
			$dateArray  =   $input['date'];
			foreach($dateArray as $key=>$value)
			{
				$input['date'][$key]    =   ($input['date'][$key]!='') ?date('Y-m-d', strtotime(str_replace('/', '-', $input['date'][$key]))):NULL;
			}


			$validator = Validator::make($input, LeaveApplication::rules_single_leaves(Input::get('date')),LeaveApplication::messages_single_leaves(Input::get('date')));

			if ($validator->fails()) {
				$output['status'] = 'error';
				$output['msg'] = $validator->getMessageBag()
				                           ->toArray();
				return Response::json($output,200);

			}else{

			foreach ($input['date'] as $index => $value) {
				if (empty($value)) continue;
				try {

					LeaveApplication::create([
						'employeeID' => $this->data['employeeID'],
						'start_date' => $value,
						'end_date' => NULL,
						'days'     =>1,
						'leaveType' => $input['leaveType'][$index],
						'halfDayType' => ($input['leaveType'][$index]=='half day')?$input['halfleaveType'][$index]:null,
						'reason' =>   $input['reason'][$index],
						'application_status' => 'pending',
						'applied_on' => date('Y-m-d', time())
					]);
		                //For email
						$this->data['emailType']  = 'single';
		                $this->data['dates'][$index] = date('d-M-Y', strtotime($value));
		                $this->data['leaveType'][$index] = $input['leaveType'][$index];
		                $this->data['reason'][$index] = $input['reason'][$index];

				} catch (Exception $e) {
					$output['status']   =   'error';

					$output['msg']      =   Lang::get('messages.leaveRequest');
					Session::flash('error_leave',Lang::get('messages.leaveRequest'));


					Session::flash('error_leave', [Lang::get('messages.errorLeaveRequest')]);
					return Response::json($output,200);
				}

			 }
			}


		}

		//        Send email to all admins
		$admins = Admin::select('email')->get()->toArray();
		foreach ($admins as $admin){
			Mail::send('emails.leave_request', $this->data, function ($message) use ($admin) {
				$message->from(Auth::employees()->get()->email, Auth::employees()->get()->fullName);
				$message->to($admin['email'])
				        ->subject('Leave Request - ' . $this->data['setting']->website);
			});
		}

		$output['status']   =   'success';

		$output['msg']      =   Lang::get('messages.leaveRequest');
		Session::flash('success_leave',Lang::get('messages.leaveRequest'));

		return Response::json($output,200);


	}

	public function overtime_store(){
		
		$input = Input::all();
		$total = count($input['ot_time_in']);

		// var_dump( $input );
		// die();

		for ($i=0; $i <= $total; $i++) { 
			if (isset($input['ot_time_in'][$i]) && isset($input['ot_time_out'][$i]) && isset($input['ot_reason'][$i]) &&
				$input['ot_time_in'][$i] != '' && $input['ot_time_out'][$i] != '' && $input['ot_reason'][$i] != '' ) {

				$total = strtotime($input['ot_time_out'][$i]) - strtotime($input['ot_time_in'][$i]);
				$total = $total > 0 ? $total : 0; 
				$hours = floor($total / 60 / 60);
				$minutes = round(($total - ($hours * 60 * 60)) / 60);

	        	$total_ot_hours = $hours + ( $minutes > 0 ? .5 : 0 );
				
				DB::table('overtime_applications')
					->insert([
						'employeeID' => $this->data['employeeID'],
						'start_date' => date('Y-m-d H:i:00', strtotime($input['ot_time_in'][$i])),
						'end_date' => date('Y-m-d H:i:00', strtotime($input['ot_time_out'][$i])),
						'reason' => $input['ot_reason'][$i],
						'application_status' => 'pending',
						'total_overtime' => $total_ot_hours,
						'type' => 'ordinary',
						'created_at' => date('Y-m-d H:i:s'),
					]);
			}
		}
		Session::flash('success_overtime', '<strong>Success ! </strong>Overtime application success. You will be notified soon');
		return Redirect::to('overtime'); 

	}
// Ajax leave application view show
    public function show($id)
    {

        $this->data['leave_application']    =   LeaveApplication::find($id);
       return View::make('front.leave_modal_show',$this->data);
    }

    public function ajaxOvertime()
    {

        // $result = LeaveApplication::select('id','start_date','end_date','days','leaveType','reason','applied_on','application_status','halfDayType')
        //     ->where('employeeID','=',$this->data['employeeID'])
        //     ->whereNotNull('application_status')
        //     ->orderBy('created_at','desc');
        $result = DB::table('overtime_applications')
        			->select('id', 'start_date', 'end_date', 'application_status', 'remarks', 'created_at' )
        			->where('employeeID', '=', $this->data['employeeID'])
        			->whereNotNull('application_status')
					->orderBy('created_at', 'desc');
					
        return Datatables::of($result)
        	->edit_column('start_date',function($row){
	        	return date('M d,Y h:i a', strtotime($row->start_date));
			})
        	->edit_column('end_date',function($row){
	        	return date('M d,Y h:i a', strtotime($row->end_date));
			})
        	->edit_column('created_at',function($row){
	        	return date('M d,Y h:i a', strtotime($row->created_at));
			})
			
			->edit_column('application_status', function($row){
				
                $color = [
                    'pending'   =>  'warning',
                    'approved'  =>  'success',
                    'rejected'  =>  'danger'
				];
				// $remarks = $row->application_status == 'rejected' ? "<span class='text-danger'> Reason:<br/></span>" . $row->remarks : '';
				
                return "<p class='label label-{$color[$row->application_status]}'>{$row->application_status}</p>" ;
			})
			->edit_column('remarks', function($row){
				
                
				$remarks = $row->application_status == 'rejected' ?  $row->remarks : '';
				
                return $remarks ;
            })
	        
			->add_column('total_hours',function($row){
				$total      = strtotime($row->end_date) - strtotime($row->start_date);
				$total = $total > 0 ? $total : 0;
				$hours      = floor($total / 60 / 60);
				$minutes    = round(($total - ($hours * 60 * 60)) / 60);

	        	return $hours .'h '. $minutes.'m';
			})
            ->add_column('edit', function($row) {

         		$string = '<div class="btn-actions">
            	<button  class="btn-u btn-u-xs btn-u-blue" data-toggle="modal" data-target=".show_notice" onclick="ot_show_application(\''.$row->id.'\');return false;" ><i class="fa fa-eye"></i></button>';
         		
            	if ($row->application_status == 'pending') {
            		$string .= '<button  class="btn-u btn-u-xs btn-u-green" data-toggle="modal" data-target=".show_notice" onclick="ot_edit_application(\''.$row->id.'\');return false;" ><i class="fa fa-edit"></i></button>';
            	}

            	$string .= '</div>';
            	return $string;
         	})
            ->make();
    }
    // Ajax leave application view show
    public function ot_show($id)
    {

        $this->data['overtime_application']    =  DB::table('overtime_applications')
        												->where('id', $id)
        												->first();

       return View::make('front.overtime_modal_show',$this->data);
    }
    
    // OVERTIME UPDATE

    public function overtimeEdit( $id ){
		$this->data['overtime_application']    =  DB::table('overtime_applications')
    												->where('employeeID', $this->data['employeeID'])
    												->where('id', $id)
    												->where('application_status', 'pending')
    												->first();
    	if ($this->data['overtime_application'] != '') {
    		
    		return View::make('front.overtime-update',$this->data);
    	}

    	Session::flash('error_overtime', 'Record not found');
		return Redirect::route('front.overtime');
    }

    public function overtimeUpdate( $id ){
    	$overtime  =  DB::table('overtime_applications')
							->where('id', $id)
							->where('employeeID', $this->data['employeeID'])
							->where('application_status', 'pending')
							->first();

		if ($overtime != '') {
			# code...
		}
		
		Session::flash('error_overtime', 'Record not found');
		return Redirect::route('front.overtime');
    }


    // Ajax leave application view show
    public function ot_edit($id)
    {

        $this->data['overtime_application']    =  DB::table('overtime_applications')
        												->where('id', $id)
        												->first();

       return View::make('front.overtime_modal_edit',$this->data);
    }

    public function updateOvertime($id)
    {

    	$input = Input::all();
    	$overtime_application = DB::table('overtime_applications')
    	                            ->where('id', $id)
    	                            ->first();
        

		if ($overtime_application !='' && $overtime_application->application_status == 'pending' ) {
			// UPDATE ONLY IF PENDING

			$total = strtotime( $input['end_date'] ) - strtotime( $input['start_date'] );
			$total = $total > 0 ? $total : 0; 
			$hours = floor($total / 60 / 60);
			$minutes = round(($total - ($hours * 60 * 60)) / 60);

        	$total_ot_hours = $hours + ( $minutes > 0 ? .5 : 0 );

			DB::table('overtime_applications')
                ->where('id', $id)
                ->update([
					'start_date' => date('Y-m-d H:i:00', strtotime( $input['start_date'] ) ),
					'end_date' => date('Y-m-d H:i:00', strtotime( $input['end_date']) ),
					'total_overtime' => $total_ot_hours,
                    // 'start_date' => date('Y-m-d H:i:s', strtotime($this->formatDate($input['start_date']))),
                    // 'end_date' => date('Y-m-d H:i:s', strtotime($this->formatDate($input['end_date']))),
                    'reason' => $input['reason'],
                ]);
            
            Session::flash('success',"<strong>Success! </strong> Updated successfully");
			
		}
		else{
		    Session::flash('error',"<strong>Error! </strong> Updating overtime failed");
		}
		
		
		
		return Redirect::to('overtime'); 
    }

    private function formatDate($date)
    {
    	// change date format to day-month-year
    	$arr = explode('-', $date);
    	return $arr[1] . '-' . $arr[0] . '-' . $arr[2];
    }


}
