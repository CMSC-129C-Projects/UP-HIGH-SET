<?= $this->extend('pageTemplate');?>

<?= $this->section('content');?>
  <section id="register" class="container-fluid">
    <div class="heading text-center">
      <h1>Registration Form</h1>
    <div>

    <div class="row justify-content-center">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#Admin" class="nav-link active" data-toggle="tab" id="btn-admin"><input type="button" value="Admin"></a>
        </li>
        <li class="nav-item">
          <a href="#Student" class="nav-link" data-toggle="tab" id="btn-student"><input type="button" value="Student"></a>
        </li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="Admin">
        <div class="row justify-content-center">
          <form id="admin-form" data-type='<?=$type;?>'>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                    <input type="text" name="adminFirstName" required>
                    <span class="text-danger"><?=displaySingleError($validation, 'adminFirstName');?></span>
                    <h3>First Name</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                    <input type="text" name="adminLastName" required>
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
                    <input type="text" name="adminUserName" required>
                    <span class="text-danger"><?=displaySingleError($validation, 'adminUserName');?></span>
                    <h3>User Name</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                    <input type="text" name="adminContactNum" required>
                    <span class="text-danger"><?=displaySingleError($validation, 'adminContactNum');?></span>
                    <h3>Contact Number</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row-md-4">
              <div class="mailBox">
                <div class="inputBox">
                  <input type="email" name="adminEmail" required>
                  <span class="text-danger"><?=displaySingleError($validation, 'adminEmail');?></span>
                  <h3>Email</h3>
                </div>
              </div>  
            </div>
            <input type="submit" value="send">
          </form>
        </div> 
      </div>
      <div class="tab-pane fade" id="Student">
        <div class="row justify-content-center">
          <form id="student-form" data-type='<?=$type;?>'>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="studFirstName" value="<?=set_value('studFirstName', $fName);?>" required>
                      <span class="text-danger"><?=displaySingleError($validation, 'studFirstName');?></span>
                      <h3>First Name</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name= "studLastName" value="<?=set_value('studLastName', $lName);?>" required>
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
                      <span class="text-danger"><?=displaySingleError($validation, 'studNum');?></span>
                      <h3>Student Number</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="studUserName" value="<?=set_value('studUserName', $uName);?>" required>
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
                    <span class="text-danger"><?=displaySingleError($validation, 'gradeLevel');?></span>
                    <h3>Grade Level</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                    <input type="text" name="studContactNum" value="<?=set_value('studContactNum', $cn);?>" required>
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
                    <span class="text-danger"><?=displaySingleError($validation, 'studEmail');?></span>
                    <h3>Email</h3>
                </div>
              </div>  
            </div>
            <input type="submit" value="send">
          </form>
        </div> 
      </div>      
    </div>
  </section>
<?= $this->endSection();?>