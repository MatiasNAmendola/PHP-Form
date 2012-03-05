<?php 
require_once '__autoload.php';

$form = new Form(array(
    'name' => 'formulaire', 
    'action' => 'index.php', 
    'method' => 'post'));

$form->add(new TextInput())
        ->name('nom')
        ->label('Votre nom')
        ->minlength(3);

$form->add(new PasswordInput())
        ->name('password')
        ->label('Mot de passe')
        ->minlength(5);

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
$form->add(new Checkbox())
        ->label('Recevoir notre newsletter')
        ->value('1')
        ->name('newsletter');

$form->add(new HtmlElement())
        ->value('<br />');

$form->add(new TextareaInput())
        ->label('Remarques (optionnel)')
        ->name('remarques')
        ->rows(8)
        ->cols(20)
        ->required(false);

$form->add(new Button())
        ->value('Bouton')
        ->onclick('javascript:alert(\'test\');')
        ->disableBreakline();

$form->add(new SubmitButton())
        ->name('submit')
        ->value("S'inscrire");

$form->hydrate($_POST);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
        <title>Inscription</title>
    </head>
    <body>
        <h1>Inscription</h1>
        
        <?php echo $form->render() ?>
        
        <p></p>
        
        <?php
        if(!$form->isValid() && $form->get('submit')) {
            echo '<div class="error">';
            echo 'Une ou plusieurs erreurs sont survenues.';
            echo '<ul>';
            foreach($form->getErrors() as $name => $error) {
                echo '<li>Le champ <i>'.strtolower($name).'</i> '.$error.'.</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
        elseif($form->isValid()) {
            echo 'Merci '.$form->get('nom').' !';
        }
        ?>
    </body>
</html>
