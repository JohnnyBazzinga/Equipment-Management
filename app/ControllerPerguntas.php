<?php

/**
 * @autores João Bastos e Bruno Lima 
 * @copyright 2020
 * @ver 1.0
 */

namespace app;
use classes\Database;
use classes\orientacao\Perguntas;

class ControllerPerguntas{

	public function listar12PerguntasCatDiferentes($id){
    $p['id']=$id;
    $servicos=new Perguntas("12PerguntasCatDiferentes", $p);
    echo $servicos->webService();
    
    }
        
    public function listarsetePerguntasMesmaCat($id){
    $p['id']=$id;
    $servicos=new Perguntas("setePerguntasMesmaCat", $p);
    echo $servicos->webService();
	}
  
    public function listarprimeiraPergunta($id){
    $p['id']=$id;
    $servicos=new Perguntas("primeiraPergunta", $p);
    echo $servicos->webService();
  }
  
   public function segundaPergunta($id){
    $servicos=new Perguntas("segundaPergunta");
    echo $servicos->webService();
  }
  
	public function show($id) {
    
    $p['id']=$id;
    $servicos=new Categorias("seeCategorias",$p); 
	  echo $servicos->webService();

	}
  
	public function erro($message){
	 echo $this->msg('Error', $message);
	}

  public function msg($title, $message){
	 echo json_encode(['Title'=>$title, 'Message' => $message]);
	}
}


?>