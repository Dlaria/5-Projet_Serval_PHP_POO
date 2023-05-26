<?php
class FirstPersonAction extends BaseClass{
    protected $_mapId;
    protected $_cleDore;
    protected $_compassDisplay;

    public function __constuct(){
        $this->_compassDisplay = "";
    }
    public function setCompassDisplay($compassDisplay){
        $this->_compassDisplay = $compassDisplay;
    }
    public function getCompassDisplay(){
        return $this->_compassDisplay;
    }

    public function goCompassDisplay(){
        switch ($this->_compassDisplay){
            case '':
                $this->_compassDisplay = "compassDisplay";
                break;
            case 'compassDisplay':
                $this->_compassDisplay = "";
                break;
        }
    }

    // Récupération de l'id de la table "map" en fonction des coordonnées
    public function checkAction(FirstPersonView $data){
        $sql = "SELECT * FROM action 
        INNER JOIN map ON map.id = action.map_id
        WHERE coordx=:X AND coordy=:Y AND direction=:Ag";
        $query = $data->_dbh->prepare($sql);
        $query->bindParam(':X',$data->_currentX,PDO::PARAM_INT);
        $query->bindParam(':Y',$data->_currentY,PDO::PARAM_INT);
        $query->bindParam(':Ag',$data->_currentAngle,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            // var_dump($result);
            $this->_mapId = $result->map_id;
            return true;
        }else{
            return false;
        }
    }

    // Récupération des actions dans la table "action" et pour chaques actions mise à jour du status et gestion de l'inventaire
    public function goAction(FirstPersonView $data){
        if ($this->checkAction($data) == true){
            $query = $data->_dbh->prepare("SELECT * FROM action INNER JOIN items ON action.item_id = items.id WHERE map_id=:mapId");
            $query->bindParam(':mapId',$this->_mapId);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if(!empty($result)){

                // L'action "take" se met à jour pour avoir un status égal a 1 et stockage de la clé dans le tableau de session
                if ($result->action == 'take'){
                        $sql = "UPDATE action SET status=1 WHERE map_id=:mapId";
                        $query = $data->_dbh->prepare($sql);
                        $query->bindParam(':mapId',$this->_mapId);
                        $query->execute();
                        $_SESSION['cle_dore'] = $result->description;
                        $data->setActionStatus(1);
                    
                // L'action "use" se met à jour pour avoir un status égal a 1 si la clé est dans l'inventaire
                }elseif ($result->action == 'use'){
                    if (isset($_SESSION['cle_dore']) && $_SESSION['cle_dore'] === $result->description){
                        $sql = "UPDATE action SET status=1 WHERE map_id=:mapId";
                        $query = $data->_dbh->prepare($sql);
                        $query->bindParam(':mapId',$this->_mapId);
                        $query->execute();
                    }
                }elseif ($_SESSION['select_doc'] === "SvetlanaEstelle") {
                    if ($result->action == "porter"){
                        $sql = "UPDATE action SET status=2 WHERE map_id=:mapId";
                        $query = $data->_dbh->prepare($sql);
                        $query->bindParam(':mapId',$this->_mapId);
                        $query->execute();
                        $_SESSION['chapeau'] = $result->description;
                    }
                }
            }
        }
    }

    public function setInventory(FirstPersonView $data){
        $query = $data->_dbh->prepare("SELECT * FROM items");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if (!empty($result)){
            if (isset($_SESSION['cle_dore']) && $_SESSION['cle_dore'] === $result->description){
                $this->_cleDore = '<img class="img-cle" src="../assets/'.$result->image.'" alt="'.$result->description.'">';
            }
            return true;
        }else{
            return false;
        }
    }

    public function getInventory(FirstPersonView $data){
        if ($this->setInventory($data) == true){
            $compassClass = $data->getAnimCompass();
            $inventory =
                '<div class="popup" id="popup">
                    <div class="popup-back"></div>
                    <div class="popup-container" id="inventory">
                        <h2 class="title-inventory">Inventaire</h2>
                        <button name="itemInventory" class="itemInventory"><img src="../assets/compass.png" alt="compass" class="img-inventory '.$compassClass.'"></button>
                        '.$this->_cleDore.'<br>
                        <input type="submit" name="fermerInventory" class="btnFermer" value="Fermer"></input>
                    </div>
                </div>';
            return $inventory;
        }
    }
}