<?php

function addCss($cssFiles = null) {

    // Make sure there is a parameter
    if(!isset($cssFiles)) {
        return null;
    }
    
    $linkHref = array();

    foreach($cssFiles as $css) {
        $completeLink = '<link href="'. base_url() . '/public/css/'. $css .'" rel="stylesheet" type="text/css">';
        array_push($linkHref, $completeLink);
    }
    return $linkHref;
}

function addJs($jsFiles = null) {

    // Make sure there is a parameter
    if(!isset($jsFiles)) {
        return null;
    }
    
    $script = array();

    foreach($jsFiles as $js) {
        $completeScript = '<script src="'. base_url() . '/public/js/'. $js .'"></script>';
        array_push($script, $completeScript);
    }
    return $script;
}