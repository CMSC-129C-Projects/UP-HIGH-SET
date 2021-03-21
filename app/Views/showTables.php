<<<<<<< Updated upstream
<?=$this->extend('pageTemplate');?>

<?=$this->section('content');?>
    <div class="main">
        <h1>STUDENTS</h1>
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add"><button class="btn btn-primary">Add Student</button></a>
        <table class="display myDesign" id='student'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Grade Level</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
=======
<?=$this->extend('tables');?>

<?=$this->section('content');?>
    <h1>DataTables</h1>
    <table class="display" id='student'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Grade Level</th>
                <th>Semester</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
>>>>>>> Stashed changes
<?=$this->endSection();?>