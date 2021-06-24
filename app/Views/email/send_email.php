<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>

  <div class="container-fluid" style="padding: 4rem 0 2rem;">
    <div class="heading text-center">
      <h1 style="font-size:5.8vmin; padding-bottom:4vmin;">SEND EMAIL</h1>
    </div>

    <div id="EmailContent">
    <div class="card">
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="email-subject" style="margin-top: 1rem; font-size:3.2vmin; margin-bottom:7px"> Email Subject</label>
            <input type="text" class="form-control" name = 'email_subject' id="email-subject" value="<?=set_value('email_subject')?>">
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_subject');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="email-content" style="font-size:3.2vmin; margin-bottom:7px">Email Content</label>
            <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="7" placeholder="Email notification content ..."></textarea>
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_content');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="purpose" style="font-size:3.2vmin;">Email Purpose :</label>
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
            <div style="text-align:center">
              <button class="button2" type="submit" style=""><i class="bi bi-check-circle"></i> Update</button>
              <button class="button2" onclick="window.location='<?=base_url('login')?>'" style=""><i class="bi bi-x-circle"></i> Cancel</button>
            </div>
          </form>
          </div>
        </div>
      </div>
  </div>
  </div>

<?= $this->endSection();?>
