<?php

function get_filenames($dirname){
    $dir_handler = opendir($dirname);
    $filenames = array();
    while (($filename = readdir($dir_handler)) !== false){
        if ($filename!='.' && $filename!='..'){
            array_push($filenames, $filename);
        }

    }
    sort($filenames);
    return $filenames;
}