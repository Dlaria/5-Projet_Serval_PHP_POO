<?php
function chargerClasse($classe){
    require 'classe_php/'.$classe.'.class.php';
}
spl_autoload_register('chargerClasse');

$_currentY = 1;
$_currentAngle = 0;


$baseClass = new BaseClass((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
if (count($_POST) != 0){
    // var_dump($_POST);

    foreach ($_POST as $key => $value){
        switch ($key){
            case 'upArrow':
                $baseClass->goFoward((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
                break;

            case 'leftArrow':
                $baseClass->goLeft((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
                break;

            case 'rightArrow':
                $baseClass->goRight((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
                break;

            case 'downArrow':
                $baseClass->goBack((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
                break;

            case 'leftRotate':
                $baseClass->goTurnLeft((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
                break;

            case 'rightRotate':
                $baseClass->goTurnRight((int) $_currentX, (int) $_currentY, (int) $_currentAngle);
                break;
            
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
    <title>Comme Doom</title>
</head>
<body>
    <section>
        <div>
            <form method="post">
                <table>
                    <tr>
                        <td><button name="leftRotate">\</button></td>
                        <td><button name="upArrow">^</button></td>
                        <td><button name="rightRotate">/</button></td>
                    </tr>
                    <tr>
                        <td><button name="leftArrow"><</button></td>
                        <td><button name="btnAction">X</button></td>
                        <td><button name="rightArrow">></button></td>
                    </tr>
                    <tr>
                        <td><button name="downArrow">V</button></td>
                    </tr>
                </table>
            </form>
            <div>
                <img src="assets/compass.png" alt="Bousole">
            </div>
        </div>
    </section>
    <section>
    </section>
</body>
</html>