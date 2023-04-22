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

class Perguntas extends LayerDB{
 
  public $instrucaoSQL = array ("12PerguntasCatDiferentes" => 'SELECT `id`, `pergunta`, `id_categoria`, `ordem` FROM `jmbPerguntas` WHERE `ordem`=:id',
                                "setePerguntasMesmaCat" => 'SELECT `id`, `pergunta`, `id_categoria`, `ordem` FROM `jmbPerguntas` WHERE `id_categoria`=:id',                                  
                                "primeiraPergunta" =>'SELECT `id`, `pergunta`, `id_categoria`, `ordem` FROM `jmbPerguntas` WHERE `id`=:id',
                                "segundaPergunta" =>'SELECT `id`, `pergunta`, `id_categoria`, `ordem` FROM `jmbPerguntas` WHERE `id_categoria`=1',
                                );
 
  

 public function doAction($accao, $parameters=""){
    switch ($accao){
      case "kjhkj":
            $this->execQuery($accao, $parameters);
            break;
      case "12PerguntasCatDiferentes":
      case "setePerguntasMesmaCat":
      case "primeiraPergunta":
      case "segundaPergunta":
            $this->getQuery($accao, $parameters);
            break;  
      default:
          break;
    }
  }
 
}

?>