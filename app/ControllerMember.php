<?php

/**
 * @autores Artur Guia, Nuno Cruz, Nuno Carvalhido, Válter Rocha
 * @copyright 2020
 * @ver 1.0
 */

namespace app;
use classes\Database;
use classes\ClassSocios;
use classes\authentication\Authentication;

//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';


class ControllerMember{

	public function listaSocios(){
    $socios=new ClassSocios("listMembersActive");
    echo $socios->webService();
        
    //$this->erro("bbbbbbbb sdddbdbfsd ");
	}

	public function show($id) {
    //echo "id=" .  $id;
    $p['id']=$id;
    //print_r($p);
  $membro=new ClassSocios("seeMember",$p); 
	echo $membro->webService();

	}
  
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