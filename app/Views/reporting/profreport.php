<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<section class="reportTable">
    <div class="heading text-center">
          <h1 style="padding: 8rem 0 2rem;"> Professor's Summary Report </h1>
        </div>
        <div class="reportHeader">
          <p><b>University of the Philippines Cebu<br>College of Social<br>
          High School Program<br>FACULTY EVALUATION INSTRUMENT<br>
          (Student Evaluation of Teachers)</b></p>
    </div>
    <div class ="profName">
      <h2>NAME: <b>DARIUOS KINCADE</b></h2>
      <h2>SCHOOL YEAR: <b>2020-2021</b></h2>
      <h2>SEMESTER: <b>1</b></h2>
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
            <th style="width: 12.5%" scope="col" colspan="2">FINAL<br> RATING</th>
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
          <tr>
          
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
          <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
          <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
          <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
          <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
          <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
          <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
          </tr>
        </tbody>
      </table>
    </div>
    <br><br>
      <div class="row info">
        <div class="col-md-4">
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

        <div class="col-md-4 text-center">
          <h4>* Sum of weighted ratings</h4>
        </div>
        
        <div class="col-md-4">
          <div class="signature text-center">
            <h4>DR. CATHERINE RODEL</h4>
            <hr class="underline">
            <h5>Principal</h5>
          </div>
        </div>
      </div>

      <div class="printBtn no-print">
        <button type="button" id="print" class="button"><i class="bi bi-printer-fill"></i> Print</button>
      </div>

   

</section>
<?= $this->endSection();?>