<?php

class AdminUsersController extends \AdminBaseController {

	public function __construct()
	{
		parent::__construct();
		$this->data['pageTitle']        =   'Admins';
		$this->data['settingOpen']      =   'active open';
		$this->data['adminUserActive']    =   'active';
	}

	public function index()
	{	
		// Check Admin Level Auth
		if(Auth::admin()->get()->level == 0)
		{
			$this->data['admins'] = Admin::all();

			return View::make('admin.adminusers.index', $this->data);
		} else {
			return Redirect::Route('admin.getlogin');
		}
		
	}

	// Datatable ajax request
	public function ajax_admin_users()
	{
		$result = Admin::select('id','name','email','created_at')
		                 ->orderBy('created_at','desc');

		return Datatables::of($result)
		                 ->edit_column('created_at',function($row){
			                 return date('d-M-Y',strtotime($row->created_at));
		                 })
						->add_column('edit',function($row){
								if($row->id ==$this->data['loggedAdmin']->id) {
									 $string =   '<div class="btn-actions"><a class="btn btn-1"  href="javascript:;" onclick="showEdit('.$row->id.');return false;" >
										          <i class="fa fa-edit fa-fw"></i></a></div>';
								} else{
									$string = '<div class="btn-actions"><a class="btn btn-1"  href="javascript:;" onclick="showEdit('.$row->id.');return false;" ><i class="fa fa-edit"></i></a>
                                         <a style="width: 75px;" href="javascript:;" onclick="del('.$row->id.');return false;" class="btn btn-1">
                                         <i class="fa fa-trash fa-fw"></i></div>';
								}
								return $string;
							})

		                 ->make();
	}

	public function create()
	{
		return View::make('admin.adminusers.create');
	}

	/**
	 * Store a newly created Admin in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Admin::$rules_add);

		if ($validator->fails())
		{
			$output['status']   =   'error';
			$output['msg']      =    $validator->getMessageBag()->toArray();
			return Response::json($output, 200);
		}

		if($this->data['setting']->admin_add==1)
		{
			$this->data['admin_name']        =  $data['name'];
			$this->data['admin_email']       = $data['email'];
			$this->data['admin_password']    = $data['password'];
			$this->data['level']   			 = $data['level'];
			//        Send Admin Add Mail
			Mail::send('emails.admin.admin_add', $this->data, function ($message) use ($data) {
				$message->from($this->data['setting']->email, $this->data['setting']->name);
				$message->to($data['email'], $data['name'])
				        ->subject('Admin Account Created - ' . $this->data['setting']->website);
			});
		}

		$data['password']   = Hash::make($data['password']);
		Admin::create($data);
		$output['status']   =   'success';
		$output['msg']      =    'New admin created successfully';
		Session::flash('success',  'New admin created successfully');
		return Response::json($output, 200);
	}





	public function edit($id)
	{
		$admin = Admin::find($id);

		return View::make('admin.adminusers.edit', compact('admin'));
	}


	public function update($id)
	{
		$Admin = Admin::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Admin::rules($id));

		if ($validator->fails())
		{
			$output['status']   =   'error';
			$output['msg']      =    $validator->getMessageBag()->toArray();
			return Response::json($output, 200);
		}
		$Admin->name    =   $data['name'];
		$Admin->email   =   $data['email'];
		if($data['password']!=''){
			$Admin->password   =  Hash::make($data['password']);
		}
		$Admin->save();

		$output['status']   =   'success';
		$output['msg']      =    'updated successfully';
		Session::flash('success',  'updated successfully');
		return Response::json($output, 200);
	}


	public function destroy($id)
	{
		if ($id != 1) {
			Admin::destroy($id);
			$output['success']  =   'deleted';
		}

		return Response::json($output,200);
	}

}
