<?php 
require_once '_autoload.php';

$form = new Form(array(
    'name' => 'formulaire', 
    'action' => 'traitement.php'));

$form->add(new TextInput())
        ->name('nom')
        ->label('Votre nom');
$form->add(new PasswordInput())
        ->name('password')
        ->label('Mot de passe');
$form->add(new TextareaInput())
        ->name('textarea')
        ->rows(10)
        ->cols(30)
        ->value('Mon texte')
        ->onclick('javascript:this.value=\'\';');
$form->add(New RangeInput()) 
        ->name('age')
        ->max(100)
        ->min(0)
        ->step(10);
$form->add(new Checkbox())
        ->checked('checked')
        ->name('newsletter');
echo $form->render();
?>
