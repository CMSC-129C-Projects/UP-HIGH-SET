<?= $this->extend('template/pageTemplate');?>


<?= $this->section('content');?>

  <div class="container-fluid">
    <div class="heading text-center">
      <h1>Update Email Content</h1>
    </div>

    <div class="card" style="width: 60%; margin: 5% auto 0; vertical-align: middle;">
      <div class="card-body" style="padding: 20px;">

        <form method="post" action="">
          <div class="form-group">
            <label for="email-subject" style="margin-top: 1rem;"> Email Subject</label>
            <input type="text" class="form-control" name = 'email_subject' id="email-subject" value="<?=set_value('email_subject')?>" placeholder="Enter Email subject here ...">
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_subject');?></span>
          </div>
          <div class="form-group">
            <label for="email-content">Email Content</label>
            <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="3" placeholder="Email notification content ..."></textarea>
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_content');?></span>
          </div>
          <div class="form-group">
            <label for="purpose">Purpose</label>
            <select name="purpose" id="purpose">
              <option value="">Select...</option>
              <option value="announcement">Announcement</option>
              <option value="registration">Registration</option>
              <option value="evaluation">Evaluation</option>
              <option value="change_pass">Change Password</option>
              <option value="forgot_pass">Forgot Password</option>
            </select>
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'purpose');?></span>
          </div>

          <p>Attachment is Optional</p>
          <input type="file" name="attachment[]" value="" >
          <br>
          <input type="submit" value="update">
        </form>

      </div>
    </div>
  </div>
<?= $this->endSection();?>
