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
            <i class="fa fa-calendar" id="startDate"></i>
          </div>
        
        </div>

        <div class="box effect6">
          <h3>END DATE</h3>
          <div class="inputBox">
            <input type="text" name="dateEnd" id="datepickerEnd" autocomplete="off">
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
