<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UP High SET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?=base_url()?>/public/css/bootstrap-4.6.0/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/css/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link href="<?=base_url()?>/public/css/custom/styles.css" rel="stylesheet">
    <?php if(isset($css)):?>
      <?= echoFiles($css);?>
    <?php endif;?>
  </head>
  <body>
    <!-- header section starts -->
    <section id="header">
      <div class="schoolWebsiteName">
          <img src="<?=base_url()?>/public/Logo.png">
          <h1> University of the Philippines Highschool Cebu</h1>
          <h2> Student Evaluation for Teachers</h2>
      </div>
    </section>
    <!-- header section ends -->

    <?= $this->renderSection('content');?>

    <!-- footer section starts  -->
    <section id="footer" class="container-fluid">
      <div class="row align-items-center">
        <div class="contactLinks">
          <h3><i class="bi bi-person-circle"></i> Contact Us:</h3>
          <a href="https://upcebu.edu.ph" target="_blank"> <i class="bi bi-globe"></i> UP Cebu</a>
          <a href="mailto:lrc.upcebu@up.edu.ph" target="_blank"><i class="bi bi-envelope-fill"></i> lrc.upcebu@up.edu.ph</a> <!-- Dili pani sure if unsajud ang contact email nga i butang -->
          <a href="tel:Phone: (032) 232 2642 / (032) 232 8185" target="_blank" id="yui_3_17_2_1_1616045956450_20"><i class="bi bi-telephone-fill"></i> (032) 232 2642 / (032) 232 8185</a>
        </div>         
      </div>     
    </section>

    <script src="<?=base_url()?>/public/js/jquery/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url()?>/public/js/bootstrap-4.6.0/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/public/js/bootstrap-4.6.0/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/js/datatables/jquery.dataTables.min.js"></script>

    <script>
        var BASE_URI = "<?=base_url();?>";
        var CURRENT_URI = "<?=uri_string();?>";
    </script>

    <?php if(isset($js)):?>
      <?= echoFiles($js);?>
    <?php endif;?>
  </body>
</html>