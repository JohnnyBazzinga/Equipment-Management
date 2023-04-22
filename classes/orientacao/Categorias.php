<?php

/**
 * @autores Cristóvão Lavarinhas
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\orientacao;
use classes\db\Database;
use classes\db\LayerDB;

ini_set("error_reporting", E_ALL);

class Categorias extends LayerDB{
 
  public $instrucaoSQL = array ("listaCategorias" => 'SELECT `id`, `categoria`, `Descrição` FROM `cl_categoria` ORDER BY `categoria`',
                                 "seeCategorias" => 'SELECT `id`, `categoria`, `Descrição` FROM `cl_categoria` WHERE id = 3;',
                                  
                                );
 

 public function doAction($accao, $parameters=""){
    switch ($accao){
            $this->execQuery($accao, $parameters);
            break;
      case "listaCategorias":
      case "seeCategorias":
            $this->getQuery($accao, $parameters);
            break;  
      default:
          break;
    }
  }
 
}

?>