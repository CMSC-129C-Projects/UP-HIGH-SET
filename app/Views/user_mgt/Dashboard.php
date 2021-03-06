<?php
    if ($_SESSION['logged_user']['role'] === '1') {
        $this->extend('template/pageTemplate');
    } elseif ($_SESSION['logged_user']['role'] === '3') {
        $this->extend('template/clerkTemplate');
    }
?>

<?= $this->section('content');?>
    <span style="display: none;" id="notif" data-notif="<?=$notif?>"></span>
    <section class="admindashboard" style="margin: auto;">
        <div class="container-fluid" style="overflow-x: auto">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 4vh;">
                    <h1>Welcome, <?=ucwords($_SESSION['logged_user']['first_name']) . ' ' . ucwords($_SESSION['logged_user']['last_name'])?>!</h1>
                    <h3>UPSET has already generated the evaluation statistics for you! Here's how the evaluation has gone so far...</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 progress-circle">
                    <div class="card effect6">
                        <span style="display: none;" data-studentstat="<?=$student_stat[0]?>" id="studentstat"></span>
                        <b>Student Progress</b><br>
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
                <div class="col-md-4 col-sm-4 progress-circle">
                    <div class="card effect6">
                        <span style="display: none;" data-subjectstat="<?=$subject_stat[0]?>" id="subjectstat"></span>
                        <b>Subject Progress</b><br>
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
                                <div><i class="bi bi-book-half"></i> <?=$subject_stat[0]?>%</div>
                            </div>
                        </div>
                        <div>
                            <i>Total Number of Subjects: <?=$subject_stat[1]?></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 progress-circle">
                    <div class="card effect6">
                        <span style="display: none;" data-faculstat="<?=$faculty_stat[0]?>" id="faculstat"></span>
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
                                <div><i class="bi bi-person-badge-fill"></i> <?=$faculty_stat[0]?>%</div>
                            </div>
                        </div>
                        <div>
                            <i>Total Number of Professors: <?=$faculty_stat[1]?></i>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>

            <div class="row">
                <div class="col-md-9 item-table">
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
                                    <?php if ($_SESSION['logged_user']['role'] === '1'):?>
                                        <th scope="col">Final Rating</th>
                                        <th scope="col">Interpretation</th>
                                    <?php endif;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($faculty_list) && count($faculty_list) !== 0):?>
                                    <?php $index=1;?>
                                    <?php foreach($faculty_list as $faculty):?>
                                        <tr>
                                            <td scope="row"><?=$index?></td>
                                            <td><?=$faculty->first_name;?></td>
                                            <td><?=$faculty->last_name;?></td>
                                            <?php if ($_SESSION['logged_user']['role'] === '1'):?>
                                                <td class="rating_<?=$index?>"><?=number_format($faculty->final_rating, 2);?></td>
                                                <td class="interpretation_<?=$index?>"></td>
                                            <?php endif;?>
                                        </tr>
                                        <?php $index++;?>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <tr>
                                        <?php if ($_SESSION['logged_user']['role'] === '1'):?>
                                            <td colspan="5" class="text-center">No results gathered</td>
                                        <?php else: ?>
                                            <td colspan="3" class="text-center">No results gathered</td>
                                        <?php endif;?>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-3 dayscount">
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
