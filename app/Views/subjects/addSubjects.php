<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>

  <section class="container-fluid">
    <div>
      <div class="heading text-center">
        <h1 style= "padding:4.7rem;">Add Subject</h1>
      </div>

      <div id="AddSubject">
        <div class="card">
          <div class="card-body">
            <form method="post" action="">
              <div class="form-group">
                <label for="purpose" style="font-size:15px; margin-bottom: 7px;">Subject Professor:</label>
                <br>
                <select class="custom-select" name="professor">
                  <?php if(isset($profs) and count($profs) > 0):?>
                    <?php foreach($profs as $prof):?>
                      <option value="<?=$prof['id']?>"><?=ucwords($prof['first_name']) . ' ' . ucwords($prof['last_name'])?></option>
                    <?php endforeach;?>
                  <?php endif;?>
                </select>
                <span class="text-danger"><?=displaySingleError($validation, 'professor');?></span>
              </div>
              <div class="form-group">
                <label for="purpose" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Grade Level:</label>
                <br>
                <select class="custom-select" name="gLevel">
                  <option value="7">Grade 7</option>
                  <option value="8">Grade 8</option>
                  <option value="9">Grade 9</option>
                  <option value="10">Grade 10</option>
                  <option value="11">Grade 11</option>
                  <option value="12">Grade 12</option>
                </select>
                <span class="text-danger"><?=displaySingleError($validation, 'gLevel');?></span>
              </div>
              <br>
              <div class="form-group">
                <label for="subjectname" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Subject</label>
                <input type="text" class="form-control" name = 'subjectname' id="subject" value="<?=set_value('subject')?>" placeholder="Enter Subject here ...">
                <br>
                <span class="text-danger"><?=displaySingleError($validation, 'subjectname');?></span>
              </div>
              <br> 
              <input type="submit" style="border-bottom-style: hidden !important; border-radius: 2rem !important" value="Save">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection();?>