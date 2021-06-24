<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>
  <div class="container-fluid" style="min-height:100vh; padding: 3rem 0 2rem;">
        
        <?php if(isset($error)) { ?>
          <div class="heading text-center" style="padding: 20px;">
            <div class="alert alert-danger" style="margin-top: 10rem !important; width: 80%; padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px; margin-left: 10%; margin-right:10%;">
              <img src="<?=base_url()?>/public/error.png" style="width:20vmin; height:20vmin;">
              <h2 style="padding-top:1em; font-size:3.2vmin;"><?=$error?><h2>
            </div> 
            <a class="button" style="padding: 3vmin 8vmin; font-size: 2.2vmin;" href="<?=base_url('login')?>"><i class="bi bi-arrow-left"></i> Return to Login Page</a>
          </div>
    
        <?php } else { ?>
          <div id="ChangePassword">
            <div class="card">
              <div class="card-body" style="padding: 40px; margin: 10px">
                <h3 class="card-title" style="color: #7b1113; margin-bottom: 20px; font-size: 3.6vmin;">Please reset your password to continue: </h3>
                <form class="reset_pass" action="<?=base_url()?>/reset_password/<?=$userToken?>" method="post">
                  <div class="form-group">
                    <label for="new_pass" style="margin-top: 1rem; font-size:3.2vmin; margin-bottom:7px">Set new password</label>
                    <input id="new_pass" class="form-control" type="password" name="new_pass" value="" required>
                    <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'new_pass')?></h4>
                  </div>
                  <div class="form-group">
                    <label for="confirm_pass" style="margin-top: 1rem; font-size:3.2vmin; margin-bottom:7px">Confirm password</label>
                    <input id="confirm_pass" class="form-control" type="password" name="confirm_pass" value="" required>
                    <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'confirm_pass')?></h4>
                  </div>
                  <br>
                  <div style="text-align: center;">
                    <button class="button2" type="submit" name="update" style="2.2vmin"><i class="bi bi-check-circle"></i> Confirm</button>
                    <button href="<?=base_url('dashboard/logout')?>" class="button2" style="2.2vmin"><i class="bi bi-x-circle"></i> Cancel</button>
                  </div>
                </form>
        <?php } ?>
              </div>
            </div>
          </div>
  </div>

<?php $this->endSection(); ?>
