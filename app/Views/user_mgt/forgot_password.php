<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>

  
<div class="container-fluid" style="min-height: 100vh; padding: 3rem 0 2rem;"> 
  <div id="ChangePassword">
    <?php if (isset($validation) != null) { ?>
      <div class="heading text-center" style="padding: 20px;">
        <div class="alert alert-danger" style="margin-top: 10rem !important; width: 80%; padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px; margin-left: 10%; margin-right:10%;">
            <img src="<?=base_url()?>/public/error.png" style="width:15vmin; height:15vmin;">
            <h2 style="padding-top:1em; font-size:3.2vmin;"><?=displaySingleError($validation, 'email_fpass')?><h2>
        </div>  
      </div>
      <div style="text-align:center;">  
          <button class="button2" style="margin-left:3.5rem;" href="#" data-toggle="modal" data-target="#forgotPassword"><i class="bi bi-arrow-clockwise"></i> Try Again</button>
          <button class="button2" style="margin-left:3.5rem;" onclick="window.location='<?=base_url('dashboard/logout')?>'"><i class="bi bi-x-circle"></i> Cancel </button>
      </div>

    <?php } elseif(isset($validate_error)!=null) { ?> <!-- verify email in db -->
      <div class="heading text-center" style="padding: 20px;">
        <div class="alert alert-danger" style="margin-top: 10rem !important; width: 80%; padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px; margin-left: 10%; margin-right:10%;">
            <img src="<?=base_url()?>/public/error.png" style="width:15vmin; height:15vmin;">
            <h2 style="padding-top:1em; font-size:3.2vmin;"><?=$validate_error?><h2>
        </div>  
      </div>
      <div style="text-align:center;">  
          <button class="button2" style="margin-left:3.5rem;" href="#" data-toggle="modal" data-target="#forgotPassword"><i class="bi bi-arrow-clockwise"></i> Try Again</button>
          <button class="button2" style="margin-left:3.5rem;" onclick="window.location='<?=base_url('dashboard/logout')?>'"><i class="bi bi-x-circle"></i> Cancel </button>
      </div>
<!-- New CHanges -->

    <?php } elseif(isset($success) != null) { ?> <!-- email has been set for change -->
      <div class="heading text-center" style="padding: 20px;">
        <div class="alert alert-success" style="margin-top: 10rem !important; width: 80%; padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px; margin-left: 10%; margin-right:10%;">
            <img src="<?=base_url()?>/public/success.png" style="width:15vmin; height:15vmin;">
            <h2 style="padding-top:1em; font-size:3.2vmin;">A password reset link was sent to your email, you have 15 minutes to change your password.<h2>
        </div>
        <a class="button" style="padding: 12px 21px; font-size: 1.3em;" href="<?=base_url('login')?>"><i class="bi bi-x-left"></i> Cancel Reset Password</a>  
      </div>

    <?php } elseif( $success == null && $validate_error == null && $validation == null) {?> <!-- gone from external sources -->
      <div class="heading text-center" style="padding: 20px;">
        <div class="alert alert-danger" style="margin-top: 10rem !important; width: 80%; padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px; margin-left: 10%; margin-right:10%;">
            <img src="<?=base_url()?>/public/error.png" style="width:15vmin; height:15vmin;">
            <h2 style="padding-top:1em; font-size:3.2vmin;">You are not authorized to access this page.<h2>
        </div>  
        <a class="button" style="padding: 12px 21px; font-size: 1.3em;" href="<?=base_url('login')?>"><i class="bi bi-arrow-left"></i> Return to Main Page</a>
      </div>
          
    <?php } ?>
  </div>
  </div>
  </div>

    <div class="modal fade" id="forgotPassword"  role="dialog" position="default" style="height:444px">
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
              <input type="text" class="form-control" style="background:white" name = 'email_fpass' id="e_mail" value="<?=set_value('email_fpass')?>" placeholder="Email" required>
              <span><?=displaySingleError($validation, 'email_fpass');?></span>
              <div class="row">
                  <button class="button2" style="border-radius: 2rem !important; margin-top: 20px; margin-left: 12px;" type="submit"><i class="bi bi-check-circle"></i> Confirm</button>
                  <button class="button2"  style="border-radius: 2rem !important; margin-top: 20px; margin-left: 10px;" data-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
<?php $this->endSection(); ?>