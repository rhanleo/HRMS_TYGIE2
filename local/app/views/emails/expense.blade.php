<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
		<tr>
	    	<td style="background-color:black;padding:10px;">
	    		 {{HTML::image("assets/admin/layout/img/logo-big.png",'Logo',array('class'=>'logo-default','height'=>'30px','width'=>'117px'))}}
	    	</td>
	    </tr>
	    <tr>
	    	<td style="padding:10px;">

	    	<b>{{Str::words(Auth::employees()->get()->fullName,1,'')}}</b> {{trans('email.expenseSubmitted')}}<br /><br/>

			  <p><b>{{trans('core.itemName')}}:</b>{{$expense['itemName']}}</p>
			  <p><b>{{trans('core.purchaseFrom')}}:</b>{{$expense['purchaseFrom']}}</p>
			  <p><b>{{trans('core.purchaseDate')}}:</b>{{$expense['purchaseDate']}}</p>
			  <p><b>{{trans('core.price')}}:</b>        {{$expense['price']}}</p>
			  <br />
			  <br />

	       <b> {{$setting->website}}</b><br />
	        <font size="1"><a href="{{URL::to('/');}}">{{URL::to('/');}}</a><br />
	        </font>
	        </td>
	    </tr>
</table>
