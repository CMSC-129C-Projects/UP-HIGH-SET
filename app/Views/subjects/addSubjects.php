<?php
  if ($_SESSION['logged_user']['role'] === '1') {
    $this->extend('template/pageTemplate');
  } elseif ($_SESSION['logged_user']['role'] === '3') {
    $this->extend('template/clerkTemplate');
  }
?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>

  <section class="container-fluid" style="padding: 4rem 0 2rem;">
    <div>
      <div class="heading text-center">
        <h1 style= "font-size: 5.8vmin; padding-bottom:4vmin;">ADD SUBJECT</h1>
      </div>
      <div id="EmailContent">
      <div id="AddSubject">
        <div class="card">
          <div class="card-body">
            <form method="post" action="">
              <div class="form-group">
                <label for="purpose" style="font-size:2.7vmin; margin-bottom: 7px;">Subject Professor:</label>
                <br>
                <select class="custom-select" name="professor">
                  <?php if(isset($profs) and count($profs) > 0):?>
                    <?php foreach($profs as $prof):?>
                      <option value="<?=$prof['id']?>" <?=set_select('professor', $prof['id']);?>><?=ucwords($prof['first_name']) . ' ' . ucwords($prof['last_name'])?></option>
                    <?php endforeach;?>
                  <?php endif;?>
                </select>
                <span class="text-danger"><?=displaySingleError($validation, 'professor');?></span>
                <br><br><br>
              </div>
              <div class="form-group">
                <label for="purpose" style="margin-top: 1rem; font-size:2.7vmin; margin-bottom:7px">Grade Level:</label>
                <br>
                <select class="custom-select" name="gLevel">
                  <option value="7" <?=set_select('gLevel', 7);?>>Grade 7</option>
                  <option value="8" <?=set_select('gLevel', 8);?>>Grade 8</option>
                  <option value="9" <?=set_select('gLevel', 9);?>>Grade 9</option>
                  <option value="10" <?=set_select('gLevel', 10);?>>Grade 10</option>
                  <option value="11" <?=set_select('gLevel', 11);?>>Grade 11</option>
                  <option value="12" <?=set_select('gLevel', 12);?>>Grade 12</option>
                </select>
                <span class="text-danger"><?=displaySingleError($validation, 'gLevel');?></span>
              </div>
              <br><br>
              <div class="form-group">
                <label for="subjectname" style="margin-top: 1rem; font-size:2.7vmin; margin-bottom:7px">Subject</label>
                <input type="text" class="form-control" name = 'subjectname' id="subject" value="<?=set_value('subject')?>">
                <br>
                <span class="text-danger"><?=displaySingleError($validation, 'subjectname');?></span>
              </div>
              <br>
              <div style="text-align: center;"> 
                <button class="button2" type="submit" style=""><i class="bi bi-check-circle"></i> Save</button>
                <button class="button2" type="button" onclick="window.location='<?=base_url('professors')?>'" style=""><i class="bi bi-x-circle"></i> Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
<?= $this->endSection();?>