<?= $this->extend('template/clerkTemplate');?>

<?= $this->section('content');?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <span style="display: none;" id="status" data-status="<?=$status?>"></span>

    <div id="myModal" class="custom-modal">
        <!-- Modal content -->
        <div class="m-content">
            <span class="close">&times;</span>
            <select class="image-picker show-html" id="avatars">
                <option data-img-src="<?=base_url();?>/public/images/avatars/hacker.png" value="1">Hacker</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/woman.png" value="2">Woman</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/ninja.png" value="3">Ninja</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/businesswoman.png" value="4">Business Woman</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/burglar.png" value="5">Burglar</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/soldier.png" value="6">Soldier</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/rasta.png" value="7">Rasta</option>
                <option data-img-src="<?=base_url();?>/public/images/avatars/rapper.png" value="8">Rapper</option>
            </select>
        </div>
    </div>

    <section class="profileupdate" style="margin: auto; padding-bottom: 10vh;">
        <div class="container" >
            <div class="row">
                <div class="col-sm-10"><h2>CLERK NAME HERE</h2></div>
            </div>
            <div class="row">
                <div class="col-sm-3 custom"><!--left col-->
                    <div class="text-center">
                        <img src='<?=base_url() . $avatar_url;?>' id="selected_avatar" style="margin-top:2rem;" >
                        <button type="changeAvatar" id="myBtn">Change Avatar</button>
                    </div>
                    </hr>
                    <br>
                </div><!--/col-3-->
                <div class="col-sm-9 align">
                    <div class="tab-content">              
                        <hr>
                        <form class="form" action="<?=base_url();?>/profile/clerk" method="post" id="registrationForm">
                            <input type="hidden" name="avatar" value="<?=set_value('avatar', $avatar_url);?>">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="first_name"><h4>First name</h4></label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?=set_value('first_name', $fN);?>" >
                                    <span class="text-danger"><?=displaySingleError($validation, 'first_name');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="last_name"><h4>Last name</h4></label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"  value="<?=set_value('last_name', $lN);?>">
                                    <span class="text-danger"><?=displaySingleError($validation, 'last_name');?></span>
                                </div>
                            </div>
                           
                           
                            <div class="form-group">
                                <div class="col-xs-6">
                                <p style="float:right; position:relative; top:4.9rem; right:1rem; color:black; font-size:2.1vmin; ">@up.edu.ph</p>
                                    <label for="email"><h4>Email</h4></label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?=set_value('email', $eml);?>">
                                    <span class="text-danger"><?=displaySingleError($validation, 'email');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="mobile"><h4>Mobile</h4></label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number" value="<?=set_value('mobile', $cN);?>">
                                    <span class="text-danger"><?=displaySingleError($validation, 'mobile');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="username"><h4>Username</h4></label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?=set_value('username', $uN);?>">
                                    <span class="text-danger"><?=displaySingleError($validation, 'username');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                   
                                   
                                    <button type="button" id="changePass" style="width: 15rem; margin-top: 42px;"><i class="bi bi-lock"></i> Change Password</button>
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
