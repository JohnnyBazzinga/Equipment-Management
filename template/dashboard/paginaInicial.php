<!DOCTYPE html>
<html>

<head>
  <?php include 'includes/header.php';?>

</head>
  <style>
    .tarefas {
      overflow-y: scroll;
      height: 100%;
    }

    .tecnicos {
      overflow-y: scroll;
      height: 100%;
    }

  </style>
<body>

  <?php include 'includes/sidebar.php';?>

  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Equipamentos</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php // Total de Equipamentos
                        require "includes/BDi.php";
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `produto` WHERE `composto`='0'");
                         $stmt->bind_result($composto);
                         $stmt->execute();
                         while ($stmt->fetch()){
                           echo $composto;
                             }
                         $stmt->free_result();
                      ?>
                      </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="fas fa-clone"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="material-icons">update</i> Atualizado</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Avarias</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php //Total de Avarias
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `reparacoes` WHERE 1");
                         $stmt->execute();
                         $stmt->bind_result($composto);
                         while ($stmt->fetch()){
                           echo $composto;
                             }
                         $stmt->free_result();
                      ?>
                    </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="fas fa-wrench"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="material-icons">update</i> Atualizado</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Avarias por resolver</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php // Total de reparações bem sucedidas
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `reparacoes` WHERE estadoReparacao=1");
                         $stmt->execute();
                         $stmt->bind_result($composto);
                         while ($stmt->fetch()){
                           echo $composto;
                             }
                         $stmt->free_result();
                      ?>
                    </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fas fa-sync-alt"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="material-icons">update</i> Atualizado</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Reparações bem sucedidas</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php //Total de reparações falhadas
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `reparacoes` WHERE estadoReparacao=2");
                         $stmt->execute();
                         $stmt->bind_result($composto);
                         while ($stmt->fetch()){
                           echo $composto;
                             }
                         $stmt->free_result();
                      ?>
                    </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="fas fa-check"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="material-icons">update</i> Atualizado</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--------------------- Conteúdo da Página ----------------------->
  <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-8">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Visão Geral</h6>
                  <h5 class="h3 text-white mb-0">Reparações</h5>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                        <span class="d-none d-md-block">Mês</span>
                        <span class="d-md-none">M</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                        <span class="d-none d-md-block">Semana</span>
                        <span class="d-md-none">S</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h5 class="h3 mb-0">Total orders</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="chart-bars" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <ul class="nav nav-tabs" data-tabs="tabs">
                <div class="col">
                  <h3 class="mb-0">Tarefas 
                   <a href="#!" class="btn btn-primary btn-sm" style="margin-top:1px;" data-toggle="modal" data-target="#mdladdTarefas">
                     <i class="fas fa-plus"></i></a></h3>
                </div>
                <li class="nav-item">
                  <a class="nav-link active" href="#tarefasDisponiveis" data-toggle="tab">
                    <i class="material-icons">event_available</i> Tarefas Disponiveis
                    <div class="ripple-container"></div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#tarefasEmProgresso" data-toggle="tab">
                    <i class="material-icons">published_with_changes</i> Tarefas em Progresso
                    <div class="ripple-container"></div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#tarefasConcluidas" data-toggle="tab">
                    <i class="material-icons">check_circle</i> Tarefas Concluidas
                    <div class="ripple-container"></div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!--------------------- Tarefas por fazer ----------------------->
          <div class="card-body tarefas">
            <div class="tab-content">
              <div class="tab-pane active" id="tarefasDisponiveis">
                <table class="table align-items-center table-flush" id="tbltarefasDisponiveis">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Data</th>
                      <th style='display:none;' scope="col">Tarefa</th>
                      <th scope="col">Tarefa</th>
                      <th scope="col">Sala</th>
                      <th scope="col">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                /* $stmt = $DB->prepare("SELECT `id`, `data`, `realizado`, `tarefa`, numeroSala FROM `tarefas` WHERE realizado=0 ORDER BY `data`");
                 $stmt->execute(); 

                 $stmt->bind_result($id, $data, $realizadorealizado, $tarefa, $numeroSala);
                 while ($stmt->fetch())
                   echo '<tr data-id="',$id,'" data-tarefa="',$tarefa,'">
                       <td>',$data,'</td>
                       <td style="display:none;">',$tarefa,'</td>
                       <td>',substr($tarefa,0,20),'...</td>
                       <td >',$numeroSala, '</h1></td>
                       <td>
                       <a class="verTarefa" style="cursor: pointer;"><i class="material-icons">visibility</i></a>
                       <a class="emProgresso" style="cursor: pointer;"><i class="material-icons">event_available</i></a>
                       </td>
                       </tr>';
                
                 $stmt->free_result();*/
                      ?>
                  </tbody>
                </table>
              </div>
              <!--------------------- Tarefas em Progresso ----------------------->
              <div class="tab-pane" id="tarefasEmProgresso">
                <table class="table align-items-center table-flush w-100" id="tblTarefasEmProgresso">
                  <thead class="thead-light">
                    <tr>

                      <th scope="col">Data</th>
                      <th style='display:none;' scope="col">Tarefa</th>
                      <th scope="col">Tecnico a realizar</th>
                      <th scope="col">Tarefa</th>
                      <th scope="col">Sala</th>
                      <th scope="col">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                 /*$stmt = $DB->prepare("SELECT `id`, `conclusao`, `realizado`, `tarefa`,numeroSala, quemRealiza FROM `tarefas` WHERE realizado=1 ORDER BY `data`");
                 $stmt->execute(); 

                 $stmt->bind_result($id, $conclusao, $realizado, $tarefa, $numeroSala, $quemRealiza);
                 while ($stmt->fetch())
                   echo '<tr data-id="',$id,'" data-tarefa="',$tarefa,'">
                       <td>',$conclusao,'</td>
                       <td>',$quemRealiza,'</td>
                       <td style="display:none;">',$tarefa,'</td>
                       <td>',substr($tarefa,0,20),'...</td>
                       <td>',$numeroSala,'</td>
                       <td>
                       <a class="verTarefaEmProgresso" style="cursor: pointer;"><i class="material-icons">visibility</i></a>
                       <a class="info" style="cursor: pointer;"> <i class="material-icons">check_circle</i></a></td></tr>';
                
                 $stmt->free_result();*/
                      ?>

                  </tbody>
                </table>
              </div>
              <!--------------------- Tarefas Concluidas ----------------------->
              <div class="tab-pane" id="tarefasConcluidas">
                <table class="table align-items-center table-flush w-100" id="tblTarefasConcluidas">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Data de Conclusão</th>
                      <th style='display:none;' scope="col">Tarefa</th>
                      <th scope="col">Tarefa</th>
                      <th scope="col">Sala</th>
                      <th scope="col">Quem Realizou</th>
                      <th scope="col">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                 /*$stmt = $DB->prepare("SELECT `id`, `conclusao`, `realizado`, `tarefa`, numeroSala,quemRealiza FROM `tarefas` WHERE realizado=2 ORDER BY `data`");
                 $stmt->execute(); 

                 $stmt->bind_result($id, $conclusao, $realizado, $tarefa, $numeroSala, $quemRealiza);
                 while ($stmt->fetch())
                   echo '<tr data-id="',$id,'" data-tarefa="',$tarefa,'">
                       <td>',$conclusao,'</td>
                       <td style="display:none;">',$tarefa,'</td>
                       <td>',substr($tarefa,0,20),'...</h1></td>
                       <td>',$numeroSala,'</h1></td>
                       <td>',$quemRealiza,'</h1></td>
                       <td>
                       <a class="verTarefaTerminada" style="cursor: pointer;"><i class="material-icons">visibility</i></a>
                       </td>
                       </tr>
                       ';
                
                 $stmt->free_result();*/
                      ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--------------------- Estatísticas dos técnicos ----------------------->
      <div class="col-xl-4">
        <div class="card" style="height: 93%;">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Estatísticas dos Técnicos</h3>
              </div>
              <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tecnicosEstatisticas">Mais informações</a>
              </div>
            </div>
          </div>
          <div class="table-responsive tecnicos">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="tecnicosStats">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Técnicos</th>
                  <th scope="col">Nº Reparações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  
                   /*$stmt = $DB->prepare("SELECT gestaoUtilizadores.foto, gestaoUtilizadores.nome, COUNT(idUserReparacao)
                                        AS reparacoes_count FROM gestaoUtilizadores JOIN reparacoes ON reparacoes.IdUserReparacao = gestaoUtilizadores.nome 
                                        GROUP BY `idUser`");
                   $stmt->execute(); 

                   $stmt->bind_result($foto, $nome, $idUserReparacao);
                   while ($stmt->fetch())
                     echo "
                     <tr>
                           <td><img class='img' src='",$foto,"' style='border-radius: 50%;' width='50px'>&nbsp;&nbsp;$nome</td>
                           <td>$idUserReparacao</td>
                          </tr>";
                   $stmt->free_result();*/
                    ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include 'includes/footer.php';?>
  </div>
  <!-- ---------------------------------------Modais----------------------------------------------------------- -->

  <!-- ---Modal Adicionar Tarefas--- -->
  <div id="mdladdTarefas" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adicionar Tarefa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/dashboard/phpcodes/tarefas.php" method="post" id="frmaddTarefas">
             <div class="form-group">
            <input type="hidden" class="form-control" id="idUser" name="idUser" value="" required="">
            <h4 class=""><b>Tarefa</b></h4>
            <textarea style="resize: none;" id="descTarefa" name="descTarefa" class="form-control" rows="4" cols="50" required></textarea>
               </div>
                              <div class="form-group">
                    <label class="form-control-label"><b>Escola</b></label>
                    <input type="hidden" name="escolaSTR" id="escolaSTR"/>
                    <select name="escolas" id="escolas" value="escolas" class="custom-select sources" placeholder="My Categories" required>
                    <option value=''>Selecione a Escola</option>
                      <?php
                         $stmt = $DB->prepare("SELECT id,escola FROM escolas WHERE 1");
                         $stmt->execute(); 
                         $stmt->bind_result($id,$escola);
                         while ($stmt->fetch())
                            echo "<option name='$id' id='$id' value='$id'>$escola</option>";
                         $stmt->free_result();
                             ?>
                   </select>
                  </div>
                    <div class="form-group">
                      <h4 class=""><b>Sala</b></h4>
                      <select name="salas" id="salas" required="true" class="custom-select sources" placeholder="My Categories" required>
                                              <?php
                         $stmt = $DB->prepare("SELECT numeroSala, descritivo FROM salas ORDER BY numeroSala");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala, $descritivo);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result();
                             ?>
                      </select>
                    </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitAdd" id="submitAdd" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Adicionar</button>
        </div>
        </form>
      </div>

    </div>
  </div>
  
  
  <!-- ---Modal Fazer Tarefas--- -->
  <div id="mdlTarefasEmProgresso" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tarefas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <p>Deseja executar esta tarefa?</p>
          <form action="/template/dashboard/phpcodes/tarefas.php" method="post">
            <input type="hidden" class="form-control" id="idTarefa" name="idTarefa" value="" required="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn1" data-dismiss="modal" style="margin: 1.3125rem 6px;">Não</button>
          <input type="submit" id="submitFazerTarefa" name="submitFazerTarefa" class="btn btn-success btn1" style="margin: 1.3125rem 6px;" value="Sim">
        </div>
        </form>
      </div>

    </div>
  </div>

  <!-- ---Modal Ver tarefa completa--- -->
  <div id="mdlVerTarefa" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tarefa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <!-- <input type="hidden" class="form-control" id="idTarefa" name="idTarefa" value="" required=""> -->
          <p id="tarefaVer"></p>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  
    <!-- ---Modal Terminar Tarefa--- -->
  <div id="mdlTarefas" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tarefas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <p>Deseja marcar a tarefa como realizada?</p>
          <form action="/template/dashboard/phpcodes/tarefas.php" method="post" id="frmTarefas">
            <input type="hidden" class="form-control" id="idTarefaConcluir" name="idTarefaConcluir" value="" required="">
            <p id="desc"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn1" data-dismiss="modal" style="margin: 1.3125rem 6px;">Não</button>
          <input type="submit" name="submitTerminar" id="submitTerminar" class="btn btn-danger btn1" style="margin: 1.3125rem 6px;" value="Sim">
        </div>
        </form>
      </div>
    </div>
  </div>
  
    <!-- ---Modal Tecnicos Estatisticas--- -->

  <div id="tecnicosEstatisticas" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width:900px">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Estatísticas Gerais dos Técnicos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="tecnicosStatsGerais">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Técnicos</th>
                  <th scope="col"></th>
                  <th scope="col">Nº Reparações</th>
                  <th scope="col">Reparações Concluidas</th>
                  <th scope="col">Reparações Falhadas</th>
                </tr>
              </thead>
              <tbody>
                <?php
                   /*$stmt = $DB->prepare("SELECT gestaoUtilizadores.foto, gestaoUtilizadores.nome, COUNT(idUserReparacao)
                                                  AS reparacoes_count FROM gestaoUtilizadores JOIN reparacoes ON reparacoes.IdUserReparacao = gestaoUtilizadores.nome 
                                                  GROUP BY `idUser`");
                   $stmt->execute(); 

                   $stmt->bind_result($foto, $nome, $reparacoes);
                   while ($stmt->fetch())
                     echo "
                     <style>
                      .card .table td, .card .table th {
                        padding-right: 0rem;
                        padding-left: 0rem;
                        padding: 0.5rem;
                     </style>
                     <tr>
                           <td><img class='img' src='",$foto,"' style='border-radius: 50%;' width='50px'></td>
                           <td>$nome</td>
                           <td>$reparacoes</td>
                           <td>5</td>
                           <td>10</td>
                           </tr>";
                   $stmt->free_result();*/
                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'includes/scripts.php';?>
    	<script>

