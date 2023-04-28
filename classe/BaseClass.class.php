<?php
class BaseClass{
    protected $_currentX;
    protected $_currentY;
    protected $_currentAngle;
    protected $_dbh;
    protected $_actionStatus;

    // Appel de la class DataBase et assignation des variables de bases
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
        if ($this->_currentY <= 2 || $this->_currentY >= 0){
            $this->_currentY = $_currentY;
        }
    }
    public function getCurrentY(){
        return $this->_currentY;
    }

    // === currentAngle ===
    public function setCurrentAngle($_currentAngle){
        if ($this->_currentAngle <= 270 || $this->_currentAngle >= 0){
            $this->_currentAngle = $_currentAngle;
        }
    }
    public function getCurrentAngle(){
        return $this->_currentAngle;
    }
    // === actionStatus ===
    public function setActionStatus(){
            $this->_actionStatus = 1;
    }

    // Fonction de vérification du movement si il est possible ou non
    public function _checkMove(int $newX, int $newY, int $newAngle) {
        $sql = "SELECT * FROM map WHERE coordx=:currentX AND coordy=:currentY AND direction=:currentAngle";
        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':currentX', $newX, PDO::PARAM_INT);
        $query->bindParam(':currentY', $newY, PDO::PARAM_INT);
        $query->bindParam(':currentAngle', $newAngle, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($result)){
            return true;
        }else{
            return false;
        }
    }
    // Vérification si _checkMove retourne bien true
    public function checkForward(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
            switch ($this->_currentAngle){
                case 0:
                    $newX++;
                    break;
                case 90:
                    $newY++;
                    break;
                case 180:
                    $newX--;
                    break;
                case 270:
                    $newY--;
                    break;
            }
            return $this->_checkMove($newX, $newY, $this->_currentAngle);
        }
    // Execution du mouvement
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
        $newX = $this->_currentX;
        $newY = $this->_currentY;
            switch ($this->_currentAngle){
                case 0:
                    $newX--;
                    break;
                case 90:
                    $newY--;
                    break;
                case 180:
                    $newX++;
                    break;
                case 270:
                    $newY++;
                    break;
            }
            return $this->_checkMove($newX, $newY, $this->_currentAngle);
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
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        if ($this->_checkMove($newX, $newY, $this->_currentAngle) == true){
            switch ($this->_currentAngle){
                case 0:
                    $newY--;
                    break;
                case 90:
                    $newX++;
                    break;
                case 180:
                    $newY++;
                    break;
                case 270:
                    $newX--;
                    break;
            }
            return $this->_checkMove($newX, $newY, $this->_currentAngle);
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
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        if ($this->_checkMove($newX, $newY, $this->_currentAngle) == true){
            switch ($this->_currentAngle){
                case 0:
                    $newY++;
                    break;
                case 90:
                    $newX--;
                    break;
                case 180:
                    $newY--;
                    break;
                case 270:
                    $newX++;
                    break;
            }
            return $this->_checkMove($newX, $newY, $this->_currentAngle);
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
    
    // Réinitialise le tableau _SESSION['inventory'] et les status des actions
    public function reset(){
        unset($_SESSION['inventory']);
        
        $sql = "UPDATE action SET status=0";
        $query = $this->_dbh->prepare($sql);
        $query->execute();

        $popup = 
        '<div class="popup" id="popup">
        <div class="popup-back"></div>
        <div class="popup-container">
            <h1>Gagné !!</h1>
            <p>
                Nous vous remercions de d\'avoir joué <br>
                Voulez-vous recommencé ?
            </p>
            <br>
            <form method="post">
                <input type="submit" name="oui" class="btnOui" value="Oui !"></input>
                <input type="submit" name="non" class="btnNon" value="Non"></input>
            </form>
        </div>
    </div>';
    return $popup;
    }
}