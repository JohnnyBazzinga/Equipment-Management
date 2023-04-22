<?php

/**
 * @autores alf
 * @copyright 2020
 * @ver 1.0
 */

namespace classes\tvguia;
use classes\db\Database;
use classes\db\LayerDB;

ini_set("error_reporting", E_ALL);

class Programas extends LayerDB{
 
  public $instrucaoSQL = array ("ProgramasPortTipo" => 'SELECT `codGuia`, DATE(`dataHora`) as dt, guia.`codCanal`, canal.canal, programas.`codPrograma`, programas.nome, programas.tipo, 
                                                        programas.foto, programas.classificacao, canal.logo, programas.tmdb, `dataHora` 
                                                        FROM `guia` INNER JOIN programas on guia.codPrograma=programas.codPrograma INNER join canal on canal.codCanal= guia.codCanal 
                                                        WHERE programas.tipo=:tipo order by dt desc, classificacao desc',
                                "ProgramaPorNome" => 'SELECT `codPrograma` FROM `programas` WHERE `nome`=:nome',
                                "ProgramasAdiciona"=> 'INSERT INTO programas (`nome`, `tipo`) 
                                                        SELECT :nome, :tipo  
                                                        WHERE NOT EXISTS (SELECT nome FROM programas WHERE nome=:nome ) LIMIT 1;',
                                "ProgramasPorProcessar"=> 'SELECT `codPrograma`, `nome` FROM `programas` WHERE `processado`=0 and tipo=1' ,
                                "ProgramasPorAdicionarGrelha"=> 'SELECT `idPlana`, `dataHora`, `canal`, `nome`, `processado` FROM `plana` WHERE `processado`=1',
                                "ProgramasActualizaAdicaoPrograma" => 'UPDATE `programas` SET `foto`=:foto,`processado`=1,`classificacao`=:class,`tmdb`=:tmdbid, fonte=:fonte, tipo=:tipo WHERE `codPrograma`=:id;',
                                "ProgramasProcurarSeries" => 'UPDATE `programas` SET `tipo`=7 WHERE `nome` like "%T.__ Ep.%"; UPDATE `programas` SET `tipo`=7 WHERE `nome` like "%T._ Ep.%"',
                                "programasProcurarFutebol" => 'UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Liga Italiana%"; UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Liga NOS%"; 
                                                              UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Premier League%"; UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Segunda Liga%";
                                                              UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Liga das Nações%"; UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Grande Jornada%";
                                                              UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Qualificação Euro%";UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Jogo de Preparação%";
                                                              UPDATE `programas` SET `tipo`=5 WHERE `nome` like "%Qualificação Mundial%";',
                                "PlanaPorProcessar"=> 'SELECT `idPlana`, `nome`, `processado`, `canal` FROM `plana` WHERE `processado`=0 order by `canal`',
                                "PlanaImport" => 'INSERT INTO plana (dataHora, canal, nome) 
                                                        SELECT :dataHora, :canal, :nome 
                                                        WHERE NOT EXISTS (SELECT dataHora, canal, nome FROM plana WHERE dataHora=:dataHora and canal =:canal and nome= :nome ) LIMIT 1;',
                                "PlanaActualizaAdicaoPrograma" => 'UPDATE `plana` SET `processado` = 1 WHERE `plana`.`idPlana` = :idPlana;',
                                "PlanaFinalizaCopiaParaGrelha" => 'UPDATE `plana` SET `processado` = 2 WHERE `plana`.`idPlana` = :idPlana;',
                                "PlanaApagaLixo" => 'DELETE FROM `plana` WHERE `nome` like "%Últimas Notícias (Direto)%"; DELETE FROM `plana` WHERE `nome` like "%Fan Zone (Direto)%"; 
                                                     DELETE FROM `plana` WHERE `nome` like "%Central + (Direto)%"; DELETE FROM `plana` WHERE `nome` like "%Titulares (Direto)%"; 
                                                     DELETE FROM `plana` WHERE `nome` like "%Últimas Notícias%"; DELETE FROM `plana` WHERE `nome` like "%Jornal de Sábado%";
                                                     DELETE FROM `plana` WHERE `nome` like "Notícias";',
                                "GrelhaAdicionaPrograma" => 'INSERT INTO `guia`(`dataHora`, `codCanal`, `codPrograma`) VALUES (:dataHora,:codCanal,:codPrograma);',
                                "CanalInformacao"=> 'SELECT `codCanal`, `canal`, `criterioGuiaTv`, `codTipoProgramas` FROM `canal` WHERE `canal`=:canal');
  
 
 public function doAction($accao, $parameters=""){
    switch ($accao){
      case "ProgramasPortTipo":
      case "ProgramasAdiciona":
      case "PlanaActualizaAdicaoPrograma":
      case "ProgramasActualizaAdicaoPrograma":
      case "PlanaFinalizaCopiaParaGrelha":
      case "GrelhaAdicionaPrograma":
            $this->execQuery($accao, $parameters);
            break;
      case "ProgramasPortTipo":
      case "ProgramaPorNome":
      case "ProgramasPorAdicionarGrelha":
      case "PlanaPorProcessar":
      case "CanalInformacao":
      case "ProgramasPorProcessar":
            $this->getQuery($accao, $parameters);
            break;  
      default:
          break;
    }
  }
 
  
  public function importarCanais($canais){
    foreach($canais as $canal){
      echo "<br><b>Canal: " . $canal . "</b><br>";
      $this->importarCana($canal);
    }
  }
  
