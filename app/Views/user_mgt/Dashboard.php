<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <section class="Dashboard">
        <!-- INSERT CONTENT HERE -->
        <section id="Contents">
            <div class="row-md-6 align-text-center">
                <div class="welcomeMsg">

                    <img src="public/Welcome Message.png" class="img-fluid" alt="Responsive image">
                </div>
            </div>

            <div class="adminDashboardButtons">
                <nav class="nav">
                    <a class="nav-link" href="<?=base_url();?>/update/add"><input type="button" value="Add User" name="addUser"></a>
                    <a class="nav-link" href="#"><input type="button" value="Evaluation Status" name="setEvalPeriod"></a>
                    <div class="dropdown">
                        <a href="#" class="nav-link dropbtn" role="button"><input type="button" value="View Users" name="removeUser"></a>
                        <div class="dropdown-content">
                            <a class="dropdown-item" href="<?=base_url();?>/update/student"><input type="button" value="View Students"></a>
                            <a class="dropdown-item" href="<?=base_url();?>/update/admin"><input type="button" value="View Admins"></a>
                        </div>
                    </div>
                </nav>
            </div>
        </section>
    </section>
<?= $this->endSection();?>
