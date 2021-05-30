<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <div class="container-fluid" style="padding: 2%;">
        <div class="row">
            <div id="col-container" class="col-md-6">
                <div class="container-fluid" style="padding: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="titles">Professors</p>
                            <?php if(isset($profs)):?>
                                <?php foreach($profs as $prof):?>
                                    <div data-id="<?=$prof['id']?>" class="prof-names d-flex justify-content-center align-items-center">
                                        <p style="margin: 2% auto;"><?=strtoupper($prof['first_name']) . ' ' . strtoupper($prof['last_name'])?></p>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="piechart" class="detail-container"></div>
                <div class="detail-container subject-container d-none" style="background-color: #ffffff;">
                    <p class="titles">Subjects Handled</p>
                    <div id="subjects">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>