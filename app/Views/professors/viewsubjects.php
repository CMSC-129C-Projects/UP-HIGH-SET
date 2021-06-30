<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<head>
<link href="<?=base_url()?>/public/css/custom/profs/viewsubjects-style.css" rel="stylesheet">
</head>

<section id="special" class="container-fluid">

<div class="heading text-center">
<h1 style="padding: 8rem 0 2rem;">PROFESSOR ROBERTO BASADRE</h1>
<h3> Civil Engineer, UPHS Faculty (Any description sa profs)</h3>


</div>


<div class="card-container">
    <?php if (isset($subjects)):?>
        <?php foreach($subjects as $subject):?>
            <div class="card">
                <img src="<?=base_url();?>/public/images/SubjectCover.jpg" alt="">
                <h1><?=$subject->name?></h1>
                <p> 42 STUDENTS ENROLLED.</p>
                <a href="#"><button>View Progress</button></a>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <!-- <div class="card">
        <img src="<?=base_url();?>/public/images/SubjectCover.jpg" alt="">
        <h1> GENERAL MATH</h1>
        <p>42 STUDENTS ENROLLED.</p>
        <a href="#"><button>View Progress</button></a>
    </div>

    <div class="card">
        <img src="<?=base_url();?>/public/images/SubjectCover.jpg" alt="">
        <h1>CALCULUS </h1>
        <p>42 STUDENTS ENROLLED.</p>
        <a href="#"><button>View Progress</button></a>
    </div> -->

</div>

</section>


<?= $this->endSection();?>