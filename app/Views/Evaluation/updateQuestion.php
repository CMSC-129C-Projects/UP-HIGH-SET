<?= $this->extend('template/studentTemplate');?>

<section id="evaluation" class="container-fluid">
  <!-- style="margin-bottom: 2.5rem !important; border: solid;" -->
      <div class="heading text-center">
          <h1>EVALUATION</h1>
      </div>
      <div class="tabs" id="questionnaire">
          <!-- <div class="row"> -->
          
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
          <div class="savestatus tab-content d-none">
            <p  class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Unsaved Changes</p>
          </div>
          
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$progress?>%;"><?=$progress?>%</div>
          </div>
          <!-- </div> -->
          <form method="post">
              <div class="row">
                  <div class="tab-content col-md-offset-2">  
                      <h1 class="likert-header">Please evaluate honestly</h1>
                      <?php $index = 0;
                        foreach($questions as $key => $value):?>
                          <?php if($key === 'Instructional Skills'):?>
                            <div class="tab-pane fade show active" id="<?=strtolower(str_replace(' ', '_', $key));?>">
                          <?php elseif($key === 'Comments'):?>
                            <div class="tab-pane fade" id="<?=strtolower(str_replace(' ', '_', $key));?>" style="padding-bottom: 5%;">
                          <?php else:?>
                            <div class="tab-pane fade" id="<?=strtolower(str_replace(' ', '_', $key));?>">
                          <?php endif;?>
                            <div class="wrap">
                              <?php foreach($value as $q):?>
                                  <input type="hidden" name="question_id_<?=$q->id?>" value="<?=$q->id?>">
                                  <label class="statement"><?=$q->question_text;?></label>
                                  <?php if ($key === 'Comments'):?>
                                      <div class="inputBox">
                                          <?php $name = 'answer_' . $q->id;?>
                                          <textarea name="<?=$name?>" cols="100" rows="5"><?=set_value($name, $prevAnswers ? $prevAnswers[$index]['answer_text']: '')?></textarea>
                                      </div>
                                  <?php else:?>
                                    <?php $name = 'choices_' . $q->id;?>
                                    <ul class='likert'>
                                        <?php foreach($choices[$key] as $choice):?>
                                            <li>
                                              <?php if(count($prevAnswers) != 0 && $prevAnswers[$index]['qChoice_id'] === $choice['id']):?>
                                                  <input type="radio" value="<?=$choice['id'];?>, css" checked <?=set_radio($name, $choice['id'], TRUE)?> name="<?=$name;?>">
                                              <?php else:?>
                                                  <input type="radio" value="<?=$choice['id'];?>" <?=set_radio($name, $choice['id'])?> name="<?=$name;?>">
                                              <?php endif;?>
                                              <label><?=$choice['choice'];?></label>
                                            </li>
                                            
                                        <?php endforeach;?>
                                    </ul>
                                  <?php endif;?>
                                  <?php $index++;?>
                              <?php endforeach;?>
                            </div> <!-- sa wrap -->
                        </div>
                      <?php endforeach;?>
                  </div> <!-- tab content-->
              </div>

<?= $this->endSection();?>