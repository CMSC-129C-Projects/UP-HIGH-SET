<?=$this->extend('template/pageTemplate');?>

<?=$this->section('content');?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <?php foreach($subjects as $s):?>  
                        <li class="alert-success"><h1><?=$s['name'];?></h1></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
<?=$this->endSection();?>