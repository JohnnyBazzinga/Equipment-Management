<?php

namespace classes\db;

use classes\db\Database;
//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';

ini_set("error_reporting", E_ALL);

//include_once $_SERVER['DOCUMENT_ROOT'] . "/forum/config.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . "/classes/ClassDatabase.php";


class LayerDB {
 
  public $instrucaoSQL = array ("ActionName" => 'SELECT * FROM tableName;'
                                 
                                );
  
 public $results;  
 
 public function __construct($accao, $parameters=""){
  
    $this->doAction($accao, $parameters);
  } 
  
  

 public function doAction($accao, $parameters=""){

    switch ($accao){
      case "ActionName":
    //        $this->execQuery($accao, $parameters);
            break;
      case "ActionName2":
//            $this->getQuery($accao, $parameters);
            break;
      case "ActionName3":
      case "listUsAct":
            //Other functions
            break;  
      default:
          break;
    }

  }
 
  
  //##########################################################################################################################################################################
  
    private function findParameters($text, $sep=":"){
      $parts=explode($sep, $text);
      //echo ($text);
      //print_r($parts);
      $parameters=[];
      for ($i=1; $i< sizeof($parts); $i++){
        $aux=explode(" ", $parts[$i]);
        $aux=explode(",", $aux[0]);
        $aux=explode(")", $aux[0]);
        $aux=explode("%", $aux[0]);
        $aux=explode('"', $aux[0]);
        $aux=explode(';', $aux[0]);
        $parameters[$i-1]=$aux[0];
      }
      return $parameters;
    }
  
   
 //##########################################################################################################################################################################
  
  public function webService(){
    
    return json_encode($this->results, JSON_UNESCAPED_UNICODE);
    
  }
  
 //##########################################################################################################################################################################
  
  public function execQuery($query, $parameters){
    $database = new Database(_BDUSER, _BDPASS, _BD);
    $database->query($this->instrucaoSQL[$query]);
    
    //bind
    //echo "abc"; 
    //echo $this->instrucaoSQL[$query];
    $par=$this->findParameters($this->instrucaoSQL[$query], ":");
    //print_r($par);
    //print_r($parameters);
    foreach ($par as $para){
      $database->bind(':' . $para, $parameters[$para]);
    }
    //print_r($database->getErrors());
    $database->execute();
    
  }
  
 //##########################################################################################################################################################################
  
  public function getQuery($query, $parameters){
    $database = new Database(_BDUSER, _BDPASS, _BD);
    $database->query($this->instrucaoSQL[$query]);
    
    //bind
    //echo "abc"; 
    $par=$this->findParameters($this->instrucaoSQL[$query], ":");
    //print_r($par);
    //print_r($parameters);
    //print_r($this->instrucaoSQL[$query]);
    if ($par!=""){
      foreach ($par as $para){
        //print_r($para);
        $database->bind(':' . $para, $parameters[$para]);
      }  
    }
    
    //$database->execute();
    $rs=$database->resultset();
    $i=0;
    //echo "aqui"; `idAccount`, `account`
    foreach ($rs as $linha){
      //echo "aqui";
      $this->results[$i]=$linha;
      $i++;
    }
    $this->results[0]['numElements']=$i;
    
  }
    
 
}
//#########################################################################################################################################################################################################

?>