<?= $this->extend('pageTemplate');?>


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
            <span class="text-danger"><?=displaySingleError($validation, 'email_subject');?></span>
          </div>
          <div class="form-group">
            <label for="email-content">Email Content</label>
            <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="3" placeholder="Email notification content ..."></textarea>
            <span class="text-danger"><?=displaySingleError($validation, 'email_content');?></span>
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
