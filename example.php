<?php
// Including autoloader
require_once dirname(__FILE__).'/__autoload.php';

$form = new Form(array(
    'action' => 'page.php', 
    'method' => 'POST'
));
echo $form->render();



