<?php
  if ($_SESSION['logged_user']['role'] === '1') {
    $this->extend('template/pageTemplate');
  } elseif ($_SESSION['logged_user']['role'] === '3') {
    $this->extend('template/clerkTemplate');
  }
?>

<?= $this->section('content');?>
    <span style="display: none;" id="status" data-status="<?=$status?>"></span>

    <section id="special" class="container-fluid">

        <div class="heading text-center">
            <h1 style="padding: 8rem 0 2rem;"><?=ucwords($prof['first_name']) . ' ' . ucwords($prof['last_name'])?></h1>
            <h3 style="margin-bottom:3rem;"><?=$prof['details']?></h3>
        </div>


        <div class="card-container">
            <?php if (isset($subjects)):?>
                <?php foreach($subjects as $subject):?>
                    <div class="card">
                        <img src="<?=base_url();?>/public/images/SubjectCover.jpg" alt="">
                        <h1><?=$subject->name?></h1>
                        <p><?=$subject->total_students?> STUDENTS ENROLLED.</p>
                        <div class="dropdown" style="margin:auto;">
                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenuButton">
                              <!-- Removed because redundant -->
                                <!-- <a class="dropdown-item" href="<?=base_url();?>/reports/report_per_subject/<?=$subject->id;?>">View Progress</a>
                                <hr> -->
                                <a class="dropdown-item" href="<?=base_url()?>/subjects/edit_subject/<?=$subject->id;?>/<?=$prof['id']?>">Edit Subject</a>
                                <hr>
                                <a class="dropdown-item" href="<?=base_url()?>/subjects/delete_subject/<?=$subject->id;?>/<?=$prof['id']?>">Delete Subject</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </section>
<?= $this->endSection();?>
