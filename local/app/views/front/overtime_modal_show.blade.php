
<div class="portlet-body form">

    <div class="row">
        <label class="control-label col-md-3"><strong>Time Start</strong></label>
        <div class="col-md-9">
            {{ date('M d,Y h:i a', strtotime($overtime_application->start_date)) }}
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Time End</strong></label>
        <div class="col-md-9">
            {{ date('M d,Y h:i a', strtotime($overtime_application->end_date)) }}
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Reason</strong></label>
        <div class="col-md-9">
            {{$overtime_application->reason}}
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Total Hours</strong></label>
        <div class="col-md-9">
            <?php
                $total = strtotime($overtime_application->end_date) - strtotime($overtime_application->start_date);
                $total = $total > 0 ? $total : 0;
                $hours = floor($total / 60 / 60);
                $minutes = round(($total - ($hours * 60 * 60)) / 60);
            ?>
            {{ $hours .'h '. $minutes.'m'}}
        </div>
    </div>
    <br>
    <div class="row">
        <label class="control-label col-md-3"><strong>Applied on</strong></label>
        <div class="col-md-9">
            {{ date('M d,Y h:i a', strtotime($overtime_application->created_at)) }}
        </div>
    </div>
    <br>
    
    @if( $overtime_application->application_status == 'pending')
        <div class="row">
            <div class="col-md-6">
                <a href="#!" onclick="ot_edit_application('{{ $overtime_application->id }}')" class="btn btn-primary">Edit</a>
            </div>
        </div>
    @endif



</div>