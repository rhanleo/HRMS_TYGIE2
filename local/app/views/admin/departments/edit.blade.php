<label for="designation">{{ trans( 'core.designation' ) }} <span>{{ trans( 'messages.designationEmptyNote' ) }}</span></label>
{{ ''; $i=0 }}
@foreach($department->Designations as $designations)
	<input class="form-control form-control-inline" name="designation[{{$i}}]" id="designation" type="text" value="{{$designations['designation']}}" placeholder="Designation #1"/>
    <input type="hidden" name="designationID[{{$i}}]" id="designation" type="text" value="{{$designations['id']}}" placeholder="Designation #1"/>
{{'';$i++;}}
@endforeach
{{-- This is ajax called inside the index page modal  --}}




