<?php


/**
 * the idea of this class is provide a interface for a mysql database.
 * @author António Lira Fernandes
 * @version 2.1
 * @updated 22-01-2020
 */

//revision


namespace classes\db;
use PDO;
  
//echo "aqui----";
class Database{
    private $_dbh;
    private $_stmt;
    private $_queryCounter = 0;

    public function __construct($user, $pass, $dbname, $host="localhost"){
      
      //echo "aqui";
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        //$dsn = 'sqlite:myDatabase.sq3';
        //$dsn = 'sqlite::memory:';
        $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_PERSISTENT => true
                    );
        try {
          //echo "$user, $pass, $dbname, $host <br><br>";
          //echo "$dsn, $user, $pass, $options";
            $this->_dbh = new PDO($dsn, $user, $pass, $options);
          //print_r($this->_dbh );
        }
      catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function getErrors(){
      return $this->_dbh->errorInfo();
    }

    public function query($query)    {
        $this->_stmt = $this->_dbh->prepare($query);
    }

    public function bind($pos, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        //echo "Pos: $pos  Value: $value  Type: $type";
        $this->_stmt->bindValue($pos, $value, $type);
    }

    public function execute(){
        $this->_queryCounter++;
        //echo $this->_stmt->querie();
        return $this->_stmt->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);
    }

    // returns last insert ID
    //!!!! if called inside a transaction, must call it before closing the transaction!!!!!!
    public function lastInsertId(){
        return $this->_dbh->lastInsertId();
    }

    // begin transaction // must be innoDatabase table
    public function beginTransaction(){
        return $this->_dbh->beginTransaction();
    }

    // end transaction
    public function endTransaction(){
        return $this->_dbh->commit();
    }

    // cancel transaction
    public function cancelTransaction(){
        return $this->_dbh->rollBack();
    }

    // returns number of rows updated, deleted, or inserted
    public function rowCount(){
        return $this->_stmt->rowCount();
    }

    // returns number of queries executed
    public function queryCounter(){
        return $this->_queryCounter;
    }

    public function debugDumpParams(){
        return $this->_stmt->debugDumpParams();
    }

}

//echo "sai";
?>