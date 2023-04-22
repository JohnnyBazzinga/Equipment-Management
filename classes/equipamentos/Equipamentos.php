<?php

/**
 * @autores Cristóvão Lavarinhas
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\equipamentos;
use classes\db\Database;
use classes\db\LayerDB;

ini_set("error_reporting", E_ALL);

class Equipamentos extends LayerDB{
 
  public $instrucaoSQL = array ("listarEquipamentosCompostos" => 'SELECT `numeroProduto`, `designacao`, `marca`, `composto`, `codTipoProduto`, `numeroSala`, 
                                                                  `serie`, `obs` FROM `produto` WHERE composto=0',
                                
                                "listarEquipamentosTodos" => 'SELECT `numeroProduto`, `designacao`, `marca`, `composto`, `codTipoProduto`, 
                                                                `numeroSala`, `serie`, `obs` FROM `produto` WHERE 1',
                                
                                "listaComponentesEquipamento" => 'SELECT `quantidade`, composicao.`numeroProduto`, `idComposicao`, 
                                                                   CONCAT(`designacao` , " - " , `marca` ) as nome , `numeroPai` FROM `composicao` 
                                                                   INNER JOIN produto ON composicao.numeroProduto = produto.numeroProduto WHERE `numeroPai`=:pai',
                                
                                "procurarEquipamentoNumeroSerie" => 'SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                                     produto.`codTipoProduto`, `numeroSala`, `serie`, `obs` FROM `produto` 
                                                                     INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                                     WHERE `serie` LIKE :serie',
                                
                                "procurarEquipamentoPisoSala" => 'SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                              produto.`codTipoProduto`, `numeroSala`,`numeroPiso`, `serie`, `obs` FROM `produto` 
                                                              INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto WHERE `numeroSala`=:sala',
                                
                                "listarAvarias" => 'SELECT `numero`, `data`, `problema`, `numeroProduto`, `solucao`, `email` FROM `reparacoes` ORDER BY `numero`',
                                
                                
                                "listarTarefas" => 'SELECT `id`, `tarefa`, `realizado` FROM `tarefas` ORDER BY `id`',
                                
                                
                                "contadorEquipamentos" =>  'SELECT COUNT(*) AS count FROM `produto` WHERE `composto`=0',
                                
                                "listarTecnicos" => 'SELECT `idUser`, `nome` FROM `gestaoUtilizadores` ORDER BY `idUser`',
                                
                                "listarNiveis" => 'SELECT `idUser`, `email`, `nome`, `nivel` FROM `gestaoUtilizadores` WHERE 1'
                                
                                "qrCode" => 'SELECT `numeroProduto`, `designacao`, `marca`, `composto`, `codTipoProduto`, `numeroSala`, 
                                            `serie`, `obs`, `data` FROM `produto` WHERE serie=:serie'
                                
                                );
 

 public function doAction($accao, $parameters=""){
    switch ($accao){
      case "dads":
            $this->execQuery($accao, $parameters);
            break;
      case "listarEquipamentosCompostos":
      case "listarEquipamentosTodos":
      case "listaComponentesEquipamento":
      case "procurarEquipamentoNumeroSerie":
      case "procurarEquipamentoPisoSala":
      case "listarAvarias":
      case "listarTarefas":
      case "contadorEquipamentos":
      case "listarTecnicos":
      case "listarNiveis":
      case "qrCode":
            $this->getQuery($accao, $parameters);
            break;  
      default:
          break;
    }
  }
 
}

?>