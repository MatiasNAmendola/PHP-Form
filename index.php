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
        ->label('Votre tranche d\'âge')
        ->options(array(
            '10_20' => 'De 10 à 20 ans', 
            '20_30' => 'De 20 à 30 ans', 
            '30_40' => 'De 30 à 40 ans', 
            '>40'   => 'Plus de 40 ans'
            ))
        ->selected('20_30');
$form->add(new Select())
        ->name('pays')
        ->label('Votre pays')
        ->options(array(
            'Europe' => array(
                'fr' => 'France', 
                'es' => 'Espagne'
            ), 
            'Asie' => array(
                'jp' => 'Japon', 
                'ch' => 'Chine'
            )
            
         ))
        ->selected('es');
$form->add(new Button())
        ->value('Bouton')
        ->onclick('javascript:alert(\'test\');')
        ->disableBreakline(); 

$form->add(new SubmitButton())
        ->value('Valider');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Inscription</title>
    </head>
    <body>
        <h1>Inscription</h1>
        
        <?php echo $form->render() ?>
        
    </body>
</html>
