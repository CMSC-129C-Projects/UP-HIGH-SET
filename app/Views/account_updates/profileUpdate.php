<?php if ($role === '1'):?>
    <?= $this->extend('template/pageTemplate');?>
<?php else:?>
    <?= $this->extend('template/studentTemplate');?>
<?php endif;?>

<?= $this->section('content');?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <span style="display: none;" id="status" data-status="<?=$status?>"></span>
    
    <div id="myModal" class="custom-modal">
        <!-- Modal content -->
        <div class="m-content">
            <span class="close">&times;</span>
            <select class="image-picker show-html" id="avatars" name="image_list">
                <option data-img-src="<?=base_url();?>/public/images/avatars/hacker.png" value="/public/images/avatars/hacker.png">Hacker</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/woman.png" value="/public/images/avatars/woman.png">Woman</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/ninja.png" value="/public/images/avatars/ninja.png">Ninja</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/businesswoman.png" value="/public/images/avatars/businesswoman.png">Business Woman</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/burglar.png" value="/public/images/avatars/burglar.png">Burglar</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/soldier.png" value="/public/images/avatars/soldier.png">Soldier</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/rasta.png" value="/public/images/avatars/rasta.png">Rasta</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/rapper.png" value="/public/images/avatars/rapper.png">Rapper</option>
            </select>
        </div>
    </div>

    <section class="profileupdate" style="margin: auto; padding-bottom: 10vh;">
        <div class="container" >
            <div class="row">
                <div class="col-sm-10"><h2><?=$lName;?>, <?=$fName;?></h2></div>
            </div>
            <div class="row">
                <div class="col-sm-3 custom"><!--left col-->
                    <div class="text-center" style="align-items:center;">
                        <img src='<?=base_url() . $avatar_url;?>' id="selected_avatar" style="margin-top:2rem;" class="text-center">
                        <button type="changeAvatar" id="myBtn" class="text-center">Change Avatar</button>
                    </div>
                    </hr>
                    <br>
                </div><!--/col-3-->
                <div class="col-sm-9 align">
                    <div class="tab-content">              
                        <hr>
                        <form class="form" action="<?=base_url();?>/profile/student" method="post" id="registrationForm">
                            <input type="hidden" name="avatar" value="<?=set_value('avatar', $avatar_url);?>">
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
                                    <p style="float:right; position:relative; top:4.9rem; right:1rem; color:black; font-size:2.1vmin; ">@up.edu.ph</p>
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
                                   
                                   
                                    <button type="button" id="changePass" style="width: 15rem; margin-top: 42px;">Change Password</button>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-xs-6">
                                    
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                   
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                    <button type="button" class="btn btn-lg cancel"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
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
