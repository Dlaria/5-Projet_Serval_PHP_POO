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

            // Boutons de gestion de l'inventaire
            case 'closeInventory':
                unset($inventory);
                break;

            case 'itemInventory':
                $action->goCompassDisplay();
                break;

            // Bouton oui/non de la popup de victoire
            case 'oui':
                $view->setCurrentX(0);
                $view->setCurrentY(1);
                $view->setCurrentAngle(0);
                unset($popup);
                break;
                
            case 'non':
                echo '<script>document.location.href="https://www.google.fr"</script>';
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Comme Doom</title>
</head>
<body>
    <div class="screen">
        <img class="screen" src="
        images/<?= $view->getView(); ?>" 
        alt="">
    </div>
    <section id="section-1">
        <form class="principal" method="post">
            <!-- Stockage des coordonnées pour éviter le problème du rafraichissement  -->
            <input type="hidden" name="currentx" value="<?= $view->getCurrentX(); ?>">
            <input type="hidden" name="currenty" value="<?= $view->getCurrentY(); ?>">
            <input type="hidden" name="currentangle" value="<?= $view->getCurrentAngle(); ?>">
            <input type="hidden" name="compassDisplay" value="<?= $action->getCompassDisplay(); ?>">
            <div>
                <select name="" id="">
                    <option value=""></option>
                </select>
            </div>
            <div>
                <table>
                    <tr>
                        <td><input type="submit" name="leftRotate" id="leftRotate" class="fa" value="\"></td>
                        <td><input type="submit" name="upArrow" id="upArrow" class="fa" value="&#xf30c;" <?php if($view->checkForward() == true) {echo 'enabled';}else{echo 'disabled';}?>></td>
                        <td><input type="submit" name="rightRotate" id="rightRotate" value="/"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="leftArrow" id="leftArrow" class="fa" value="&#xf30a;" <?= ($view->checkLeft() == true) ? ('enabled') : ('disabled');?>></td>
                        <td><input type="submit" name="btnAction" id="btnAction" class="fa" value="&#xf25a;" <?= ($action->checkAction($view) == true) ? ('enabled') : ('disabled'); ?>></td>
                        <td><input type="submit" name="rightArrow" id="rightArrow" class="fa" value="&#xf30b;" <?= ($view->checkRight() == true) ? ('enabled') : ('disabled');?>></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="btnInventory" id="btnInventory" class="fa" value="&#xf0c9;"></td>
                        <td><input type="submit" name="downArrow" id="downArrow" class="fa" value="&#xf309;" <?php if($view->checkBack() == true) {echo 'enabled';}else{echo 'disabled';}?>></td>
                    </tr>
                </table>
                    <img src="assets/compass.png" id="compass" alt="compass" class="compass <?= $view->getAnimCompass(); ?> <?= $action->getCompassDisplay(); ?>">
            </div>
            <?php if(isset($_POST['btnInventory'])){
                echo $action->getInventory($view);
            }?>
        </form>
        <!-- Affichage du text -->
        <div class="text">
            <p><?= $text->getText($view);?></p>
        </div>
        <?php if ($text->getText($view) == 'Gagné !!'){echo $view->reset();} ?>
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