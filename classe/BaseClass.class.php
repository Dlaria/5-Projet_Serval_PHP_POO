<?php
class BaseClass{
    protected $_currentX;
    protected $_currentY;
    protected $_currentAngle;
    protected $_dbh;
    protected $_actionStatus;

    public function __construct() {
        $this->_dbh = new Database();
        $this->_currentX = 0;
        $this->_currentY = 1;
        $this->_currentAngle = 0;
        $this->_actionStatus = 0;

    }

    // === currentX ===
    public function setCurrentX($_currentX){
        if ($this->_currentX >= 0 || $this->_currentX <= 1){
            $this->_currentX = $_currentX;
        }
    }
    public function getCurrentX(){
        return $this->_currentX;
    }

    // === currentY ===
    public function setCurrentY($_currentY){
        if ($this->_currentY <= 2 && $this->_currentY >= 0){
            $this->_currentY = $_currentY;
        }
    }
    public function getCurrentY(){
        return $this->_currentY;
    }

    // === currentAngle ===
    public function setCurrentAngle($_currentAngle){
        if ($this->_currentAngle <= 270 && $this->_currentAngle >= 0){
            $this->_currentAngle = $_currentAngle;
        }
    }
    public function getCurrentAngle(){
        return $this->_currentAngle;
    }

    public function setActionStatus(){
            $this->_actionStatus = 1;
    }

    // Fonction de vérification du movement si il est possible ou non
    public function _checkMove() {
        $sql = "SELECT * FROM map WHERE coordx=:currentX AND coordy=:currentY AND direction=:currentAngle AND status_action=:actionStatus";
        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':currentX', $this->_currentX, PDO::PARAM_INT);
        $query->bindParam(':currentY', $this->_currentY, PDO::PARAM_INT);
        $query->bindParam(':currentAngle', $this->_currentAngle, PDO::PARAM_INT);
        $query->bindParam(':actionStatus',$this->_actionStatus,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            return true;
        }else{
            return false;
        }
    }

    public function checkForward(){
        if ($this->_checkMove() == true){
            return true;
        }else{
            return false;
        }
    }

    public function goForward(){
        if ($this->checkForward() == true){
            switch ($this->_currentAngle){
                case 0:
                    $this->_currentX++;
                    break;
                case 90:
                    $this->_currentY++;
                    break;
                case 180:
                    $this->_currentX--;
                    break;
                case 270:
                    $this->_currentY--;
                    break;
            }
        }
    }

    public function checkBack(){
        if ($this->_checkMove() == true){
            return true;
        }else{
            return false;
        }
    }
    public function goBack(){
        if ($this->checkBack() == true){
            switch ($this->_currentAngle){
                case 0:
                    $this->_currentX--;
                    break;
                case 90:
                    $this->_currentY--;
                    break;
                case 180:
                    $this->_currentX++;
                    break;
                case 270:
                    $this->_currentY++;
                    break;
            }
        }
    }
    
    public function checkRight(){
        if ($this->_checkMove() == true){
            return true;
        }else{
            return false;
        }
    }
    public function goRight(){
        if ($this->checkRight() == true){
            switch ($this->_currentAngle){
                case 0:
                    $this->_currentY--;
                    break;
                case 90:
                    $this->_currentX++;
                    break;
                case 180:
                    $this->_currentY++;
                    break;
                case 270:
                    $this->_currentX--;
                    break;
            }
        }
    }

    public function checkLeft(){
        if ($this->_checkMove() == true){
            return true;
        }else{
            return false;
        }
    }
    public function goLeft(){
        if ($this->checkLeft() == true){
            switch ($this->_currentAngle){
                case 0:
                    $this->_currentY++;
                    break;
                case 90:
                    $this->_currentX--;
                    break;
                case 180:
                    $this->_currentY--;
                    break;
                case 270:
                    $this->_currentX++;
                    break;
            }
        }
    }

    public function goTurnRight(){
            switch ($this->_currentAngle){
                case 0:
                    $this->_currentAngle = 270;
                    break;
                case 90:
                    $this->_currentAngle = 0;
                    break;
                case 180:
                    $this->_currentAngle = 90;
                    break;
                case 270:
                    $this->_currentAngle = 180;
                    break;
                }
        }
    
    public function goTurnLeft(){
            switch ($this->_currentAngle){
                case 0:
                    $this->_currentAngle = 90;
                    break;
                case 90:
                    $this->_currentAngle = 180;
                    break;
                case 180:
                    $this->_currentAngle = 270;
                    break;
                case 270:
                    $this->_currentAngle = 0;
                    break;
            }
        }
    }