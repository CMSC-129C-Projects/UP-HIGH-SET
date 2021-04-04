<?= $this->extend('pageTemplate');?>

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

<section class="container-fluid">

    <div class="heading text-center">
      <h1>Update Email Content</h1>
    </div>

<!-- Button -->
  <div style="text-align:center">
    <input type ="button" class="button"  data-toggle="modal" data-target="#emailModal" value="Click to change email content.">
    <input type ="button" class="button"  data-toggle="modal" data-target="#forgotPassword" value="Forgot Password?">
  </div>

<!-- Start of Email Modal -->
    <div class="modal fade" id="emailModal" role="dialog" position="default">
      <div class="modal-dialog modal-xl">
      <div class="modal-content" style="background: transparent;">
      
        <div class="modal-header">
          <h2 style="color: #e9dbc1">Update Email Contents</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div> 

        <div class="modal-body" style="padding: 20px;">
          <form method="post" action="">
            <div class="form-group">
              <label for="email-subject" style="margin-top: 1rem; font-family: Roboto; font-size: 15px;"> Email Subject</label>
              <input type="text" class="form-control" name = 'email_subject' id="email-subject" value="<?=set_value('email_subject')?>" placeholder="Enter Email subject here ...">
              <br>
            </div>
            <div class="form-group">
              <label for="email-content" style="font-family: Roboto; font-size: 15px;">Email Content</label>
              <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="7" placeholder="Email notification content ..."></textarea>
              <br>
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
            </div>

            <p style="font-size: 13px">Attachment is Optional</p>
            <input type="file" name="attachment[]" value="" >
            <br>
            <input type="submit" value="update">
          </form>
        </div>
      </div>
      </div>
  </div>
<!-- End of Email Modal -->

<!-- Start of Password Modal -->  
    <div class="modal fade" id="forgotPassword"  role="dialog" position="default">
      <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background: transparent;">

        <div class="modal-header">
          <h2 style="color: #e9dbc1">Retrieve your account</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div> 

        <div class="modal-body" style="padding: 20px;">
          <form method="post" action="">
            <div class="form-group">
              <label for="email" style="margin-top: 1rem; font-size: 15px;"> Please provide your email: </label>
              <input type="text" class="form-control" name = 'email' id="e_mail" value="<?=set_value('email_content')?>" placeholder="Email">
            </div>
            <input type="submit" value="Confirm">
          </form>
        </div>
      </div>
      </div>
    </div>
<!-- End of Password Modal -->
  </div>
</section>

<?= $this->endSection();?>
