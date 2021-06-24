<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<section class="reportTable">
    <div class="heading text-center">
          <h1 style="padding: 8rem 0 2rem;" class="no-print"> Professor's Summary Report </h1>
        </div>
        <div class="reportHeader">
          <p><b>University of the Philippines Cebu<br>College of Social<br>
          High School Program<br>FACULTY EVALUATION INSTRUMENT<br>
          (Student Evaluation of Teachers)</b></p>
    </div>

    <div class ="profName">
      <h2>NAME: <b><?=strtoupper($faculty['first_name']) . ' ' . strtoupper($faculty['last_name'])?></b></h2>
      <h2>SCHOOL YEAR: <b><?=$evaluation_info['year_start'] . ' - ' . $evaluation_info['year_end']?></b></h2>
      <h2>SEMESTER: <b><?=$evaluation_info['semester']?></b></h2>
    </div>

    <div class="printBtn no-print float-right">
      <button type="button" id="print" class="button"><i class="bi bi-printer-fill"></i> Print</button>
    </div>
    
    <div class="table-responsive item-table-prof">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 12.5%" scope="col">SUBJECT</th>
            <th style="width: 12.5%" scope="col">SECTION</th>
            <th style="width: 12.5%" scope="col">NO. OF STUDENTS</th>
            <th style="width: 12.5%" scope="col" colspan="2">INSTRUCTIONAL <br>SKILLS</th>
            <th style="width: 12.5%" scope="col" colspan="2">CLASS<br> MANAGEMENT</th>
            <th style="width: 12.5%" scope="col" colspan="2">PERSONAL <br>QUALITIES</th>
            <th style="width: 12.5%" scope="col" colspan="2">STUDENT-FACULTY<br> RELATION</th>
            <th style="width: 12.5%" scope="col" colspan="2">FINAL<br> RATING *</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan=3 class="empty"></td>
            <th>AR</th>
            <th>WR</th>
            <th>AR</th>
            <th>WR</th>
            <th>AR</th>
            <th>WR</th>
            <th>AR</th>
            <th>WR</th>
            <th class="empty"></th>
          </tr>
          <?php foreach($all_info as $subject_id => $info):?>
            <tr>
              <td><?=$info['subject_info']['name']?></td>
              <td><?=$info['subject_info']['grade_level']?></td>
              <td><?=$info['total_students']?></td> 
              <?php foreach($info['rating'][0] as $section_id => $ratings):?>
                <td><?=number_format($ratings['AR'], 2);?></td>
                <td><?=number_format($ratings['WR'], 2);?></td>
              <?php endforeach;?>
              <td class="final_rating"><?=number_format($info['rating'][1], 2);?></td>
            </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="11"></td>
            <td>Overall Rating: <b class="overall" style="text-decoration: underline;"></b></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <br><br>
      <div class="row info">
        <div class="col-md-4 col-sm-4">
          <div class="legend d-flex flex-direction-column">
            <div class="legend-cntr text-right">
              <h4>Legend:</h4>
            </div>
            <div class="legend-cntr">
              <h4>AR - average rating</h4>
              <h4>WR - weighted rating</h4>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 text-center">
          <h4>* Sum of weighted ratings</h4>
        </div>
        
        <div class="col-md-4 col-sm-4">
          <div class="signature text-center">
            <h4>CATHERINE M. RODEL</h4>
            <hr class="underline">
            <h5>Principal</h5>
          </div>
          <div class="signature text-center">
            <h4>MA. ROWENA V. MENDE</h4>
            <hr class="underline">
            <h5>Dean, College of Social Sciences</h5>
          </div>
        </div>
      </div>
</section>
<?= $this->endSection();?>