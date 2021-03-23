<?=$this->extend('pageTemplate');?>

<?=$this->section('content');?>
    <div class="main">
        <h1 style="padding-top: 35px;">STUDENT LIST</h1>
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add"><button class="btn btn-primary">Add Student</button></a>
        <table class="display" id='student'>
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
<?=$this->endSection();?>
