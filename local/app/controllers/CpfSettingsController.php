<?php

class CpfSettingsController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
   public function __construct() {
 		parent::__construct();
 		$this->data['cpfSettingsActive'] 	= 'active';
 		$this->data['settingOpen']      =   'active open';
 		$this->data['pageTitle']       	= 'CPF Settings';
 	}

	public function index()
	{
		$this->data['cpf_settings'] = DB::table('cpf_settings')->orderBy('age_from', 'asc')->get();
    return View::make('admin.cpfsettings.browse', $this->data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.cpfsettings.edit-add', $this->data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
    	'age_from' => 'required|min:0',
      'age_to' => 'required|min:0',
      'total_max_contribution' => 'required',
      'employee_max_contribution' => 'required',
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
		$id = DB::table('cpf_settings')->insertGetId($input);

		if ($id != '') {
    	return Redirect::to('admin/cpf_settings/' . $id . '/edit')->with('success', '<strong>Success! </strong>Updated Successfully');	
		}
		else{
			return Redirect::back()->withInput()->withErrors('Failed to insert data');
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
		$this->data['cpf_settings'] = DB::table('cpf_settings')->where('id', $id)->first();

		if ($this->data['cpf_settings'] != null) {
			return View::make('admin.cpfsettings.edit-add', $this->data);
		}

		return Redirect::to('admin/cpf_settings')->withErrors(['No record found']);		
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
    	'age_from' => 'required|min:0',
      'age_to' => 'required|min:0',
      'total_max_contribution' => 'required',
      'employee_max_contribution' => 'required',
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
		$update = DB::table('cpf_settings')->where('id', $id)->update($input);
		if ($update != '') {
    	return Redirect::to('admin/cpf_settings/' . $id . '/edit')->with('success', '<strong>Success! </strong>Updated Successfully');	
		}
		else{
			return Redirect::back()->withInput()->withErrors('Cpf setting not updated');
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
		//
	}


}
