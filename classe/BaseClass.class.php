<?php
class BaseClass{
    protected $_currentX;
    protected $_currentY;
    protected $_currentAngle;
    protected $_dbh;

    public function __construct() {
        $this->_dbh = new Database();
    }

    // === currentX ===
    public function setCurrentX(int $_currentX){
        if ($this->_currentX <= 1 && $this->_currentX >= 0){
            $this->_currentX = $_currentX;
        }
    }
    public function getCurrentX(){
        return $this-> $_currentX;
    }

    // === currentY ===
    public function setCurrentY(int $_currentY){
        if ($this->_currentY <= 2 && $this->_currentY >= 0){
            $this->_currentY = $_currentY;
        }
    }
    public function getCurrentY(){
        return $this->$_currentY;
    }

    // === currentAngle ===
    public function setCurrentAngle(int $_currentAngle){
        if ($this->_currentAngle <= 270 && $this->_currentAngle >= 0){
            $this->_currentAngle = $_currentAngle;
        }
    }
    public function getCurrentAngle(){
        return $this-> $_currentAngle;
    }

    // Fonction de vérification du movement si il est possible ou non
    private function _checkMove(int $_currentX, int $_currentY, int $_currentAngle) {
        $this->_currentX = $_currentX;
        $this->_currentY = $_currentY;
        $this->_currentAngle = $_currentAngle;
        $sql = "SELECT * FROM map WHERE coordx=:currentX AND coordy=:currentY AND direction=:currentAngle";
        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':currentX', $this->_currentX, PDO::PARAM_INT);
        $query->bindParam(':currentY', $this->_currentY, PDO::PARAM_INT);
        $query->bindParam(':currentAngle', $this->_currentAngle, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            $_currentX = $result->coordx;
            $_currentY = $result->coordy;
            return true;
        }else{
            return false;
        }
    }

    public function checkForward(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove($_currentX, $_currentY, $_currentAngle) == true){
            return true;
        }else{
            return false;
        }
    }

    public function goForward(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkForward($_currentX, $_currentY, $_currentAngle) == true){
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
        }
    }

    public function checkBack(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->_checkMove($_currentX, $_currentY, $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goBack(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkBack($_currentX, $_currentY, $_currentAngle) == true){
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
        if ($this->_checkMove($_currentX, $_currentY, $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goRight(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkRight($_currentX, $_currentY, $_currentAngle) == true){
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
        if ($this->_checkMove($_currentX, $_currentY, $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goLeft(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkLeft($_currentX, $_currentY, $_currentAngle) == true){
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
        if ($this->_checkMove($_currentX, $_currentY, $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goTurnRight(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkTurnRight($_currentX, $_currentY, $_currentAngle) == true){
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
        if ($this->_checkMove($_currentX, $_currentY, $_currentAngle)){
            return true;
        }else{
            return false;
        }
    }
    public function goTurnLeft(int $_currentX, int $_currentY, int $_currentAngle){
        if ($this->checkTurnLeft($_currentX, $_currentY, $_currentAngle) == true){
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