<?=$this->extend('pageTemplate');?>

<?=$this->section('content');?>
    <div id="bg-modal" class="black-modal">
        <div id="content-modal" class="customModal horizontalCenter verticalCenter">
            <div class="mdl-content">
                <p>Are you sure you want to delete this user?</p>
                <div class="btn-delete">
                    <button id="yesDelete">Yes</button>
                    <button id="dontDelete">No</button>
                </div>
            </div>
        </div>
    </div>
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
        <a style="float: right; padding: 10px;" href="<?=base_url();?>/update/add/student"><button class="btn btn-primary">Add Student</button></a>
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
