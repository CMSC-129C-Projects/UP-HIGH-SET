<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<link href="<?=base_url()?>/public/css/custom/evaluation/setstatus.css" rel="stylesheet">
  <section id="setStatus" class="conatiner-fluid">
    <div class="heading text-center">
      <h1 style="padding: 8rem 0 2rem;">Set Evaluation Status </h1>
    </div>


    <div class=" container box-container">

      <div class="box effect6">
        <h3>SET DATE START</h3>

        <div class="inputBox">
          <input type="text">
        </div>
       <i class="bi bi-calendar2-week-fill"></i>
      </div>

      <div class="box effect6">
        <h3>SET DATE END</h3>
        <div class="inputBox">
          <input type="text">
        </div>
        <i class="bi bi-calendar2-week-fill"></i>
      </div>
    </div>
    
    <div class="form-check text-center createEval" id="createEval">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
      <label class="form-check-label" for="flexCheckDefault">
        <h3>Create Evaluation Sheets</h3>
    </label>
    </div>
    <div class="text-center">
      <button type="button" ><i class="bi bi-check-circle"></i> Confirm</button>
    </div>

  </section>
<?= $this->endSection();?>
