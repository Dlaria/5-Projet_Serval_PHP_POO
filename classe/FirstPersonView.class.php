<?php
class FirstPersonView extends BaseClass {
    protected $_mapId;

    public function setView(){
        $sql = "SELECT * FROM image 
        INNER JOIN map ON map.id = image.map_id
        WHERE coordx=:X AND coordy=:Y AND direction=:Ag";
        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':X',$this->_currentX,PDO::PARAM_INT);
        $query->bindParam(':Y',$this->_currentY,PDO::PARAM_INT);
        $query->bindParam(':Ag',$this->_currentAngle,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            $this->_mapId = $result->map_id;
            return true;
        }else{
            return false;
        }
    }
    public function getView(){
        if ($this->setView() == true){
            $query = $this->_dbh->prepare("SELECT * FROM image WHERE map_id=:mapid AND status_action=:actionStatus");
            $query->bindParam(':mapid',$this->_mapId);
            $query->bindParam(':actionStatus',$this->_actionStatus,PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if (!empty($result)){
                return $result->path;
            }
        }
    }
    public function getAnimCompass(){
        switch ($this->_currentAngle){
            case 0:
                $cssClass = "est";
                break;
            case 90:
                $cssClass = "nord";
                break;
            case 180:
                $cssClass = "ouest";
                break;
            case 270:
                $cssClass = "sud";
                break;
        }
        return $cssClass;
    }
}