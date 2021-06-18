<?= $this->extend('template/default');?>

<?= $this->section('content');?>
    <div class="container-fluid" style="padding:10px; min-height:100vh;">
        <div class="heading text-center">
            <h1 style="margin-top: 5.2rem; margin-bottom: -3%;"> An email has been sent to verify this activity. <h1>
            <h2 style="color:grey"> You have 30 minutes before the verification email will expire. <h2>
            <br><br>
            <a href="<?=base_url();?>/dashboard/logout"><button class="button" style="height:50px; font-size: 15px; border-radius:2rem;">Cancel Verification</button></a> 
        </div>    
    </div> 
<?= $this->endSection();?>