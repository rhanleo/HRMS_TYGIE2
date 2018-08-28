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

</style>
<div style="margin-top: 5px;">
  <div class="row">
    <div class="col-md-6">
      <div class="col-md-4"><label>Name: </label></div>
      <div class="col-md-8"><p><strong>{{ $data->fullName }}</strong></p></div>
    </div>
    <div class="col-md-6">
      <div class="col-md-4"><label>Department:</label></div>
      <div class="col-md-8"><p><strong>{{ $data->deptName }}</strong></p></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="col-md-4"><label>Level Position:</label></div>
      <div class="col-md-8"><p><strong>{{ $data->designation }}</strong></p></div>
    </div>
    <div class="col-md-6">
      <div class="col-md-4"><label>Hire Date:</label></div>
      <div class="col-md-8"><p><strong>{{ $data->joiningDate }}</strong></p></div>
    </div>
  </div>

  <div class="row">
    <div class="panel-body">

    </div>
  </div>
</div>

<script>

</script>