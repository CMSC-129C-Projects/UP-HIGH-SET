<?= $this->extend('Dashboard');?>

<?= $this->section('accRegContent');?>
  <section id="register" class="container-fluid">
    <div class="heading text-center">
      <h1>Registration Form</h1>
    <div>

    <div class="row-md-6">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#Admin" class="nav-link" data-toggle="tab"><input type="button" value="Admin" name="Admin"></a>
        </li>
        <li class="nav-item">
          <a href="#Student" class="nav-link" data-toggle="tab"><input type="button" value="Student" name="Student"></a>
        </li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="Admin">
        <div class="row justify-content-center">
          <form action="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="adminFirstName" required>
                      <h3>First Name</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="adminLastName" required>
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
                      <h3>User Name</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="adminContactNum" required>
                      <h3>Contact Number</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row-md-4">
              <div class="mailBox">
                <div class="inputBox">
                    <input type="email" name="adminEmail" required>
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
          <form action="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="studFirstName" required>
                      <h3>First Name</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name= "studLastName" required>
                      <h3>Last Name</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="studNum" required>
                      <h3>Student Number</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                      <input type="text" name="studUserName" required>
                      <h3>User Name</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                    <input type="text" name="gradeLevel" required>
                    <h3>Grade Level</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="inputBox">
                    <input type="text" name="studContactNum" required>
                    <h3>Contact Number</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row-md-4">
              <div class="mailBox">
                <div class="inputBox">
                    <input type="email" name="studEmail" required>
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