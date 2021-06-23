<?= $this->extend('template/studentTemplate');?>

<?= $this->section('content');?>
    <section id="special" class="container-fluid">
        <div class="heading text-center">
            <h1  style="padding: 8rem 0 2rem;">Subjects</h1>
            <h3 style="margin-bottom:3rem;"> Please Choose a Subject to Evaluate </h3>
        </div>
        <div class="card-container" id="subjects">
        </div>
    </section>
<?= $this->endSection();?>