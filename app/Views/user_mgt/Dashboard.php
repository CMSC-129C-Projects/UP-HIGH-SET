<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <section class="Dashboard" style="margin: auto;">
        <!-- INSERT CONTENT HERE -->
        <section id="Contents"> -->
            <div class="row-md-6 align-text-center">
                <div class="welcomeMsg">
                    <img src="public/Welcome Message.png" class="img-fluid" alt="Responsive image">
                </div>
            </div>
            <!-- <div id="statistics">
                <div class="row">
                    <div class="col-12">
                        <div class="card1">
                            <div class="card-body" style="padding:2rem; text-align:center;">
                                <p>EVALUATION STATUS OVERVIEW</p>
                                <p>START DATE ---- END DATE</p>
                                <p>Student Finished / Student Overall
                            </div>
                        </div>
                    </div>
                </div> -->
        </section>
    </section>
<?= $this->endSection();?>
