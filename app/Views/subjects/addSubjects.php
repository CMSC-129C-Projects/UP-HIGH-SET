<?=$this->extend('template/pageTemplate');?>

<?=$this->section('content');?>
    <?php if(isset($message)):?>
        <div id="bg-modal" class="black-modal-email">
            <div id="content-modal" class="customModal-email horizontalCenter verticalCenter">
                <div class="mdl-content">
                    <?php if($message):?>
                        <p>Subject added successfully</p>
                    <?php else:?>
                        <p>An error has occurred</p>
                    <?php endif;?>
                    <div class="btn-delete">
                        <button id="dontDelete">Dismiss</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <section style="width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-dark text-white" style="padding: 30px; width: 60%; margin: auto;">
                        <form action="<?=base_url();?>/subjects/add_subject" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profs">Professors</label>
                                        <select class="form-control" name="professors" id="profs">
                                            <?php foreach($profs as $p):?>
                                                <option value="<?=$p['id'];?>"><?=$p['first_name'].' '.$p['last_name'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Subject Title</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                        <span><?=displaySingleError($validation, 'name');?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="float: right;">
                                        <input type="submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?=$this->endSection();?>