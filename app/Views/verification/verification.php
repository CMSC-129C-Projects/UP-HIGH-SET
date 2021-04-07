<?= $this->extend('template/default');?>

<?= $this->section('content');?>
    <div style="height: 100vh;">
        <a href="<?=base_url();?>/dashboard/logout"><button class="btn btn-primary" style="position: relative; top: 20vh; left: 50%; transform: translateX(-50%);">Cancel Verification</button></a>
    </div>
<?= $this->endSection();?>