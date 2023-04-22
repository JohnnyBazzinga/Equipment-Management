<style>
.navbar-vertical.navbar-expand-xs .navbar-nav > .nav-item > .nav-link.active {
    margin-right: .5rem;
    margin-left: .5rem;
    padding-right: 1rem;
    padding-left: 1rem;
    border-radius: .375rem;
    background: #eeeeee;
  }
</style>

<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
  ?>

<!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="http://stock.alunos.esmonserrate.org/public/equipamentos/inicio">
          <img src="/template/dashboard/imagens/logoesm.png" class="navbar-brand-img"  alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Funcionalidades</span>
        </h6>
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($url == 'http://stock.alunos.esmonserrate.org/public/equipamentos/adicionar'){ echo 'active';} ?>" href="http://stock.alunos.esmonserrate.org/public/equipamentos/adicionar">
                <i class="far fa-plus-square text-primary"></i>
                <span class="nav-link-text">Adicionar Equipamento</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($url == 'http://stock.alunos.esmonserrate.org/public/equipamentos/procurar'){ echo 'active';} ?>" href="http://stock.alunos.esmonserrate.org/public/equipamentos/procurar">
                <i class="fas fa-search-plus text-orange"></i>
                <span class="nav-link-text">Procurar Equipamento</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($url == 'http://stock.alunos.esmonserrate.org/public/equipamentos/registar/avarias'){ echo 'active';} ?>" href="http://stock.alunos.esmonserrate.org/public/equipamentos/registar/avarias">
                <i class="fas fa-clipboard text-primary"></i>
                <span class="nav-link-text">Registar Avarias</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.the-qrcode-generator.com/scan">
                <i class="fas fa-qrcode text-red"></i>
                <span class="nav-link-text">Ler QR Code</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="upgrade.html">
                <i class="ni ni-calendar-grid-58"></i>
                <span class="nav-link-text">Atividade</span>
              </a>
            </li>
          </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Administração</span>
        </h6>
          <ul class="navbar-nav">
            <li class="nav-item" <?php if($url == 'http://stock.alunos.esmonserrate.org/public/admin'){ echo 'hidden';} ?>>
              <a class="nav-link" href="http://stock.alunos.esmonserrate.org/public/admin">
                <i class="fas fa-user-cog text-blue"></i>
                <span class="nav-link-text">Administração</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Suporte</span>
          </h6>
          <ul class="navbar-nav">
          <!-- Navigation -->
            <li class="nav-item">
              <a class="nav-link" href="upgrade.html">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Contactar Admin</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  
  
  
  
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link notification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                <i class="ni ni-bell-55"></i>
                  <span class="badge"><?php include $_SERVER['DOCUMENT_ROOT']."/template/dashboard/phpcodes/notificacao.php" ?></span>
                          <style>
                          .notification {
                color: white;
                text-decoration: none;
                position: relative;
                display: inline-block;
                border-radius: 2px;
                }

                .notification .badge {
                position: absolute;
                top: -9px;
                right: -5px;
                padding: 5px 10px;
                border-radius: 50%;
                background: red;
                color: white;
                }
                </style>
              </a>
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">1</strong> notifications.</h6>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- View all -->
                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-ungroup"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                <div class="row shortcuts px-4">
                  <a data-toggle="modal" data-target="#calendario" href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                      <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <small>Calendário</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                      <img src="/template/dashboard/imagens/moodlev2.ico" style="">
                    </span>
                    <small>Moodle</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Site Escola</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Facebook</small>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <?php if (isset( $_SESSION["idUser"]))  {
                    $stmt = $DB->prepare("SELECT foto FROM gestaoUtilizadores WHERE idUser=? AND foto IS NOT NULL");
                    $stmt->bind_param('d', $_SESSION["idUser"]);
                    $stmt->execute();
                    $stmt->bind_result($foto);
                    if ($stmt->fetch()) {
                      echo '<img class="img" src="',$foto,'" width="300px">';
                       $stmt->free_result();
                      }
                      else
                          echo '<img class="img" src="img/fotoUnknown.jpg" width="300px" >';
                      }
			
                  ?>
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION["nome"];?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bem Vindo!</h6>
                </div>
                <a href="http://stock.alunos.esmonserrate.org/public/perfil" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Perfil</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Suporte</span>
                </a>
                <div class="dropdown-divider"></div>
                  <a onclick="signOut();" class="dropdown-item" href="">
                  <i class="ni ni-user-run"></i>
                  <span>Sair</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    
        <!-- ---------------------------------------Modal Calendário----------------------------------------------------------- -->

<div id="calendario" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Calendario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
                <div class="container-calendar">
          <h3 id="monthAndYear"></h3>
          <div class="button-container-calendar">
              <button id="previous" onclick="previous()">&#8249;</button>
              <button id="next" onclick="next()">&#8250;</button>
          </div>
          
          <table class="table-calendar" id="calendar" data-lang="en">
              <thead id="thead-month"></thead>
              <tbody id="calendar-body"></tbody>
          </table>
          
          <div class="footer-container-calendar">
              <label for="month">Mudar: </label>
              <select id="month" onchange="jump()">
                  <option value=0>Janeiro</option>
                  <option value=1>Fevereiro</option>
                  <option value=2>Março</option>
                  <option value=3>Abril</option>
                  <option value=4>Maio</option>
                  <option value=5>Junho</option>
                  <option value=6>Julho</option>
                  <option value=7>Agosto</option>
                  <option value=8>Setembro</option>
                  <option value=9>Outubro</option>
                  <option value=10>Novembro</option>
                  <option value=11>Dezembro</option>
              </select>
              <select id="year" onchange="jump()"></select>       
          </div>
      </div>
      </div>
    </div>
  </div>
</div>

    
    