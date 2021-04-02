<?php

function displaySingleError($validation, $field) {
    if(isset($validation)) {
        if($validation->hasError($field)) {
            return $validation->getError($field);
        }
    } else {
        return false;
    }
}

function setFormBasedOnRole($role) {
    $default = '<li class="nav-item">
                    <a href="#Admin" class="nav-link active" data-toggle="tab" id="btn-admin"><input type="button" value="Admin"></a>
                </li>
                <li class="nav-item">
                    <a href="#Student" class="nav-link" data-toggle="tab" id="btn-student"><input type="button" value="Student"></a>
                </li>';
    if(isset($role) && $role === 'student') {
        return '<li class="nav-item">
                    <a href="#Admin" class="nav-link" data-toggle="tab" id="btn-admin"><input type="button" value="Admin" disabled></a>
                </li>
                <li class="nav-item">
                    <a href="#Student" class="nav-link active" data-toggle="tab" id="btn-student"><input type="button" value="Student"></a>
                </li>';
    } elseif(isset($role) && $role === 'admin') {
        return '<li class="nav-item">
                    <a href="#Admin" class="nav-link" data-toggle="tab" id="btn-admin"><input type="button" value="Admin" disabled></a>
                </li>
                <li class="nav-item">
                    <a href="#Student" class="nav-link active" data-toggle="tab" id="btn-student"><input type="button" value="Student" disabled></a>
                </li>';
    } else {
        return $default;
    }
}