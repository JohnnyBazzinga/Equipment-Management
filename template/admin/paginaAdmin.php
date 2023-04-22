<?php 
 /*     if($_SESSION["nivel"] == '2')
                {
                } else {
                echo '<script>
            window.location.href="http://stock.alunos.esmonserrate.org/public/equipamentos/inicio";
            alert("Sem acesso");
            </script>';
      }

include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/verificalogin.php';*/?>

<!DOCTYPE html>
<html>

<head>


  <?php include 'template/dashboard/includes/header.php'; ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
</head>

<body>

  <style>
    .tarefas {
      overflow-y: scroll;
      height: 500px;
    }

    .tecnicos {
      overflow-y: scroll;
      height: 478px;
    }
  </style>

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
                        <?php
                       require 'template/dashboard/includes/BDi.php';
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `produto` WHERE `composto`='0'");
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
                        <?php
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
                <!-- Card stats -->
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Utilizadores</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `gestaoUtilizadores` WHERE 1");
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
                    <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                      <i class="fas fa-user-friends"></i>
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
                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Escolas</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `escolas` WHERE 1");
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
                      <i class="fas fa-school"></i>
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
                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Salas</h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php
                         $stmt = $DB->prepare("SELECT COUNT(*) AS count FROM `salas` WHERE 1");
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
                      <i class="fas fa-door-open"></i>
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
                    <h5 class="card-title text-uppercase text-muted mb-0">Nota final (20) </h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?php
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
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="fas fa-times"></i>
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
  </div>
  </div>


</body>

<?php include 'template/dashboard/includes/scripts.php';?>

</html>