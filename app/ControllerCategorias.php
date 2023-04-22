<?php

/**
 * @autores Cristóvão Lavarinhas
 * @copyright 2020
 * @ver 1.0
 */

namespace app;
use classes\Database;
use classes\orientacao\Categorias;

class ControllerCategorias{

	public function listaCategorias(){
    $servicos=new Categorias("listaCategorias");
    echo $servicos->webService();
        
	}
  

	public function show($id) {
    
    $p['id']=$id;
    $servicos=new Categorias ("seeCategorias",$p); 
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