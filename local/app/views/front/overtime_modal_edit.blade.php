
<div class="portlet-body form ot-modal-update">
	<form action="{{ url('dashboard/update_overtime/' . $overtime_application->id) }}" method="POST" id="form-leave">
	    <div class="row">
	        <label class="control-label col-md-3"><strong>Time Start</strong></label>
	        <div class="col-md-9">
	        	<input type="text" class="form-control ot-time-in required" name="start_date" value="{{ date('Y/m/d g:i A', strtotime($overtime_application->start_date)) }}">
	        </div>
	    </div>
	    <br>

	    <div class="row">
	        <label class="control-label col-md-3"><strong>Time End</strong></label>
	        <div class="col-md-9">
	            <input type="text" class="form-control ot-time-out required" name="end_date" value="{{ date('Y/m/d g:i A', strtotime($overtime_application->end_date)) }}">
	        </div>
	    </div>
	    <br>
	    <div class="row">
	        <label class="control-label col-md-3"><strong>Reason</strong></label>
	        <div class="col-md-9">
	        	<textarea name="reason" class="form-control">{{$overtime_application->reason}}</textarea>
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
	            <p class="computed-time"> {{ $hours .'h '. $minutes.'m'}} </p> 
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
	    <div class="modal-footer">
	        <input type="submit" data-loading-text="Updating..." class="demo-loading-btn btn-primary update-ot" value="Update" id="update-overtime"/>
	    </div>
	</form>

</div>

<style>
    .update-ot{
        width: 110px;
        margin: 0 5px;
        font: 1em/1.45 Lato-Regular;
        padding: 10px 0;
        display: block;
        color: #fff;
        -webkit-appearance: none;
        border: 0;
        text-align: center;
        border-radius: 0 !important;
    }

</style>

<script type="text/javascript">
	$(function() {
		init_datetimepicker();
	    function init_datetimepicker(){
            var allow_time = [];
            for (var i = 0; i <= 23; i++) {
                allow_time.push( i + ':00');
                allow_time.push( i + ':30');
            }

            $('.ot-modal-update .ot-time-in').datetimepicker({
            	onShow: function(ct, input){
                    this.setOptions({
                        maxDate: $('.ot-time-out').val() ? $('.ot-time-out').val() : new Date(),
                    });
                },
                format: 'YYYY/MM/DD h:mm A',
                formatDate: 'YYYY/MM/DD h:mm A',
                formatTime: 'h:mm A', 
                datepicker: true,
                timepicker: true,
                allowTimes: allow_time,
            });

            $('.ot-modal-update .ot-time-out').datetimepicker({
                onShow: function(ct, input){
                    this.setOptions({
                        minDate: $('.ot-time-in').val() ? $('.ot-time-in').val() : new Date(),
                    });
                },
                format: 'YYYY/MM/DD h:mm A',
                formatDate: 'YYYY/MM/DD h:mm A',
                formatTime: 'h:mm A', 
                datepicker: true,
                timepicker: true,
                allowTimes: allow_time,
            });
        }

        $('.ot-modal-update .ot-time-in, .ot-time-out').change(function(e) {
        	e.preventDefault();

        	var start = $('.ot-time-in').val();
        	// var arr = start.split('-');
        	// var start = arr[1] + '-' + arr[0] + '-' + arr[2];
        	// console.log(start);

        	var end = $('.ot-time-out').val();
        	// var arr_end = end.split('-');
        	// var end = arr_end[1] + '-' + arr_end[0] + '-' + arr_end[2];
        	// console.log(end);

        	// return;
			start_actual_time = new Date(start);
			end_actual_time = new Date($('.ot-time-out').val());

			var diff = end_actual_time - start_actual_time;

			var diffSeconds = diff/1000;
			var HH = Math.floor(diffSeconds/3600);
			var MM = Math.floor(diffSeconds%3600)/60;

			var formatted = ((HH < 1)?("0" + HH):HH)  + "h " + ((MM < 10)?("0" + MM):MM) + "m"

        	$('.computed-time').html(formatted);
        })

    });
</script>