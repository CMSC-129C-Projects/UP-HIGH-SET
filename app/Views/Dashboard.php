<?= $this->extend('pageTemplate');?>

<?= $this->section('content');?>
    <section class="Dashboard">
        <div class="wrapper d-flex align-items-stretch">    
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <div class="img bg-wrap text-center py-4" style="background-image: url(<?=base_url()?>public/samplecover.jpg);">
                        <div class="user-logo">
                            <img class="rounded-cricle" src="<?=base_url()?>/public/LogoCitronella.png">
                            <h3>CITRONELLA</h3>
                        </div>
                    </div>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="#"><i class="bi bi-person-circle"></i>  Profile</a>
                        <a href="#"><i class="bi bi-gear-wide-connected"></i>  Settings and Privacy</a>
                        <a href="#pageSubmenu"><i class="bi bi-house-fill"></i> Dashboard</a>
                        <a href="#"><i class="bi bi-zoom-in"></i> About</a>
                        <a href="#"><i class="bi bi-telephone-fill"></i> Contact</a>
                    </li>
                </ul>
                <ul class="list-unstyled CTAs">
                    <a class="nav-link" href="#"><input type="button" value=" View Report" name="viewResults"></a>
                    <a class="nav-link" href="#"><input type="button" value="Print Report" name="printReports"></a>
                    <div class="logout">
                        <a class="nav-link" id="logout" href="#"><input type="button" value="LOGOUT" name="logOut"></a>
                    </div>
                </ul>
            </nav>
            <!-- Page Content Holder -->
            <div class="navIcon">
                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="navbar-btn"89>
                    <i class="bi bi-list fa-2x"></i>
                        
                    </button>
                </div>
            </div>     
            <!-- INSERT CONTENT HERE -->
            <section id="Contents">
                <div class="row-md-6 align-text-center">
                    <div class="welcomeMsg">
                        
                        <img src="public/Welcome Message.png" class="img-fluid" alt="Responsive image">
                    </div>
                </div>

                <div class="adminDashboardButtons">
                    <nav class="nav">
                        <a class="nav-link active" href="<?=base_url();?>/update/add"><input type="button" value="Add User" name="addUser"></a>
                        <a class="nav-link" href="#"><input type="button" value="Evaluation Status" name="setEvalPeriod"></a>
                        <a class="nav-link" href="<?=base_url();?>/update"><input type="button" value="View Users" name="removeUser  "></a>
                    </nav>
                </div>
            </section>
        </div>   
    </section>
<?= $this->endSection();?>