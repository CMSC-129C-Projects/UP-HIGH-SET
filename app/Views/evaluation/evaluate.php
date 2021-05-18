<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="evaluation" class="container-fluid">
    <div class="heading text-center" style="margin:2.5rem  auto !important;">
      <h1 style="padding: 4.7rem; text-align: center; margin: auto !important;">Evaluation</h1>
    </div>
    <form method="post">
      <div class="row" style="width: 100%;">
        <div class="col-md-12">
          <!-- Tab links -->
          <div class="tab">
            <?php foreach($questions as $key => $value):?>
              <?php if($key === 'Instructional Skills'):?>
                <button type="button" class="tablinks active" onclick="openQuestionnaire(event, '<?=strtolower(str_replace(' ', '_', $key));?>')"><?=$key;?></button>
              <?php else:?>
                <button type="button" class="tablinks" onclick="openQuestionnaire(event, '<?=strtolower(str_replace(' ', '_', $key));?>')"><?=$key;?></button>
              <?php endif;?>
            <?php endforeach;?>
          </div>
          <?php $index = 0;
            foreach($questions as $key => $value):?>
            <?php if($key === 'Instructional Skills'):?>
              <div id="<?=strtolower(str_replace(' ', '_', $key));?>" class="tabcontent text-center" style="display: block;">
            <?php else:?>
              <div id="<?=strtolower(str_replace(' ', '_', $key));?>" class="tabcontent text-center">
            <?php endif;?>
            <?php foreach($value as $q):?>
              <input type="hidden" name="question_id_<?=$q->id?>" value="<?=$q->id?>">
              <h4><?=$q->question_text;?></h4>
              <div class="form-group form-inline" style="display: flex; justify-content: center;">
                <?php foreach($choices[$key] as $choice):?>
                  <?php $name = 'choices_' . $q->id;?>
                  <div style="padding: 0 2%;">
                    <label for="<?=$name;?>"><?=$choice['choice'];?></label>
                    <?php if(count($prevAnswers) != 0 && $prevAnswers[$index]['qChoice_id'] === $choice['id']):?>
                      <input type="radio" class="form-control" value="<?=$choice['id'];?>" <?=set_radio($name, $choice['id'], TRUE)?> name="<?=$name;?>">
                    <?php else:?>
                      <input type="radio" class="form-control" value="<?=$choice['id'];?>" <?=set_radio($name, $choice['id'])?> name="<?=$name;?>">
                    <?php endif;?>
                  </div>
                <?php endforeach;
                $index++;?>

                <div class="clear" data-id="<?=$q->id;?>"><i class="fa fa-times-circle"></i><span> Clear</span></div>
              </div>
            <?php endforeach;?>
            </div>
          <?php endforeach;?>

          <input type="submit" value="Submit">
        </div>
      </div>
    </form>

  </section>
<?= $this->endSection();?>
