<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <section id="special" class="container-fluid">

        <div class="heading text-center">
            <h1>Professor <?=ucwords($prof['first_name']) . ' ' . ucwords($prof['last_name'])?></h1>
            <h3><?=$prof['details']?></h3>
        </div>


        <div class="card-container">
            <?php if (isset($subjects)):?>
                <?php foreach($subjects as $subject):?>
                    <div class="card">
                        <img src="<?=base_url();?>/public/images/SubjectCover.jpg" alt="">
                        <h1><?=$subject->name?></h1>
                        <p><?=$subject->total_students?> STUDENTS ENROLLED.</p>
                        <a href="<?= base_url();?>/reports/progress_per_subject/<?=$subject->id;?>"><button>View Progress</button></a>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </section>
<?= $this->endSection();?>