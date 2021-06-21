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
  <div class="container-fluid" style="min-height:100vh">

    <?php if(isset($error)) { ?>
      <div id="ChangePassword">            
      <div class="heading text-center" style="padding: 20px;">
        <div class="alert alert-danger" style="margin-top: 10rem !important; width: 80%; padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px; margin-left: 10%; margin-right:10%;">  
          <img src="<?=base_url()?>/public/error.png" style="width:7em; height:7em;">
          <h2 style="padding-top:1em; font-size:2em;"><?=$error?><h2>
        </div> 
        <a class="button" style="padding: 12px 21px; font-size: 13px; margin-bottom:20px;" href="<?=$url?>"><i class="bi bi-arrow-left"></i> Return to login page</a>
      </div>
      <div>

    <?php } else { ?>
      <div class="heading text-center">
        <h1 style= "padding:4.7rem;">Change Password</h1>
      </div>
      <div id="ChangePassword">
        <div class="card">
          <div class="card-body" style="padding: 40px; margin: 10px">
            <h3 class="card-title" style="color: #7b1113; margin-bottom: 20px; font-size: 2em;">Fill up the form to change password.</h3>
            <br>
            <form class="reset_pass" action="<?=base_url('home/change_password')?>" method="post">
              <div class="form-group">
                <label for="old_pass" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px">Old Password:</label>
                <input id="old_pass" class="form-control" type="password" name="old_pass" value="" required>
                <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'old_pass')?></h4>
              </div>
              <br><br>
              <div class="form-group">
                <label for="new_pass" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px">Set New Password:</label>
                <input id="new_pass" class="form-control" type="password" name="new_pass" value="" required>
                <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'new_pass')?></h4>
              </div>
              <br><br>
              <div class="form-group">
                <label for="confirm_pass" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px">Confirm Password:</label>
                <input id="confirm_pass" class="form-control" type="password" name="confirm_pass" value="" required>
                <h4 class="text-danger" style="text-align: center; margin: auto !important;"><?=displaySingleError($validation, 'confirm_pass')?></h4>
              </div>
              <br><br>
              <div style="text-align:center">
                <button class="button" type="submit" name="update" style="height: 3em; width:8em; border-bottom-style: hidden !important; border-radius: 2rem !important; font-weight: bold; font-size: 1.3em; margin-right:2.25%;"><i class="bi bi-check-circle"></i> Update</button>
                <button href="<?=base_url('dashboard')?>" class="button" style="height: 3.15em; width:7.8em; padding: 12px 0px; font-size: 1.3em;"><i class="bi bi-x-circle"></i> Cancel</button>
              </div>
              </form>
            <?php } ?>
          </div>
        </div>
      </div>
  </div>

<?php $this->endSection(); ?>
