<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>
  <div class="container-fluid" style="height:420px;">
  <div id="ChangePassword" style="margin-top:4.7rem;">
    <div class="card">
      <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
      <div class="card-body" style="padding: 40px; margin: 10px">

        <?php if(isset($error)) { ?>
          <h3 class="card-title" style="color: #7b1113; margin-bottom: 20px; font-size: 20px;">An error occurred.</h3>
          <div class="alert alert-danger" style="padding: 20px">
            <h4><?=$error?><h4>
          </div>
          <br>
          <a class="button" style="border-radius: 2rem !important; padding: 12px 21px; font-size: 13px;" href="<?=base_url('login')?>">Back</a>
        <?php } else { ?>
          <h3 class="card-title" style="color: #7b1113; margin-bottom: 20px; font-size: 20px;">Please reset your password to continue: </h3>
          <form class="reset_pass" action="<?=base_url()?>/reset_password/<?=$userToken?>" method="post">
            <div class="form-group">
              <label for="new_pass" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Set new password</label>
              <input id="new_pass" class="form-control" type="password" name="new_pass" value="" placeholder="Enter New Password..." required>
              <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'new_pass')?></h4>
            </div>

            <div class="form-group">
              <label for="confirm_pass" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Confirm password</label>
              <input id="confirm_pass" class="form-control" type="password" name="confirm_pass" value="" placeholder="Enter New Password Again..." required>
              <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'confirm_pass')?></h4>
            </div>

            <div class="form-group">
              <input type="submit" name="update" style="border-bottom-style: hidden !important; border-radius: 2rem !important; margin: none; font-weight: bold; font-size: 13px" value="Update">
              <a href="<?=base_url('dashboard/logout')?>" class="button" style="border-radius: 2rem !important; padding: 12px 21px; font-size: 13px;">Cancel</a>
            </div>
          </form>

          <?php } ?>
      </div>
    </div>
  </div>
  </div>

<?php $this->endSection(); ?>
