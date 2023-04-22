<?php

/**
 * @autores João Bastos e Bruno Lima 
 * @copyright 2020
 * @ver 1.0
 */

namespace app;
use classes\Database;
use classes\equipamentos\Equipamentos;

class ControllerEquipamentos{
  
   public function qrCode($serie){
     $p['serie']=$serie;
    $servicos=new Equipamentos("qrCode", $p);
    echo $servicos->webService();
  }

     public function listarTarefas(){
    $servicos=new Equipamentos("listarTarefas");
    echo $servicos->webService();
  }
 
  
	public function listarEquipamentosCompostos(){
    $servicos=new Equipamentos("listarEquipamentosCompostos");
    echo $servicos->webService();
    
    }
  	public function listarEquipamentosTodos(){
    $servicos=new Equipamentos("listarEquipamentosTodos");
    echo $servicos->webService();
    
    }
        
    public function listaComponentesEquipamento($pai){
    $p['pai']=$pai;
    $servicos=new Equipamentos("listaComponentesEquipamento", $p);
    echo $servicos->webService();
	}
  
    public function procurarEquipamentoNumeroSerie($serie){
    $p['serie']="%".$serie."%";
    $servicos=new Equipamentos("procurarEquipamentoNumeroSerie", $p);
    echo $servicos->webService();
  }
  
   public function procurarEquipamentoPisoSala($sala){
     $p['sala']=$sala;
    $servicos=new Equipamentos("procurarEquipamentoPisoSala", $p);
    echo $servicos->webService();
  }
  
   public function listarAvarias(){
    $servicos=new Equipamentos("listarAvarias");
    echo $servicos->webService();
  }
     public function contadorEquipamentos(){
    $servicos=new Equipamentos("contadorEquipamentos");
    echo $servicos->webService();
  }
       public function listarTecnicos(){
    $servicos=new Equipamentos("listarTecnicos");
    echo $servicos->webService();
  }
  
         public function listarNiveis(){
    $servicos=new Equipamentos("listarNiveis");
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