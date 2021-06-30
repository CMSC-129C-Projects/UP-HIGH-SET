<?php
  if ($_SESSION['logged_user']['role'] === '1') {
    $this->extend('template/pageTemplate');
  } elseif ($_SESSION['logged_user']['role'] === '3') {
    $this->extend('template/clerkTemplate');
  }
?>

<?=$this->section('content');?>
<section id="studentTable" class="container-fluid">

    <div class="heading text-center">
      <h1 style="padding: 8rem 0 2rem;"> VIEW CLERKS </h1>
    </div>

    <div class="main">
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add/clerk"><button class="button" style="width: 13em;"><i class="bi bi-plus-square"></i> Add Clerk</button></a>
        <br><br>
        <div table="table-responsive">
        <table class="table-bordered table-striped table-hover item-table" id='admin'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
    </div>
</section>
<?=$this->endSection();?>
