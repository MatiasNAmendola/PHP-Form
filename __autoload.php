<?php 
function _autoload($className) {
    if(file_exists(dirname(__FILE__).'/'.$className.'.class.php')) {
        require_once dirname(__FILE__).'/'.$className.'.class.php';
    }
    if(file_exists(dirname(__FILE__).'/'.$className.'.interface.php')) {
        require_once dirname(__FILE__).'/'.$className.'.interface.php';
    }
    if(file_exists(dirname(__FILE__).'/elements/'.$className.'.class.php')) {
        require_once dirname(__FILE__).'/elements/'.$className.'.class.php';
    }
}
spl_autoload_register('_autoload');
?>