// escolher salas de uma escola especifica-------------------------------
		var salas = new Array();
            salas[2] += "<?php 
                         $stmt = $DB->prepare("SELECT numeroSala FROM salas WHERE escola = 'Escola Secundária de Monserrate'");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result(); ?>"
            salas[1] += "<?php 
                         $stmt = $DB->prepare("SELECT numeroSala FROM salas WHERE escola = 'Escola Pedro Barbosa'");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result(); ?>"

function mostrasalas(){
	$("#salas").html('<option value="" disabled selected>Selecione a sala</option>' + 
		salas[$("#escolas").val()]);
}
      
	$(document).ready(function(){
		mostrasalas();
			$("#escolas").change(function(){
				$("#escolaSTR").val($("#escolas option:selected").text());
				mostrasalas();
			});
		});
//-----------------------------------------------------------------------------
	</script>
  
  <script>
    $(document).ready(function() {
      $(".info").click(function() {
        var linha = $(this).closest("tr");
        $("#idTarefaConcluir").val(linha.data("id"));
        $("#desc").html(linha.find("th").eq(2).html());
        $("#mdlTarefas").modal("show");
      });

      //----------------------------------------------------------

      $("#tbltarefas tbody tr").click(function() {
        //alert($(this).data("tarefa"))
        $("#tarefasdetalhe .modal-body").html($(this).data("tarefa"))
        $("#tarefasdetalhe").modal("show");



      })
      $(".emProgresso").click(function() {
        var linha = $(this).closest("tr");
        $("#idTarefa").val(linha.data("id"));
        $("#mdlTarefasEmProgresso").modal("show");


      })

      $(".verTarefa").click(function() {
        var linha = $(this).closest("tr");
        $("#tarefaVer").html(linha.find("td").eq(1).html());
        $("#mdlVerTarefa").modal("show");
      })

      $(".verTarefaEmProgresso").click(function() {
        var linha = $(this).closest("tr");
        $("#tarefaVer").html(linha.find("td").eq(2).html());
        $("#mdlVerTarefa").modal("show");


      })

      $(".verTarefaTerminada").click(function() {
        var linha = $(this).closest("tr");
        $("#tarefaVer").html(linha.find("td").eq(1).html());
        $("#mdlVerTarefa").modal("show");


      })


      $('#tbltarefasDisponiveis').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
        }
      });

      $('#tblTarefasEmProgresso').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
        }
      });

      $('#tblTarefasConcluidas').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
        }
      });


      $('#tecnicosStats').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
        },
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false
      });

      $('#tecnicosStatsGerais').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
        }
      });

    });
  </script>

</body>