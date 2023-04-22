<?php

/**
 * @autores Artur Guia, Nuno Cruz, Nuno Carvalhido, Válter Rocha
 * @copyright 2020
 * @ver 1.0
 */

namespace app;
use classes\Database;
use classes\tickets\Artigos;
//use classes\authentication\Authentication;

//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';


class ControllerArtigos{

	public function listaArtigos($id){
    $p['id']=$id;
    $artigos=new Artigos("listaArtigos",$p);
    echo $artigos->webService();
        
    //$this->erro("bbbbbbbb sdddbdbfsd ");
	}

	//public function show($id) {
    //echo "id=" .  $id;
    //$p['id']=$id;
    //print_r($p);
  //$clientes=new Clientes("seeCliente",$p); 
	//echo $clientes->webService();

	//}
  
  public function login() {
    if (isset($_POST['email']) && isset($_POST['pass'])){
      $p['email']=$_POST["email"];
      $p['pass']=$_POST["pass"];
      $membro=new ClassSocios("login",$p); 
      if ($membro->results[0]['numElements']>0){
        //grava variaáveis de sessão
        $dataSession= new Authentication();
        $dataSession->setAuthentication($membro->results[0]['Email'],$membro->results[0]['Socio'],$membro->results[0]['Level']);
        echo $membro->webService();
        //header("Location: http://www.forumvianense.php");
        die();
      }else{
        $this->erro("Wrong email and/or Password");
      }
      print_r($membro->results);
      
	    
    }else{
      $this->erro("You should provide email and Password");
    }
	}

  public function logout() {
    $dataSession= new Authentication();
    $dataSession->logout();
    $this->msg("Result","Logout Successely");
	}
  
	public function erro($message){
	 echo $this->msg('Error', $message);
	}

  public function msg($title, $message){
	 echo json_encode(['Title'=>$title, 'Message' => $message]);
	}
}


//$cl=new ControllerMember();
//$cl->index();message
//echo "ole";
?>