@extends('admin.adminlayouts.adminlayout')
@section('head')
    {{HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}
    {{HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}
@stop
@section('mainarea')
    <div class="content-section">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-8">
                <div class="col-md-12">
                <strong> Employee ID: </strong>  {{$employee->employeeID}}
                
                </div>
                
                <div class="col-md-12">
                <strong> Name: </strong>  {{ $employee->firstName }}
                        {{ $employee->lastName }}
                        {{ $employee->middleName }}
                        {{ $employee->suffix }}
                
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                {{HTML::image("/profileImages/{$employee->profileImage}",'ProfileImage',['height'=>'80px'])}}
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover" id="sample_employees">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{'Company Name'}}</th>
                                        <th class="text-center">{{'Role'}}</th>
                                        <th style="text-align: center">{{'Start Date'}}</th>
                                        <th class="text-center">{{'End Date'}}</th>
                                        <th class="text-center">{{'Reason for Laving'}}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($employee->getWorkingHistory) > 0)
                                    @foreach($employee->getWorkingHistory as $history)  
                                    <tr>
                                        <td>{{$history['companyName']}}</td>
                                        <td>{{$history['role']}}</td>
                                        <td>{{$history['startDate']}}</td>   
                                        <td>{{$history['endDate']}}</td>
                                        <td>{{$history['reasonToLeave']}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                 <tr><strong class="text-danger">* No record found!</strong> </tr>
                                @endif
                                
                                </tbody>
                            </table>
                
            </div>
        </div> {{-- end of .container-fluid --}}
    </div> {{-- end of .content-section --}}

                         {{-- DELETE MODAL CALLING --}}
                            @include('admin.common.delete')
                        {{-- DELETE MODAL CALLING END --}}

                        {{-- NEW SALARY ADD MODALS --}}



 {{------------------------------------END NEW SALARY ADD MODALS--------------------------------------}}

@stop



@section('footerjs')


<!-- BEGIN PAGE LEVEL PLUGINS -->
    {{ HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
    {{ HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{ HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    {{ HTML::script('assets/admin/pages/scripts/components-pickers.js')}}



@stop
