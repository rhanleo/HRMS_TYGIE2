<?php

class DepartmentsController extends \AdminBaseController {



    public function __construct()
    {
        parent::__construct();
        $this->data['departmentOpen'] ='active open';
        $this->data['pageTitle'] ='Department';
    }

    /**
     * Display a listing of departments
     */
	public function index() {
		$this->data['departments'] = Department::all();
		$this->data['departmentActive'] = 'active';
		$employeeCount = array();
		foreach (Department::all() as $dept) {
			$employeeCount[$dept->id] = Employee::join('designation', 'employees.designation', '=', 'designation.id')
			                                    ->join('department', 'designation.deptID', '=', 'department.id')
			                                    ->where('department.id', '=', $dept->id )
												->count();
		}

		$this->data['employeeCount']    =   $employeeCount;

		return View::make('admin.departments.index', $this->data);
	}

	public function sub() {
		$this->data['departments'] = Department::all();
		
		$this->data['departmentActive'] = 'active';
		$employeeCount = array();
		foreach (Department::all() as $dept) {
			$employeeCount[$dept->id] = Employee::join('designation', 'employees.designation', '=', 'designation.id')
			                                    ->join('department', 'designation.deptID', '=', 'department.id')
			                                    ->where('department.id', '=', $dept->id )
												->count();
		}

		$this->data['employeeCount']    =   $employeeCount;

		return View::make('admin.departments.sub', $this->data);
	}

	/**
	 * Store a newly created department in storage.
	 */
	public function store()
	{
		$validator = Validator::make($input = Input::all(), Department::rules());

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$dept = Department::create([
            'deptName'  => $input['deptName']
        ]);

        foreach ($input['designation'] as $index => $value) {
            if($value=='')continue;
            Designation::firstOrCreate([
                'deptID' => $dept->id,
                'designation' => $value
            ]);

        }

		return Redirect::route('admin.departments.index')->with('success',"<strong>{$input['deptName']}</strong> successfully added to the Database");
	}

	public function save(){
		$validator = Validator::make($input = Input::all(), Department::rules());
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$dept = Department::create([
			'deptName' => $input['deptName']
		]);
		foreach($input['designation'] as $index => $value){
			if($value == '')continue;
			Designation::create([
				'deptID' => $dept->id,
				'designation' => $value
			]);
		}
		return Redirect::route('admin.departments.sub')->with('success',"<strong>{$input['deptName']}</strong> successfully added to the Database");
	}



	/**
	 * Show the form for editing the specified department.
	 */
	public function edit($id)
	{

		$this->data['department'] = Department::find($id);
		return View::make('admin.departments.edit', $this->data);
	}


	/**
	 * Update the specified department in storage.
	 */
	public function update($id)
	{
		$department = Department::findOrFail($id);


		$validator = Validator::make($input = Input::all(), Department::rules($id));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$department->update([
            'deptName'=> $input['deptName']
        ]);

        foreach ($input['designation'] as $index => $value) {
            if($value=='' && !isset($input['designationID'][$index]))continue;

            if(isset($input['designationID'][$index]))
            {

                if($value=='') {
                    Designation::destroy($input['designationID'][$index]);
                }
                else{
                    $design = Designation::find($input['designationID'][$index]);
                    $design->designation = $value;
                    $design->save();
                }


            }else
            {
                Designation::firstOrCreate([
                    'deptID'=> $department->id,
                    'designation' => $value
                ]);
            }

        }

		return Redirect::route('admin.departments.index')->with('success',"<strong>{$input['deptName']}</strong> updated successfully");;
	}

	/**
	 * Remove the specified department from storage.
	 */
	public function destroy($id)
	{
		if (Request::ajax()) {

			Department::destroy($id);

			$output['success'] = 'deleted';

			return Response::json($output, 200);
		}


	}

    public function ajax_designation()
    {
	    if (Request::ajax()) {
		    $input = Input::get('deptID');
		    $designation = Designation::where('deptID', '=', $input)
		                              ->get();
			
		    return Response::json($designation, 200);
		}
	
	}
	public function ajax_branch()
    {
	    if (Request::ajax()) {
		    $input = Input::get('deptID');
		    $designation = Branch::where('designationID', '=', $input)
		                              ->get();
			// $designation = array(array('id'=>'1', 'designation'=>'web'),array('id'=>'2', 'designation'=>'web2'));
		    return Response::json($designation, 200);
		}
	
    }
}
