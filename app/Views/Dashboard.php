<?= $this->extend('pageTemplate.php');?>
namespace App\Views;

<?= $this->section('content');?>
    <body>

    
    <section class="Dashboard">
        
    <div class="wrapper d-flex align-items-stretch">    
                <!-- Sidebar Holder -->
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h3>Profile Diri</h3>
                    </div>

                    <ul class="list-unstyled components">
                        <p>Some Chuchu</p>
                        <li class="active">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li><a href="#">Home 1</a></li>
                                <li><a href="#">Home 2</a></li>
                                <li><a href="#">Home 3</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">About</a>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li><a href="#">Page 1</a></li>
                                <li><a href="#">Page 2</a></li>
                                <li><a href="#">Page 3</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Portfolio</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>

                    <ul class="list-unstyled CTAs">
                        <li><a href="#" class="download">Print Evaluation Status</a></li>
                       
                    </ul>
                </nav>

                <!-- Page Content Holder -->
            
                    <div class="navIcon">
                
                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn" >
                            <i class="bi bi-list fa-2x"></i>
                                
                            </button>
                        </div>
                    </div>     
                        <!-- INSERT CONTENT HERE -->
                    
                        <section id="Contents">
                            <div class="row-md-6 align-text-center">
                                <div class="welcomeMsg">
                                   
                                    <img src="public/Dashboard Design.png" class="img-fluid" alt="Responsive image">
                                </div>
                            </div>

                            <div class="adminDashboardButtons">
                                
                                <nav class="nav">
                                <a class="nav-link active" href="#"><input type="button" value="Add User" name="addUser"></a>
                                <a class="nav-link" href="#"><input type="button" value="Evaluation Status" name="setEvalPeriod"></a>
                                <a class="nav-link" href="#"><input type="button" value="Remove User" name="removeUser  "></a>
                                
                                </nav>
                                
                            </div>
                        </section>
                    </div>    
                    

                                
                    
            </div>

       
            
</section>
       


       


        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                    
                     $('#sidebar').toggleClass('active');
                     
                 });
             });
         </script>
    </section>
<?= $this->endSection();?>