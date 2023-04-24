<?php
function chargerClasse($classe){
    require 'classe_php/'.$classe.'.class.php';
}
spl_autoload_register('chargerClasse');

$_currentX = 0;
$_currentY = 1;
$_currentAngle = 0;

$baseClass = new BaseClass();

$baseClass->setCurrentX(0);
$baseClass->setCurrentY(1);
$baseClass->setCurrentAngle(0);

if (count($_POST) != 0){
    // var_dump($_POST);

    foreach ($_POST as $key => $value){
        switch ($key){
            case 'upArrow':
                $baseClass->goForward($_currentX, $_currentY, $_currentAngle);
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
var_dump($baseClass);
var_dump($baseClass->checkForward($_currentX, $_currentY, $_currentAngle));
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
            <form method="post">
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
                        <td><input type="submit" name="downArrow" id="downArrow" value="V"></td>
                    </tr>
                </table>
            </form>
            <div>
            </div>
        </div>
    </section>
    <section>
    </section>
</body>
</html>