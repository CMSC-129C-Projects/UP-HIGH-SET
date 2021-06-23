<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="special" class="container-fluid">
    <div class="heading text-center">
      <h1>Add Faculty</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="<?=base_url()?>/professors/add_professors" method="post">

          <?php if(isset($error)!=null) {?>
            <span class="text-danger" style="text-align: center; margin: auto !important;"><?=$error?></span>
          <?php } ?>

            <div class="form-group">

                <label for="first_name">First Name</label>
                <input type="text" id="first_name" class="form-control" name="first_name" value="<?=set_value('first_name')?>">
                <span><?=displaySingleError($validation, 'first_name');?></span>
            </div>
            <div class="form-group">

                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" class="form-control" name="last_name" value="<?=set_value('last_name')?>">
                <span><?=displaySingleError($validation, 'last_name');?></span>
            </div>
            <div class="form-group">
                <label for="details"> Details</label>
                <textarea  id="details" class="form-control" name="details" rows="7" placeholder="Faculty Details "></textarea>
                <span><?=displaySingleError($validation, 'details');?></span>
            </div>
            <button class="button" type="submit" style="width: 10em; height: 3em; border-bottom-style: hidden !important; border-radius: 2rem !important; margin-right: 10px;"><i class="bi bi-check-circle"></i> Submit</button>
        </form>
      </div>
    </div>
    <div class="card-container" id="prof-content">
    </div>
  </section>
<?= $this->endSection();?>
