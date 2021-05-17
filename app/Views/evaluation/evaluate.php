<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="evaluation" class="container-fluid">
    <div class="heading text-center" style="margin:2.5rem  auto !important;">
      <h1 style="padding: 4.7rem; text-align: center; margin: auto !important;">Evaluation</h1>
    <div>
    <form method="post">
      <div class="row" style="width: 100%;">
        <div class="col-md-12">
          <!-- Tab links -->
          <div class="tab">
            <?php foreach($questions as $key => $value):?>
              <button type="button" class="tablinks" onclick="openQuestionnaire(event, '<?=strtolower(str_replace(' ', '_', $key));?>')"><?=$key;?></button>
            <?php endforeach;?>
          </div>
          <?php foreach($questions as $key => $value):?>
            <div id="<?=strtolower(str_replace(' ', '_', $key));?>" class="tabcontent">
              <?php foreach($value as $q):?>
                <h4><?=$q->question_text;?></h4>
                <div class="form-group form-inline" style="display: flex; justify-content: center;">
                  <?php foreach($choices[$key] as $choice):?>
                    <div style="padding: 0 2%;">
                      <label for="<?='choices_' . $q->id;?>"><?=$choice['choice'];?></label>
                      <input type="radio" class="form-control" value="<?=$choice['id'];?>" name="<?='choices_' . $q->id;?>">
                    </div>
                  <?php endforeach;?>
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
