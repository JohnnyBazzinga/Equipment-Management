<?php

/**
 * @autores Artur Guia, Nuno Cruz, Nuno Carvalhido, Válter Rocha
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\tickets;

use classes\db\Database;
use classes\db\LayerDB;
//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';

ini_set("error_reporting", E_ALL);

//include_once $_SERVER['DOCUMENT_ROOT'] . "/forum/config.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . "/classes/ClassDatabase.php";


class Clientes extends LayerDB{
 
  public $instrucaoSQL = array ("listaClientes" => 'SELECT `id_C`, `Nome`, `Ativo` FROM `TicketsClientes` order by `Nome`',
                                 "seeCliente" => 'SELECT `id_C`, `Nome`, `Ativo` FROM `TicketsClientes` WHERE `id_C`=:id ;',                         
                                );
  
   
 
  

 public function doAction($accao, $parameters=""){
    //echo "fdfsfddsdsfdsfds";
   
   //echo "<br><br>aqui $accao ffff  ";
   
     //print_r($parameters);
  
    switch ($accao){
      case "addCliente":
      case "delCliente":
      case "updCliente":
    //        $this->execQuery($accao, $parameters);
            break;
      case "listaClientes":
      case "seeCliente":
            $this->getQuery($accao, $parameters);
            break;
      case "listUserAccounts":
      case "listUsAct":
            //$this->listUserAccounts($parameters['idUser']);
            break;  
      case "addAccount":
      case "addAct":
            //$this->addAccount($_POST['account'], $_POST['idUser']);
            break;
      case "addMoviments":
      case "addMvt":
            
            //$parameters['valid']=0;
            //$this->addMoviments($parameters);
            break;
      default:
          break;
    }

  }
 
  
 
  
  
  
  private function totalYearAccount($parametros){
    //print_r($parametros);
    $database = new Database(_BDUSER, _BDPASS, _BD);
    $database->query($this->instrucaoSQL['totalYearAccount']);
    $database->bind(':idAccount',$parametros['idAccount']);
    $database->bind(':year',$parametros['year']);
    $rs=$database->resultset();
    //$i=0;
    //echo "aqui";
    foreach ($rs as $linha){
      //echo "aqui";
      $this->results['idAccount']=$linha['idAccount'];
      $this->results['year']=$linha['year'];
      $this->results['total']=$linha['total'];
      $i++;
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