<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <?php if(isset($emailStatus)):?>
    <div id="bg-modal" class="black-modal-email">
      <div id="content-modal" class="customModal-email horizontalCenter verticalCenter">
        <div class="mdl-content">
          <?php if($emailStatus):?>
            <p>User has been added. Email sent successfully</p>
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
  <section id="register" class="container-fluid">
    <div class="heading text-center" style="margin-bottom: 2.5rem !important;">
      <h1 style="padding: 4.7rem;">User Registration</h1>
    <div>

    <div class="tabs">
      <div class="tab-content" style="border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;">
        <div class="row-md-6">
          <ul class="nav nav-tabs">
            <?=setFormBasedOnRole($role);?>
          </ul>
        </div>
        <?php if(isset($role) && $role === 'student'):?>
          <div class="tab-pane fade" id="Admin">
        <?php else:?>
          <div class="tab-pane fade active show" id="Admin">
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
                      <input type="email" name="adminEmail" value="<?=set_value('adminEmail');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'adminEmail');?></span>
                      <h3>Email</h3>
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
              <input type="submit" value="submit">
              <button onclick="window.location.href='<?=base_url();?>/update/admin';" id="cancel" type="button" name="cancel">Cancel</button>
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
                    
                    <select class="form-select" aria-label="Grade Level">
                      <option selected>Grade Level</option>
                      <option value="1">Grade 7</option>
                      <option value="2">Grade 8</option>
                      <option value="3">Grade 9</option>
                      <option value="1">Grade 10</option>
                      <option value="2">Grade 11</option>
                      <option value="3">Grade 12</option>
                    </select>
                
                    
                  </div>
                </div>
              </div>

              <div class="row-md-4">
                <div class="mailBox">
                  <div class="inputBox">
                  
                      <input type="email" name="studEmail" value="<?=set_value('studEmail');?>" required>
                      <br>
                      <span class="text-danger"><?=displaySingleError($validation, 'studEmail');?></span>
                      <h3>Email</h3>
                  </div>

                </div>
                
              </div>
              
              <input type="submit" value="submit">
              <button onclick="window.location.href='<?=base_url();?>/update/student';" id="cancel" type="button" name="cancel">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection();?>
