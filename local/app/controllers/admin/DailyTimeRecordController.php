<?php

class DailyTimeRecordController extends \AdminBaseController {


    public function __construct()
    {
        parent::__construct();
        $this->data['DailyTimeRecord'] ='active open';
        $this->data['pageTitle']  =  'DailyTimeRecord';
    }

    //    Display a listing of awards
    public function index()
	{
		$this->data['pageTitle']  =  'DailyTimeRecord';
		$this->data['DailyTimeRecords'] = DailyTimeRecord::all();
		
		return View::make('admin.daily_time_records.index', $this->data);
	}




	public function create()
	{
        $this->data['DailyTimeRecord'] = 'active';
        $this->data['employees'] = Employee::selectRaw('CONCAT(firstName, " ", lastName, " (EmpID:", employeeID,")") as full_name, employeeID')
	                                        ->where('status','=','active')
	                                        ->lists('full_name','employeeID');

		return View::make('admin.daily_time_records.create',$this->data);
	}

	/**
	 * Store a newly created award in storage.
	 */

	public function store()
	{

		$validator = Validator::make($input = Input::all(), DailyTimeRecord::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
   
		DailyTimeRecord::create([
			'employeeID' => $input['employeeID'],
			'timeIn' => trim($input['timeIn'], 'AMPM'),
			'timeOut' => trim($input['timeOut'], 'AMPM'),
			'breakIn' => trim($input['breakIn'], 'AMPM'),
			'breakOut' => trim($input['breakOut'], 'AMPM'),
			'status' => $input['status'],

		]);

		return Redirect::route('admin.dailytimerecord.index')->with('success',"<strong>{$input['employeeID']}</strong> Daily Time Record added");
	}



	/**
	 * Show the form for editing the specified award.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $this->data['dailytimerecords']    = DailyTimeRecord::where('id','=',$id)->get();
      
		return View::make('admin.daily_time_records.edit', $this->data);
	}

	/**
	 * Update the specified award in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$dtr = DailyTimeRecord::findOrFail($id);

		$validator = Validator::make($data = Input::all(), DailyTimeRecord::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$dtr->update($data);

		return Redirect::route('admin.dailytimerecord.index')->with('success',"<strong>Success</strong> Updated Successfully");
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
			DailyTimeRecord::destroy($id);
			$output['success'] = 'deleted';

			return Response::json($output, 200);
		}else{
			throw(new Exception('Wrong request'));
		}

	}

}
