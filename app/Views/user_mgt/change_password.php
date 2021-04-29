<?php
  if($is_changed) {
    $this->extend('template/pageTemplate');
    $url = base_url('dashboard');
  } else {
    $this->extend('template/default');
    $url = base_url('login');
  }
?>  

<?php $this->section('content'); ?>

  <div class="container-fluid">
      <div class="heading text-center">
        <h1 style= "padding:4.7rem;">Change Password</h1>
      </div>
      <div id="ChangePassword" style="margin-left: 125px">
        <div class="card" style="width:70%;">
          <div class="card-body" style="padding: 40px; margin: 10px">
            <?php if(isset($error)) { ?>
            <h3 class="card-title" style="color: #7b1113; margin-bottom: 20px; font-size: 20px;">An error occurred.</h3>
            <div class="alert alert-danger">
              <?=$error?>
            </div>
            <br><br>
            <a class="button" style="border-radius: 2rem !important; padding: 12px 21px; font-size: 13px;" href="<?=$url?>">Back</a>
            <?php } else { ?>
            <h3 class="card-title" style="color: #7b1113; margin-bottom: 20px; font-size: 20px;">Fill up the form to change password.</h3>
            <form class="reset_pass" action="<?=base_url('home/change_password')?>" method="post">
              <div class="form-group">
                <label for="old_pass" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Old Password:</label>
                <input id="old_pass" class="form-control" type="password" name="old_pass" value="" required>
                <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'old_pass')?></h4>
              </div>
              <br><br>
              <div class="form-group">
                <label for="new_pass" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Set New Password:</label>
                <input id="new_pass" class="form-control" type="password" name="new_pass" value="" required>
                <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'new_pass')?></h4>
              </div>
              <br><br>
              <div class="form-group">
                <label for="confirm_pass" style="margin-top: 1rem; font-size:15px; margin-bottom:7px">Confirm Password:</label>
                <input id="confirm_pass" class="form-control" type="password" name="confirm_pass" value="" required>
                <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'confirm_pass')?></h4>
              </div>
              <br><br>
              <div class="form-group">
                <input type="submit" name="update" style="border-bottom-style: hidden !important; border-radius: 2rem !important; margin: none; font-weight: bold; font-size: 13px" value="Update">
                <a href="<?=base_url('dashboard')?>" class="button" style="border-radius: 2rem !important; padding: 12px 21px; font-size: 13px;">Cancel</a>
              </div>
            </form>
            <?php } ?>
          </div>
        </div>
      </div>
  </div>

<?php $this->endSection(); ?>
