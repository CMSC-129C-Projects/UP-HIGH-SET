<?= $this->extend('template/studentTemplate');?>

<?= $this->section('content');?>
  

<section id="evaluation" class="container-fluid">
  
  <!-- style="margin-bottom: 2.5rem !important; border: solid;" -->
    <div class="heading text-center">
      <h1>EVALUATION</h1>
    </div>
    
    <div class="tabs" id="questionnaire">


    



      <!-- <div class="row"> -->
      <!-- <ul class="row nav nav-tabs tab-content topnav" id="myTopnav">
      
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
      </ul> -->


      <div class="categories" id="evalCategories">
        <a href="#"class="" >Instructional Skills</a>
        <a href="#"class="" >Class Manangement</a>
        <a href="#" class="" >Personal Qualities</a>
        <a href="#" class="" >Student Faculty Relation</a>
        <a href="#" class="" >General Evaluation</a>
        <a href="#" class="" >Comments</a>
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
                        <textarea name="<?=$name?>" id="" cols="100" rows="5"><?=set_value($name, $prevAnswers ? $prevAnswers[$index]['answer_text']: '')?></textarea>
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
        
        <div class="row">
          <div class="buttons tab-content">
            <button type="submit" formaction="<?=base_url()?>/evaluation/evaluate/<?=$eval_sheet_id?>" class="btn btn-lg btn-success" type="save"><i class="bi bi-check-circle"></i> Save</button>  
            <button class="btn btn-lg btn-review" type="Review"><i class="bi bi-pencil-square"></i> Review</button>
            <button type="button" class="btn btn-lg cancel"><i class="bi bi-x-circle"></i> Cancel</button>
              
          </div>
        </div>
        
      </form>
      <div class="arrowup">
          <a href="#"><i class="bi bi-arrow-up-square"></i></a>
        </div>
    </div> <!--Para sa tabs -->
  </section>

  
  
<?= $this->endSection();?>
