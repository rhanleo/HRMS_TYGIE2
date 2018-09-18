<label for="designation">{{ trans( 'core.designation' ) }} <span>{{ trans( 'messages.designationEmptyNote' ) }}</span></label>
{{ ''; $i=0 }}

@foreach($branches as $branch)

	<input class="form-control form-control-inline" name="branch[{{$i}}]" id="designation" type="text" value="{{$branch['branch']}}" placeholder="Designation #1"/>
    <input type="hidden" name="branchID[{{$i}}]" id="designation" type="text" value="{{$branch['id']}}" placeholder="Designation #1"/>
{{'';$i++;}}
@endforeach
{{-- This is ajax called inside the index page modal  --}}




