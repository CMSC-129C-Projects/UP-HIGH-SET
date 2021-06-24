<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
    <section class="admindashboard" style="margin: auto;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 4vh;">
                    <h1>Welcome, Admin Name!</h1>
                    <h3>UPSET has already generated the evaluation statistics for you! Here's how the evaluation has gone so far...</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="card effect6">
                        <span style="display: none;" data-studentstat="<?=$student_stat[0]?>" id="studentstat"></span>
                        <b>Student Progress</b>
                        <i>Students that finished evaluation over the total students</i>
                        <hr>
                        <div class="progress maroon">
                            <span class="progress-left">
                                <span class="progress-bar student-progress"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar student-progress"></span>
                            </span>
                            <div class="progress-value progress-value-maroon">
                                <div><i class="bi bi-people-fill"></i> <?=$student_stat[0]?>%</div>
                            </div>
                        </div>
                        <div>
                            <i>Total Number of Students: <?=$student_stat[1]?></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card effect6">
                        <span style="display: none;" data-subjectstat="<?=$subject_stat[0]?>" id="subjectstat"></span>
                        <b>Subject Progress</b>
                        <i>Subjects completed over total number of subjects</i>
                        <hr>
                        <div class="progress green">
                            <span class="progress-left">
                                <span class="progress-bar subject-progress"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar subject-progress"></span>
                            </span>
                            <div class="progress-value progress-value-green">
                                <div><i class="bi bi-people-fill"></i> <?=$subject_stat[0]?>%</div>
                                <!-- <p></p> -->
                            </div>
                        </div>
                        <div>
                            <i>Total Number of Subjects: <?=$subject_stat[1]?></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card effect6">
                        <!-- <span style="display: none;" data-faculstat="<?=$subject_stat[0]?>" id="faculstat"></span> -->
                        <b>Faculty Progress</b><br>
                        <i>Faculty that are evaluated over the total number of faculty</i>
                        <hr>
                        <div class="progress maroon">
                            <span class="progress-left">
                                <span class="progress-bar faculty-progress"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar faculty-progress"></span>
                            </span>
                            <div class="progress-value">
                                <div><i class="bi bi-people-fill"></i> 90%</div>
                                <!-- <p></p> -->
                            </div>
                        </div>
                        <div>
                            <i>Total Number of Professors: </i>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>

            <div class="row">
                <div class="col-md-9">
                    <div class="card effect6">
                            <b>Faculty Performance Overview</b>
                            <i>Professors list are ordered by their evaluation rating</i>
                            <hr>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Top</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Final Rating</th>
                                        <th scope="col">Completion Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                        <td>cell</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card effect6">
                        <h1><b><?=$daysLeft?> DAYS</b></h1>
                        <hr>
                        <i>Before the SET evaluation period closes</i>
                        <br>
                        <span>You may notify the students who haven't evaluated by sending them email notification. You can do this by pressing "Administration" and "Send Email Notification" in the sidebar.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection();?>
