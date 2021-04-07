<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>

  <div class="container-fluid" style="height: 420px;">
    <div class="card" style="width:400px; margin: auto !important; position: relative; top: 25%;">
      <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
      <div class="card-body">
        <?php if (isset($validation) != null) { ?>

          <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'email_fpass')?></h4>
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#forgotPassword">Retry!</a>

        <?php } elseif(isset($validate_error)!=null) { ?>

          <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=$validate_error?></h4>
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#forgotPassword">Retry!</a>

        <?php } elseif(isset($success) != null) { ?>
          <div class="alert-success" style="padding: 20px;">
            <h4> A password reset link was sent to your email, you have 15 minutes to change your password.</h4>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

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

  <!-- <div class="container" style="height: ">
    <div class="reset_password">
      <h3>Reset Password</h3>
      <?php if(isset($error) != null) { ?>
        <div class="alert alert-danger">
          <?=$error?>;
        </div>
      <?php } else { ?>

      <?php } ?>
    </div>
  </div> -->
<?php $this->endSection(); ?>
