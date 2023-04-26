<?php
class FirstPersonAction extends BaseClass{
    protected $_mapId;

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

    public function goAction(FirstPersonView $data){
        if ($this->checkAction($data) == true){
            $query = $data->_dbh->prepare("SELECT * FROM action INNER JOIN items ON action.item_id = items.id WHERE map_id=:mapId");
            $query->bindParam(':mapId',$this->_mapId);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if(!empty($result)){
                // var_dump($result);
                switch ($result->action){
                    case 'take':
                        $sql = "UPDATE action SET status=1 WHERE map_id=:mapId";
                        $query = $data->_dbh->prepare($sql);
                        $query->bindParam(':mapId',$this->_mapId);
                        $query->execute();
                        $_SESSION['inventory'] = $result->description;
                        break;
                    case 'use':
                        if (isset($_SESSION['inventory']) === true && $_SESSION['inventory'] === $result->description){
                            $sql = "UPDATE action SET status=1 WHERE map_id=:mapId";
                            $query = $data->_dbh->prepare($sql);
                            $query->bindParam(':mapId',$this->_mapId);
                            $query->execute();

                        }
                        break;
                }
            }
        }
    }
}