<?= $this->extend('template/clerkTemplate');?>

<?= $this->section('content');?>
    <span style="display: none;" id="notif" data-notif="<?=$notif?>"></span>
    <section class="Dashboard" style="margin: auto;">
        <!-- INSERT CONTENT HERE -->
        <section id="Contents">
            <div class="row-md-6 align-text-center">
                <div class="welcomeMsg">
                <img src="public/Welcome Message1.png" class="img-fluid image1" alt="Responsive image">
                    <img src="public/Welcome Message2.png" class="img-fluid image2" alt="Responsive image">
                </div>
            </div>
        </section>
    </section>
<?= $this->endSection();?>