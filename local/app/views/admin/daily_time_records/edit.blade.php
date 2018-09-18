<label for="designation">{{ trans( 'core.designation' ) }} <span>{{'Daily Time Record' }}</span></label>


@foreach($dailytimerecords as $records)

	<input class="form-control form-control-inline" name="timeIn" id="timeIn" type="text" value="{{$records->timeIn}}" placeholder="{{$records->timeIn}}"/>
    <input class="form-control form-control-inline" name="timeOut" id="timeOut" type="text" value="{{$records->timeOut}}" placeholder="{{$records->timeOut}}"/>
    <input class="form-control form-control-inline" name="breakIn" id="breakIn" type="text" value="{{$records->breakIn}}" placeholder="{{$records->breakIn}}"/>
    <input class="form-control form-control-inline" name="breakOut" id="breakOut" type="text" value="{{$records->breakOut}}" placeholder="{{$records->breakOut}}"/>
    
@endforeach
{{-- This is ajax called inside the index page modal  --}}




