<?php
class FirstPersonView extends BaseClass {
    protected $_mapId;

    public function setView(int $X,int $Y,int $Ag){
        $sql = "SELECT * FROM image 
        INNER JOIN map ON map.id = image.map_id
        WHERE coordx=:X AND coordy=:Y AND direction=:Ag";
        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':X',$X,PDO::PARAM_INT);
        $query->bindParam(':Y',$Y,PDO::PARAM_INT);
        $query->bindParam(':Ag',$Ag,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            $this->_mapId = (int) $result->map_id;
            return true;
        }else{
            return false;
        }
    }
    public function getView(int $X,int $Y,int $Ag){
        if ($this->setView($X,$Y,$Ag) == true){
            $query = $this->_dbh->prepare("SELECT * FROM image WHERE map_id=:mapid");
            $query->bindParam(':mapid',$this->_mapId,PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if (!empty($result)){
                $path = $result->path;
                return $path;
            }
        }
    }
}