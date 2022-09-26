<?php

function get_filenames($dirname){
    var_dump($dirname);
    $dir_handler = opendir($dirname);
    $filenames = array();
    while (($filename = readdir($dir_handler)) !== false){
        if ($filename!='.' && $filename!='..'){
            array_push($filenames, $filename);
        }

    }
    return $filenames;
}