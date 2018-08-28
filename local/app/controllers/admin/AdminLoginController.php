<?php
/*
 * Admin Login Controller
 */

class AdminLoginController extends AdminBaseController {


    public function __construct()
    {
        parent::__construct();
    }

/*  When Admin is not logged in show the login page.
 *  Otherwise redirect to Dashboard
 */
	public function index()
	{
		if(Auth::admin()->check())
		{
			 return Redirect::route('admin.dashboard.index');
		}else{

			return View::make('admin/login',$this->data);
		}	
	}


/*
 * When login button of admin is clicked .This Method checks the credentails from
 * Database and return as success value.
 */
	public function ajaxAdminLogin()
	{

		$input = Input::all();

		$data	=	[
			'email'	    =>	$input['email'],
			'password'	=>	$input['password']
		];

		//Rules to validate the incoming username and password
		$rules  =[
			'email'	=> 'required',
			'password'	=>	'required'
		];

		$validator	= Validator::make($input,$rules);


		//if validator fails then move to this block
		if($validator->fails())
		{
			$output['status']	=	'error';
			//Check if login is from lock screen or from login page
			$output['msg']		=	(Session::get("lock")!=1)	?	'Both Fields are Required':'Password is required';

		}
		// Check if admin exists in database with the credentials of not
		else if (Auth::admin()->attempt($data,true))
        {
			$event = Event::fire('auth.login', Auth::admin()->get());
			Session::put('lock', '0'); //Reset the lock screen session;
			$output['status']	=	'success';
			$output['msg']		=	trans('messages.loginSuccess');
		}
		//Show error Message if admin with posted data doesnot exists
		else
		{
			$output['status']	=	'error';
			//Check if login is from lock screen or from login page
			$output['msg']		=	(Session::get("lock")!=1)	?trans('messages.loginInvalid'):trans('messages.wrongPassword');

		}

		return Response::json($output, 200); 


	}



/*
 * When logout button of admin panel is clicked.This method is called.This method destroys all the
 * the session stored and redirect to the Login Page
 */
	public function logout()
	{
		Auth::admin()->logout();

		return Redirect::route('admin.getlogin');
	}
}