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
    <link href="<?=base_url()?>/public/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <!-- <link href="<?=base_url()?>/public/jquery-ui-1.12.1/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/jquery-ui-1.12.1/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/> -->

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="<?=base_url()?>/public/css/custom/alert.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/css/custom/emailContent.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/css/custom/change_password.css" rel="stylesheet">
    <!-- <link href="<?=base_url()?>/public/css/custom/dashboard.css" rel="stylesheet"> -->
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <link href="<?=base_url()?>/public/css/custom/styles.css" rel="stylesheet">

    <?php if(isset($css)):?>
      <?=echoFiles($css);?>
    <?php endif;?>
  </head>
  <body>
    <div class="bg-loader">
      <div class="se-pre-con"></div>
    </div>

    <!-- header section starts -->
    <section id="header" class="no-print">
      <div class="schoolWebsiteName landscape">
          <a href="<?=base_url();?>"><img src="<?=base_url()?>/public/Logo.png"></a>
          <h1> University of the Philippines High School Cebu</h1>
          <h2> Student Evaluation of Teachers</h2>
      </div>
      <div class="schoolWebsiteName portrait">
          <a href="<?=base_url();?>"><img src="<?=base_url()?>/public/Logo.png"></a>
          <h1> University of the Philippines <br>High School Cebu</h1>
          <h2> Student Evaluation of Teachers</h2>
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
                <img class="rounded-cricle" src="<?=base_url() . $_SESSION['logged_user']['avatar_url']?>" style="margin-bottom: 2vh; width: 50%!important; height: auto !important;">
                <h3>Hi, <?=$_SESSION['logged_user']['first_name']?></h3>
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
              <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-gear-wide-connected"></i> Settings </a>
                  <ul class="collapse list-unstyled" id="settings">
                      <div class="d-flex flex-direction-row">
                        <p style="font-size: 1.3rem; margin-bottom: 0;">Allow Two-step Verification</p>
                        <div class="button-2f r" id="button-6">
                            <input type="checkbox" name="allow_verification" <?=set_checkbox('allow_verification', '', $_SESSION['logged_user']['allow_verify'])?> class="checkbox">
                            <div class="knobs">
                              <span class="dot"></span>
                            </div>
                            <div class="layer"></div>
                        </div>
                      </div>
                  </ul>
              <a href="#"><i class="bi bi-zoom-in"></i> About</a>
            </li>
          </ul>
          <ul class="list-unstyled components">
            <li class="active">
              <a href="#report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-journal-check"></i> Report</a>
              <ul class="collapse list-unstyled" id="report">
                <li>
                    <a href="#" data-toggle="modal" data-target="#subjectReport">View Subject Summary Report</a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#profReport">View Faculty Summary Report</a>
                </li>
              </ul>
              <a href="#evaluation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-pencil-square"></i> Evaluation</a>
              <ul class="collapse list-unstyled" id="evaluation">
                <li>
                  <a href="<?=base_url();?>/monitoring/update_set_status">Set Evaluation Status</a>
                </li>
                <li>
                  <a href="<?=base_url();?>/monitoring/monitor_progress">Monitor Progress</a>
                </li>
              </ul>
              <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-person"></i> Users</a>
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
                <li>
                  <a href="<?=base_url();?>/monitoring/transcend_students">Transcend Students</a>
                </li>
              </ul>
              <a href="#facultyMembers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-pie-chart"></i> Database Management</a>
              <ul class="collapse list-unstyled" id="facultyMembers">
                <li>
                  <a href="#">Add Professors</a>
                </li>
                <li>
                  <a href="<?=base_url()?>/professors">View Professors</a>
                </li>
                <li>
                  <a href="<?=base_url()?>/subjects/add_subject">Add Subjects</a>
                </li>
              </ul>
              <a href="#announcements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-megaphone"></i> Administration </a>
              <ul class="collapse list-unstyled" id="announcements">
                <li>
                  <a href="<?=base_url()?>/send_email">Send Email Notification</a>
                </li>
                <li>
                  <a href="<?=base_url()?>/send_email">Archive Evaluation</a> <!-- Archives the latest/recently closed Evaluation since possible na giclose na daan before i-archive -->
                </li>
                <!-- <li>
                  <a href="<?=base_url()?>/send_email">Unarchive Evaluation</a> Clerk/Admin must indicate which evaluation to unarchive : What Semester and year
                </li> -->
              </ul>

            </li>
          </ul>
          <ul class="list-unstyled CTAs">
            <div class="logout">
              <a class="nav-link" id="logout" href="<?=base_url('dashboard/logout')?>"><button type="button"  name="logOut"><i class="bi bi-box-arrow-left"></i> LOG OUT</button></a>
            </div>
          </ul>
        </nav>
        <!-- Page Content Holder -->
        <div class="navIcon no-print">
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

    <!-- MODAL FOR SUBJECT SUMMARY REPORT -->
    <?php $subjects = get_all_subjects();?>
    <div class="subj modal fade" id="subjectReport"  role="dialog" position="default" style="height:420px">
      <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">

          <div class="subj modal-header">
            <h2 style="color: #e9dbc1">Subject Summary Report</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </div>

          <div class="subj modal-body" style="padding: 20px;">
            <div class="form-group" id="subj-form">
              <select name="subjects" id="subject-dropdown" class="subj-select">
                <?php foreach($subjects as $sub):?>
                  <option value="<?=$sub['id']?>"><?=$sub['name']?></option>
                <?php endforeach;?>
              </select>
              <div class="row modal-button">
                  <button class="button2 button-sub" type="button"><i class="bi bi-check-circle"></i> Confirm</button>
                  <button class="button2"  data-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL FOR PROFESSORS SUMMARY REPORT -->
    <?php $professors = get_all_professors();?>
    <div class="subj modal fade" id="profReport"  role="dialog" position="default" style="height:420px">
      <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">

          <div class="subj modal-header">
            <h2 style="color: #e9dbc1">Professor Summary Report</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </div>

          <div class="subj modal-body" style="padding: 20px;">
            <div class="form-group" id="subj-form">
              <select name="professors" id="prof-dropdown" class="subj-select">
                <?php foreach($professors as $prof):?>
                  <option value="<?=$prof['id']?>"><?=ucwords($prof['first_name']) . ' ' . ucwords($prof['last_name']);?></option>
                <?php endforeach;?>
              </select>
              <div class="row modal-button">
                  <button class="button2 button-prof" type="button"><i class="bi bi-check-circle"></i> Confirm</button>
                  <button class="button2"  data-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <style>

    div#subj-form {
      padding: 1.25rem;
    }

    .modal {
      position: fixed !important;
      top: 30vh !important;
      left: 0;
      z-index: 1050;
      display: none;
      width: 100%;
      height: 100%;
      overflow: hidden;
      outline: 0;
    }

    .subj.modal-header {
      background: #7b1113;
      padding: 2rem 1.5rem !important;
    }
      .subj.modal-body {
          position: relative;
          -ms-flex: 1 1 auto;
          flex: 1 1 auto;
          padding: 2rem !important;
          background: #E9DBC1 !important;
      }

      #subject-dropdown.subj-select {
        background: #7b1113 url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='white' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e) no-repeat right 0.75rem center/8px 10px !important;
        font-size: 1.5rem;
        font-family: Roboto;
        /* width: 150px; */
      }

    .subj-select {
      display: inline-block;
      width: 100%;
      height: calc(1.75em + .75rem + 2px) !important;
      padding: .375rem 1.75rem .375rem .75rem;
      font-size: 1.5rem;
      font-weight: 400;
      line-height: 1.5;
      color: #000;
      vertical-align: middle;
      /* background: #7b1113 url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e) right .75rem center/8px 10px no-repeat !important; */
      border: 1px solid #025741 !important;
      border-radius: .25rem;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: inherit;
    }

    .row.modal-button {
        margin: auto !important;
        text-align-last: center !important;
        margin-top: 2rem !important;
        justify-content: center !important;
    }

    .modal-button .button2 {
      outline: none;
      border: none;
      border-radius: 5rem;
      color: #7b1113;
      font-size: 1.2rem;
      font-weight: bold;
      text-transform: capitalize;
      letter-spacing: 0.2rem;
      cursor: pointer;
      position: relative;
      z-index: 1;
      overflow: hidden;
      height: 4rem;
      width: 10rem;
      margin-top: 1.5rem !important;
      margin-bottom: 0%;
      margin-right: 10px;
      background: #7b1113;
      color: #fff;
    }
  </style>

    <!-- footer section starts  -->
    <section id="footer" class="no-print container-fluid" style="position: relative; z-index: 1000;">
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
    <!-- <script src="<?=base_url()?>/public/js/bootstrap-4.6.0/bootstrap.min.js"></script> -->
    <script src="<?=base_url()?>/public/js/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/public/js/alertify/alertify.min.js"></script>
    <script src="<?=base_url()?>/public/js/image-picker/image-picker.min.js"></script>
    <script src="<?=base_url()?>/public/js/css-element-queries/src/ResizeSensor.js"></script>
    <script src="<?=base_url()?>/public/js/keyframes/jquery.keyframes.js"></script>
    <script src="<?=base_url()?>/public/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>

    <script>
        // overried defaults of alertify
        alertify.defaults.theme.ok = "btn btn-primary";
        alertify.defaults.glossary.ok = "Dismiss";
        alertify.defaults.theme.cancel = "btn btn-danger";

        var BASE_URI = "<?=base_url();?>";
        var CURRENT_URI = "<?=uri_string();?>";
    </script>

    <script src="<?=base_url()?>/public/js/custom/common.js"></script>

    <?php if(isset($js)):?>
      <?= echoFiles($js);?>
    <?php endif;?>
  </body>
</html>
