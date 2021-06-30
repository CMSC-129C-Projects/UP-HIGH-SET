<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="special" class="container-fluid">
    <div class="heading text-center">
      <h1 style="padding: 8rem 0 2rem;">FACULTIES</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="input-group" style="width: 30%; margin: auto; margin-bottom:3rem;">
            <input type="text" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"/>
            <button type="button" style="margin: 0 2%;" class="btn btn-outline-primary start-search">Search</button>
            <button type="button" style="margin: 0 2%;" class="btn btn-outline-primary display-all">Display All</button>
        </div>
      </div>
    </div>
    <div class="card-container" id="prof-content">
    </div>
  </section>
<?= $this->endSection();?>
