<?php
set_exception_handler(array('AppCore', 'handleException')); 

function autoloadUtil($className) {
    $path = 'system/util/' . $className . '.class.php';
    if (file_exists($path)) {
        require_once $path;
    }
}

spl_autoload_register('autoloadUtil');
//
?>