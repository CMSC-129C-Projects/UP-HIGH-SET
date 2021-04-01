<?= $this->extend('template/default');?>

<?= $this->section('content');?>
<!-- <div class="container-fluid">
  <div class="row home">
    <div class="container" style="height: 500px;">
      <div class="card login" style="margin: 10% auto !important; padding: 3rem; width: 40%; vertical-align: middle; border-radius: .5rem;">
        <div class="heading text-center">
          <h3>User Login</h3>
        </div>

        <form class="form-horizontal" action="" method="post">
          <?php if(isset($error)!=null) {?>
            <span class="text-danger" style="text-align: center; margin: auto !important;"><?=$error?></span>
          <?php } ?>
            <div class="form-group">
              <label class="control-label" for="email">Email address:</label>
              <span class="text-danger"><?=displaySingleError($validation, 'email');?></span>
              <input type="email" name="email" class="form-control" id="email" value="<?=set_value('email')?>">
            </div>

            <div class="form-group">
              <label class="control-label" for="pwd">Password:</label>
              <span class="text-danger"><?=displaySingleError($validation, 'password');?></span>
              <input type="password" name="password" class="form-control" id="pwd">
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div> -->
    <img src="<?=base_url('public/images/uphs.jpeg')?>" class="background">
    <section class="login">
        <div class="container cntr-custom">
            <div class="row custom-row">
                <div class="col-md 6 d-flex justify-content-center">
                    <div class="form-background">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email" value="<?=set_value('email')?>">
                                <span><?=displaySingleError($validation, 'email');?></span>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" id="pwd" class="form-control" name="password">
                                <span><?=displaySingleError($validation, 'password');?></span>
                            </div>
                            <div style="display: flex; flex-direction: column;">
                                <small style="float: right;"><a href="">Forgot Password?</a></small>
                                <button class="btn btn-primary btn-login" type="submit">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 s-col align-items-start">
                    <div class="r-content">
                        <img src="<?=base_url('public/images/voice.png');?>">
                        <bold>Let's create a better environment for both students and teachers.</bold>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection();?>
