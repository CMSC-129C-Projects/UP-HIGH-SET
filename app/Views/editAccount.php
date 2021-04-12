<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <?php if(isset($status) && $status):?>
        <div id="bg-modal" class="black-modal-email">
            <div id="content-modal" class="customModal-email horizontalCenter verticalCenter">
                <div class="mdl-content">
                    <p>User updated successfully!</p>
                    <div class="btn-delete">
                        <button id="dontDelete">Dismiss</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <section id="register" class="container-fluid">
        <div class="heading text-center">
            <h1>Registration Form</h1>
        <div>
        <div class="row justify-content-center">
            <ul class="nav nav-tabs">
                <?php if($role == 'admin'):?>
                    <li class="nav-item">
                        <a href="#Admin" class="nav-link active" data-toggle="tab" id="btn-admin"><input type="button" value="Admin"></a>
                    </li>
                <?php elseif($role == 'student'):?>
                    <li class="nav-item">
                        <a href="#Student" class="nav-link active" data-toggle="tab" id="btn-student"><input type="button" value="Student"></a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
        <div class="tab-content">
            <?php if($role == 'admin'):?>
                <div class="tab-pane fade show active" id="Admin">
                    <div class="row justify-content-center">
                        <form action="<?=base_url()?>/update/edit/admin/<?=$id;?>" method="post" class="edit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="adminFirstName" value="<?=set_value('adminFirstName', $fN);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'adminFirstName');?></span>
                                            <h3>First Name</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="adminLastName" value="<?=set_value('adminLastName', $lN);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'adminLastName');?></span>
                                            <h3>Last Name</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="adminUserName" value="<?=set_value('adminUserName', $uN);?>">
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'adminUserName');?></span>
                                            <h3>User Name</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="adminContactNum" value="<?=set_value('adminContactNum', $cN);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'adminContactNum');?></span>
                                            <h3>Contact Number</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-md-4">
                                <div class="mailBox">
                                    <div class="inputBox">
                                        <input type="email" name="adminEmail" value="<?=set_value('adminEmail', $eml);?>" required>
                                        <br>
                                        <span class="text-danger"><?=displaySingleError($validation, 'adminEmail');?></span>
                                        <h3>Email</h3>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="update">
                            <button onclick="window.location.href='<?=base_url();?>/update/admin';" id="cancel" type="button" name="cancel">Cancel</button>
                        </form>
                    </div>
                </div>
            <?php elseif($role == 'student'):?>
                <div class="tab-pane fade show active" id="Student">
                    <div class="row justify-content-center">
                        <form action="<?=base_url()?>/update/edit/student/<?=$id;?>" method="post" class="edit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="studFirstName" value="<?=set_value('studFirstName', $fName);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'studFirstName');?></span>
                                            <h3>First Name</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name= "studLastName" value="<?=set_value('studLastName', $lName);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'studLastName');?></span>
                                            <h3>Last Name</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="studNum" value="<?=set_value('studNum', $sNo);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'studNum');?></span>
                                            <h3>Student Number</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="studUserName" value="<?=set_value('studUserName', $uName);?>">
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'studUserName');?></span>
                                            <h3>User Name</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="gradeLevel" value="<?=set_value('gradeLevel', $glevel);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'gradeLevel');?></span>
                                            <h3>Grade Level</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="studContactNum" value="<?=set_value('studContactNum', $cn);?>">
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'studContactNum');?></span>
                                            <h3>Contact Number</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-md-4">
                                <div class="mailBox">
                                    <div class="inputBox">
                                        <input type="email" name="studEmail" value="<?=set_value('studEmail',$email);?>" required>
                                        <br>
                                        <span class="text-danger"><?=displaySingleError($validation, 'studEmail');?></span>
                                        <h3>Email</h3>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="update">
                            <button onclick="window.location.href='<?=base_url();?>/update/student';" id="cancel" type="button" name="cancel">Cancel</button>
                        </form>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </section>
<?= $this->endSection();?>

<!-- <style media="screen">
  form.edit {
    padding: 2.75rem 1.50rem !important;
  }
</style> -->
