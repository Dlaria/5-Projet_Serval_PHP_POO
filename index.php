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
                header('location:Views/quentinsanithView.php');
                break;
            case 'SvetlanaEstelle':
                header('location:Views/svetelleView.php');
                break;
        }
        $_SESSION["select_doc"] = $value;
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
    <link rel="stylesheet" href="css/allFont.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Séléction de version</title>
</head>
<body>
    <div class="titre">
        <h1 id=titre>Selectionne ta version du jeu !</h1>
    </div>
    <section id="section-1">
        <form method="post">
            <select name="select_doc" id="select_doc" class="select_doc" oninput="getFont()">
                <option value="default_pic" class="default_pic" id="default_pic" selected>Par défaut</option>
                <option value="Aurelien" class="Aurelien" id="Aurelien">Aurélien</option>
                <option value="CaroDoriane" class="CaroDoriane" id="CaroDoriane">Caro & Doriane</option>
                <option value="Nathalie" class="Nathalie" id="Nathalie">Nathalie</option>
                <option value="Quentin" class="Quentin" id="Quentin">Quentin & Sanith</option>
                <option value="SvetlanaEstelle" class="SvetlanaEstelle" id="SvetlanaEstelle">Svetlana & Estelle</option>
            </select><br>
            <input type="submit" value="C'est parti !">
        </form>
    </section>

    <script>
        let getFont = () => {
            let select = document.getElementById('select_doc'),
            titre = document.getElementById('titre');
            console.log(document.body.style);
            switch(select.value){
                case 'Aurelien':
                    select.style.fontFamily = "gabriele-br";
                    titre.style.fontFamily = "impactLabel-l";
                    titre.style.display = "inline";
                    titre.style.backgroundColor = "white";
                    document.body.style.background = "#00000090 no-repeat center/cover url(images/Aurelien/background.png)"
                    break;
                case 'CaroDoriane':
                    select.style.fontFamily = "gratitudeScriptPro";
                    titre.style.fontFamily = "gratitudeScriptPro";
                    titre.style.display = "";
                    titre.style.backgroundColor = "";
                    document.body.style.background = "#00000090 no-repeat center/cover url(images/CaroDoriane/background.png)"
                    break;
                case 'Nathalie':
                    select.style.fontFamily = "media-gothic";
                    titre.style.fontFamily = "media-gothic";
                    titre.style.display = "";
                    titre.style.backgroundColor = "";
                    document.body.style.background = "#00000090 no-repeat center/cover url(images/Nathalie/background.png)"
                    break;
                case 'Quentin':
                    select.style.fontFamily = "berkshireSwash-regular";
                    titre.style.fontFamily = "berkshireSwash-regular";
                    titre.style.display = "";
                    titre.style.backgroundColor = "";
                    document.body.style.background = "#00000090 no-repeat center/cover url(images/Quentin/background.jpg)"
                    break;
                case 'SvetlanaEstelle':
                    select.style.fontFamily = "mooncheese-regular";
                    titre.style.fontFamily = "mooncheese-regular";
                    titre.style.display = "";
                    titre.style.backgroundColor = "";
                    document.body.style.background = "#00000090 no-repeat center/cover url(images/SvetlanaEstelle/background.jpg)"
                    break;
                default:
                    select.style.fontFamily = "";
                    titre.style.fontFamily = "";
                    titre.style.display = "";
                    titre.style.backgroundColor = "";
                    document.body.style.background = ""
                    break;
            }

        }
    </script>
</body>
</html>