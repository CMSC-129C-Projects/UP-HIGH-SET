<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<section class="reportTable">
    <div class="heading text-center">
      <h1 style="padding: 8rem 0 2rem;"> Subject Summary Report </h1>
    </div>
        
    <div class ="profName">
      <h2>NAME: <b><?=strtoupper($faculty['first_name']) . ' ' . strtoupper($faculty['last_name'])?></b></h2>
      <h2>SCHOOL YEAR: <b><?=$evaluation_info['year_start'] . ' - ' . $evaluation_info['year_end']?></b></h2>
      <h2>SEMESTER: <b><?=$evaluation_info['semester']?></b></h2>
    </div>
    
    <div class="table-responsive item-table" style="border: solid .3rem #7b1113">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">SUBJECT</th>
            <th scope="col">SECTION</th>
            <th scope="col">NO. OF STUDENTS</th>
            <th scope="col" colspan="5">TALLY</th>
            <th scope="col" colspan="2">INSTRUCTIONAL <br>SKILLS</th>
            <th scope="col" colspan="5">TALLY</th>
            <th scope="col" colspan="2">CLASS<br> MANAGEMENT</th>
            <th scope="col" colspan="5">TALLY</th>
            <th scope="col" colspan="2">PERSONAL <br>QUALITIES</th>
            <th scope="col" colspan="5">TALLY</th>
            <th scope="col" colspan="2">STUDENT-FACULTY<br> RELATION</th>
            <th>FINAL RATING</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="3" class="empty"></td>
            <th>E</th>
            <th>VG</th>
            <th>G</th>
            <th>F</th>
            <th>P</th>
            <th>AR</th>
            <th>WR</th>
            <th>E</th>
            <th>VG</th>
            <th>G</th>
            <th>F</th>
            <th>P</th>
            <th>AR</th>
            <th>WR</th>
            <th>E</th>
            <th>VG</th>
            <th>G</th>
            <th>F</th>
            <th>P</th>
            <th>AR</th>
            <th>WR</th>
            <th>E</th>
            <th>VG</th>
            <th>G</th>
            <th>F</th>
            <th>P</th>
            <th>AR</th>
            <th>WR</th>
            <th class="empty"></th>
          </tr>
          <tr>
          
            <td><?=ucwords($subject_info['name']);?></td>
            <td><?=$sections[$subject_info['grade_level']];?></td>
            <td><?=$total_students?></td>

            <?php foreach($ratings[0] as $key => $value):?>
                <td><?=$tally[$key]['e'];?></td>
                <td><?=$tally[$key]['vg'];?></td>
                <td><?=$tally[$key]['g'];?></td>
                <td><?=$tally[$key]['f'];?></td>
                <td><?=$tally[$key]['p'];?></td>
                <td><?=$value['AR']?></td>
                <td><?=$value['WR']?></td>
            <?php endforeach;?>
            <td><?=$ratings[1];?></td>
          </tr>
        </tbody>
      </table>      
    </div>
    <span>Note: Scroll right to see the rest of the table.</span>

    <div class="row">
        <div class="col-md-4">
            <div class="inputBox">
                <p>Professor's Strong Points<p>
                <div class="comments">
                    <?php foreach($open_ended[0] as $strongPoints):?>
                        <div class="commentBox effect1">
                            <p class="pcomments"><?=$strongPoints;?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="inputBox">
                <p>Professor's Weak Points<p>
                <div class="comments">
                    <?php foreach($open_ended[1] as $weakPoints):?>
                        <div class="commentBox effect1">
                            <p class="pcomments"><?=$weakPoints;?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="inputBox">
                <p>Recommendation for Improvement<p>
                <div class="comments">
                    <?php foreach($open_ended[2] as $recommendation):?>
                        <div class="commentBox effect1">
                            <p class="pcomments"><?=$recommendation;?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div> 
        </div>
    </div>

</section>
<?= $this->endSection();?>