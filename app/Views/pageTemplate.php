<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UP High SET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?=base_url();?>/public/css/bootstrap-4.6.0/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link href="<?=base_url();?>/public/css/custom/styles.css" rel="stylesheet">
  </head>
  <body>
    <!-- header section starts -->
    <section id="header">
      <div class="schoolWebsiteName">
          <img src="<?=base_url()?>/public/Logo.png">
          <h1> University of the Philippines High School Cebu</h1>
          <h2> Student Evaluation for Teachers</h2>
      </div>
    </section>
    <!-- header section ends -->

    <?= $this->renderSection('content');?>
    <!-- footer section starts  -->

    <section id="footer" class="container-fluid">

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
    <script src="<?=base_url();?>/public/js/jquery/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script src="<?=base_url();?>/public/js/bootstrap-4.6.0/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url();?>/public/js/bootstrap-4.6.0/bootstrap.min.js"></script>
         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                 });
             });
         </script>
  </body> 
</html>