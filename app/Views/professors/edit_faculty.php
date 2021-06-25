<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="special" class="container-fluid" style="padding: 4rem 0 2rem;">
    <div class="heading text-center">
      <h1 style="font-size:5.8vmin; padding-bottom:4vmin;">ADD FACULTY</h1>
    </div>
    <div id="EmailContent">
    <div class="card">
      <div class="card-body">
            <form action="<?=base_url()?>/professors/add_professors" method="post">

              <?php if(isset($error)!=null) {?>
                <span class="text-danger" style="text-align: center; margin: auto !important;"><?=$error?></span>
              <?php } ?>

                <div class="form-group">
                    <label for="first_name" style="margin-top: 1rem; font-size:3.2vmin; margin-bottom:7px">First Name</label>
                    <input type="text" id="first_name" class="form-control" name="first_name" value="<?=set_value('first_name', $professor['first_name'])?>">
                    <br>
                    <span><?=displaySingleError($validation, 'first_name');?></span>
                </div>
                <br>
                <div class="form-group">
                    <label for="last_name" style="margin-top: 1rem; font-size:3.2vmin; margin-bottom:7px">Last Name</label>
                    <input type="text" id="last_name" class="form-control" name="last_name" value="<?=set_value('last_name', $professor['last_name'])?>">
                    <br>
                    <span><?=displaySingleError($validation, 'last_name');?></span>
                </div>
                <br>
                <div class="form-group">
                    <label for="details" style="margin-top: 1rem; font-size:3.2vmin; margin-bottom:7px"> Details</label>
                    <textarea  id="details" class="form-control" name="details" rows="7" placeholder="Faculty Details "><?=$professor['details']?></textarea>
                    <br>
                    <span><?=displaySingleError($validation, 'details');?></span>
                </div>
                <br><br>
                <div style="text-align:center;">
                  <button class="button2" type="submit" style=""><i class="bi bi-check-circle"></i> Submit</button>
                  <button class="button2" type="button" onclick="window.location='<?=base_url('professors')?>'" style=""><i class="bi bi-x-circle"></i> Cancel</button>
                </div>
            </form>
      </div>  
    </div>
    </div>
    <div class="card-container" id="prof-content">  
    </div>
  </section>
<?= $this->endSection();?>
