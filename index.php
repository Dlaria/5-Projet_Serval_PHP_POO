<?php
// §Fonction d'autocharchement des pages de chaque class
function chargerClasse($classe){
    require 'classe/'.$classe.'.class.php';
}
spl_autoload_register('chargerClasse');

session_start();

// Création et stockage des objets de class dans des variables
$view = new FirstPersonView();
$text = new FirstPersonText();
$action = new FirstPersonAction();

if (count($_POST) != 0){
    // var_dump($_POST);
    foreach ($_POST as $key => $value){
        switch ($key){
            case 'upArrow':
                $view->goForward();
                break;

            case 'leftArrow':
                $view->goLeft();
                break;

            case 'rightArrow':
                $view->goRight();
                break;

            case 'downArrow':
                $view->goBack();
                break;

            case 'leftRotate':
                $view->goTurnLeft();
                break;

            case 'rightRotate':
                $view->goTurnRight();
                break;

            case 'btnAction':
                $view->setActionStatus();
                $action->goAction($view);
                break;

            // Récupération des valeurs des input[hidden] dans le tableau _POST 
            case 'currentx':
                $view->setCurrentX((int) $_POST['currentx']);
                $view->setCurrentY((int) $_POST['currenty']);
                $view->setCurrentAngle((int) $_POST['currentangle']);
            }
        }
    }
    // var_dump($action->checkAction($view));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Comme Doom</title>
</head>
<body>
    <div class="screen">
        <img class="screen" src="images/<?= $view->getView(); ?>" alt="">
    </div>
    <section id="section-1">
        <form method="post">
            <!-- stockage des coordonnées pour éviter le problème du rafraichissement  -->
            <input type="hidden" name="currentx" value="<?= $view->getCurrentX(); ?>">
            <input type="hidden" name="currenty" value="<?= $view->getCurrentY(); ?>">
            <input type="hidden" name="currentangle" value="<?= $view->getCurrentAngle(); ?>">
            <div>
                <table>
                    <tr>
                        <td><input type="submit" name="leftRotate" id="leftRotate" value="\"></td>
                        <td><input type="submit" name="upArrow" id="upArrow" value="^" <?php if($view->checkForward() == true) {echo 'enabled';}else{echo 'disabled';}?>></td>
                        <td><input type="submit" name="rightRotate" id="rightRotate" value="/"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="leftArrow" id="leftArrow" value="<" <?php if($view->checkLeft() == true) {echo 'enabled';}else{echo 'disabled';}?>></td>
                        <td><input type="submit" name="btnAction" id="btnAction" value="X" <?php echo ($action->checkAction($view) == true) ? ('enabled') : ('disabled'); ?>></td>
                        <td><input type="submit" name="rightArrow" id="rightArrow" value=">" <?php if($view->checkRight() == true) {echo 'enabled';}else{echo 'disabled';}?>></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="downArrow" id="downArrow" value="v" <?php if($view->checkBack() == true) {echo 'enabled';}else{echo 'disabled';}?>></td>
                    </tr>
                </table>
                    <img src="assets/compass.png" alt="compass" class="compass <?= $view->getAnimCompass(); ?>">
            </div>
        </form>
        <!-- pour afficher le text -->
        <div class="text">
            <p><?= $text->getText($view);?></p>
        </div>
    </section>
    </section>
</body>
</html>
<?php if ($text->getText($view) == 'Gagné !!'){$view->reset();} ?>