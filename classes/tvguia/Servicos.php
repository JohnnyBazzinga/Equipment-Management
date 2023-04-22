<?php

/**
 * @autores alf
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\tvguia;
use classes\db\Database;
use classes\db\LayerDB;

ini_set("error_reporting", E_ALL);

class Servicos extends LayerDB{
 
  public $instrucaoSQL = array ("listaServicos" => 'SELECT `id_LS`, `Nome`, `Ativo` FROM `TicketsListaServicos` order by `Nome`',
                                 "seeServicos" => 'SELECT `id_LS`, `Nome`, `Ativo`,`letra` FROM `TicketsListaServicos` WHERE `id_LS`=:id ;',
                                  "addServicos" => 'INSERT INTO `TicketsListaServicos` (`id_LS`, `Nome`, `Ativo`) 
                                                    VALUES (:id_LS, :Nome, 1 );',
                                "servicosAtivos"=> 'SELECT COUNT(`id_LS`) as numServicos,`Ativo`FROM TicketsListaServicos WHERE `Ativo`=1 GROUP BY `Ativo`'
                                );
 

 public function doAction($accao, $parameters=""){
    switch ($accao){
      case "addServicos":
            $this->execQuery($accao, $parameters);
            break;
      case "listaServicos":
      case "seeServicos":
      case "servicosAtivos":
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