<?php

class BranchesController extends \AdminBaseController {



    public function __construct()
    {
        parent::__construct();
        $this->data['departmentOpen'] ='active open';
        $this->data['pageTitle'] = 'Branches';
    }

    /**
     * Display a listing of departments
     */
	public function index() {
		$this->data['branches'] = Branch::All();
	
		$extrnals = Department::where('deptName', '=','External')->get();
		foreach($extrnals as $ext){
			$designations = Designation::where('deptID', '=', $ext['id'])->get();
			
			$this->data['designations']  = $designations;
			
		}
		return View::make('admin.branches.index', $this->data);
	}



	/**
	 * Store a newly created department in storage.
	 */
	public function store()
	{
		$validator = Validator::make($input = Input::all(), Branch::rules());
	
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        foreach ($input['branch'] as $index => $value) {
            if($value=='')continue;
            Branch::firstOrCreate([
                'designationID' => $input['designationID'],
                'branch' => $value
            ]);

        }

		return Redirect::route('admin.branches.index')->with('success',"<strong>{$input['designationID']}</strong> successfully added to the Database");
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

		$this->data['branches'] = Branch::where('designationID', '=', $id)->get();
		
		return View::make('admin.branches.edit', $this->data);
	}


	/**
	 * Update the specified department in storage.
	 */
	public function update($id)
	{
		$designation = Designation::findOrFail($id);
		$input = Input::all();
		// $validator = Validator::make($input = Input::all(), Branch::rules($id));
	
		// if ($validator->fails())
		// {
		// 	return Redirect::back()->withErrors($validator)->withInput();
		// }


		$designation->update([
            'designation'=> $input['designation']
        ]);

        foreach ($input['branch'] as $index => $value) {
			
            if($value=='' && !isset($input['branchID'][$index]))continue;

            if(isset($input['branchID'][$index]))
            {

                if($value=='') {
                    Branch::destroy($input['branchID'][$index]);
                }
                else{
                    $design = Branch::find($input['branchID'][$index]);
					$design->branch = $value;
					$design->designationID = $designation->id;
                    $design->save();
                }


            }else
            {
                Branch::firstOrCreate([
                    'designationID'=> $designation->id,
                    'branch' => $value
                ]);
            }

        }

		return Redirect::route('admin.branches.index')->with('success',"<strong>{$input['designation']}</strong> updated successfully");;
	}

	/**
	 * Remove the specified department from storage.
	 */
	public function destroy($id)
	{
		if (Request::ajax()) {
			
			Branch::destroy($id);

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