  public function importarCanaisApartirDaNos($canais, $canaisNos){
    $i=0;
    foreach($canais as $canal){
      echo "<br><b>Canal: " . $canal . "</b><br>";
      $this->importarCanaApartirDaNos($canaisNos[$i], $canal);
      $i++;
    }
  }
  
  
  public function importarCana($canal){
    // importa na guia-tv a programação de hoje de um canal
    $url = "https://www.guia-tv.pt";
    $page = file_get_contents($url);
    echo $url . "<br>";
    $canais=explode("<p>$canal</p>", $page);
    //echo($canais[0]);
    if (sizeof($canais)>1){
      $canais=explode("canal-style-2", $canais[1]);
      //echo($canais[0]);
      $canais=explode('class="canal-listing-time">', $canais[0]);
      //echo sizeof($canais). "<br>";
      //echo($canais[240]); 
      for ($i=1; $i<sizeof($canais); $i++){
        //echo($canais[$i]);
        $hora=explode('</div>  ', $canais[$i]);
        $nomeaux=explode('class="canal-listing-name">', $canais[$i]);
        //echo($canal[1]); 
        $nome=explode('</div>', $nomeaux[1]);
        //$foto=explode('" alt="', $fotoAux[1]);
        //$canal=explode('"', $foto[1]);
        //echo "$hora[0] - $nome[0]";
        //echo "<br>";
        $p['dataHora']=date("Y-m-d") . " " . $hora[0];
        $p['canal']=$canal;
        $p['nome']=$nome[0];
        //print_r($p);
        echo "<i>" . $nome[0] . "</i><br>";
        $this->doAction("PlanaImport", $p);

    }
    

    }
  }
  
  
  public function importarCanaApartirDaNos($canal, $canalBd){
    // importa na guia-tv a programação de hoje de um canal
    //$canal="NOSSTUDIOSHD";
    //$canalBd="NOS STUDIOS";
    $url = "https://www.nos.pt/particulares/televisao/guia-tv/Pages/default.aspx";
    $page = file_get_contents($url);
    //echo $url . "<br>";
    $canais=explode(" id='$canal'>", $page);
    //print_r($canais);
    $canais=explode('<div class="clearfix">', $canais[1]);
    //echo "<br><b>Canal: " . $canal . "</b><br>";
    //echo($canais[1]);
    $filmes=explode("<a class='filmes'", $canais[0]);
    if (sizeof($filmes)>1){
      for ($i=1; $i<sizeof($filmes); $i++){
        //echo($canais[$i]);
        $filmeAux=explode("title='", $filmes[$i]);
        $filme=explode("'><span", $filmeAux[1]);
        
        $hora=explode('duration">', $filme[1]);
        $hora=explode('-', $hora[1]);
        $hora[0]=trim($hora[0]);
        echo "<i>filme: " . $filme[0]. "</i>(" . $hora[0] . ")<br>";
        //$nomeaux=explode('class="canal-listing-name">', $canais[$i]);
        //echo($canal[1]); 
        //$nome=explode('</div>', $nomeaux[1]);
        //$foto=explode('" alt="', $fotoAux[1]);
        //$canal=explode('"', $foto[1]);
        //echo "$hora[0] - $nome[0]";
        //echo "<br>";
        $p['dataHora']=date("Y-m-d") . " " . $hora[0];
        $p['canal']=$canalBd;
        $p['nome']=$filme[0];
        //print_r($p);
        //echo "<i>" . $filme[0] . "</i><br>";
        $this->doAction("PlanaImport", $p);

      }
    }
  
  }
  
}

//#########################################################################################################################################################################################################
//$aux=new ClassTempos("MediasTemposFuncionariosMes");
/*$d=$aux->resposta[0]['dados'];
    echo " var chart_data = [$d];";
    $d=$aux->resposta[1]['dados'];
    echo " var chart_data1 = [$d];";
    $d=$aux->resposta[2]['dados'];
    echo " var chart_data2 = [$d];";

*/
//phpinfo();
//$socio=new ClassSocios("listMembersActive");
//print_r($socio->results);
//echo "aaa";
?>