<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto Mono">
</head>
<style>
  .navbar-vertical.navbar-expand-xs .navbar-nav>.nav-item>.nav-link.active {
    margin-right: .5rem;
    margin-left: .5rem;
    padding-right: 1rem;
    padding-left: 1rem;
    border-radius: .375rem;
    background: #eeeeee;
  }
</style>

<?php
    /*if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    */
  ?>

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="inicio">
          <img src="../template/dashboard/imagens/logoesm.png" class="navbar-brand-img"  alt="...">
        </a>
    </div>
    <div class="navbar-inner">

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Administração</span>
        </h6>
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?php if (strpos($_SERVER['REQUEST_URI'], "utilizadores") !== false){ echo 'active';} ?>" href="utilizadores">
                <i class="fas fa-users text-primary"></i>
                <span class="nav-link-text">Gerir Utilizadores</span>
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (strpos($_SERVER['REQUEST_URI'], "salas") !== false){ echo 'active';} ?>" href="salas">
                <i class="fas fa-eraser text-primary"></i>
                <span class="nav-link-text">Gerir Salas</span>
              </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link <?php if (strpos($_SERVER['REQUEST_URI'], "admin/equipamentos") !== false){ echo 'active';} ?>" href="equipamentos">
                <i class="fas fa-clipboard text-primary"></i>
                <span class="nav-link-text">Gerir Equipamentos</span>
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (strpos($_SERVER['REQUEST_URI'], "avarias") !== false){ echo 'active';} ?>" href="avarias">
                <i class="fas fa-tasks text-primary"></i>
                <span class="nav-link-text">Gerir Avarias</span>
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (strpos($_SERVER['REQUEST_URI'], "escolas") !== false){ echo 'active';} ?>" href="escolas">
                <i class="fas fa-school text-primary"></i>
                <span class="nav-link-text">Gerir Escolas</span>
              </a>
          </li>

        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Suporte</span>
        </h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link notification_ <?php if (strpos($_SERVER['REQUEST_URI'], "mensagens") !== false){ echo 'active';} ?>" href="mensagens">
                <i class="fas fa-headset"></i>
                <span class="nav-link-text">Mensagens do Suporte</span>
                <span class="badge_ badge_ bounce-2" ><?php //include $_SERVER['DOCUMENT_ROOT']."/template/dashboard/phpcodes/notificacao1.php" ?></span>
                <style>
                           .notification_ {
                color: white;
                text-decoration: none;
                position: relative;
                display: inline-block;
                border-radius: 2px;
                }

                .notification_ .badge_ {
                position: absolute;
                top: -4px;
                right: 12px;
                padding: 0px 7px;
                border-radius: 20%;
                background: red;
                color: white;
                animation-duration: 2.5s;
                animation-iteration-count: infinite;
                }
                  .bounce-2 {
                  animation-name: bounce-2;
                  animation-timing-function: ease;
              }
                  @keyframes bounce-2 {
                      0%   { transform: translateY(0); }
                      50%  { transform: translateY(-10px); }
                      100% { transform: translateY(0); }
              }
                </style>
              </a>
          </li>
        </ul>
        <hr class="my-3">

        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Sair</span>
        </h6>
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link <?php if($url == 'http://stock.alunos.esmonserrate.org/public/equipamentos/inicio'){ echo 'active';} ?>" href="../equipamentos/inicio">
                <i class="fas fa-arrow-alt-circle-left"></i>
                <span class="nav-link-text">Voltar para a Dashboard</span>
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
          <!-- Navbar links -->
                  <h6 class="h2 text-white d-inline-block mb-0" style="margin-left: auto; font-family: Architects Daughter, sans-serif;">Gestão de Equipamentos</h6>
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
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
              <div class="px-3 py-3">
                <h6 class="text-sm text-muted m-0"><strong class="text-primary">Notificações</strong></h6>
              </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                                <?php
                   /*require '/dashboard/includes/BDi.php';
                   $stmt = $DB->prepare("SELECT `foto`, `nome`, `descricao`, `dataHora` FROM `log` WHERE 1 ORDER BY `dataHora` DESC LIMIT 5");
                   $stmt->execute(); 

                   $stmt->bind_result($foto,$nome, $descricao,$data);
                   while ($stmt->fetch())
                     
                     echo '
                     <a href="#!" class="list-group-item list-group-item-action">
                     <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <img alt="Image placeholder" src=',$foto,' class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h4 class="mb-0 text-sm">',$nome,'</h4>
                        </div>
                        <div class="text-right text-muted">
                          <small>',$data,'</small>
                        </div>
                      </div>
                      <p class="text-sm mb-0">',$descricao,'</p>
                    </div>
                  </div>
                  </a>
                     ';
                   $stmt->free_result();
                    */
                    ?>
              <a href="http://stock.alunos.esmonserrate.org/public/equipamentos/atividade" class="dropdown-item text-center text-primary font-weight-bold py-3">Ver tudo</a>
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
                <a href="http://moodle.esmonserrate.org" target="_blank" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                      <img src="/template/dashboard/imagens/moodlev2.ico" style="">
                    </span>
                    <small>Moodle</small>
                  </a>
                <a href="https://www.esmonserrate.org" target="_blank" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Site Escola</small>
                  </a>
                <a href="https://www.facebook.com/AgrupamentoEscolasMonserrate/" target="_blank" class="col-4 shortcut-item">
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
                    <img class="img" src="" width="300px">
                    <?php
                   /* if (isset( $_SESSION["idUser"]))  {
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
			*/
                  ?> 
                  </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Bem Vindo!</h6>
              </div>
              <a class="dropdown-item" data-toggle='modal' data-target='#perfil' href="">
                  <i class="ni ni-single-02"></i>
                  <span>Perfil</span>
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

  
  
  <!------------------------------------------------------ Modal Perfil -------------------------------------------------------->
    
    <div class="modal fade" id="perfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title intro3">Informações de Utilizador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
              <div class="card-profile-image" style="    margin-top: 50px;">
                <a href="#">
                  <?php if (isset( $_SESSION["idUser"]))  {
                    $stmt = $DB->prepare("SELECT foto FROM gestaoUtilizadores WHERE idUser=? AND foto IS NOT NULL");
                    $stmt->bind_param('d', $_SESSION["idUser"]);
                    $stmt->execute();
                    $stmt->bind_result($foto);
                    if ($stmt->fetch()) {
                      echo '<img class="rounded-circle" src="',$foto,'" width="300px">';
                       $stmt->free_result();
                      }
                      else
                          echo '<img class="img" src="img/fotoUnknown.jpg" width="300px" >';
                      }
			
                  ?>
                </a>
              </div>
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-between">
            </div>
          </div>
        
          <div class="card-body pt-0" style="margin-top: 30px;">
            <hr class="my-3">
            <div class="row">
              <div class="col">
                <div class="card-profile-stats d-flex justify-content-center">
                </div>
              </div>
            </div>
            <div class="text-center">
              <h5 class="h3">Nome:</h5><p><?php echo $_SESSION["nome"];?> <span class="font-weight-light"></span></p>
              <h5 class="h3">Email:</h5>
                <?php echo $_SESSION["email"];?> <span class="font-weight-light"></span>
            </div>
          </div>
        </div>
      </div>
      </div>  
    </div>
  
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