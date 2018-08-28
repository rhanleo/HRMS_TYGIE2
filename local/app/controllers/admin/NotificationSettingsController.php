<?php

class NotificationSettingsController extends \AdminBaseController {

    public function __construct()
    {
        parent::__construct();
        $this->data['settingOpen']  =   'active open';
        $this->data['pageTitle']    =   trans('core.emailNotification');
    }


    /**
     * Show the form for editing the specified Admin.
     */
    public function edit()
    {

        $this->data['notificationSettingActive']    =   'active';
        $this->data['setting']          =    Setting::all()->first();


        return View::make('admin.notificationSettings.edit', $this->data);
    }


    public function update($id)
    {
        $setting = Setting::findOrFail($id);

        $input = Input::all();

        $input['award_notification']  = (isset($input['award_notification']))?1:0;
        $input['leave_notification']  = (isset($input['leave_notification']))?1:0;
        $input['attendance_notification']  = (isset($input['attendance_notification']))?1:0;
        $input['notice_notification']  = (isset($input['notice_notification']))?1:0;
        $input['employee_add']  = (isset($input['employee_add']))?1:0;
        $setting->update($input);

        Session::flash('success', trans('messages.successUpdate'));
        return Redirect::route('admin.notificationSettings.edit','setting');
    }


	public function ajax_update_notification()
	{
		$setting = Setting::findOrFail(Input::get('id'));
		$input[Input::get('type')]  = Input::get('value');

		$setting->update($input);

		$output['success'] = 'success';

		return Response::json($output,200);
	}
}
