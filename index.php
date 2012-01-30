<?php 
require_once '_autoload.php';

$form = new Form(array(
    'name' => 'formulaire', 
    'action' => 'traitement.php'));

$form->add(new TextInput('nom'))
        ->label('Votre nom');
$form->add(new PasswordInput('password'))
        ->label('Mot de passe');
$form->add(new TextareaInput('textarea'))
        ->rows(10)
        ->cols(30)
        ->value('Mon texte');

echo $form->render();
?>
