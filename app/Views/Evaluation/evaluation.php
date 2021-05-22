<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
 <head>
 <link href="<?=base_url()?>/public/css/custom/eval.css" rel="stylesheet">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
   

  <section id="evaluation" class="container-fluid">
    <div class="heading text-center" style="margin-bottom: 2.5rem !important;">
      <h1>EVALUATION</h1>
    </div>

    <div class="tabs">
        
                <!-- <div class="row"> -->

                    <ul class="row nav nav-tabs tab-content">
                            <li class="nav-item col-md-2 btncat"style="width:100%;">
                                <a href="#instSkill" class="nav-link"  data-toggle="tab" id="btn-instructionalSkills"><button type="button" class="evalbtn">Instructional <br> Skills</button></a>
                            </li>
                            <li class="nav-item col-md-2 btncat" style="width:100%;">
                                <a href="#classmgt" class="nav-link " data-toggle="tab" id="btn-classManagement"><button type="button" class="evalbtn">Class <br> Management</button></a>
                            </li>
                            <li class="nav-item col-md-2 btncat" style="width:100%;">
                                <a href="#personalQualities" class="nav-link " data-toggle="tab" id="btn-personalQualities"><button type="button" class="evalbtn">Personal<br>Qualities</button></a>
                            </li>
                            <li class="nav-item col-md-2 btncat" style="width:100%;">
                                <a href="#sfRelations" class="nav-link " data-toggle="tab" id="btn-sfRelations"><button type="button" class="evalbtn">Student-Faculty <br> Relation</button></a>
                            </li>
                            <li class="nav-item col-md-2 btncat" style="width:100%;">
                                <a href="#genEval" class="nav-link " data-toggle="tab" id="btn-sfRelations"><button type="button" class="evalbtn">General <br>Evaluation</button></a>
                            </li>
                            <li class="nav-item col-md-2 btncat" style="width:100%;">
                                <a href="#comments" class="nav-link " data-toggle="tab" id="btn-sfRelations"><button type="button" class="evalbtn">Additional <br> Comments</button></a>
                            </li>    
                    </ul>
                    <div class="container">
  
  <div class="progress tab-content">
    <div class="progress-bar progress-bar-striped progress-bar-animated">40%</div>
    </div>
  </div>
  <div class="savestatus tab-content">
    <p  class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Unsaved Changes</p>
</div>
              

                <!-- </div> -->
                <div class="row">
                <div class="tab-content col-md-offset-2">  
                <h1 class="likert-header">Please evaluate honestly</h1>     
                  <div class="tab-pane fade show active" id="instSkill">
                

                    <div class="wrap">
                     
                      <form action="">
                        <label class="statement">Has mastery of subject matter.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill1" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill1" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill1" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill1" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill1" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Explains clearly course objectives and expectations.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill2" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill2" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill2" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill2" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill2" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Discusses subect matter clearly and systematically.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill3" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill3" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill3" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill3" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill3" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Provides in-depth treatment of subject matter.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill4" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill4" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill4" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill4" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill4" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Relates course to other fields and present-day problems.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill5" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill5" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill5" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill5" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill5" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Uses effective teaching techniques, considering the total capacity of the students.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill6" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill6" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill6" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill6" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill6" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Encourages and respects new ideas and students' viewpoints.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill7" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill7" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill7" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill7" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill7" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Stimulates students' desires to learn more about the subject.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill8" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill8" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill8" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill8" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill8" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Gives challenging examinations and asks questions that require analysis.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill9" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill9" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill9" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill9" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill9" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                        <label class="statement">Expresses and communicates effectively.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="instSkill10" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill10" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill10" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill10" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="instSkill10" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                      </form>
                    </div> <!-- sa wrap -->
                  </div>


          <div class="tab-pane fade show" id="classmgt">
                

                  <div class="wrap">
                      
                      <form action="">
                        <label class="statement">Corrects and gives results and feedback of examinations and/or other work withiin reasonable time.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="classmgt1" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="classmgt1" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="classmgt1" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="classmgt1" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="classmgt1" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                      </form>
                  </div>
          </div>
          <div class="tab-pane fade show" id="personalQualities">
                

                  <div class="wrap">
                      
                      <form action="">
                        <label class="statement">Has high intellectual standard.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="personalQualities1" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="personalQualities1" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="personalQualities1" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="personalQualities1" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="personalQualities1" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                      </form>
                  </div>
          </div>
          <div class="tab-pane fade show" id="sfRelations">
                

                  <div class="wrap">
                      
                      <form action="">
                        <label class="statement">Maintains cordial but professional relations with students.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="sfRelations1" value="Excellent">
                            <label>Excellent</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Very Good">
                            <label>Very Good</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Good">
                            <label>Good</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Fair">
                            <label>Fair</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Poor">
                            <label>Poor</label>
                          </li>
                        </ul>
                      </form>
                  </div>
          </div>
          <div class="tab-pane fade show" id="genEval">
                

                  <div class="wrap">
                      
                      <form action="">
                        <label class="statement">Taking into account instructional skills,  class management,  personal qualities,  and student-faculty relations. <br>	Please rate your teacher by encircling, on a scale of 1 to 5 with 5 as excellent.												.</label>
                        <ul class='likert'>
                          <li>
                            <input type="radio" name="sfRelations1" value="Excellent">
                            <label>5</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Very Good">
                            <label>4</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Good">
                            <label>3</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Fair">
                            <label>2</label>
                          </li>
                          <li>
                            <input type="radio" name="sfRelations1" value="Poor">
                            <label>1</label>
                          </li>
                        </ul>
                      </form>
                  </div>
          </div>
          <div class="tab-pane fade show" id="comments">
              <div class="inputBox">
                <h2>My teacher's strong points are:</h2>
                <textarea required name="" id="" cols="100" rows="5"></textarea>
              </div>
              <div class="inputBox">
                <h2>My teacher's weak points are:</h2>
                <textarea required name="" id="" cols="100" rows="5"></textarea>
              </div>
              <div class="inputBox" style="margin-bottom:3.5rem;">
                <h2>Recommendation for improvement:</h2>
                <textarea required name="" id="" cols="100" rows="5"></textarea>
              </div>
              
          </div>
          
          
          
        </div> <!-- tab content-->
      </div> 
      
     <div class="arrowup">

      <a href="#"><i class="bi bi-arrow-up-square"></i></a>
    </div>
        <div class="row">
          <div class="buttons tab-content" style="">
            <button class="btn btn-lg btn-success" type="save"><i class="bi bi-check-circle"></i> Save</button>  
            <button type="button" class="btn btn-lg cancel"><i class="bi bi-x-circle"></i> Cancel</button>
            <button class="btn btn-lg btn-review" type="Review"> Review</button>  
          </div>
</div>

           
            
        


     </div> <!--Para sa tabs -->
    
</section>
<?= $this->endSection();?>
