<?php
/**
 * @author alf
 * @copyright 2019
 *
 */

/* The purpose of this class is to manager the text string for the active linguage */
/*Requeriments:
    for each linguage suported must be add a file with the texts*/
/*Methods:
    ClassLingua() - is the class constroctor
    private function getActiveLinguage() - determine the active linguage by searchin a session variable in frist place and if is do not exist search on the configuration file. 
                                           If neither option existe choose the english by default
    public function getLinguage() - returns the current linguage
    public function setLinguage($linguage) - determine that language used is the one is indicated on $language. The language is indicated with string of two caracter.
    public function readText($tag,$value="") - providing a tag that represent a text, return a string of a text in the language select in the site. $tag is the text indentifier e 
                                               $value (optional) the text to return if no traduction are find.
    public function textsTranslate($texts) - providing a array os texts identifiers, with or without default values, to make a translation for the language define for te site. 
                                             $texts is the array with the identifiers and default values. The format for the array is:
          $texts=[
                    "autent" => "there isn't a translate for autent",
                    "login" =>"Login",
                    "pass" =>"",
                    "ok" =>"",
                    "logout" =>"",
                    "remember" =>"there isn't a translate for remember",
                    "cancel" => "",
                    "administar" =>""
              ];
 */


include_once $_SERVER['DOCUMENT_ROOT'] . "/forum/config.php";

//echo "lingua";
class ClassLingua{
    
  private $lin="pt";
  
  //#######################################################################################################
  
    public function __construct(){
      $this->getActiveLinguage();
    }
 
  //#######################################################################################################
  
    private function getActiveLinguage(){
      if (isset($_SESSION['ling'])){
        $this->lin=$_SESSION['ling'];
      }else{
         if ((_LINGUA)!=""){ 
           $this->setLinguage(_LINGUA);
        } 
      }
    }
    
  //#######################################################################################################
  
    public function getLinguage(){
      return $this->lin;
    }
  
  //#######################################################################################################
  
    public function setLinguage($linguage){
      $this->lin=$linguage;
      $_SESSION['ling']= $this->lin;
    }
    
  //#######################################################################################################
  
    public function readText($tag,$value=""){
          $lin= $this->lin;
          //echo "ingua";
          require $_SERVER['DOCUMENT_ROOT'] ._CAMINHO_CLASSES ."/lingua/$lin.php";
          //echo "$tag <br>";
          if (isset($t[$tag])){
            $s=$t[$tag];
          }else{
            $s=$value;
          }
          return ($s);
    }
  
  //#######################################################################################################
  // ############################## Deprecated ############################################################
  
    public function leTexto($tag,$value=""){
          $s=$deprecatedLeTexto . "";
          $s=$this->readText($tag,$value);
          return ($s);
      }
    
  //#######################################################################################################
  
    public function textsTranslate($texts){
        $novoArray;
        foreach ($texts as $t=>$valor){
            //echo $t;
            $v=$this->readText($t,$valor);
            //echo $valor;
            $novoArray[$t]=$v;
        };
        return $novoArray;
    }
 
  //#######################################################################################################
  //############################### Deprecated ############################################################
  
  
    public function traduzTextos($textos){
        $s=$deprecatedTraduzTextos . "";
        $novoArray=$this->textsTranslate($textos);
        return $novoArray;
    }
}
//echo "fim lingua";
?>