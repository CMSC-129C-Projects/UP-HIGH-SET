<?= $this->extend('pageTemplate');?>


<?= $this->section('content');?>

  <div class="container-fluid">
    <div class="card" style="width: 60%; margin: 10% auto; vertical-align: middle;">
      <div class="card-body">
        <h5 class="card-title" style="margin: 1.5rem 0 2rem;">Update Email Content</h5>

        <form>
          <div class="form-group">
            <label for="email-subject">Email Subject</label>
            <input type="text" class="form-control" id="email-subject" placeholder="Enter Email subject here ...">
          </div>
          <div class="form-group">
            <label for="email-content">Email Content</label>
            <textarea class="form-control" id="email-content" rows="3" placeholder="Email notification content ..."></textarea>
          </div>


        </form>

        <button id="update" type="button" name="update">Update</button>
      </div>
    </div>
  </div>

<?= $this->endSection();?>
