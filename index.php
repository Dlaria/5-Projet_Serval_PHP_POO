<?php 
session_start();
$_SESSION = array();
if (!empty($_POST)){
    // var_dump($_POST);
    foreach ($_POST as $key => $value){
        switch ($value){
            case 'default_pic':
                header('location:Views/defaultView.php');
                break;
            case 'Aurelien':
                header('location:Views/aurelView.php');
                break;
            case 'CaroDoriane':
                header('location:Views/carodorianeView.php');
                break;
            case 'Nathalie':
                header('location:Views/nathView.php');
                break;
            case 'Quentin':
                header('location:Views/quentinView.php');
                break;
            case 'SvetlanaEstelle':
                header('location:Views/svetelleView.php');
                break;
        }
        $_SESSION["selec_doc"] = $value;
        // var_dump($_SESSION); 

    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélétion de version</title>
</head>
<body>
    <h1>Séléctionne ta version du jeu !</h1>
    <form method="post">
        <select name="select_doc" id="select_doc" class="select_doc">
            <option value="default_pic">Par défaut</option>
            <option value="Aurelien">Aurélien</option>
            <option value="CaroDoriane">Caro & Doriane</option>
            <option value="Nathalie">Nathalie</option>
            <option value="Quentin">Quentin</option>
            <option value="SvetlanaEstelle">Svetlana & Estelle</option>
        </select><br>
        <input type="submit" value="C'est parti !">
    </form>
</body>
</html>