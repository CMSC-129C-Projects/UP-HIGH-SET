<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UPSET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="<?=base_url('public/Logo.png');?>" type="image/x-icon">

    <link href="<?=base_url()?>/public/css/bootstrap-4.6.0/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/css/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/css/image-picker/image-picker.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/css/alertify/alertify.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/css/alertify/themes/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="<?=base_url()?>/public/css/custom/emailContent.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/css/custom/change_password.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <link href="<?=base_url()?>/public/css/custom/styles.css" rel="stylesheet">

    <?php if(isset($css)):?>
      <?=echoFiles($css);?>
    <?php endif;?>
  </head>
  <body>
    <!-- header section starts -->
    <section id="header">
      <div class="schoolWebsiteName">
          <a href="<?=base_url();?>"><img src="<?=base_url()?>/public/Logo.png"></a>
          <h1> University of the Philippines High School Cebu</h1>
          <h2> Student Evaluation for Teachers</h2>
      </div>
    </section>
    <!-- header section ends -->

    <!-- Sidebar Holder -->
    <div>
      <div class="d-flex" style="position: absolute; z-index: 1;">
        <nav id="sidebar" style="height: 109.5vh; overflow-y: scroll" class="active">
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
              <a href="<?=base_url('dashboard');?>"><i class="bi bi-house-fill"></i> Dashboard</a>
              <?php if ($_SESSION['logged_user']['role'] === '2'):?>
                <a href="<?=base_url();?>/profile/student"><i class="bi bi-person-circle"></i>  Profile</a>
              <?php else:?>
                <a href="<?=base_url();?>/profile/admin"><i class="bi bi-person-circle"></i>  Profile</a>
              <?php endif;?>
              <a href="#"><i class="bi bi-gear-wide-connected"></i>  Settings</a>
              <a href="#"><i class="bi bi-zoom-in"></i> About</a>
            </li>
          </ul>
          <ul class="list-unstyled components">
            <li class="active">
              <a href="#report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-journal-check"></i> Report</a>
              <ul class="collapse list-unstyled" id="report">
                <li>
                    <a href="#">View Report</a>
                </li>
                <li>
                    <a href="#">Print Report</a>
                </li>
              </ul>
              <a href="#evaluation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-pencil-square"></i> Evaluation</a>
              <ul class="collapse list-unstyled" id="evaluation">
                <li>
                  <a href="<?=base_url();?>/evaluation/set_status">Set Evaluation Status</a>
                </li>
                <li>
                  <a href="<?=base_url();?>/monitoring/monitor_progress">Monitor Progress</a>
                </li>
              </ul>
              <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-person-fill"></i> Users</a>
              <ul class="collapse list-unstyled" id="users">
                <li>
                  <a href="<?=base_url();?>/update/add" name="addUser">Add Users</a>
                </li>
                <li>
                  <a href="<?=base_url();?>/update/student">View Students</a>
                </li>
                <li>
                  <a href="<?=base_url();?>/update/admin">View Admin</a>
                </li>
              </ul>
              <a href="#facultyMembers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-person-fill"></i> Faculty Members</a>
              <ul class="collapse list-unstyled" id="facultyMembers">
                <li>
                  <a href="<?=base_url()?>/professors">View Professors</a>
                </li>

              </ul>
              <a href="#announcements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-megaphone-fill"></i> Announcements</a>
              <ul class="collapse list-unstyled" id="announcements">
                <li>
                  <a href="<?=base_url()?>/send_email">Update Email Content</a>
                </li>

              </ul>
              
            </li>
          </ul>
          <ul class="list-unstyled CTAs">
            <div class="logout">
              <a class="nav-link" id="logout" href="<?=base_url('dashboard/logout')?>"><input type="button" value="LOGOUT" name="logOut"></a>
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
      </div>
      <div class="wrapper align-items-stretch" id="main" style="height: 109.5">
        <?= $this->renderSection('content');?>
      </div>
    </div>
    <!-- footer section starts  -->

    <section id="footer" class="container-fluid" style="position: relative; z-index: 1000;">
      <div class="row-md-4">
        <div class="contactLinks">
          <h3><i class="bi bi-person-circle"></i> Contact Us:</h3>
          <div class="row">
            <div class="col-md-4 ">
              <div class="form-group footerContact ">
                <a href="https://upcebu.edu.ph" target="_blank" class="footerContact"> <i class="bi bi-globe"></i> UP Cebu</a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <a href="mailto:lrc.upcebu@up.edu.ph" target="_blank"><i class="bi bi-envelope-fill"></i> lrc.upcebu@up.edu.ph</a> <!-- Dili pani sure if unsajud ang contact email nga i butang -->
              </div>
            </div>
            <div class="col-md-4 ">
              <div class="form-group">
                <a href="tel:Phone: (032) 232 2642 / (032) 232 8185" target="_blank" id="yui_3_17_2_1_1616045956450_20"><i class="bi bi-telephone-fill"></i> (032) 232 2642 / (032) 232 8185</a>
              </div>
            </div>
          </div>
        </div>
      </div>


    </section>
    <script src="<?=base_url()?>/public/js/jquery/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url()?>/public/js/bootstrap-4.6.0/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/public/js/bootstrap-4.6.0/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/js/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/public/js/alertify/alertify.min.js"></script>
    <script src="<?=base_url()?>/public/js/image-picker/image-picker.min.js"></script>
    <script src="<?=base_url()?>/public/js/css-element-queries/src/ResizeSensor.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>

    <script src="<?=base_url()?>/public/js/custom/common.js"></script>
    <script>
        // overried defaults of alertify
        alertify.defaults.theme.ok = "btn btn-primary";
        alertify.defaults.glossary.ok = "Dismiss";
        alertify.defaults.theme.cancel = "btn btn-danger";

        var BASE_URI = "<?=base_url();?>";
        var CURRENT_URI = "<?=uri_string();?>";
    </script>
    <?php if(isset($js)):?>
      <?= echoFiles($js);?>
    <?php endif;?>
  </body>
</html>
