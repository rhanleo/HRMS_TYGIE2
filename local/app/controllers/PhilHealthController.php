<?php

class PhilHealthController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
   public function __construct() {
 		parent::__construct();
 		$this->data['philHealthActive'] 	= 'active';
 		$this->data['philHealthOpen']      =   'active open';
 		$this->data['pageTitle']       	= 'PhilHealth Settings';
 	}

	public function index() {

		$this->data['philHealthSettings'] = DB::table('philhealth_settings')->get();
		return View::make( 'admin.philhealth.index', $this->data );

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {

		return View::make( 'admin.philhealth.create', $this->data );

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
    	'salary_from' => 'required|min:0|numeric',
    	'salary_to' => 'required|min:0|numeric',      
      'total_share' => 'required|min:0|numeric',
      'employee_share' => 'required|min:0|numeric',
    );

    $validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()){
			Input::flash();
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$input = Input::all();
		unset($input['_token']);

		foreach ($input as $key => $val) {
			if (is_array($val)) {
				$input[$key] = json_encode($val);
			}
		}

		$input['created_at'] = date('Y-m-d H:i:s');
		$create = DB::table('philhealth_settings')->insertGetId($input);

		if ($create != '') {
    	return Redirect::route('admin.philhealth.index')->with('success',"Philhealth Setting successfully added");
		}
		else{
			return Redirect::back()->withInput()->withErrors('Failed to add Philhealth Setting');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->edit($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$this->data['philHealthSettings'] = DB::table('philhealth_settings')->where('id', $id)->first();

		if ($this->data['philHealthSettings'] != null) {
			return View::make('admin.philhealth.create', $this->data);
		}
			return Redirect::route('admin.philhealth.index')->withErrors(['No record found']);
		}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$rules = array(
    	'salary_from' => 'required|min:0|numeric',
    	'salary_to' => 'required|min:0|numeric',      
      'total_share' => 'required|min:0|numeric',
      'employee_share' => 'required|min:0|numeric',
    );

    $validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()){
			Input::flash();
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$input = Input::all();
		unset($input['_token']);
		unset($input['_method']);

		foreach ($input as $key => $val) {
			if (is_array($val)) {
				$input[$key] = json_encode($val);
			}
		}

		$input['updated_at'] = date('Y-m-d H:i:s');
		$update = DB::table('philhealth_settings')->where('id', $id)->update($input);

		if ($update != '') {
    	return Redirect::route('admin.philhealth.update', $id)->with('success',"Philhealth Setting Updated Successfully!");
		}
		else{
			return Redirect::back()->withInput()->withErrors('Failed to update Philhealth Setting');
		}

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DB::table('philhealth_settings')->where('id', $id)->delete();
			return array(
				'success' => true,
			);
	}


}
