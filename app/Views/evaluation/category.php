<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
  <section id="evaluation" class="conatiner-fluid">
    <div class="heading text-center" style="margin:2.5rem  auto !important;">
      <h1 style="padding: 4.7rem; text-align: center; margin: auto !important;">Evaluation</h1>
    <div>

    <?php
    $is_questions = array();
    $cm_questions = array();
    $pq_questions = array();
    $sfr_questions = array();
    $ge_questions = array();
    $c_questions = array();

      if(isset($questions)) {
        foreach ($questions as $q) {
          foreach ($q as $value) {
            echo $value->name;
            if($value->name == "Instructional Skills")
              $is_questions[] = $value->question_text;
            elseif($value->name == "Class Management")
              $cm_questions[] = $value->question_text;
            elseif($value->name == "Personal Qualities")
              $pq_questions[] = $value->question_text;
            elseif($value->name == "Student Faculty Relations")
              $sfr_questions[] = $value->question_text;
            elseif($value->name == "General Evaluation")
              $ge_questions[] = $value->question_text;
            elseif($value->name == "Comments")
              $c_questions[] = $value->question_text;
          }
        }
      }
     ?>

  </section>
<?= $this->endSection();?>
