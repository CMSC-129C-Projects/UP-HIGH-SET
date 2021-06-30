<?php
  if ($_SESSION['logged_user']['role'] === '1') {
    $this->extend('template/pageTemplate');
  } elseif ($_SESSION['logged_user']['role'] === '3') {
    $this->extend('template/clerkTemplate');
  }
?>

<?= $this->section('content');?>
    <div class="container-fluid" style="padding-bottom: 50px; padding-left:30px; padding-right: 30px;">
        <div class="heading text-center">
            <h1 style="font-size:5.8vmin; padding: 8rem 0 2rem;"> MONITOR PROGRESS </h1>
        </div>
        <div class="row">
            <div id="col-container" class="col-md-4">
                <div class="container-fluid" style="padding: 5%">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="titles">PROFESSORS</p>
                            <br>
                            <?php if(isset($profs)):?>
                                <?php foreach($profs as $prof):?>
                                    <div data-id="<?=$prof['id']?>" class="prof-names d-flex justify-content-center align-items-center">
                                        <p style="margin: 4% auto;"><?=strtoupper($prof['first_name']) . ' ' . strtoupper($prof['last_name'])?></p>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="piechart" class="detail-container"></div>
                <div class="detail-container subject-container d-none" style="background-color: transparent;">
                    <p class="titles">HANDLED SUBJECTS</p>
                    <div id="subjects">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>