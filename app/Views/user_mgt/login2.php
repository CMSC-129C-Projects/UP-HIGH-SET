<?= $this->extend('template/default');?>

<?= $this->section('content');?>
  <div class="container-fluid">
    <div class="row home">
      <div class="container" style="height: 500px;">
        <div class="card login" style="margin: 10% auto !important; padding: 3rem; width: 40%; vertical-align: middle; border-radius: .5rem;">
          <div class="heading text-center">
            <h3>User Login</h3>
          </div>

          <form class="form-horizontal" action="" method="post">
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
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?= $this->endSection();?>


<style media="screen">
  .login {
    padding: 4rem !important;
  }
</style>
