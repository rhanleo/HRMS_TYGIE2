<style>
  fieldset.rating{
    text-align: center;
  }
  fieldset.rating label {
    position: relative;
    padding: 0;
    margin: 0;
    display: inline-block;
    cursor: pointer;
  }

  fieldset.rating label input[type=radio] {
    position: absolute;
    opacity: 0;
  }

  fieldset.rating label span {
    display: block;
    padding: 5px;
    height: 25px;
    width: 25px;
    border: 1px solid #ccc;
    color: #231f20;
    line-height: 11px;
    border-radius: 100px !important;
    text-align: center;
  }

  fieldset.rating label span:hover {
    border-color: #00aeef;
  }

  fieldset.rating label input[type=radio]:checked + span {
    background: #00aeef;
    border: 1px solid #00aeef;
    color: #fff;
  }

  .pad {
    padding: 0;
  }

</style>
<div class="panel-body">
  <div class="row">
    <div class="col-md-6 pad">
      <div class="col-md-4"><label>Name: </label></div>
      <div class="col-md-8"><p><strong>{{ $data->fullName }}</strong></p></div>
    </div>
    <div class="col-md-6 pad">
      <div class="col-md-4"><label>Department:</label></div>
      <div class="col-md-8"><p><strong>{{ $data->deptName }}</strong></p></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 pad">
      <div class="col-md-4"><label>Level Position:</label></div>
      <div class="col-md-8"><p><strong>{{ $data->designation }}</strong></p></div>
    </div>
    <div class="col-md-6 pad">
      <div class="col-md-4"><label>Hire Date:</label></div>
      <div class="col-md-8"><p><strong>{{ $data->joiningDate }}</strong></p></div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <?php
        $quarter_text = array(
            1 => '1st',
            2 => '2nd',
            3 => '3rd',
            4 => '4th',
          );
      ?>
      <h3>{{ $quarter_text[$quarter] }} Quarter</h3>
      <table class="table table-striped table-bordered table-hover" id="appraisal-modal">
        <thead>
          <tr>
            <th class="col-sm-6">Business Goal/Objective</th>
            <th class="col-sm-2">Rating</th>
            <th class="col-sm-4">Remarks</th>
            <th class="col-sm-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($appraisal_questions as $key => $val)
            @if(!in_array($val->id, $appraisal_done_ids))
              <tr>
                <td>{{ $val->question }}</td>
                <td>
                  <fieldset class="rating">
                    @for($i = 1; $i <= 6; $i++)
                      <label>
                        <input type="radio" name="appraisal_rating[{{ $val->id }}]" value="{{ $i }}">
                        <span>{{ $i }}</span>
                      </label>
                    @endfor
                  </fieldset>
                </td>
                <td>
                  <textarea class="form-control" name="remarks"></textarea>
                  <input class="appraisal_question_id" type="hidden" value="{{ $val->id }}">
                </td>
                <td><button onclick="submit_appraisal( this )" class="btn appraise-btn green">Submit</button></td>
              </tr>
            @endif
          @endforeach

          {{-- FINISHED APPRAISAL --}}
          @foreach ($appraisal_done as $key => $val)
            <tr>
              <?php $question = DB::table('appraisal_questions')->where('id', $val->question_id)->first(); ?>
              <td>{{ $question->question }}</td>
              <td>
                <fieldset class="rating">
                  @for($i = 1; $i <= 6; $i++)
                    <label>
                      <input type="radio" name="appraisal_rating[{{ $val->id }}]" value="{{ $i }}" {{ $i == $val->rating ? 'checked' : ''}} disabled>
                      <span>{{ $i }}</span>
                    </label>
                  @endfor
                </fieldset>
              </td>
              <td>
                <textarea class="form-control" name="remarks" readonly="">{{ $val->remarks }}</textarea>
              </td>
              <td><button class="btn appraise-btn green" disabled=""><i class="fa fa-check"></i> Done</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <button onclick="save_all()" class="btn green" style="display: inline-block; width: auto; padding: 10px 20px;">Save All</button>
    </div>
  </div>
</div>

<script>

  function save_all(){
    $('#appraisal-modal').find('.appraise-btn').each(function(e){
      submit_appraisal($(this), true);
    })
  }

  function submit_appraisal(btn, save_all = false){
    var tbody = $(btn).closest('tbody'),
        row = $(btn).closest('tr'),
        row_html = $(row).html(),
        rating = $(row).find('input[type=radio]:checked'),
        remarks = $(row).find('textarea'),
        question_id = $(row).find('input.appraisal_question_id'),
        appraise_btn_span = '';

    if (rating.length > 0 && !$(btn).is(":disabled")) {

      $(btn).html('<i class="fa fa-circle-o-notch fa-spin"></i> Saving');

      $.ajax({
        url: '{{ url('api/submit_appraisal/' . $data->employeeID . '/' . $quarter) }}',
        type: 'POST',
        dataType: 'json',
        data: {
          _token: '{{ csrf_token() }}',
          question_id: $(question_id).val(),
          rating: $(rating).val(),
          remarks: $(remarks).val(),
        },
      })
      .done(function(res) {
        if (res.status == 'success') {
          $(row).find('input').attr('disabled', true);
          $(row).find('textarea').attr('disabled', true).attr('readonly', true);
          $(row).find('button').attr('onclick', '').attr('disabled', true).html('<i class="fa fa-check"></i> Done');
          $(row).fadeOut().appendTo(tbody).fadeIn();

          // total_questions
          if(res.args.total_done >= res.args.total_questions){
            $('.modal-appraise-active').removeClass('active');
            appraise_btn_span = '<i class="fa fa-check"></i> Done';
          }
          else{
            $('.modal-appraise-active').find('.appraise-btn-span').html(res.args.btn_counter)
            appraise_btn_span = '('+ res.args.total_done + '/' + res.args.total_questions +')';
          }

          $('.modal-appraise-active').find('.appraise-btn-span').html(appraise_btn_span);


          showToastrMessage(res.msg, '', 'success');
        }
        else{
          $(btn).html('Submit');
          showToastrMessage(res.msg, '', 'error');
        }

      })
      .fail(function(res) {
        showToastrMessage('Appraisal saving error, please try again.', '', 'error');
      })
      .always(function() {
        console.log("complete");
      });

    }
    else{
      if (save_all == false) {
        showToastrMessage('Rating', '', 'error');
      }
    }
    return false;

  }
</script>