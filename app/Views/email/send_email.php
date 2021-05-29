<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>

<?php if(isset($status)):?>
    <div id="bg-modal" class="black-modal-email">
      <div id="content-modal" class="customModal-email horizontalCenter verticalCenter">
        <div class="mdl-content">
          <?php if($status):?>
            <p>Email content updated succesfully</p>
          <?php else:?>
            <p>Error on Update. Please try again</p>
          <?php endif;?>
          <div class="btn-delete">
            <button id="dontDelete">Dismiss</button>
          </div>
        </div>
      </div>
    </div>
  <?php endif;?>

  <div class="container-fluid">
    <div class="heading text-center">
      <h1 style= "padding:4.7rem;">Update Email Content</h1>
    </div>

    <div id="EmailContent">
    <div class="card">
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="email-subject" style="margin-top: 1rem; font-size:15px; margin-bottom:7px"> Email Subject</label>
            <input type="text" class="form-control" name = 'email_subject' id="email-subject" value="<?=set_value('email_subject')?>" placeholder="Enter Email subject here ...">
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_subject');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="email-content" style="font-size:15px; margin-bottom:7px">Email Content</label>
            <textarea class="form-control" name="email_content" id="email-content" value="<?=set_value('email_content')?>" rows="7" placeholder="Email notification content ..."></textarea>
            <br>
            <span class="text-danger"><?=displaySingleError($validation, 'email_content');?></span>
          </div>
          <br>
          <div class="form-group">
            <label for="purpose" style="font-size:15px;">Email Purpose :</label>
            <select class="custom-select">
              <option selected>Select...</option>
              <option value="announcement">Announcement</option>
              <option value="registration">Registration</option>
              <option value="evaluation">Evaluation</option>
              <option value="change_pass">Change Password</option>
              <option value="forgot_pass">Forgot Password</option>
              <option value="verification">Verification</option>
            </select>
            </div>
            <br><br>  
            <p style="font-size:13px">Attachment is Optional</p>
            <input type="file" style="border-bottom-style: hidden !important" name="attachment[]" value="" >
            <br><br>
            <input type="submit" style="border-bottom-style: hidden !important; border-radius: 2rem !important" value="update">
            <small style="float: right;"><a href="#" data-toggle="modal" data-target="#subModal">Submission Modal</a></small>
          </form>
          </div>
        </div>
      </div>
  </div>
  </div>

  <div id="submitModal">
  <div class="modal fade" id="subModal"  role="dialog" position="default">
      <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background: transparent;">

        <div class="modal-header">
          <h2 style="color: #e9dbc1">Submit Your Evaluation Form</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>

        <div class="modal-body" style="padding: 25px;">
          <i style="font-size: 12px;"> Please double-check your answers before submitting this form. Your review will be unmodifiable after submission. </i>
          <br><br>
          <div class="row" style="background-color:#7b1113;">
            <p style="font-size: 15px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">Instructional Skills</p>
          </div>
          <div class="row" style="margin-top: 3px;">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113; padding-top: 3px;"> Has mastery of the subject matter. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Explains clearly course objectives and expectations. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Discusses subject matter clearly and systematically. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Provides in-depth treatment of subject matter. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Relates course to other fields and present-day problems. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Uses effective teaching techniques, considering the total capacity of the students. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Encourages and respects new ideas and students' viewpoints. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div> 
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Stimulates students' desires to learn more about the subject. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div> 
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Gives challenging examinations and asks questions that require analysis. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Expresses and communicates effectively. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>  
          <div class="row" style="background-color:#7b1113;">
            <p style="font-size: 15px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;"> Class Management</p>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113; padding-top: 3px;"> Corrects and gives results and feedback of examinations and/or other work within reasonable time. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Uses students' achievements as basis of grades. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Maintains good conduct of students in class.  </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Comes to class on time. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Attends class regularly. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Maximizes class hour for learning. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Treats students equally and fairly; shows no favoritism. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Firm and consistent, strict but reasonable in disciplining students. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Encourages students to do their best to develop their potentials </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Gives and explains assignments. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row" style="background-color:#7b1113;">
            <p style="font-size: 15px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">Personal Qualities</p>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113; padding-top: 3px;"> Has high intellectual standard. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Is ethical or moral in the performance of his/her official duties. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Observe university regulations. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Has dedication/sense of commitment. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Admits mistakes and accepts constructive criticism. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Mentally alert and enthusiastic. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Employs wit and has keen sense of humor when the situation demands. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Is approachable and pleasant. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Maintains poise or calm in different situations. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Keeps individual and/or group appointments. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row" style="background-color:#7b1113;">
            <p style="font-size: 15px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;"> Student-Faculty Relations </p>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113; padding-top: 3px;"> Maintains cordial but professional relations with students. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Encourages and makes himself/herself available for consultation. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Elicits positive reactions from students. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Shows enthusiasm for and interest in student campus life. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Performs duties and responsibilities in school. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row" style="background-color:#7b1113;">
            <p style="font-size: 15px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">General Evaluation</p>
          </div>
          <div class="row">
            <div class="col-7" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113; padding-top: 3px;"> Taking into account instructional skills, class management, personal qualities, and student-faculty relations. Please rate your teacher on a scale of 1 to 5 with 5 as excellent. </p>
            </div>
            <div class="col-5" style="margin-top: 6px;">
                <li>
                  <i style="font-size: 12px;"> Excellent </i>
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Excellent" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Very Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Good" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Fair" onclick="CheckIt(this)">
                </li>
                <li>
                  <input type="radio" name="instSkill1" value="Poor" onclick="CheckIt(this)">
                </li>
                <li>
                  <i style="font-size: 12px;"> Poor </i>
                </li>
            </div>
          </div>
          <div class="row" style="background-color:#7b1113;">
            <p style="font-size: 15px; color: #e9dbc1; padding-left:10px; margin-top:5px; margin-bottom: 3px;">Additional Comments</p>
          </div>
          <div class="row">
            <div class="col-5" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113; padding-top: 3px;"> My teacher's strong points are: </p>
            </div>
            <div class="col-7" style="margin-top: 3px;">
                <textarea class="form-control" style="font-size: 12px;" rows="3" placeholder="Sample Text" readonly></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-5" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> My teacher's weak points are: </p>
            </div>
            <div class="col-7" style="margin-top: 3px;">
                <textarea class="form-control" style="font-size: 12px;" rows="3" placeholder="Sample Text" readonly></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-5" style="margin-top: 3px;">
              <p style="font-size: 12px; color: #7b1113;"> Recommendations for improvement:  </p>
            </div>
            <div class="col-7" style="margin-top: 3px;">
                <textarea class="form-control" style="font-size: 12px;" rows="3" placeholder="Sample Text" readonly></textarea>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4">
              <div style="text-align: center;">
                <input type="button" class="button"  style="border-radius: 2rem !important; margin-top: 20px; width: 100%;" data-dismiss="modal" value="Modify">
              </div>
            </div>
            <div class="col-4">
              <div style="text-align: center;">
                <input type="button" class="button"  style="border-radius: 2rem !important; margin-top: 20px; width: 100%;" data-dismiss="modal" value="Submit">
              </div>
            </div>
            <div class="col-4">
              <div style="text-align: center;">
                <input type="button" class="button"  style="border-radius: 2rem !important; margin-top: 20px; width: 100%;" data-dismiss="modal" value="Close">
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
  </div>
  </div>

  <script>
    AllowChecks = false;
    function CheckIt(X){
      if(!AllowChecks)X.checked=false;
    }
  </script>

<?= $this->endSection();?>