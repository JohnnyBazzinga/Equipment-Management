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
      <h2 class="text-left border-bottom mt-3" style="color: white;"><i class="fas fa-school"></i> Escola Secundária de Monserrate</h2>
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
      <h2 class="text-left border-bottom mt-3" style="color: white;"><i class="fas fa-school"></i> Escola Pedro Barbosa</h2>
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
        <div class="col-xl-6">
          <!--* Card header *-->
          <!--* Card body *-->
          <!--* Card init *-->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Surtitle -->
              <h6 class="surtitle">Escola Secundária de Monserrate</h6>
              <!-- Title -->
              <h5 class="h3 mb-0">Avarias</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <!--* Card header *-->
          <!--* Card body *-->
          <!--* Card init *-->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Surtitle -->
              <h6 class="surtitle">Escola Pedro Barbosa</h6>
              <!-- Title -->
              <h5 class="h3 mb-0">Avarias</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-bars" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <!--* Card header *-->
          <!--* Card body *-->
          <!--* Card init *-->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Surtitle -->
              <h6 class="surtitle">Growth</h6>
              <!-- Title -->
              <h5 class="h3 mb-0">Sales value</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-points" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <!--* Card header *-->
          <!--* Card body *-->
          <!--* Card init *-->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Surtitle -->
              <h6 class="surtitle">Users</h6>
              <!-- Title -->
              <h5 class="h3 mb-0">Audience overview</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-doughnut" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <!--* Card header *-->
          <!--* Card body *-->
          <!--* Card init *-->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Surtitle -->
              <h6 class="surtitle">Partners</h6>
              <!-- Title -->
              <h5 class="h3 mb-0">Affiliate traffic</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-pie" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <!--* Card header *-->
          <!--* Card body *-->
          <!--* Card init *-->
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Surtitle -->
              <h6 class="surtitle">Overview</h6>
              <!-- Title -->
              <h5 class="h3 mb-0">Product comparison</h5>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-bar-stacked" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Footer -->
    <?php include 'template/dashboard/includes/footer.php';?>
  </div>


  <?php include 'includes/scripts.php';?>

</body>