<?php
function chargerClasse($classe){
    require 'classe/'.$classe.'.class.php';
}
spl_autoload_register('chargerClasse');

$_currentX = 0;
$_currentY = 1;
$_currentAngle = 0;

$baseClass = new BaseClass();
$view = new FirstPersonView();

// var_dump($view->setView($_currentX,$_currentY,$_currentAngle));


if (count($_POST) != 0){
    // var_dump($_POST);
    if (isset($_POST['currentx']) === true){
        $baseClass->setCurrentX((int) $_POST['currentx']);
        $baseClass->setCurrentY((int) $_POST['currenty']);
        $baseClass->setCurrentAngle((int) $_POST['currentangle']);
    }
    foreach ($_POST as $key => $value){
        switch ($key){
            case 'upArrow':
                $baseClass->goForward();
                break;

            case 'leftArrow':
                $baseClass->goLeft($_currentX, $_currentY, $_currentAngle);
                break;

            case 'rightArrow':
                $baseClass->goRight($_currentX, $_currentY, $_currentAngle);
                break;

            case 'downArrow':
                $baseClass->goBack($_currentX, $_currentY, $_currentAngle);
                break;

            case 'leftRotate':
                $baseClass->goTurnLeft($_currentX, $_currentY, $_currentAngle);
                break;

            case 'rightRotate':
                $baseClass->goTurnRight($_currentX, $_currentY, $_currentAngle);
                break;
            
            }
        }
    }
    // var_dump($baseClass);
    // var_dump($baseClass->getCurrentX());
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comme Doom</title>
</head>
<body>
    <section>
        <div>
            <img src="images/<?= $view->getView($_currentX,$_currentY,$_currentAngle); ?>" alt="">
        </div>
        <div>
            <form method="post">
                <input type="hidden" name="currentx" value="<?= $baseClass->getCurrentX(); ?>">
                <input type="hidden" name="currenty" value="<?= $baseClass->getCurrentY(); ?>">
                <input type="hidden" name="currentangle" value="<?= $baseClass->getCurrentAngle(); ?>">
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
            </form>
        </div>
    </section>
    <section>
    </section>
</body>
</html>