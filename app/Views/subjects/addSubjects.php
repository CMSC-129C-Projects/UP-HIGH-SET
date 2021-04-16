<?=$this->extend('template/pageTemplate');?>

<?=$this->section('content');?>
    <section style="width: 100%;">
        <div class="container">
            <div class="row">
                <div class="bg-dark text-white" style="padding: 30px; width: 60%; margin: auto;">
                    <form action="<?=base_url();?>/subjects/add_subject" method="post">
                        <div class="form-group">
                            <label for="profs">Professors</label>
                            <select class="form-control" name="professors" id="profs">
                                <option value="1">Tony Stark</option>
                                <option value="2">Roberto Basadre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gl">Grade Level</label>
                            <select class="form-control" name="gLevel" id="gl">
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject Title</label>
                            <input type="text" name="name" class="form-control" id="name">
                            <span><?=displaySingleError($validation, 'name');?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?=$this->endSection();?>