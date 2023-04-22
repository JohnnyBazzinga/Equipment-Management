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


class Fornecedores extends LayerDB{
 
  public $instrucaoSQL = array ("listaFornecedores" => 'SELECT `id_F`,`TicketsFornecedores`.`Nome`, `Balcao`, `TicketsFornecedores`.`id_LS`,`TicketsListaServicos`.`Nome`, `TicketsFornecedores`.`Ativo`
                                                        FROM `TicketsFornecedores`
                                                        INNER JOIN `TicketsListaServicos` ON `TicketsListaServicos`.`id_LS`= `TicketsFornecedores`.`id_LS` 
                                                        order by `TicketsFornecedores`.`Nome`',
                                 "seeFornecedores" => 'SELECT `id_F`,`TicketsFornecedores`.`Nome` as Funcionaria, `Balcao`, `TicketsFornecedores`.`id_LS`,`TicketsListaServicos`.`Nome`, `TicketsFornecedores`.`Ativo`
                                                        FROM `TicketsFornecedores`
                                                        INNER JOIN `TicketsListaServicos` ON `TicketsListaServicos`.`id_LS`= `TicketsFornecedores`.`id_LS`  WHERE `id_F`=:id',
                                
                                "funcionariasAtivas"=>'SELECT COUNT(`id_F`) as numFuncionarias,`Ativo` FROM TicketsFornecedores WHERE `Ativo`=1 GROUP BY `Ativo` ',
                                
                                "login"=>'SELECT `id_F`, `Nome`, `id_LS`,  `email`,`Balcao`, `funcao` FROM `TicketsFornecedores` WHERE `email`=:email'
                                );
  
   
 
  

 public function doAction($accao, $parameters=""){
    //echo "fdfsfddsdsfdsfds";
   
   //echo "<br><br>aqui $accao ffff  ";
   
     //print_r($parameters);
  
    switch ($accao){
      case "addFornecedores":
      case "delFornecedores":
      case "updFornecedores":
    //        $this->execQuery($accao, $parameters);
            break;
      case "listaFornecedores":
      case "seeFornecedores":
      case "funcionariasAtivas":
      case "login":
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