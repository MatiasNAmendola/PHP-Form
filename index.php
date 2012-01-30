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
$form->add(new Options())
        ->name('age')
        ->options(array(
            '10_20' => 'De 10 à 20 ans', 
            '20_80' => 'De 20 à 80 ans'
            ))
        ->selected('20_80');
$form->add(new Select())
        ->name('pays')
        ->label('Votre pays')
        ->options(array(
         'fr' => 'France', 
         'en' => 'Angleterre', 
         'de' => 'Allemagne'))
        ->selected('en');
      
echo $form->render();
?>
