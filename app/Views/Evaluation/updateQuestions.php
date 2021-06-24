<?= $this->extend('template/studentTemplate');?>

<?= $this->section('content');?>

  <section id="evaluation" class="container-fluid">
      <div class="heading text-center">
          <h1 style="padding-bottom: 4.7rem;">UPDATE QUESTIONS</h1>
      </div>
      <div class="tabs" id="questionnaire">
          
          <div class="categories" id="evalCategories">
            <?php foreach($questions as $key => $value):?>
              <?php if($key === 'Instructional Skills'):?>
                <a class="category display-none action-display"><?=$key?></a>
                <a data-target="<?=strtolower(str_replace(' ', '_', $key));?>" class="category activeCategory"><?=$key?></a>
              <?php else:?>
                <a data-target="<?=strtolower(str_replace(' ', '_', $key));?>" class="category"><?=$key?></a>
              <?php endif;?>
            <?php endforeach;?>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
              <i class="fa fa-bars"></i>
            </a>
          </div>
    <script>
      function myFunction() {
        var x = document.getElementById("evalCategories");
        if (x.className === "categories") {
          x.className += " responsive";
        } else {
          x.className = "categories";
        }
      }
    </script>
          <!-- </div> -->
          <form method="post">
              <div class="row" style="margin-top:-2%;">
                  <div class="tab-content col-md-offset-2" style="padding:2rem;">
                      <h1 style="font-size:4vmin; margin-top:3rem; margin-bottom:2rem;">Please click the Save button to ensure your changes will be recorded.</h1>
                      <label style="padding-top:3rem; font-size:3.5vmin; margin-bottom:7px;"> Question 1: </label>
                      <input type="text" class="form-control" name = 'question1' id="question1">
                      <label style="padding-top:3rem; font-size:3.5vmin; margin-bottom:7px;"> Question 2: </label>
                      <input type="text" class="form-control" name = 'question2' id="question2">
                      <br>
                  </div> <!-- tab content-->
              </div>
              <div class="row">
                  <div class="buttons tab-content">
                      <button type="submit" formaction="<?=base_url()?>/evaluation/evaluate/<?=$eval_sheet_id?>" class="btn btn-lg btn-success" type="save"><i class="bi bi-check-circle"></i> Save</button>  
                      <button type="button" class="btn btn-lg cancel" onclick="window.location.href = BASE_URI + '/dashboard'"><i class="bi bi-x-circle"></i> Cancel</button>
                  </div>
              </div>
          </form>
      </div> <!--Para sa tabs -->
  </section>
<?= $this->endSection();?>
