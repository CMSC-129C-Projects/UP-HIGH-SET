<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>

  <div class="container-fluid">
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
            <select class="custom-select">
              <option selected>Select Professor...</option>
              <option value="7">Grade 7</option>
              <option value="8">Grade 8</option>
              <option value="9">Grade 9</option>
              <option value="10">Grade 10</option>
              <option value="11">Grade 11</option>
              <option value="12">Grade 12</option>
            </select>
            </div>
            <div class="form-group">
            <label for="purpose" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Grade Level:</label>
            <br>
            <select class="custom-select">
              <option selected>Select Grade Level...</option>
              <option value="7">Grade 7</option>
              <option value="8">Grade 8</option>
              <option value="9">Grade 9</option>
              <option value="10">Grade 10</option>
              <option value="11">Grade 11</option>
              <option value="12">Grade 12</option>
            </select>
            </div>
            <br>
            <div class="form-group">
              <label for="subject" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Subject</label>
              <input type="text" class="form-control" name = 'subject' id="subject" value="<?=set_value('subject')?>" placeholder="Enter Subject here ...">
              <br>
              <span class="text-danger"><?=displaySingleError($validation, 'subject');?></span>
            </div>
            <br> 
            <input type="submit" style="border-bottom-style: hidden !important; border-radius: 2rem !important" value="update">
          </form>
          </div>
        </div>
      </div>
  </div>
  </div>
</section>

<?= $this->endSection();?>