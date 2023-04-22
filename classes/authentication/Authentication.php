<?php

namespace classes\authentication;

//use classes\db\Database;

//ini_set("error_reporting", E_ALL);

/**
 * @author alf
 * @copyright 2019
 * @ver 4.0
 */
 
 
 
//echo "aqui";
class Authentication{
    
	
	   
    public function __construct(){
      //session_start();
		}
 
    //Save session varibles for autentication
    public function setAuthentication($user, $nome,$fornecedor,$balcao,$servico,$level=1){
      $_SESSION['user']=$user;
      $_SESSION['nome']=$nome;
      $_SESSION['mesa']=$balcao;
      $_SESSION['servico']=$servico;
      $_SESSION['fornecedor']=$fornecedor;
      $_SESSION['level']=$level;
    }
  
  //clean session varibles for autentication
    public function logout(){
      $_SESSION['user']=null;
      $_SESSION['nome']=null;
      $_SESSION['mesa']=null;
      $_SESSION['servico']=null;
      $_SESSION['fornecedor']=null;
      $_SESSION['level']=null;
    }
    
  
    //get session varible user
    public function getUser(){
      return $_SESSION['user'];
    }

 public function getServico(){
      return $_SESSION['servico'];
    }

 public function getFornecedor(){
      return $_SESSION['fornecedor'];
    }
  
  
  //get session varible user
    public function getName(){
      return $_SESSION['nome'];
    }
  
  //get session varible user
    public function getLevel(){
      return $_SESSION['level'];
    }
   
  //verify if a usser is loged
  public function isLoged(){
    $resp=False;
    if (isset( $_SESSION['user'])){
      if ($_SESSION['user']!=""){
        $resp=True;
      }
    return $resp;
    }
  }
}

?>