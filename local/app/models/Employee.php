<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;


	// Validation Rules
	public static function rules($action,$id=false, $merge=[])
	{

		$fullNameValidation     = 'required';
		$ProfileImageValidation = 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:4000';

		$rules = [
		'create' => [
			'employeeID'    =>  'required|unique:employees,employeeID|alpha_dash',
			'firstName'      =>  $fullNameValidation,
			'lastName'      =>  $fullNameValidation,
			'email'         =>  'required|email|unique:employees',
			'password'      =>  'required',
			'profileImage'  =>  $ProfileImageValidation,
			'resume'        =>  'max:1000',
			'offerLetter'   =>  'max:1000',
			'joiningLetter' =>  'max:1000',
			'contract'      =>  'max:1000',
			'IDProof'       =>  'max:1000',
		],

		'update'=>[
			'employeeID'   =>   "required|unique:employees,employeeID,:id",
			'annual_leave' =>  "numeric"
		],

		'password' =>  [
			'password'              =>  'required|confirmed',
			'password_confirmation' =>  'required|min:5'
		],

		'bank' => [
			'accountName'   =>   'required',
			'accountNumber' =>   'required'
		],

		'personalInfo' => [
			'firstName'      =>   $fullNameValidation,
			'lastName'      =>   $fullNameValidation,
			'email'         =>   "required|email|unique:employees,email,:id",
			'profileImage'  =>   $ProfileImageValidation,
		],

		'schedule' => [
			'dateTo'      =>   'required',
			'dateFrom'    =>   'required',
			'timeFrom'    =>   'required',
			'timeTo'      =>   'required',
			'shift'      =>   'required',
		],

	];

		$rules = $rules[$action];

		if ($id) {
			foreach ($rules as &$rule) {
				$rule = str_replace(':id', $id, $rule);
			}
		}

		return array_merge( $rules, $merge );
	}



	// Don't forget to fill this array
    protected $guarded = ['id'];

	protected $hidden  = ['password'];


	public function getSchedule()
    {
       // belongs('OtherClass','thisclasskey','otherclasskey')
       return $this->hasMany('Schedule','employeeID','employeeID');
    }
    public function getDesignation()
    {
       // belongs('OtherClass','thisclasskey','otherclasskey')
       return $this->belongsTo('Designation','designation','id');
    }

	public function getWorkingHistory(){

		return $this->hasMany('WorkingHistory','employeeID','employeeID');
	}
    public function getDocuments()
    {
        return $this->hasMany('Employee_document','employeeID','employeeID');
    }

    public function getSalary()
    {
        return $this->hasMany('Salary','employeeID','employeeID');
    }

    public function getAwards()
    {
        return $this->hasMany('Award','employeeID','employeeID');
    }

    public function getBankDetail()
    {
        return $this->belongsTo('Bank_detail','employeeID','employeeID');
    }

    public static function  currentMonthBirthday()
    {
        $birthdays = Employee::select('firstName', 'lastName', 'date_of_birth','profileImage')
                ->whereRaw("MONTH(date_of_birth) = ?", [date('m')])
                ->where('status','=','active')
	            ->orderBy('date_of_birth','asc')

                ->get();
        return $birthdays;
    }
	
	//Function to calculate number of days of work
	public function workDuration($employeeID)
	{
		$employee = Employee::select('joiningDate','exit_date')->where('employeeID','=',$employeeID)->first();
		$lastDate   =   ($employee->exit_date==NULL)?date('Y-m-d'):$employee->exit_date;

		$diff = date_diff(date_create($employee->joiningDate),date_create($lastDate));

		$difference = ($diff->y==0)?null:$diff->y.' year ';
		$difference .= ($diff->m==0)?null:$diff->m.' month ';
		$difference .= ($diff->d==0)?null:$diff->d.' day ';

		return $difference;

	}


	/**
	 * Get the last absent days
	 * If the user is not absent since joining then.Joining date is last absent date
	 */
	public function lastAbsent($employeeID,$type='days'){
		$absent =   Attendance::where('status','=','absent')
		                      ->where('employeeID','=',$employeeID)
		                      ->where(function($query)
		                      {
			                      $query->where('application_status','=','approved')
			                            ->orWhere('application_status','=',null);
		                      })->orderBy('date', 'desc')->first();

		$joiningDate = Employee::select('joiningDate')->where('employeeID','=',$employeeID)->first();

		$lastDate   =   date('Y-m-d');
		$old_date   =   isset($absent->date)?$absent->date:$joiningDate->joiningDate;
		$diff       =   date_diff(date_create($old_date),date_create($lastDate));

		$difference = $diff->format('%R%a').' day ago';
		if($type == 'days'){
			return $difference;
		}elseif($type   ==  'date'){
			return date_create($old_date)->format('d-M-Y');
		}





	}
}