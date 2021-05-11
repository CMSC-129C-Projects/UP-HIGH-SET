<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>

<?php if(isset($status)):?>
    <div id="bg-modal" class="black-modal-email">
      <div id="content-modal" class="customModal-email horizontalCenter verticalCenter">
        <div class="mdl-content">
          <?php if($status):?>
            <p>Email content updated succesfully</p>
          <?php else:?>
            <p>Error on Update. Please try again</p>
          <?php endif;?>
          <div class="btn-delete">
            <button id="dontDelete">Dismiss</button>
          </div>
        </div>
      </div>
    </div>
  <?php endif;?>

  <div class="container-fluid">
    <div class="heading text-center">
      <h1 style= "padding:4.7rem;">Update Email Content</h1>
    </div>

    <div id="EmailContent">
    <div class="card">
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="email-subject" style="margin-top: 1rem; font-size:15px; margin-bottom:7px"> Email Subject</label>
            <input type="text" class="form-control" name = 'email_subject' id="email-subject" value="<?=set_value('email_subject')?>" placeholder="Enter Email subject here ...">
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_subject');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="email-content" style="font-size:15px; margin-bottom:7px">Email Content</label>
            <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="7" placeholder="Email notification content ..."></textarea>
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_content');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="purpose" style="font-size:15px;">Email Purpose :</label>
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
            <br><br>  
            <p style="font-size:13px">Attachment is Optional</p>
            <input type="file" style="border-bottom-style: hidden !important" name="attachment[]" value="" >
            <br><br>
            <input type="submit" style="border-bottom-style: hidden !important; border-radius: 1rem !important" value="update">
          </form>
          </div>
        </div>
      </div>
  </div>
  </div>
</section>

<?= $this->endSection();?>