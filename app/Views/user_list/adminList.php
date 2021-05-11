<?=$this->extend('template/pageTemplate');?>

<?=$this->section('content');?>
    <div id="bg-modal" class="black-modal">
        <div id="content-modal" class="customModal horizontalCenter verticalCenter">
            <div class="mdl-content">
                <p>Are you sure you want to delete this admin?</p>
                <div class="btn-delete">
                    <button id="yesDelete">Yes</button>
                    <button id="dontDelete">No</button>
                </div>
            </div>
        </div>
    </div>
<section id="studentTable" class="container-fluid">

    <div class="heading text-center">
      <h1 style="padding:4.7rem"> View Admins </h1>
    </div>

    <div class="main">
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add/admin"><button class="button">Add Admin</button></a>
        <div table="table-responsive">
        <table class="table-bordered table-striped table-hover" id='admin'>
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
