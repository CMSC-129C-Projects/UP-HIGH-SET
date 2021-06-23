<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<link href="<?=base_url()?>/public/css/custom/reporting/profreport.css" rel="stylesheet">
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
    </div>
    
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">SUBJECT</th>
            <th scope="col">SECTION</th>
            <th scope="col">NO. OF STUDENTS</th>
            <th scope="col" colspan="2">INSTRUCTIONAL <br>SKILLS</th>
            <th scope="col" colspan="2">CLASS<br> MANAGEMENT</th>
            <th scope="col" colspan="2">PERSONAL <br>QUALITIES</th>
            <th scope="col" colspan="2">STUDENT-FACULTY<br> RELATION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>AR</th>
            <th>WR</th>
            <th>AR</th>
            <th>WR</th>
            <th>AR</th>
            <th>WR</th>
            <th>AR</th>
            <th>WR</th>
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
          </tr>

        </tbody>
        
      </table>
      <div class="printBtn">
  <button type="submit" class="button"><i class="bi bi-printer-fill"></i> Print</button>
</div>  
    </div>

   

</section>
<?= $this->endSection();?>