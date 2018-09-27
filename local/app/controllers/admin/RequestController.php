<?php

class RequestController extends \AdminBaseController {


    public function __construct()
    {
        parent::__construct();
        $this->data['Request'] ='active open';
        $this->data['pageTitle']  =  'Request';
    }

    //    Display a listing of awards
    public function index()
	{
		$this->data['pageTitle']  =  'Request';
		$this->data['requestOthers'] = RequestOther::all();
		$this->data['Employees'] = Employee::all();
		$this->data['employees'] = Employee::selectRaw('CONCAT(firstName, " ", lastName, " (EmpID:", employeeID,")") as full_name, employeeID')
	                                        ->where('status','=','active')
	                                        ->lists('full_name','employeeID');
		
		return View::make('admin.request_other.index', $this->data);
	}


	/**
	 * Store a newly created award in storage.
	 */

	public function store()
	{

		$validator = Validator::make($input = Input::all(), RequestOther::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
   
		RequestOther::create([
			'employeeID' => $input['employeeID'],
			'quantity' => ($input['quantity'])?:0,
			'remarks' => $input['remarks'],
			'description' => $input['description'],
			'status' => $input['status'],

		]);

		return Redirect::route('admin.request.index')->with('success',"<strong>{$input['employeeID']}</strong> Daily Time Record added");
	}


	
	/**
	 * Show the form for editing the specified award.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $this->data['requests']    = RequestOther::where('id','=',$id)->get();
      
		return View::make('admin.request_other.edit', $this->data);
	}

	/**
	 * Update the specified award in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$request = RequestOther::findOrFail($id);

		$validator = Validator::make($data = Input::all(), RequestOther::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$request->update($data);

		return Redirect::route('admin.request.index')->with('success',"<strong>Success</strong> Updated Successfully");
	}

	/**
	 * Remove the specified award from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Request::ajax()) {
			RequestOther::destroy($id);
			$output['success'] = 'deleted';

			return Response::json($output, 200);
		}else{
			throw(new Exception('Wrong request'));
		}

	}

}
