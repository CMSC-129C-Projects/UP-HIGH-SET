<?= $this->extend('template/studentTemplate');?>

<?= $this->section('content');?>
    <section id="special" class="container-fluid">
        <div class="heading text-center">
            <h1>Subjects</h1>
            <h3> Please Choose a Subject to Evaluate </h3>
        </div>
        <div class="card-container" id="subjects">
        </div>
    </section>
<?= $this->endSection();?>