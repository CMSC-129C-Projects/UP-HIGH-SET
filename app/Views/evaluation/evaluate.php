<?= $this->extend('template/studentTemplate');?>

<?= $this->section('content');?>
  <div id="submitModal">
    <div class="modal fade" id="subModal"  role="dialog" position="default">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: transparent;">
          <div class="modal-header">
            <h2 style="color: #e9dbc1">Submit Your Evaluation Form</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </div>
          <form method="post">
              <div class="modal-body" style="padding: 25px;">
                <i style="font-size: 15px;"> Please double-check your answers before submitting this form. Your review will be unmodifiable after submission. </i>
                <br><br>
                <?php $index = 0;?>
                <?php foreach($questions as $key => $value):?>
                    <div class="row" style="background-color:#7b1113;">
                        <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;"><?=$key?></p>
                    </div>
                    <?php foreach($value as $q):?>
                      <input type="hidden" name="review_question_id_<?=$q->id?>" value="<?=$q->id?>">
                        <div class="row" style="margin-top: 3px;">
                          <div class="col-12" style="margin-top: 3px;">
                            <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> <?=$q->question_text;?> </p>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="text-align:center;">
                                <?php if ($key === 'Comments'):?>
                                    <div class="inputBox">
                                        <?php $name = 'review_answer_' . $q->id;?>
                                        <div class="row">
                                            <div class="col-12" style="margin-top: 3px;">
                                                <textarea class="form-control" style="font-size: 13px;" name="<?=$name?>" rows="3" readonly><?=set_value($name, $prevAnswers ? $prevAnswers[$index]['answer_text']: '')?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php else:?>
                                    <li>
                                        <i style="font-size: 13px;"> Excellent </i>
                                    </li>
                                    <?php $name = 'review_choices_' . $q->id;?>
                                    <?php foreach($choices[$key] as $choice):?>
                                        <li>
                                            <?php if (count($prevAnswers) != 0):?>
                                              <input type="hidden" name="review_final_choices_<?=$q->id?>" value="<?=$prevAnswers[$index]['qChoice_id'];?>">
                                            <?php endif;?>
                                            <?php if(count($prevAnswers) != 0 && $prevAnswers[$index]['qChoice_id'] === $choice['id']):?>
                                                <input type="radio" name="<?=$name;?>" value="<?=$choice['id'];?>" <?=set_radio($name, $choice['id'], TRUE)?> disabled>
                                            <?php else:?>
                                                <input type="radio" name="<?=$name;?>" value="<?=$choice['id'];?>" <?=set_radio($name, $choice['id'])?> disabled>
                                            <?php endif;?>
                                        </li>
                                    <?php endforeach;?>
                                    <li>
                                        <i style="font-size: 13px;"> Poor </i>
                                    </li>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php $index++;?>
                    <?php endforeach;?>
                    <br>
                <?php endforeach;?>
                <br>
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div style="text-align: center;">
                      <input type="submit" class="button" formaction="<?=base_url()?>/evaluation/submit/<?=$eval_sheet_id?>" style="border-radius: 2rem !important; margin-top: 20px; width: 100%" value="Submit">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div style="text-align: center;">
                      <input type="button" class="button"  style="border-radius: 2rem !important; margin-top: 20px; width: 100%" data-dismiss="modal" value="Close">
                    </div>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
                                                  <input type="radio" value="<?=$choice['id'];?>" <?=set_radio($name, $choice['id'], TRUE)?> name="<?=$name;?>">
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
              <div class="arrowup">
                  <a href="#"><i class="bi bi-arrow-up-square"></i></a>
              </div>
              <div class="row">
                  <div class="buttons tab-content">
                      <button type="submit" formaction="<?=base_url()?>/evaluation/evaluate/<?=$eval_sheet_id?>" class="btn btn-lg btn-success" type="save"><i class="bi bi-check-circle"></i> Save</button>  
                      <button type="button" class="btn btn-lg cancel"><i class="bi bi-x-circle"></i> Cancel</button>
                      <button data-toggle="modal" data-target="#subModal" class="btn btn-lg btn-review" type="button"> Review</button>  
                  </div>
              </div>
          </form>
      </div> <!--Para sa tabs -->
  </section>
<?= $this->endSection();?>
