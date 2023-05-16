<?php 
if (!empty($_POST)){
    var_dump($_POST);
    foreach ($_POST as $key => $value){
        switch ($value){
            case 'default_pic':
                header('location:Views/defaultView.php');
                break;
            case 'Aurelien':
                break;
            case 'CaroDoriane':
                break;
            case 'Nathalie':
                break;
            case 'Quentin':
                break;
            case 'SvetlanaEstelle':
                break;
            default:
                header('location:Views/defaultView.php');
                break;
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
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