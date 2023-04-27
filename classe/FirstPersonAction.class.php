<?php
class FirstPersonAction extends BaseClass{
    protected $_mapId;

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
                    $_SESSION['inventory'] = $result->description;
                    
                // L'action "use" se met à jour pour avoir un status égal a 1 si la clé est dans l'inventaire
                }elseif ($result->action == 'use'){
                    if (isset($_SESSION['inventory']) && $_SESSION['inventory'] === $result->description){
                        $sql = "UPDATE action SET status=1 WHERE map_id=:mapId";
                        $query = $data->_dbh->prepare($sql);
                        $query->bindParam(':mapId',$this->_mapId);
                        $query->execute();
                    }
                }
            }
        }
    }
}