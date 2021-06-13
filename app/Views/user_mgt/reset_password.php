<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>
  <div class="container-fluid" style="min-height:100vh">
        
        <?php if(isset($error)) { ?>
          <div class="heading text-center" style="padding: 20px;">
            <h1 style="margin-top: 5.2rem; margin-bottom: -1%;"> An error occured. <h1>
            <div class="alert alert-danger" style="padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px;">
              <h2 style=""><?=$error?><h2>
            </div> 
            <a class="button" style="padding: 12px 21px; font-size: 13px;" href="<?=base_url('login')?>">Return to Login Page</a>
          </div>
    
        <?php } else { ?>
          <div id="ChangePassword" style="margin-top:4.7rem;">
            <div class="card">
              <div class="card-body" style="padding: 40px; margin: 10px">
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
                  <div class="form-group" style="text-align: center;">
                    <br>
                    <input type="submit" name="update" style="border-bottom-style: hidden !important; margin: none; font-weight: bold; font-size: 13px; border-radius:2rem !important;" value="Update">
                    <a href="<?=base_url('dashboard/logout')?>" class="button" style="padding: 12px 21px; font-size: 13px; border-radius:2rem">Cancel</a>
                  </div>
                </form>
        <?php } ?>
              </div>
            </div>
          </div>
  </div>

<?php $this->endSection(); ?>
