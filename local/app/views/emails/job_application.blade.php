<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
		<tr>
	    	<td style="background-color:black;padding:10px;">
	    		 {{HTML::image("assets/admin/layout/img/logo-big.png",'Logo',array('class'=>'logo-default','height'=>'30px','width'=>'117px'))}}
	    	</td>
	    </tr>
	    <tr>
	    	<td style="padding:10px;">

	    	<b>{{Str::words(Auth::employees()->get()->fullName,1,'')}}</b> {{trans('email.resumeSubmitted')}}<br /><br/>

			  <p><b>{{trans('core.position')}}:</b>{{$position}}</p>
			  <p><b>{{trans('core.name')}}:</b>    {{$job_application['name']}}</p>
			  <p><b>{{trans('core.email')}}:</b>   {{$job_application['email']}}</p>
			  <p><b>{{trans('core.phone')}}:</b>   {{$job_application['phone']}}</p>
			  <p><b>{{trans('core.coverLetter')}}:</b> {{$job_application['cover_letter']}}</p>

			  <br />
			  Click resume  to view resume: <a href="https://docs.google.com/viewer?url={{URL::to('job_application/resume/'.$job_application['resume'])}}" target="_blank">view {{trans('core.resume')}}</a>
			  <br />
			  <br />

	       <b> {{$setting->website}}</b><br />
	        <font size="1"><a href="{{URL::to('/');}}">{{URL::to('/');}}</a><br />
	        </font>
	        </td>
	    </tr>
</table>
