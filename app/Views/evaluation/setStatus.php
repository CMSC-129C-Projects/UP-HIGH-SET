<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<link href="<?=base_url()?>/public/css/custom/evaluation/setstatus.css" rel="stylesheet">
  <section id="setStatus" class="conatiner-fluid">
    <div class="heading text-center">
      <h1 style="padding: 8rem 0 6rem;">SET EVALUATION STATUS </h1>
    </div>


    <div class=" container box-container">

      <div class="box effect6">
        <h3>START DATE</h3>

        <div class="inputBox">
          <input type="text">
        </div>
      
      </div>

      <div class="box effect6">
        <h3>END DATE</h3>
        <div class="inputBox">
          <input type="text">
        </div>
       
      </div>
    </div>

    
    
    <div class="text-center">
      <button type="button" ><i class="bi bi-check-circle"></i> Confirm</button>
      <button type="button" ><i class="bi bi-x-circle"></i> Cancel</button>
    </div>

  </section>
<?= $this->endSection();?>
