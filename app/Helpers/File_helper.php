<?php

function addExternal($files = null, $type = null) {

    // Make sure there is a parameter
    if(!isset($files) || !isset($type)) {
        return null;
    }

    $htmlContent = array();

    if($type === 'css') {
        foreach($files as $file) {
            $content = '<link href="'. base_url() . '/public/css/'. $file .'" rel="stylesheet" type="text/css">';
            array_push($htmlContent, $content);
        }
    } else {
        foreach($files as $file) {
            $content = '<script src="'. base_url() . '/public/js/'. $file .'"></script>';
            array_push($htmlContent, $content);
        }
    }
    return $htmlContent;
}

function echoFiles($files = null) {
    if(isset($files)) {
        foreach($files as $file) {
            echo $file;
        }
    }
}