<?php
// §Fonction d'autocharchement des pages de chaque class
function chargerClasse($classe){
    require '../classe/'.$classe.'.class.php';
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

            // Boutons de direction
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
                $view->setCurrentX($_POST['currentx']);
                $view->setCurrentY($_POST['currenty']);
                $view->setCurrentAngle($_POST['currentangle']);
                $action->setCompassDisplay($_POST['compassDisplay']);
                break;
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
    <link rel="stylesheet" href="../css/allFont.css">
    <link rel="stylesheet" href="../css/<?= $_SESSION['select_doc'] ?>.css">
    <title>Comme Doom</title>
</head>
<body style="
background: no-repeat center/cover url(../images/<?= $_SESSION['select_doc'] ?>/background.png);
">
    <div class="screen">
        <img class="screen" src="
        ../images/<?= $_SESSION['select_doc'] ?>/<?= $view->getView(); ?>.png" 
        alt="">
    </div>
    <section id="section-2">
        <form class="principal" method="post">
            <!-- Stockage des coordonnées pour éviter le problème du rafraichissement  -->
            <input type="hidden" name="currentx" value="<?= $view->getCurrentX(); ?>">
            <input type="hidden" name="currenty" value="<?= $view->getCurrentY(); ?>">
            <input type="hidden" name="currentangle" value="<?= $view->getCurrentAngle(); ?>">
            <input type="hidden" name="compassDisplay" value="<?= $action->getCompassDisplay(); ?>">
            <table>
                <tr>
                        <td><button style="padding:10px;" type="submit" name="leftRotate" id="leftRotate" class="button"><div class="vide"></div></button></td>
                        <td><button type="submit" name="upArrow" id="upArrow" class="button" <?php if($view->checkForward() == true) {echo 'enabled';}else{echo 'disabled';}?>><div class="vide"></div></button></td>
                        <td><button style="padding:10px;" type="submit" name="rightRotate" id="rightRotate" class="button"><div class="vide"></div></button></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="leftArrow" id="leftArrow" class="button" <?= ($view->checkLeft() == true) ? ('enabled') : ('disabled');?>><div class="vide"></div></button></td>
                        <td><button type="submit" name="btnAction" id="btnAction" class="button" <?= ($action->checkAction($view) == true) ? ('enabled') : ('disabled'); ?>><div class="vide"></div></button></td>
                        <td><button type="submit" name="rightArrow" id="rightArrow" class="button" <?= ($view->checkRight() == true) ? ('enabled') : ('disabled');?>><div class="vide"></div></button></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="downArrow" id="downArrow" class="button" <?php if($view->checkBack() == true) {echo 'enabled';}else{echo 'disabled';}?>><div class="vide"></div></button></td>
                    </tr>
                </table>
        </form>
    </section>
</body>
<!-- Script pour utiliser le clavier au lieu des boutons visibles -->
<script type="text/javascript">
        const turnLeft = document.getElementById("leftRotate"),
        goForward = document.getElementById("upArrow"),
        turnRight = document.getElementById("rightRotate"),
        goLeft = document.getElementById("leftArrow"),
        action = document.getElementById("btnAction"),
        goRight = document.getElementById("rightArrow"),
        goBack = document.getElementById("downArrow"),
        inventory = document.getElementById('btnInventory');
        document.addEventListener("keydown", (event) => {
            
            switch (event.code) {
                case 'KeyQ':
                    turnLeft.click();
                    break;
                case 'KeyW':
                    goForward.click();
                    break;
                case 'KeyE':
                    turnRight.click();
                    break;
                case 'KeyA':
                    goLeft.click();
                    break;
                case 'KeyF':
                    action.click();
                    break;
                case 'KeyD':
                    goRight.click();
                    break;
                case 'KeyS':
                    goBack.click();
                    break;
                case 'KeyI':
                    inventory.click();
                    break;
            }
        })
</script>
</html>