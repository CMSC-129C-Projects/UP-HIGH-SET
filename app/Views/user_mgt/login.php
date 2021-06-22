<?= $this->extend('template/default');?>

<?= $this->section('content');?>
    <img src="<?=base_url('public/images/loginbgimage.jpg')?>" class="background">
    <section class="login">
        <div class="container cntr-custom">
          <div class="row custom-row">
            <div class="d-flex col-md-6 s-col justify-content-center align-middle">
              <div class="r-content">
                  <?php if (isset($evaluation_info)):?>
                    <bold>Evaluation period closes in</bold>
                    <bold class="days"><?=$daysLeft?> days</bold>
                    <bold>and</bold>
                    <bold class="time"><?=$timeLeft?></bold>
                  <?php else:?>
                    <span style="display: none;" id="eval_status"></span>
                    <bold class="closed">CLOSED</bold>
                  <?php endif;?>
              </div>
            </div>
            <div class="col-md 6 d-flex justify-content-center">
              <div class="form-background">
                <form action="<?=base_url()?>/home/login" method="post">

                  <?php if(isset($error)!=null) {?>
                    <span class="text-danger" style="text-align: center; margin: auto !important;"><?=$error?></span>
                  <?php } ?>

                    <div class="form-group">

                        <label for="email" class="bi bi-envelope-fill"> Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="<?=set_value('email')?>">
                        <span><?=displaySingleError($validation, 'email');?></span>
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="bi bi-key-fill"> Password</label>
                        <input type="password" id="pwd" class="form-control" name="password">
                        <span><?=displaySingleError($validation, 'password');?></span>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <small style="float: right;"><a href="#" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a></small>
                        <button class="btn btn-primary btn-login" type="submit">Log In</button>
                        <!-- for testing purposes -->
                        <!-- <a href="<?=base_url('home/change_password')?>" class="btn btn-primary btn-login">Change Pass</a>  -->
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    <div class="modal fade" id="forgotPassword"  role="dialog" position="default" style="height:420px">
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
  </section>
<?= $this->endSection();?>
