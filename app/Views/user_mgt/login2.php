<?= $this->extend('template/default');?>

<?= $this->section('content');?>
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