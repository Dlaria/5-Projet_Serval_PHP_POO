<?php
class DataBase extends PDO{

    private $_dbHost = 'localhost';
    private $_dbName = 'fpview';
    private $_dbUser = 'root';
    private $_dbPass = 'root';


    public function __construct(){
        try{
            parent::__construct("mysql:host={$this->_dbHost};dbname={$this->_dbName}",$this->_dbUser,$this->_dbPass);
        }catch(PDOExeption $e){
            exit("Error: " . $e->getMessage());
        }
    }
}

?>