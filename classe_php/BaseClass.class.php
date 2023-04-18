<?php
class BaseClass{
    protected $_currentX;
    protected $_currentY;
    protected $_currentAngle;
    protected $_dbh;

    public function __construct(int $_currentX, int $_currentY, int $_currentAngle) {
        $this->_dbh = new Database();
        $_currentX = $this->setCurrentX((int) $_currentX);
    }

    // === currentX ===
    public function setCurrentX(int $_currentX){
        $this->_currentX = 0;
    }
    public function getCurrentX(int $_currentX){
        return $this->setCurrentX((int) $_currentX);
    }

    // === currenty ===
    public function setCurrentY(int $_currentY){
        $this->_currentY = $_currentY;
    }
    public function getCurrentY(int $_currentY){
        return $this->setCurrentY((int) $_currentY);
    }

    // === currentAngle ===
    public function setCurrentAngle(int $_currentAngle){
        $this->_currentAngle = $_currentAngle;
    }
    public function getCurrentAngle(int $_currentAngle){
        return $this->setCurrentAngle((int) $_currentAngle);
    }

    // Fonction de vérification du movement si il est possible ou non
    private function _checkMove(int $_currentX, int $_currentY, int $_currentAngle) {
        $sql = "SELECT * FROM map WHERE coordx=:currentX AND coordy=:currentY AND direction=:currentAngle";
        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':currentX', $_currentX, PDO::PARAM_INT);
        $query->bindParam(':currentY', $_currentY, PDO::PARAM_INT);
        $query->bindParam(':currentAngle', $_currentAngle, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            return true;
        }else{
            return false;
        }
    }

    public function checkFoward(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove((int) $_currentX, (int) $_currentY, (int) $_currentAngle) == true){
            return true;
        }else{
            return false;
        }
    }

    public function goFoward(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkFoward((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            switch ($_currentAngle){
                case 0:
                    $_currentX++;
                    break;
                case 90:
                    $_currentY++;
                    break;
                case 180:
                    $_currentX--;
                    break;
                case 270:
                    $_currentY--;
                    break;
            }
            var_dump($_currentX);
            var_dump($_currentY);
            var_dump($_currentAngle);
        }
    }

    public function checkBack(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goBack(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkBack((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            switch ($_currentAngle){
                case 0:
                    $_currentX--;
                    break;
                case 90:
                    $_currentY--;
                    break;
                case 180:
                    $_currentX++;
                    break;
                case 270:
                    $_currentY++;
                    break;
            }
        }
    }
    
    public function checkRight(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goRight(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkRight((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            switch ($_currentAngle){
                case 0:
                    $_currentY--;
                    break;
                case 90:
                    $_currentX++;
                    break;
                case 180:
                    $_currentY++;
                    break;
                case 270:
                    $_currentX--;
                    break;
            }
        }
    }

    public function checkLeft(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goLeft(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkLeft((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            switch ($_currentAngle){
                case 0:
                    $_currentY++;
                    break;
                case 90:
                    $_currentX--;
                    break;
                case 180:
                    $_currentY--;
                    break;
                case 270:
                    $_currentX++;
                    break;
            }
        }
    }

    public function checkTurnRight(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goTurnRight(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkTurnRight((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            switch ($_currentAngle){
                case 0:
                    $_currentAngle = 270;
                    break;
                case 90:
                    $_currentAngle = 0;
                    break;
                case 180:
                    $_currentAngle = 90;
                    break;
                case 270:
                    $_currentAngle = 180;
                    break;
                }
            var_dump($_currentX);
            var_dump($_currentY);
            var_dump($_currentAngle);
        }
    }

    public function checkTurnLeft(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goTurnLeft(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkTurnLeft((int) $_currentX, (int) $_currentY, (int) $_currentAngle)){
            switch ($_currentAngle){
                case 0:
                    $_currentAngle = 90;
                    break;
                case 90:
                    $_currentAngle = 180;
                    break;
                case 180:
                    $_currentAngle = 270;
                    break;
                case 270:
                    $_currentAngle = 0;
                    break;
            }
            var_dump($_currentX);
            var_dump($_currentY);
            var_dump($_currentAngle);
        }
    }
}
?>