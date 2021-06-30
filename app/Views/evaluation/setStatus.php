<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>
  <span style="display: none;" id="db_content" data-dbcontent="<?=$db_content?>"></span>
  
  <section id="setStatus" class="conatiner-fluid">
    <div class="heading text-center">
      <h1 style="padding: 8rem 0 6rem;">SET EVALUATION STATUS </h1>
    </div>

  <form action="" method="post">
      <div class=" container box-container">

        <div class="box effect6">
          <h3>START DATE</h3>

          <div class="inputBox">
            <input type="text" name="dateStart" id="datepickerStart" autocomplete="off">
          </div>
          <span class="text-danger"><?=displaySingleError($validation, 'dateStart');?></span>

          <div class="calIcon">
            <i class="fa fa-calendar" id="startDate"></i>
          </div>
        </div>

        <div class="box effect6">
          <h3>END DATE</h3>
          <div class="inputBox">
            <input type="text" name="dateEnd" id="datepickerEnd" autocomplete="off">
            
          </div>
          <span class="text-danger"><?=displaySingleError($validation, 'dateEnd');?></span>
          
          <div class="calIcon">
            <i class="fa fa-calendar" id="endDate"></i>
          </div>
        
        </div>
      </div>

      <div class ="setEvalDropDown d-flex justify-content-center">
          <select name="type" id="drpdwn1" class="custom-select" style="width:10%">
              <option value="semester" selected="selected">Semester</option>
              <option value="grading">Grading</option>
          </select>
          <select name="nth-type" id="drpdwn2" class="custom-select" style="width:10%">
              <option value="1" selected>1</option>
              <option value="2">2</option>
          </select>
      </div>
      <span class="text-danger"><?=displaySingleError($validation, 'type');?></span>
    
    <div class="text-center">
      <button type="submit" ><i class="bi bi-check-circle"></i> Confirm</button>
      <button type="button" ><i class="bi bi-x-circle"></i> Cancel</button>
    </div>
  </form>

  </section>
<?= $this->endSection();?>
