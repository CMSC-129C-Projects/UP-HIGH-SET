<?php
  if ($_SESSION['logged_user']['role'] === '1') {
    $this->extend('template/pageTemplate');
  } elseif ($_SESSION['logged_user']['role'] === '3') {
    $this->extend('template/clerkTemplate');
  }
?>

<?=$this->section('content');?>
    <!-- <div id="bg-modal" class="black-modal">
        <div id="content-modal" class="customModal horizontalCenter verticalCenter">
            <div class="mdl-content">
                <p>Are you sure you want to delete this student?</p>
                <div class="btn-delete">
                    <button id="yesDelete">Yes</button>
                    <button id="dontDelete">No</button>
                </div>
            </div>
        </div>
    </div> -->
<section id="studentTable" class="container-fluid">

    <div class="heading text-center">
      <h1 style="padding: 8rem 0 2rem"> VIEW STUDENTS </h1>
    </div>

    <div class="main">
        <select name="glevel" id="gl" class="custom-select" style="width:100px">
            <option value="7" selected="selected">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
            <option value="11">Grade 11</option>
            <option value="12">Grade 12</option>    
        </select>

        <a style="float: right;" href="<?=base_url();?>/update/add/student"><button class="button" style="width: 13em;"><i class="bi bi-plus-square"></i> Add Student</button></a>
        <br><br>
        <div style="table-responsive">
        <table class="table-bordered table-striped table-hover item-table" id="student">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Grade Level</th>
                    <th>Student Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
    </div>
</section>
<?=$this->endSection();?>
