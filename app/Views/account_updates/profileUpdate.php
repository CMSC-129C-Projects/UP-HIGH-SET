<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <section class="profileupdate" style="margin: auto; margin-top:50px; martin-bottom:50px;">
        <div class="container" >
            <div class="row">
                <div class="col-sm-10"><h2>LASTNAME, FIRSTNAME MIDDLENAME</h2></div>
            </div>
            <div class="row">
                <div class="col-sm-3"><!--left col-->
                    <div class="text-center">
                        <img src='https://avataaars.io/?avatarStyle=Circle&topType=LongHairStraight&accessoriesType=Blank&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light'>
                        <button type="changeAvatar" id="change_avatar">Change Avatar</button>
                    </div>
                    </hr>
                    <br>        
                    <!-- <div class="panel panel-default" id="privacyStatement">
                        <div class="panel-heading text-center">Privacy Notice <i class="fa fa-link fa-1x"></i></div>
                        <div class="panel-body"></div>
                    </div> -->
                </div><!--/col-3-->
                <div class="col-sm-9">
                    <div class="tab-content">              
                        <hr>
                        <form class="form" action="<?=base_url();?>/profile" method="post" id="registrationForm">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="first_name"><h4>First name</h4></label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?=set_value('first_name', $fName);?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="last_name"><h4>Last name</h4></label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"   value="<?=set_value('last_name', $lName);?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="studentNumber"><h4>Student Number</h4></label>
                                    <input type="text" class="form-control" name="studentNumber" id="studentNumber" value="<?=set_value('studentNumber', $sNo);?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="grade_level"><h4>Grade Level</h4></label>
                                    <input type="text" class="form-control" name="grade_level" id="grade_level" value="<?=set_value('grade_level', $glevel);?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email"><h4>Email</h4></label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?=set_value('email', $email);?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="mobile"><h4>Mobile</h4></label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number" value="<?=set_value('mobile', $cn);?>">
                                    <span class="text-danger"><?=displaySingleError($validation, 'mobile');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="username"><h4>Username</h4></label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?=set_value('username', $uName);?>">
                                    <span class="text-danger"><?=displaySingleError($validation, 'username');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="password"><h4>Password</h4></label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="color:#7b1113"></span>
                                    <input type="password" class="form-control" name="password" id="pass_log_id" value="Show PW Here" disabled>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-xs-6">
                                    
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button type="changePW" style="float: right; margin: 0;">Change</button>
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                    <button type="button" class="btn btn-lg cancel"><i class="glyphicon glyphicon-repeat"></i> Cancel</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div><!--/tab-content-->
                </div><!--/col-9-->
            </div><!--/row-->
        </div>  
    </section>
<?= $this->endSection();?>                                                 
