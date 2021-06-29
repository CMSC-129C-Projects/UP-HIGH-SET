<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>
  
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
          <div class ="setEvalDropDown">
          <select name="dropdown1" id="drpdwn1" class="custom-select" style="width:100px">
            <option value="7" selected="selected">Chuchu</option>
            <option value="8">Chacha</option>
            <option value="9">Cheche</option>
            <option value="10">Chichi</option>
            <option value="11">chocho</option>
            <option value="12">chuchu</option>    
        </select>
        <select name="dropdown2" id="drpdwn2" class="custom-select" style="width:100px">
        <option value="7" selected="selected">Chuchu</option>
            <option value="8">Chacha</option>
            <option value="9">Cheche</option>
            <option value="10">Chichi</option>
            <option value="11">chocho</option>
            <option value="12">chuchu</option> 
        </select>
          </div>
          <div class="calIcon" style="margin-top:5rem;">
        <i class="fa fa-calendar" id="startDate"></i>
        </div>
        
        </div>

        <div class="box effect6">
          <h3>END DATE</h3>
          <div class="inputBox">
            <input type="text" name="dateEnd" id="datepickerEnd" autocomplete="off">
            
          </div>
          <div class ="setEvalDropDown">
          <select name="dropdown1" id="drpdwn1" class="custom-select" style="width:100px">
            <option value="7" selected="selected">Chuchu</option>
            <option value="8">Chacha</option>
            <option value="9">Cheche</option>
            <option value="10">Chichi</option>
            <option value="11">chocho</option>
            <option value="12">chuchu</option>    
        </select>
        <select name="dropdown2" id="drpdwn2" class="custom-select" style="width:100px">
        <option value="7" selected="selected">Chuchu</option>
            <option value="8">Chacha</option>
            <option value="9">Cheche</option>
            <option value="10">Chichi</option>
            <option value="11">chocho</option>
            <option value="12">chuchu</option> 
        </select>
          </div>
        <div class="calIcon" style="margin-top:5rem;">
        <i class="fa fa-calendar" id="endDate"></i>
        </div>
        
        </div>
      </div>
    
    <div class="text-center">
      <button type="submit" ><i class="bi bi-check-circle"></i> Confirm</button>
      <button type="button" ><i class="bi bi-x-circle"></i> Cancel</button>
    </div>
  </form>

  </section>
<?= $this->endSection();?>
