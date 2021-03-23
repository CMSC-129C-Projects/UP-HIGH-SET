<?=$this->extend('pageTemplate');?>

<?=$this->section('content');?>
    <div class="main">
        <h1 style="padding-top: 35px;">STUDENT LIST</h1>
        <select name="glevel" id="gl" class="form-select">
            <option value="7" selected="selected">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
            <option value="11">Grade 11</option>
            <option value="12">Grade 12</option>
        </select>
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add"><button class="btn btn-primary">Add Student</button></a>
        <table class="display tbl" id='student'>
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
