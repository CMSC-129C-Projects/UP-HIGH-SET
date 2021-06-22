<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<link href="<?=base_url()?>/public/css/custom/reporting/profreport.css" rel="stylesheet">
<section class="reportTable">
    <div class="heading text-center">
      <h1 style="padding: 8rem 0 2rem;"> Subject Summary Report </h1>
    </div>
        
    <div class ="profName">
      <h2>NAME: <b>DARIUOS KINCADE</b></h2>
      <h2>SCHOOL YEAR: <b>2020-2021</b></h2>
    </div>
    
    <div class="table-responsive item-table">
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
            <td colspan="3" class="empty"></td>
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
         

        </tbody>
        
      </table>
      
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="inputBox">
          <p>Professor's Strong Points<p>
          <div class="comments">
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwadawdawdawdwadwadawdawdawdwadwadawdawdawdwadwa dawdawdawdwadwa dawdawdawdwadwadawdawdawdwadwa</p>
              </div>
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwa</p>
              </div>
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwa</p>
              </div>
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwa</p>
              </div>
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwa</p>
              </div>
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwa</p>
              </div>
              <div class="commentBox effect1">
                  <p class="pcomments">dawdawdawdwadwa</p>
              </div>
            </div> 
        </div>
      </div>
      <div class="col-md-4">
          <div class="inputBox">
              <p>Professor's Weak Points<p>
              <div class="comments">
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="inputBox">
              <p>Recommendation for Improvement<p>
              <div class="comments">
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
                  <div class="commentBox effect1">
                      <p class="pcomments">dawdawdawdwadwa</p>
                  </div>
              </div>
          </div>
      </div>
    </div>

</section>
<?= $this->endSection();?>