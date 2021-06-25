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
            <h1 style="padding: 8rem 0 2rem;">REGISTRATION FORM</h1>
        <div>
        <div class="row justify-content-center">
            <ul class="nav nav-tabs">
                <?php if($role == 'admin'):?>
                    <li class="nav-item" style=" margin-left:0.9rem;">
                        <a href="#Admin" class="nav-link active" data-toggle="tab" id="btn-admin"><input type="button" value="Admin" style="background: #fff; color: #7b1113; text-transform: uppercase;"></a>
                    </li>
                <?php elseif($role == 'student'):?>
                    <li class="nav-item style=" margin-left:0.9rem;"">
                        <a href="#Student" class="nav-link active" data-toggle="tab" id="btn-student"><input type="button" value="Student" style="margin-left: 1px !important; background: #fff; color: #7b1113; text-transform: uppercase;"></a>
                    </li>
                <?php elseif($role == 'clerk'):?>
                <li class="nav-item style=" margin-left:0.9rem;"">
                    <a href="#Clerk" class="nav-link active" data-toggle="tab" id="btn-clerk"><input type="button" value="Clerk" style="margin-left: 1px !important; background: #fff; color: #7b1113; text-transform: uppercase;"></a>
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
                                          <input type="email" name="adminEmail" value="<?=set_value('adminEmail', explode('@', $eml)[0]);?>" required>
                                          <br>
                                          <span class="text-danger"><?=displaySingleError($validation, 'adminEmail');?></span>
                                          <h3>Email</h3>
                                          <h4> @up.edu.ph </h4>
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
                            <!-- <div class="row-md-4">
                                <div class="mailBox">
                                    <div class="inputBox">
                                        <input type="email" name="adminEmail" value="<?=set_value('adminEmail', $eml);?>" required>
                                        <br>
                                        <span class="text-danger"><?=displaySingleError($validation, 'adminEmail');?></span>
                                        <h3>Email</h3>
                                    </div>
                                </div>
                            </div> -->
                            <button type="submit"><i class="bi bi-check-circle"></i> Submit</button>
              <button onclick="window.location.href='<?=base_url();?>/update/admin';" id="cancel" type="button" name="cancel"><i class="bi bi-x-circle"></i> Cancel</button>
                        </form>
                    </div>
                </div>












<!-------------------------------------------  FOR CLERK -------------------------------------->




                <?php elseif($role == 'clerk'):?>
                <div class="tab-pane fade show active" id="clerk">
                    <div class="row justify-content-center">
                        <form action="<?=base_url()?>/update/edit/clerk/<?=$id;?>" method="post" class="edit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="clerkFirstName" value="<?=set_value('clerkFirstName', $fN);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'clerkFirstName');?></span>
                                            <h3>First Name</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="clerkLastName" value="<?=set_value('clerkLastName', $lN);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'clerkLastName');?></span>
                                            <h3>Last Name</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <div class="inputBox">
                                          <input type="email" name="clerkEmail" value="<?=set_value('clerkEmail', explode('@', $eml)[0]);?>" required>
                                          <br>
                                          <span class="text-danger"><?=displaySingleError($validation, 'clerkEmail');?></span>
                                          <h3>Email</h3>
                                          <h4> @up.edu.ph </h4>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="inputBox">
                                            <input type="text" name="clerkContactNumber" value="<?=set_value('clerkContactNumber', $cN);?>" required>
                                            <br>
                                            <span class="text-danger"><?=displaySingleError($validation, 'clerkContactNumber');?></span>
                                            <h3>Contact Number</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row-md-4">
                                <div class="mailBox">
                                    <div class="inputBox">
                                        <input type="email" name="adminEmail" value="<?=set_value('clerkEmail', $eml);?>" required>
                                        <br>
                                        <span class="text-danger"><?=displaySingleError($validation, 'clerkEmail');?></span>
                                        <h3>Email</h3>
                                    </div>
                                </div>
                            </div> -->
                            <button type="submit"><i class="bi bi-check-circle"></i> Submit</button>
              <button onclick="window.location.href='<?=base_url();?>/update/admin';" id="cancel" type="button" name="cancel"><i class="bi bi-x-circle"></i> Cancel</button>
                        </form>
                    </div>
                </div>






                
        
       




<!------------------------------------- FOR STUDENT --------------------------------------->




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
                                <div class="col-md-6 half">
                                    <div class="form-group">     
                                        <select class="form-select" name="gradeLevel" aria-label="Grade Level">
                                        <option value="0" <?=set_select('gradeLevel', 0)?>>Grade Level</option>
                                        <option value="7" <?=set_select('gradeLevel', 7, $glevel=='7')?>>Grade 7</option>
                                        <option value="8" <?=set_select('gradeLevel', 8, $glevel=='8')?>>Grade 8</option>
                                        <option value="9" <?=set_select('gradeLevel', 9, $glevel=='9')?>>Grade 9</option>
                                        <option value="10" <?=set_select('gradeLevel', 10, $glevel=='10')?>>Grade 10</option>
                                        <option value="11" <?=set_select('gradeLevel', 11, $glevel=='11')?>>Grade 11</option>
                                        <option value="12" <?=set_select('gradeLevel', 12, $glevel=='12')?>>Grade 12</option>
                                        </select>
                                        <br>
                                        <span class="text-danger"><?=displaySingleError($validation, 'gradeLevel');?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">

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
                            </div>-->
                            <div class="row-md-4">
                                <div class="mailBox">
                                    <div class="inputBox">
                                        <input type="email" name="studEmail" value="<?=set_value('studEmail', explode('@', $email)[0]);?>" required>
                                        <br>
                                        <span class="text-danger"><?=displaySingleError($validation, 'studEmail');?></span>
                                        <h3>Email</h3>
                                        <h4> @up.edu.ph </h4>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"><i class="bi bi-check-circle"></i> Submit</button>
                            <button onclick="window.location.href='<?=base_url();?>/update/admin';" id="cancel" type="button" name="cancel"><i class="bi bi-x-circle"></i> Cancel</button>
                        </form>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </section>
<?= $this->endSection();?>
