<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="special" class="container-fluid">
    <div class="heading text-center">
      <h1 style="padding-bottom: 4.7rem;">Add Faculty</h1>
    </div>
    <div id="EmailContent">
    <div class="card">
      <div class="card-body">
            <form action="<?=base_url()?>/professors/add_professors" method="post">

              <?php if(isset($error)!=null) {?>
                <span class="text-danger" style="text-align: center; margin: auto !important;"><?=$error?></span>
              <?php } ?>

                <div class="form-group">
                    <label for="first_name" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px">First Name</label>
                    <input type="text" id="first_name" class="form-control" name="first_name" value="<?=set_value('first_name')?>">
                    <br>
                    <span><?=displaySingleError($validation, 'first_name');?></span>
                </div>
                <div class="form-group">
                    <label for="last_name" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px">Last Name</label>
                    <input type="text" id="last_name" class="form-control" name="last_name" value="<?=set_value('last_name')?>">
                    <br>
                    <span><?=displaySingleError($validation, 'last_name');?></span>
                </div>
                <div class="form-group">
                    <label for="details" style="margin-top: 1rem; font-size:1.5em; margin-bottom:7px"> Details</label>
                    <textarea  id="details" class="form-control" name="details" rows="7" placeholder="Faculty Details "></textarea>
                    <br>
                    <span><?=displaySingleError($validation, 'details');?></span>
                </div>
                <br><br>
                <div>
                  <button class="button2" type="submit" style="margin-left: 0.5em; width: 10em; height  : 3em; border-bottom-style: hidden !important; border-radius: 2rem !important; "><i class="bi bi-check-circle"></i> Submit</button>
                  <button class="button2" onclick="window.location='<?=base_url('login')?>'" style="margin-left: 0.5em; margin-top: 1em; width: 10em; height: 3em; border-bottom-style: hidden !important; border-radius: 2rem !important; margin-right:4em;  "><i class="bi bi-x-circle"></i> Cancel</button>
                </div>
            </form>
      </div>  
    </div>
    </div>
    <div class="card-container" id="prof-content">  
    </div>
  </section>
<?= $this->endSection();?>
