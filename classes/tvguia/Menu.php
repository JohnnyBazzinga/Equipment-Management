<?php

/**
 * @autores alf
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\tvguia;

use classes\db\Database;
use classes\db\LayerDB;
//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';

ini_set("error_reporting", E_ALL);

//include_once $_SERVER['DOCUMENT_ROOT'] . "/forum/config.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . "/classes/ClassDatabase.php";


class Menu extends LayerDB{
 
  public $instrucaoSQL = array ("listaTipos" => 'SELECT `codTipo`, `tipo`, `foto` FROM `tipos` order BY `order`',                      
                                );
  
   
 
  

 public function doAction($accao, $parameters=""){
    //echo "fdfsfddsdsfdsfds";
   
   //echo "<br><br>aqui $accao ffff  ";
   
     //print_r($parameters);
  
    switch ($accao){
      case "updCliente":
    //        $this->execQuery($accao, $parameters);
            break;
      case "listaTipos":
            $this->getQuery($accao, $parameters);
            break;
      default:
          break;
    }

  }
 
  
 
}
//#########################################################################################################################################################################################################
//$aux=new ClassTempos("MediasTemposFuncionariosMes");
/*$d=$aux->resposta[0]['dados'];
    echo " var chart_data = [$d];";
    $d=$aux->resposta[1]['dados'];
    echo " var chart_data1 = [$d];";
    $d=$aux->resposta[2]['dados'];
    echo " var chart_data2 = [$d];";

*/
//phpinfo();
//$socio=new ClassSocios("listMembersActive");
//print_r($socio->results);
//echo "aaa";
?>