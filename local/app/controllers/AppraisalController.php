<?php

class AppraisalController extends \AdminBaseController {

  public function __construct() {
    parent::__construct();
    $this->data['appraisalOpen']  = 'active open';
    $this->data['pageTitle']        = 'Appraisal';
  }

  public function index()
  {
    // $this->data['employees']       =    Employee::join('department', 'employees.designation', '=', 'department.id','left outer')
    //                                             ->join('designation', 'designation.deptID', '=', 'department.id','left outer')
    //                                             ->get();
    $this->data['employees'] = Employee::all();                                                
    $this->data['questions'] = DB::table('appraisal_questions')
                                ->where('app_for', '2')
                                ->select(['question'])
                                ->get();
                                
    return View::make('admin.appraisal.index',$this->data);
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
    //
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
    //
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
