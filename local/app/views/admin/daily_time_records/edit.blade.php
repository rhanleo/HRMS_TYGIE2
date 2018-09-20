

@foreach($dailytimerecords as $records)
    <label for="timeIn">{{'Time In'}}</label>
	<input class="form-control form-control-inline" name="timeIn" id="timeIn" type="text" value="{{$records->timeIn}}" placeholder="{{$records->timeIn}}"/>
    <label for="timeOut">{{'Time Out'}}</label>
	<input class="form-control form-control-inline" name="timeOut" id="timeOut" type="text" value="{{$records->timeOut}}" placeholder="{{$records->timeOut}}"/>
    <label for="breakOut">{{'breakOut'}}</label>
	<input class="form-control form-control-inline" name="breakOut" id="breakOut" type="text" value="{{$records->breakOut}}" placeholder="{{$records->breakOut}}"/>
    <label for="breakIn">{{'Break In'}}</label>
	<input class="form-control form-control-inline" name="breakIn" id="breakIn" type="text" value="{{$records->breakIn}}" placeholder="{{$records->breakIn}}"/>
@endforeach
{{-- This is ajax called inside the index page modal  --}}




