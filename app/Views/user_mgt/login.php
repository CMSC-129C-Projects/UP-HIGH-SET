<?= $this->extend('template/default');?>

<?= $this->section('content');?>
    <img src="<?=base_url('public/images/loginbgimage.jpg')?>" class="background">
    <section class="login">
        <div class="container cntr-custom">
          <div class="row custom-row">
            <div class="d-flex col-md-6 s-col justify-content-center align-middle" style="margin-left: 3%;">
              <div class="r-content">
                  <?php if (isset($evaluation_info) && ($daysLeft != '0' || $timeLeft != '00:00:00')):?>
                    <!-- <img class="logo" src="<?=base_url()?>/public/images/CitronellaLogo.png" alt=""> -->
                    <span>The UP Student-Teacher Evaluation will close in</span>
                    <span class="countdown"><?=($daysLeft === '1') ? ($daysLeft . ' DAY') : ($daysLeft . ' DAYS')?> & <span class="time"><?=$timeLeft?></span></span>
                    <hr class="line">
                    <span class="closing">Let your voice be heard. Evaluate your teachers now.</span>
                  <?php else:?>
                    <span style="display: none;" id="eval_status"></span>
                    <!-- <img class="logo" src="<?=base_url()?>/public/images/CitronellaLogo.png" alt=""> -->
                    <span>The UP Student-Teacher Evaluation is still</span>
                    <span class="closed">CLOSED</span>
                    <hr class="line">
                    <span class="closing">Students cannot login while the SET is closed. <br>If you think this is a mistake, <br>please approach your school clerk.</span>
                  <?php endif;?>
              </div>
            </div>
            <div class="col-md 6 d-flex justify-content-center">
              <div class="form-background">
                <form action="<?=base_url()?>/home/login" method="post">

                  <?php if(isset($error)!=null) {?>
                    <span style="text-align: center; margin: auto !important;"><?=$error?></span>
                  <?php } ?>

                    <div class="form-group">

                        <label for="email"> Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="<?=set_value('email')?>">
                        <span><?=displaySingleError($validation, 'email');?></span>
                    </div>
                    <div class="form-group">
                        <label for="pwd"> Password</label>
                        <input type="password" id="pwd" class="form-control" name="password">
                        <span><?=displaySingleError($validation, 'password');?></span>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <small style="float: right;"><a href="#" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a></small>
                        <button class="btn btn-primary btn-login" type="submit"><i class="bi bi-box-arrow-in-right"></i> Log In</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    <div class="modal fade" id="forgotPassword"  role="dialog" position="default" style="height:428px">
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
