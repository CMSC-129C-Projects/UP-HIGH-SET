<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <span style="display: none;" id="status" data-status="<?=$status?>"></span>

  <section id="register" class="container-fluid">
    <div class="heading text-center" style="margin-bottom: 2.5rem !important;">
      <h1 style="padding: 8rem 0 2rem;">USER REGISTRATION</h1>
    <div>

    <div class="tabs">
      <div class="tab-content" style="border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;">
        <div class="row-md-6">
          <ul class="nav nav-tabs">
            <?=setFormBasedOnRole($role);?>
          </ul>
        </div>
        <?php if(!isset($roles) || (isset($role) && $role === 'admin')):?>
          <div class="tab-pane fade active show" id="Admin">
        <?php else:?>
          <div class="tab-pane fade" id="Admin">
        <?php endif;?>
          <div class="row justify-content-center ">
            <form action="<?=base_url()?>/update/add/admin" method="post" class="add">
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox fname">
                      <input type="text" name="adminFirstName" value="<?=set_value('adminFirstName');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'adminFirstName');?></span>
                      <h3>First Name</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox lname">
                      <input type="text" name="adminLastName" value="<?=set_value('adminLastName');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'adminLastName');?></span>
                      <h3>Last Name</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox uname">
                      <input type="text" name="adminEmail" value="<?=set_value('adminEmail');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'adminEmail');?></span>
                      <h3>Email</h3>
                      <h4> @up.edu.ph </h4>
                    </div>
                  </div>
                
                </div>
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox contactnum">
                      <input type="text" name="adminContactNum" value="<?=set_value('adminContactNum');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'adminContactNum');?></span>
                      <h3>Contact Number</h3>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit"><i class="bi bi-check-circle"></i> Submit</button>
              <button onclick="window.location.href='<?=base_url();?>/update/admin';" id="cancel" type="button" name="cancel"><i class="bi bi-x-circle"></i> Cancel</button>
            </form>
          </div>
        </div>

        <?php if(isset($role) && $role === 'clerk'):?>
          <div class="tab-pane fade active show" id="Clerk">
        <?php else:?>
          <div class="tab-pane fade" id="Clerk">
        <?php endif;?>
          <div class="row justify-content-center ">
            <form action="<?=base_url()?>/update/add/clerk" method="post" class="add">
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox fname">
                      <input type="text" name="clerkFirstName" value="<?=set_value('clerkFirstName');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'clerkFirstName');?></span>
                      <h3>First Name</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox lname">
                      <input type="text" name="clerkLastName" value="<?=set_value('clerkLastName');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'clerkLastName');?></span>
                      <h3>Last Name</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox uname">
                      <input type="text" name="clerkEmail" value="<?=set_value('clerkEmail');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'clerkEmail');?></span>
                      <h3>Email</h3>
                      <h4> @up.edu.ph </h4>
                    </div>
                  </div>
                
                </div>
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox contactnum">
                      <input type="text" name="clerkContactNum" value="<?=set_value('clerkContactNum');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'clerkContactNum');?></span>
                      <h3>Contact Number</h3>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit"><i class="bi bi-check-circle"></i> Submit</button>
              <button onclick="window.location.href='<?=base_url();?>/dashboard';" id="cancel" type="button" name="cancel"><i class="bi bi-x-circle"></i> Cancel</button>
            </form>
          </div>
        </div>


        <?php if(isset($role) && $role === 'student'):?>
          <div class="tab-pane fade active show" id="Student">
        <?php else:?>
          <div class="tab-pane fade" id="Student">
        <?php endif;?>
          <div class="row justify-content-center">
            <form action="<?=base_url()?>/update/add/student" method="post" class="add">
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox">
                        <input type="text" name="studFirstName" value="<?=set_value('studFirstName');?>" required>
                        <br>
                        <span class="text-danger"><?=displaySingleError($validation, 'studFirstName');?></span>
                        <h3>First Name</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox">
                        <input type="text" name= "studLastName" value="<?=set_value('studLastName');?>" required>
                        <br>
                        <span class="text-danger"><?=displaySingleError($validation, 'studLastName');?></span>
                        <h3 >Last Name</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox">
                        <input type="text" name="studNum" value="<?=set_value('studNum');?>" required>
                        <br>
                        <span class="text-danger"><?=displaySingleError($validation, 'studNum');?></span>
                        <h3>Student Number</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 half">
                  <div class="form-group">     
                    <select class="form-select" name="gradeLevel" aria-label="Grade Level">
                      <option value="0" selected>Grade Level</option>
                      <option value="7">Grade 7</option>
                      <option value="8">Grade 8</option>
                      <option value="9">Grade 9</option>
                      <option value="10">Grade 10</option>
                      <option value="11">Grade 11</option>
                      <option value="12">Grade 12</option>
                    </select>
                    <br>
                    <span class="text-danger"><?=displaySingleError($validation, 'gradeLevel');?></span>
                  </div>
                </div>

              </div>

              <!-- <div class="row-md-4">
                <div class="mailBox">
                  <div class="inputBox">
                  
                      <input type="text" name="studEmail" value="<?=set_value('studEmail');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'studEmail');?></span>
                      <h3>Email</h3>
                      <h4> @up.edu.ph </h4>
                  </div>

                </div>
                
              </div> -->
              <div class="row">
                <div class="col-md-6 half">
                  <div class="form-group">
                    <div class="inputBox uname">
                    <input type="text" name="studEmail" value="<?=set_value('studEmail');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'studEmail');?></span>
                      <h3>Email</h3>
                      <h4> @up.edu.ph </h4>
                    </div>
                  </div>
                 
                 

                
                </div>
                <div class="col-md-6 half">
                  <div class="form-group" style="margin-left:0%;">
                  <button type="submit"><i class="bi bi-check-circle"></i> Submit</button>
                  <button onclick="window.location.href='<?=base_url();?>/update/student';" id="cancel" type="button" name="cancel"><i class="bi bi-x-circle"></i> Cancel</button>
                  </div>
                </div>
              </div>
             
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection();?>
