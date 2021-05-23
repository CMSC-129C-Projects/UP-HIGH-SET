<?=$this->extend('template/pageTemplate');?>

<?=$this->section('content');?>
    <section class="profs">
        <div class="container" style="margin-top: 30px;">
            <div class="form-group form-inline">
                <i class="fa fa-search fa-2x"></i>
                <input type="text" name="search" placeholder="Search Professor" class="form-control">
            </div>
            <div class="row" id="prof-content">
            </div>
        </div>
    </section>
<?=$this->endSection();?>