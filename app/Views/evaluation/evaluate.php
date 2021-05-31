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

          <div class="modal-body" style="padding: 25px;">
            <i style="font-size: 15px;"> Please double-check your answers before submitting this form. Your review will be unmodifiable after submission. </i>
            <br><br>
            <div class="row" style="background-color:#7b1113;">
              <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">Instructional Skills</p>
            </div>
            <div class="row" style="margin-top: 3px;">
              <div class="col-12" style="margin-top: 3px;">
                <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> Has mastery of the subject matter. </p>
              </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <li>
                      <i style="font-size: 13px;"> Excellent </i>
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Excellent">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Very Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Fair">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Poor">
                    </li>
                    <li>
                      <i style="font-size: 13px;"> Poor </i>
                    </li>
                </div>
            </div>
            <br>
            <div class="row" style="background-color:#7b1113;">
              <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;"> Class Management</p>
            </div>
            <div class="row">
              <div class="col-12" style="margin-top: 3px;">
                <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> Corrects and gives results and feedback of examinations and/or other work within reasonable time. </p>
              </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <li>
                      <i style="font-size: 13px;"> Excellent </i>
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Excellent">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Very Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Fair">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Poor">
                    </li>
                    <li>
                      <i style="font-size: 13px;"> Poor </i>
                    </li>
                </div>
            </div>
            <br>
            <div class="row" style="background-color:#7b1113;">
              <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">Personal Qualities</p>
            </div>
            <div class="row">
              <div class="col-12" style="margin-top: 3px;">
                <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> Has high intellectual standard. </p>
              </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <li>
                      <i style="font-size: 13px;"> Excellent </i>
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Excellent">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Very Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Fair">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Poor">
                    </li>
                    <li>
                      <i style="font-size: 13px;"> Poor </i>
                    </li>
                </div>
            </div>
            <br>
            <div class="row" style="background-color:#7b1113;">
              <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;"> Student-Faculty Relations </p>
            </div>
            <div class="row">
              <div class="col-12" style="margin-top: 3px;">
                <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> Maintains cordial but professional relations with students. </p>
              </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <li>
                      <i style="font-size: 13px;"> Excellent </i>
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Excellent">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Very Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Fair">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Poor">
                    </li>
                    <li>
                      <i style="font-size: 13px;"> Poor </i>
                    </li>
                </div>
            </div>
            <br>
            <div class="row" style="background-color:#7b1113;">
              <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">General Evaluation</p>
            </div>
            <div class="row">
              <div class="col-12" style="margin-top: 3px;">
                <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> Taking into account instructional skills, class management, personal qualities, and student-faculty relations. Please rate your teacher on a scale of 1 to 5 with 5 as excellent. </p>
              </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <li>
                      <i style="font-size: 13px;"> Excellent </i>
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Excellent">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Very Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Good">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Fair">
                    </li>
                    <li>
                      <input type="radio" name="instSkill1" value="Poor">
                    </li>
                    <li>
                      <i style="font-size: 13px;"> Poor </i>
                    </li>
                </div>
            </div>
            <br>
            <div class="row" style="background-color:#7b1113;">
              <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">Additional Comments</p>
            </div>
            <div class="row">
              <div class="col-12" style="margin-top: 3px;">
                <p style="font-size: 15px; color: #7b1113; padding-top: 3px;"> My teacher's strong points are: </p>
              </div>
            </div>
            <div class="row">
              <div class="col-12" style="margin-top: 3px;">
                  <textarea class="form-control" style="font-size: 13px;" rows="3" placeholder="Sample Text" readonly></textarea>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-4">
                <div style="text-align: center;">
                  <input type="button" class="button"  style="border-radius: 2rem !important; margin-top: 20px; width: 100%" data-dismiss="modal" value="Submit">
                </div>
              </div>
              <div class="col-4">
                <div style="text-align: center;">
                  <br>
                </div>
              </div>  
              <div class="col-4">
                <div style="text-align: center;">
                  <input type="button" class="button"  style="border-radius: 2rem !important; margin-top: 20px; width: 100%" data-dismiss="modal" value="Close">
                </div>
              </div>
            </div>
          </div>
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
          <ul class="row nav nav-tabs tab-content">
              <?php foreach($questions as $key => $value):?>
                  <?php if($key === 'Instructional Skills'):?>
                      <li class="nav-item col-md-2 btncat"style="width:100%;">
                          <a href="#<?=strtolower(str_replace(' ', '_', $key));?>" class="nav-link"  data-toggle="tab" id="btn-<?=strtolower(str_replace(' ', '_', $key));?>"><button type="button" class="evalbtn active"><?=$key?></button></a>
                      </li>
                  <?php else:?>
                      <li class="nav-item col-md-2 btncat"style="width:100%;">
                          <a href="#<?=strtolower(str_replace(' ', '_', $key));?>" class="nav-link"  data-toggle="tab" id="btn-<?=strtolower(str_replace(' ', '_', $key));?>"><button type="button" class="evalbtn"><?=$key?></button></a>
                      </li>
                  <?php endif;?>
              <?php endforeach;?>
          </ul>
          <div class="container">
              <div class="progress tab-content">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$progress?>%;"><?=$progress?>%</div>
              </div>
          </div>
          <div class="savestatus tab-content d-none">
              <p  class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Unsaved Changes</p>
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
                      <button type="submit" formaction="<?=base_url()?>/evaluation/evaluate" class="btn btn-lg btn-success" type="save"><i class="bi bi-check-circle"></i> Save</button>  
                      <button type="button" class="btn btn-lg cancel"><i class="bi bi-x-circle"></i> Cancel</button>
                      <button data-toggle="modal" data-target="#subModal" class="btn btn-lg btn-review" type="button"> Review</button>  
                  </div>
              </div>
          </form>
      </div> <!--Para sa tabs -->
  </section>
<?= $this->endSection();?>
