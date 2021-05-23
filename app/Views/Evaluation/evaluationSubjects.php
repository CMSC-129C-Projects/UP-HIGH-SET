<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<head>
<link href="<?=base_url()?>/public/css/custom/evaluation/evalSubjects.css" rel="stylesheet">
</head>

<section id="special" class="container-fluid">

<div class="heading text-center">
<h1>Subjects</h1>


</div>


<div class="card-container">

    <div class="card">
        <img src="<?=base_url();?>/public/images/EvaluationCover.jpg" alt="">
        <h1> Subject Name</h1>
        <p>This Subject is handled by NAME OF PROFESSOR.</p>
        <a href="#"><button>View Subjects</button></a>
    </div>

    <div class="card">
        <img src="<?=base_url();?>/public/images/EvaluationCover.jpg" alt="">
        <h1> Subject Name</h1>
        <p>This Subject is handled by NAME OF PROFESSOR.</p>
        <a href="#"><button>View Subjects</button></a>
    </div>

    <div class="card">
        <img src="<?=base_url();?>/public/images/EvaluationCover.jpg" alt="">
        <h1> Subject Name</h1>
        <p>This Subject is handled by NAME OF PROFESSOR.</p>
        <a href="#"><button>View Subjects</button></a>
    </div>

</div>

</section>


<?= $this->endSection();?>