<?= $this->extend('template/default');?>

<?= $this->section('content');?>
    <img src="<?=base_url('public/images/uphs.jpeg')?>" class="background">
    <section class="login">
        <div class="container cntr-custom">
            <div class="row custom-row">
                <div class="col-md 6 d-flex justify-content-center">
                    <div class="form-background">
                        <form action="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" name="username">
                                <span><?=displaySingleError($validation, 'username');?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password">
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