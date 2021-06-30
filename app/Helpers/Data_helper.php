<?php

function get_all_subjects()
{
    $subjectModel = new \App\Models\SubjectModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    return $subjects;
}


function get_all_professors()
{
    $faculModel = new \App\Models\FacultyModel();

    $professors = $faculModel->where('is_deleted', 0)->findAll();

    return $professors;
}