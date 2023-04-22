<?php

/**
 * @autores Artur Guia, Nuno Cruz, Nuno Carvalhido, Válter Rocha
 * @copyright 2020
 * @ver 1.0
 */

namespace app;
use classes\Database;
use classes\tickets\Servicos;

class ControllerServicos{

	public function listaServicos(){
    $servicos=new Servicos("listaServicos");
    echo $servicos->webService();
        
	}
  
  public function servicosAtivos(){
    $pedidos=new Servicos("servicosAtivos");
    echo $pedidos->webService();
        
    //$this->erro("bbbbbbbb sdddbdbfsd ");
	}


	public function show($id) {
    
    $p['id']=$id;
    $servicos=new Servicos("seeServicos",$p); 
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