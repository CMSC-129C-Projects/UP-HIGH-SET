<?= $this->extend('template/pageTemplate.php');?>


<?= $this->section('content');?>
    <body>


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

                        <div class="logout">
                            <a class="nav-link" id="logout" href="#"><input type="button" value="LOGOUT" name="logOut"></a>
                        </div>

                    </ul>
                </nav>

                <!-- Page Content Holder -->

                    <div class="navIcon">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
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

                            <div class="studentDashboardButtons">

                                <nav class="nav">

                                <a class="nav-link" href="#"><input type="button" value="Evaluate" name="evaluate"></a>


                                </nav>

                            </div>

                            <?= $this->renderSection('content');?>
                        </section>
                    </div>




            </div>



</section>








         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {

                     $('#sidebar').toggleClass('active');

                 });
             });
         </script>
    </section>
<?= $this->endSection();?>
