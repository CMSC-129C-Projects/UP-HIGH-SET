<?php $this->extend('template/default') ?>

<?php $this->section('content'); ?>

  <div class="container-fluid" style="min-height: 100vh">
  <div id="ChangePassword">  
    <?php if (isset($validation) != null) { ?>
      <div class="heading text-center" style="padding: 20px;">
        <h1 style="margin-top: 5.2rem; margin-bottom: -1%;"> An error occured. <h1>
        <div class="alert alert-danger" style="padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px;">
            <h2 style=""><?=$validate_error?><h2>
        </div>
        <br>  
        <a class="button" style="padding: 12px 21px; font-size: 13px;" href="#" data-toggle="modal" data-target="#forgotPassword">Create Another Request</a>
      </div>

    <?php } elseif(isset($validate_error)!=null) { ?> <!-- verify email in db -->
      <div class="heading text-center" style="padding: 20px;">
        <h1 style="margin-top: 5.2rem; margin-bottom: -1%;"> An error occured. <h1>
        <div class="alert alert-danger" style="padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px;">
            <h2 style=""><?=$validate_error?><h2>
        </div>  
        <a class="button" style="padding: 12px 21px; font-size: 13px;" href="#" data-toggle="modal" data-target="#forgotPassword">Create Another Request</a>
      </div>

    <?php } elseif(isset($success) != null) { ?> <!-- email has been set for change -->
      <div class="heading text-center" style="padding: 20px;">
        <h1 style="margin-top: 5.2rem; margin-bottom: -1%;"> Your request has been processed. <h1>
        <div class="alert-success" style="padding:30px; border-color:#23297A; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px;">
            <h2 style="">A password reset link was sent to your email, you have 15 minutes to change your password.<h2>
        </div>  
      </div>

    <?php } elseif( $success == null && $validate_error == null && $validation == null) {?> <!-- gone from external sources -->
      <div class="heading text-center" style="padding: 20px;">
        <h1 style="margin-top: 5.2rem; margin-bottom: -1%;"> An error occured. <h1>
        <div class="alert alert-danger" style="padding:30px; border-color:#7b1113; border-width: 2px; border-radius: 0.5rem; margin-bottom:30px;">
            <h2 style="">You are not authorized to access this page.<h2>
        </div>  
        <a class="button" style="padding: 12px 21px; font-size: 13px;" href="<?=base_url('login')?>">Go Back to Main Page</a>
      </div>
          
    <?php } ?>
  </div>
  </div>

  <div class="modal fade" id="forgotPassword"  role="dialog" position="default" style="height: 429px">
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
