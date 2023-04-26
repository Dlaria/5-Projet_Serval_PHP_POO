<?php
function chargerClasse($classe){
    require 'classe/'.$classe.'.class.php';
}
spl_autoload_register('chargerClasse');

$view = new FirstPersonView();
$text = new FirstPersonText();
$action = new FirstPersonAction();

if (count($_POST) != 0){
    // var_dump($_POST);
    if (isset($_POST['currentx']) === true){
        $view->setCurrentX((int) $_POST['currentx']);
        $view->setCurrentY((int) $_POST['currenty']);
        $view->setCurrentAngle((int) $_POST['currentangle']);
    }
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

            
            }
        }
    }
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
            <input type="hidden" name="currentx" value="<?= $view->getCurrentX(); ?>">
            <input type="hidden" name="currenty" value="<?= $view->getCurrentY(); ?>">
            <input type="hidden" name="currentangle" value="<?= $view->getCurrentAngle(); ?>">
            <div class="boutons">
                <table>
                    <tr>
                        <td><input type="submit" name="leftRotate" id="leftRotate" value="\"></td>
                        <td><input type="submit" name="upArrow" id="upArrow" value="^"></td>
                        <td><input type="submit" name="rightRotate" id="rightRotate" value="/"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="leftArrow" id="leftArrow" value="<"></td>
                        <td><input type="submit" name="btnAction" id="btnAction" value="X"></td>
                        <td><input type="submit" name="rightArrow" id="rightArrow" value=">"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="downArrow" id="downArrow" value="v"></td>
                    </tr>
                </table>
                    <img src="assets/compass.png" alt="compass" class="compass <?= $view->getAnimCompass(); ?>">
            </div>
        </form>
        <!-- pour afficher le text -->
        <div class="text">
            <p><?= $text->getText($view); ?></p>
        </div>
    </section>
    </section>
</body>
</html>