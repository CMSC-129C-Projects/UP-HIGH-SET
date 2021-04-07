<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>

  <?php if (isset($validation) != null): ?>
    <div class="container-fluid" style="height: 420px;">
      <div class="card" style="width:400px; margin: auto !important; position: relative; top: 25%;">
      <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
      <div class="card-body">
        <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'email_fpass');?></h4>
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#forgotPassword">Retry!</a>
      </div>
    </div>
    </div>
  <?php endif; ?>

  <?php if(isset($error)!=null) {?>
    <div class="container-fluid" style="height: 420px;">
      <div class="card" style="width:400px; margin: auto !important; position: relative; top: 25%;">
      <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
      <div class="card-body">
        <!-- <h4><?=displaySingleError($validation, 'email_fpass');?></h4> -->
        <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=$error?></h4>
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#forgotPassword">Retry!</a>
      </div>
    </div>
    </div>
  <?php } ?>

  <div class="modal fade" id="forgotPassword"  role="dialog" position="default">
    <div class="modal-dialog">
    <div class="modal-content" style="background: transparent;">

      <div class="modal-header">
        <h2 style="color: #e9dbc1">Retrieve your account</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </div>

      <div class="modal-body" style="padding: 20px;">
        <form method="post" action="<?=base_url()?>/forgot_password">
          <div class="form-group">
            <label for="e_mail" style="margin-top: 1rem; font-size: 15px;"> Please provide your email: </label>
            <input type="text" class="form-control" style="background:white" name = 'email_fpass' id="e_mail" placeholder="Email" required>
            <input type="submit" value="Confirm">
            <input type="button" class="button2" data-dismiss="modal" value="Close">
          </div>
        </form>
      </div>
    </div>
    </div>
  </div>
<?php $this->endSection(); ?>
