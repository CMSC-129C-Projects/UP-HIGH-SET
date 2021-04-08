<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>
  <div class="container-fluid" style="height: 420px;">
    <div class="card" style="width:400px; margin: auto !important; position: relative; top: 25%;">
      <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
      <div class="card-body">
        <h3 class="card-title">Reset Password</h3>

        <?php if(isset($error)) { ?>
          <div class="alert alert-danger">
            <?=$error?>
          </div>
        <?php } else { ?>
          <form class="reset_pass" action="<?=base_url()?>/reset_password/<?=$userToken?>" method="post">
            <div class="form-group">
              <label for="new_pass">Set new password</label>
              <input id="new_pass" class="form-control" type="password" name="new_pass" value="">
              <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'new_pass')?></h4>
            </div>

            <div class="form-group">
              <label for="confirm_pass">Confirm password</label>
              <input id="confirm_pass" class="form-control" type="password" name="confirm_pass" value="">
              <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'confirm_pass')?></h4>
            </div>

            <div class="form-group">
              <input type="submit" name="update" value="Update" class="btn btn-primary">
              <a href="<?=base_url('dashboard/logout')?>" class="btn button2 btn-primary" style='margin: auto;'>Cancel</a>
            </div>
          </form>

          <?php } ?>
      </div>
    </div>
  </div>

<?php $this->endSection(); ?>
