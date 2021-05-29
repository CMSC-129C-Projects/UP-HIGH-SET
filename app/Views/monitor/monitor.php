<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <div class="container-fluid" style="padding: 2%;">
        <div class="row">
            <div id="col-container" class="col-md-6">
                <div class="container-fluid" style="padding: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="font-weight: bold; font-size: 2rem; color: #7b1113;;">Professors Not Completed</p>
                            <div class="prof-names d-flex justify-content-center align-items-center">
                                <p style="margin: 2% auto;">Basadre</p>
                            </div>
                            <div class="prof-names d-flex justify-content-center align-items-center">
                                <p style="margin: 2% auto;">Laus</p>
                            </div>
                            <div class="prof-names d-flex justify-content-center align-items-center">
                                <p style="margin: 2% auto;">Bondoc</p>
                            </div>
                            <div class="prof-names d-flex justify-content-center align-items-center">
                                <p style="margin: 2% auto;">Vilbar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="piechart" style="box-shadow: 0 0 1rem #333;"></div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>