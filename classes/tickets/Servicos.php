<?php

/**
 * @autores Artur Guia, Nuno Cruz, Nuno Carvalhido, Válter Rocha
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\tickets;
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

?>