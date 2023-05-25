<?php
class FirstPersonText extends BaseClass {
    protected $_mapId;

    // Récupération de l'id de la table "map" en fonction des coordonnées
    public function setText(FirstPersonView $data){
        $sql = "SELECT * FROM text 
        INNER JOIN map ON map.id = text.map_id
        WHERE coordx=:X AND coordy=:Y AND direction=:Ag";
        $query = $data->_dbh->prepare($sql);
        $query->bindParam(':X',$data->_currentX,PDO::PARAM_INT);
        $query->bindParam(':Y',$data->_currentY,PDO::PARAM_INT);
        $query->bindParam(':Ag',$data->_currentAngle,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            $this->_mapId = $result->map_id;
            return true;
        }else{
            return false;
        }
    }
    // Récupération et retour du texte à affiché dans la table "text"
    public function getText(FirstPersonView $data){
        if ($this->setText($data) == true){
            if (isset($_SESSION['cle_dore']) === true){
                $sql = "SELECT * FROM text WHERE map_id=:mapId AND status_action=:actionStatus AND dossiers=:dossier";
                $query = $data->_dbh->prepare($sql);
                $query->bindParam(':mapId',$this->_mapId);
                $query->bindParam(':dossier',$_SESSION['select_doc'], PDO::PARAM_STR);
                $query->bindParam(':actionStatus',$data->_actionStatus,PDO::PARAM_INT);

            }else{
                $sql = "SELECT * FROM text WHERE map_id=:mapId AND status_action=0 AND dossiers=:dossier";
                $query = $data->_dbh->prepare($sql);
                $query->bindParam(':mapId',$this->_mapId);
                $query->bindParam(':dossier',$_SESSION['select_doc'], PDO::PARAM_STR);
            }
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if(!empty($result)){
                return $result->text;
            }
        }
    }
}