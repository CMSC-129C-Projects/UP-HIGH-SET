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
    <div class="main">
        <h1 style="padding-top: 35px;">ADMIN LIST</h1>
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add/admin"><button class="btn btn-primary">Add Admin</button></a>
        <table class="display tbl" id='admin'>
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
<?=$this->endSection();?>
