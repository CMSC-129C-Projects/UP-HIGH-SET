<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>

  <section id="evaluation" class="container-fluid">
      <span style="display: none;" id="status" data-status="<?=$status?>"></span>

      <div class="heading text-center">
          <h1 style="padding-bottom: 4.7rem;">UPDATE QUESTIONS</h1>
      </div>
      <div class="tabs" id="questionnaire">
          
          <div class="categories" id="evalCategories">
            <?php foreach($sections as $category):?>
              <?php if($category['name'] === 'Instructional Skills'):?>
                <a class="category display-none action-display"><?=$category['name']?></a>
                <a data-target="<?=strtolower(str_replace(' ', '_', $category['id']));?>" class="category activeCategory"><?=$category['name']?></a>
              <?php else:?>
                <a data-target="<?=strtolower(str_replace(' ', '_', $category['id']));?>" class="category"><?=$category['name']?></a>
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
          <form method="post">
                <div class="row">
                  <div class="tab-content col-md-offset-2" style="padding-bottom: 10vh;">
                      <h1 class="likert-header">Please evaluate honestly</h1>                      
                      <?php foreach($questions as $key => $value):?>
                          <?php if($key === 1):?>
                            <div class="tab-pane fade show active" id="<?=strtolower(str_replace(' ', '_', $key));?>">
                          <?php else:?>
                            <div class="tab-pane fade" id="<?=strtolower(str_replace(' ', '_', $key));?>">
                          <?php endif;?>

                            <button data-section="<?=$key?>" class="btn btn-secondary action-add-question" type="button">Add Question</button>

                            <div class="wrap question_grp" style="text-align: left;" id="question_grp_<?=$key?>">
                              <?php $index = 1;?>
                              <?php foreach($value as $q):?>
                                  <div class="form-group"">
                                      <input type="hidden" name="question_id_<?=$q['id']?>" value="<?=$q['id']?>">

                                      <input type="hidden" name="section_<?=$q['id']?>" value="<?=$key?>">

                                      <label for="q<?=$q['id']?>" style="margin-left: 10%; padding-top:3rem; font-size:3.5vmin; margin-bottom:5vh;"> Question <?=$index?>: </label>
                                      <div class="row">
                                        <div class="col-md-11">
                                          <input type="text" class="form-control" name="question<?=$q['id']?>" id="q<?=$q['id']?>" value="<?=set_value('question1', $q['content']);?>">
                                        </div>
                                        <div class="col-md-1 text-left">
                                          <i class="bi bi-trash text-danger action_delete" id="delete_<?=$q['id']?>" style="cursor: pointer; font-size: 4vmin"></i>
                                        </div>
                                      </div>
                                  </div>
                                  <?php $index++;?>
                              <?php endforeach;?>
                              <span data-count=<?=$index-1;?> style="display: none;" id="counter_<?=$key?>"></span>
                            </div>
                        </div>
                      <?php endforeach;?>
                  </div>
              </div>
              <div class="arrowup">
                  <a href="#"><i class="bi bi-arrow-up-square"></i></a>
              </div>
              <div class="row">
                  <div class="buttons tab-content">
                      <button type="submit" formaction="<?=base_url()?>/questions" class="btn btn-lg btn-success" type="save"><i class="bi bi-check-circle"></i> Save</button>  
                      <button type="button" class="btn btn-lg cancel" onclick="window.location.href = BASE_URI + '/dashboard'"><i class="bi bi-x-circle"></i> Cancel</button>
                  </div>
              </div>
          </form>
      </div>
  </section>
<?= $this->endSection();?>
