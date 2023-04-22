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


class Pedidos extends LayerDB{
 
  public $instrucaoSQL = array ("listaPedidos" => 'SELECT `TicketsPedidos`.`id_P`, `Numero`, `Data`,  `TicketsListaServicos`.`id_LS`,`TicketsListaServicos`.`Nome` as Servico, `TicketsClientes`.`id_C`,`TicketsClientes`.
                                                   `Nome` as Cliente ,`TicketsFornecedores`.`id_F`, `TicketsFornecedores`.`Nome` as Fornecedor, `Resolvido` 
                                                   FROM `TicketsPedidos` 
                                                   INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`. `id_LS`=`TicketsListaServicos`.`id_LS` 
                                                   INNER JOIN `TicketsFornecedores` ON `TicketsPedidos`. `id_F`=`TicketsFornecedores`.`id_F` 
                                                   INNER JOIN `TicketsClientes` ON `TicketsPedidos`. `id_C`=`TicketsClientes`.`id_C`                                           
                                                   order by `Numero`',
                                "listaPedidosEspera" => 'SELECT `TicketsPedidos`.`id_P`, `Numero`, `Data`,  `TicketsListaServicos`.`id_LS`,`TicketsListaServicos`.`Nome` as Servico, `TicketsClientes`.`id_C`,
                                                        `TicketsClientes`.`Nome` as Cliente ,`TicketsFornecedores`.`id_F`, `TicketsFornecedores`.`Nome` as Fornecedor, `Resolvido` 
                                                         FROM `TicketsPedidos` 
                                                   INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`. `id_LS`=`TicketsListaServicos`.`id_LS` 
                                                   INNER JOIN `TicketsFornecedores` ON `TicketsPedidos`. `id_F`=`TicketsFornecedores`.`id_F` 
                                                   INNER JOIN `TicketsClientes` ON `TicketsPedidos`. `id_C`=`TicketsClientes`.`id_C`                                           
                                                   where `Resolvido`=0 and `TicketsListaServicos`.`id_LS`=:id order by `Numero`',
                                "listaPedidosAtribuidosPorResolver" => 'SELECT `TicketsPedidos`.`id_P`, `Numero`, `Data`,  `TicketsListaServicos`.`id_LS`,`TicketsListaServicos`.`Nome` as Servico, `TicketsClientes`.
                                                                       `id_C`,`TicketsClientes`.`Nome` as Cliente ,`TicketsFornecedores`.`id_F`, `TicketsFornecedores`.`Nome` as Fornecedor, `Resolvido` 
                                                                        FROM `TicketsPedidos` 
                                                                        INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`. `id_LS`=`TicketsListaServicos`.`id_LS` 
                                                                        INNER JOIN `TicketsFornecedores` ON `TicketsPedidos`. `id_F`=`TicketsFornecedores`.`id_F` 
                                                                        INNER JOIN `TicketsClientes` ON `TicketsPedidos`. `id_C`=`TicketsClientes`.`id_C`                                           
                                                                        where `Resolvido`=0 and `TicketsFornecedores`.`id_F`=:id order by `Numero`',
                                 "listaPedidosAtribuidosPorResolverPorServico" => 'SELECT `TicketsPedidos`.`id_P`, `Numero`, `Data`,  `TicketsListaServicos`.`id_LS`,`TicketsListaServicos`.`Nome` as Servico, `TicketsClientes`.
                                                                       `id_C`,`TicketsClientes`.`Nome` as Cliente ,`TicketsFornecedores`.`id_F`, `TicketsFornecedores`.`Nome` as Fornecedor, `Resolvido`, `TicketsFornecedores`.`Balcao`  
                                                                        FROM `TicketsPedidos` 
                                                                        INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`. `id_LS`=`TicketsListaServicos`.`id_LS` 
                                                                        INNER JOIN `TicketsFornecedores` ON `TicketsPedidos`. `id_F`=`TicketsFornecedores`.`id_F` 
                                                                        INNER JOIN `TicketsClientes` ON `TicketsPedidos`. `id_C`=`TicketsClientes`.`id_C`                                           
                                                                        where `Resolvido`=0 and `TicketsFornecedores`.`id_F`<>1
                                                                        order by `Numero`',
                                 "seePedidos" => 'SELECT `TicketsPedidos`.`id_P`, `Numero`, `Data`,  `TicketsListaServicos`.`id_LS`,`TicketsListaServicos`.`Nome` as Servico, `TicketsClientes`.`id_C`,`TicketsClientes`.
                                                  `Nome` as Cliente ,`TicketsFornecedores`.`id_F`, `TicketsFornecedores`.`Nome` as Fornecedor, `Resolvido` , TicketsFornecedores.Balcao
                                                   FROM `TicketsPedidos` 
                                                   INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`. `id_LS`=`TicketsListaServicos`.`id_LS` 
                                                   INNER JOIN `TicketsFornecedores` ON `TicketsPedidos`. `id_F`=`TicketsFornecedores`.`id_F` 
                                                   INNER JOIN `TicketsClientes` ON `TicketsPedidos`. `id_C`=`TicketsClientes`.`id_C` 
                                                   WHERE `id_P`=:id;',
                                
                                "listaPedidosResolvidosNoDiaPorFornecedor"=>'SELECT `TicketsPedidos`.`id_P`, `Numero`, `Data`,  `TicketsListaServicos`.`id_LS`,`TicketsListaServicos`.`Nome` as Servico, `TicketsClientes`.`id_C`,
                                                        `TicketsClientes`.`Nome` as Cliente ,`TicketsFornecedores`.`id_F`, `TicketsFornecedores`.`Nome` as Fornecedor, `Resolvido` 
                                                         FROM `TicketsPedidos` 
                                                   INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`. `id_LS`=`TicketsListaServicos`.`id_LS` 
                                                   INNER JOIN `TicketsFornecedores` ON `TicketsPedidos`. `id_F`=`TicketsFornecedores`.`id_F` 
                                                   INNER JOIN `TicketsClientes` ON `TicketsPedidos`. `id_C`=`TicketsClientes`.`id_C`                                           
                                                   where `Resolvido`=1 and `Data`=curdate() and `TicketsFornecedores`.`id_F`=:id order by `Numero`',
                                
                                "adicionarPedido"=>'INSERT INTO `TicketsPedidos`(`Numero`, `Data`, `id_LS`, `id_C`, `id_F`, `Resolvido`) 
                                                    VALUES (:numero,curdate(),:id_LS,1,1,0)',
                                
                                "ultimoPedido"=>'  SELECT max(`Numero`) as numPedido, max(`id_P`) as id FROM TicketsPedidos WHERE `id_LS`=:id_LS and `Data`=curdate() GROUP BY `id_LS`',
                                
                                "listaPedidosEsperaGeral"=>'SELECT COUNT(`id_P`) as numPedidos FROM `TicketsPedidos` WHERE `id_F`=1 and `Resolvido`=0',
                                
                                "pedidosResolvidosPorDia"=>'SELECT COUNT(`id_P`) as numPedidos,`Data` FROM `TicketsPedidos` WHERE `Resolvido`=1 and `Data`=:dia GROUP BY `Data`',
                                
                                "encerrarPedido"=>'UPDATE `TicketsPedidos` SET `Resolvido`=1 WHERE `id_P`=:id',
                                
                                "chamarPedido"=>'UPDATE `TicketsPedidos` SET `id_F`=:id_F WHERE `id_P`=:id',
                                
                                "pedidosAtendidosPorServicoMes"=>'SELECT year(`Data`) as Ano,month(`Data`) as Mes,`TicketsPedidos`.`id_LS`,`TicketsListaServicos`.Nome ,
                                                                  COUNT(`id_P`) as numPedidos FROM `TicketsPedidos` 
                                                                  INNER JOIN `TicketsListaServicos` ON `TicketsPedidos`.`id_LS`= `TicketsListaServicos`.`id_LS` 
                                                                  WHERE `Resolvido`=1 
                                                                  GROUP BY year(`Data`),month(`Data`),`id_LS`',
                                
                                "pedidosAtendidosPorFuncionariaMes"=>'SELECT year(`Data`) as Ano,month(`Data`) as Mes,`TicketsPedidos`.`id_F`,`TicketsFornecedores`.Nome ,
                                                                      COUNT(`id_P`) as numPedidos FROM `TicketsPedidos` 
                                                                      INNER JOIN `TicketsFornecedores` 
                                                                      ON `TicketsPedidos`.`id_F`= `TicketsFornecedores`.`id_F` 
                                                                      WHERE `Resolvido`=1 
                                                                      GROUP BY year(`Data`),month(`Data`),`id_F`',
                                
                                "listaPedidosEsperaPorServico"=>'SELECT TicketsListaServicos.Nome, COUNT(`id_P`) as numPedidos, TicketsPedidos.`id_LS` 
                                                                 FROM `TicketsPedidos` INNER JOIN TicketsListaServicos ON TicketsPedidos.id_LS=TicketsListaServicos.id_LS 
                                                                 WHERE `Resolvido`=0 and `id_F`=1 GROUP BY TicketsPedidos.`id_LS`',
                                
                                "listaPedidosResolvidosPorFornecedor"=>'SELECT TicketsFornecedores.Nome, COUNT(`id_P`) as numPedidos,TicketsPedidos.`id_F` 
                                                                        FROM `TicketsPedidos` INNER JOIN TicketsFornecedores ON TicketsPedidos.id_F=TicketsFornecedores.id_F
                                                                        WHERE `Resolvido`=1 and `Data`=current_date() GROUP BY TicketsPedidos.`id_F`'
                                );
  
   
 
  

 public function doAction($accao, $parameters=""){
    //echo "fdfsfddsdsfdsfds";
   
   //echo "<br><br>aqui $accao ffff  ";
   
     //print_r($parameters);
  
    switch ($accao){
      case "adicionarPedido":
      case "delPedidos":
      case "updPedidos":
      case "encerrarPedido":
      case "chamarPedido":
          $this->execQuery($accao, $parameters);
            break;
      case "listaPedidos":
      case "seePedidos":
      case "listaPedidosEspera":
      case "listaPedidosAtribuidosPorResolver":
      case "listaPedidosResolvidosNoDiaPorFornecedor":
      case "ultimoPedido":
      case "listaPedidosAtribuidosPorResolverPorServico":
      case "pedidosResolvidosPorDia":
      case "listaPedidosEsperaGeral":
      case "pedidosAtendidosPorServicoMes":
      case "pedidosAtendidosPorFuncionariaMes":
      case  "listaPedidosEsperaPorServico":
      case "listaPedidosResolvidosPorFornecedor":
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