<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>

  <div class="container-fluid">
    <div class="heading text-center">
      <h1 style= "padding:4.7rem;">Update Email Content</h1>
    </div>

    <div id="EmailContent">
    <div class="card">
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="email-subject" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px"> Email Subject</label>
            <input type="text" class="form-control" name = 'email_subject' id="email-subject" value="<?=set_value('email_subject')?>">
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_subject');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="email-content" style="font-size:1.5em; margin-bottom:7px">Email Content</label>
            <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="7" placeholder="Email notification content ..."></textarea>
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_content');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="purpose" style="font-size:1.5em;">Email Purpose :</label>
            <select class="custom-select">
              <option selected>Select...</option>
              <option value="announcement">Announcement</option>
              <option value="registration">Registration</option>
              <option value="evaluation">Evaluation</option>
              <option value="change_pass">Change Password</option>
              <option value="forgot_pass">Forgot Password</option>
              <option value="verification">Verification</option>
            </select>
            </div>
            <br><br><br>
            <button class="button" type="submit" style="width: 10em; height: 3em; border-bottom-style: hidden !important; border-radius: 2rem !important; margin-right: 10px;"><i class="bi bi-check-circle"></i> Update</button>
            <button class="button" href="#" style="width: 10em; height: 3em; border-bottom-style: hidden !important; border-radius: 2rem !important;"><i class="bi bi-x-circle"></i> Cancel</button>
          </form>
          </div>
        </div>
      </div>
  </div>
  </div>

<?= $this->endSection();?>