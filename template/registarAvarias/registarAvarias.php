<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- UTF-8 -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Icon do separador -->
  <link href="../template/dashboard/imagens/logo16x16.png" rel="icon" type="image/png">
  <title>Gestão de Equipamentos</title>
  <link rel="stylesheet" href="../template/registarAvarias/assets/style.css" type="text/css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
         <img src="../template/dashboard/imagens/logoesm.png" alt="logo" style="margin-left: 473px; margin-bottom: -39px; margin-top: 38px; width: 160px;" >
      <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
    <div class="row main">
      <div class="main-login main-center">
        <div class="borderlargo" id="titulo_form">
          <h5>Avarias <a class="h6 text-light" href="#" data-target="#ajudamodal" data-toggle="modal"><i class="fas fa-question-circle"></i></a></h5>
        </div>
        <form action="/template/dashboard/phpcodes/registarAvaria.php" method="post">
          <div class="form-group">
            <label class="cols-sm-2 control-label" for="name">Nome</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon corlabelform"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input name="nome" class="form-control cortextoform" id="nome" required="" type="text" placeholder="Insira o seu Nome">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="cols-sm-2 control-label" for="name">Email</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon corlabelform"><i class="fa fa-at fa" aria-hidden="true"></i></span>
                <input name="email" class="form-control cortextoform" id="email" required="" type="email" placeholder="Insira o seu Email">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label class="cols-sm-2 control-label" for="sala">Sala</label>
                <div class="input-group">
                  <span class="input-group-addon corlabelform"><i class="fas fa-door-open fa-lg" aria-hidden="true"></i></span>
                  <select name="sala" class="form-control cortextoform" id="sala" required="">
                    <option disabled="" value="" selected="">- Selecione a sala -</option>
                      <?php
                         require "includes/BDi.php";
                         $stmt = $DB->prepare("SELECT DISTINCT numeroSala FROM salas ORDER BY numeroSala");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result();
                        ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-5 col-sm-6 col-lg-6">
                <label class="cols-sm-2 control-label" for="sala">Equipamento</label>
                <div class="input-group">
                  <span class="input-group-addon corlabelform"><i class="fas fa-desktop fa-lg" aria-hidden="true"></i></span>
                  <select name="NumeroProduto" class="form-control cortextoform" id="NumeroProduto" required="">
										<option disabled="" value="" selected="">- Selecione o equipamento -</option>
                      <?php
                         require "includes/BDi.php";
                         $stmt = $DB->prepare("SELECT numeroProduto,`designacao`,`serie` FROM `produto` WHERE composto=0 ORDER BY `designacao`");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroProduto,$designacao,$serie);
                         while ($stmt->fetch())
                            echo "<option value='$numeroProduto'>$designacao || $serie</option>";
                         $stmt->free_result();
                        ?>
										</select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="cols-sm-2 control-label" for="problema">Descrição do problema</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon corlabelform"><i class="fas fa-file-alt fa-lg" aria-hidden="true"></i></span>
                <textarea name="diagnostico" class="form-control cortextoform" id="diagnostico" required="" placeholder="Descreva o problema" rows="5"></textarea>

              </div>
            </div>
          </div>

          <div class="form-group ">
            <button onclick="myFunction()" class="btn btn-primary btn-lg btn-block login-button font-weight-bold" id="button" style="border-color: white; color: rgb(0, 110, 229);" type="submit" name="submit" id="submit">Enviar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div tabindex="-1" class="modal fade" id="ajudamodal" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Precisa de Ajuda?</h3>


          <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <h6 class="text-left lead">1. <u>O que inserir.</u></h6>
          <p class="text-justify">Para preencher os campos do formulario pedimos que nos forneça <b class="text-primary">NOME</b> e <b class="text-primary">APELIDO</b>, o seu <b class="text-primary">EMAIL</b> de preferência aquele que mais utiliza, a <b class="text-primary">ESCOLA</b>            onde existe a avaria que vai reportar, a <b class="text-primary">SALA</b> da mesma, o <b class="text-primary">EQUIPAMENTO</b> que precisa de intervenção, e por fim uma descrição da <b class="text-primary">AVARIA</b>.</p>
          <h6 class="text-left lead">2. <u>Submeter avaria.</u></h6>
          <p class="text-justify">Para submeter uma avaria, depois de preencher os dados necessários, carregue em <b class="text-primary">ENVIAR</b> se tiver preenchido tudo corretamente irá aparecer uma pagina a dizer que enviou a avaria com sucesso.</p>
          <h6 class="text-left lead">3. <u>Quer submeter duas ou mais avarias.</u></h6>
          <p class="text-justify">Para submeter duas avarias, é seguir o ponto numero dois, e logo em seguido irá aparecer uma janela com um <b class="text-primary">BOTÃO</b> para inserir uma nova avaria, caso nao queira inserir a segunda avaria, é só fechar ou então será reencaminhada/o
            automáticamente para a página da <u><a href="http://esmonserrate.org" target="_blank">Escola Secundária de Monserrate.<a></a></u></p>
          <a>
            <h6 class="text-left lead">4. <u>O que acontece as avarias submetidas.</u></h6>
            <p class="text-justify">Todas as avarias submetidas com sucesso serão enviadas para a nossa plataforma, para podermos ver e ajudar o mais rápido possível.</p>
            <h6 class="text-left lead">5. <u>Como posso saber se uma avaria foi resolvida.</u></h6>
            <p class="text-justify">Depois de submeter a avaria irá receber um <b class="text-primary">EMAIL</b> automático, para o email que indicou no formulário. <br>Nesse email irá conter um <b class="text-primary">LINK</b> de acesso à avaria enviada, onde poderá ver o estado
              em que a mesma se encontra, e alguns comentários adicionados.</p>

            <p class="small text-center"><u>Se tem duvidas envie mensagem pelos contactos. Obrigado.</u></p>
          </a>
        </div>
        <a>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>

          </div>
        </a>
      </div><a>
      </a></div><a>
</a></div>
  <div tabindex="-1" class="modal fade" id="sobremodal" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel"><a>
      </a>
    <div class="modal-dialog" role="document"><a>
        </a>
      <div class="modal-content">
        <a>
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Termos e Condições</h3>
            <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
          </div>
        </a>
        <div class="modal-body"><a>
                </a>
          <h4><a>Política de privacidade para <a href="http://avarias.esmonserrate.org">Avarias Esm</a></h4>
          <p>Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.</p>
          <p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o Avarias Esm.</p>
          <p>Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o Avarias Esm serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).</p>
          <p>A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento e/ou outros.</p>
          <p>O uso do Avarias Esm pressupõe a aceitação deste Acordo de privacidade. A equipa do Avarias Esm reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade
            de forma a estar sempre atualizado.</p>
          <h4>Ligações a Sites de terceiros</h4>
          <p>O Avarias Esm possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro
            site a partir do nosso deverá ler a politica de privacidade do mesmo.</p>
          <p>Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>

        </div>
      </div>
    </div>
  </div>
    
  <div tabindex="-1" class="modal fade" id="contactosmodal" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Contactos <i class="far fa-comment"></i></h3>
          <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <h5 class="text-center">Se tem duvidas, ou se encontrou algum tipo de erro, diga-nos.</h5>
          <div class="row m-1 p-1 teccards">
            <div class="col-md-12 mt-2">
              <i class="fas fa-file-alt"></i> Coloque a sua duvida
              <form id="formContacto" action="" method="post">
                <input name="duvidasnome" class="form-control mt-2 mb-1" id="duvidasnome" required="" type="text" placeholder="Nome">
                <input name="duvidasemail" class="form-control mb-1" id="duvidasemail" required="" type="email" placeholder="Email">
                <input name="duvidasassunto" class="form-control mb-1" id="duvidasassunto" required="" type="text" placeholder="Assunto">
                <textarea name="duvidasmensagem" class="w-100 form-control mb-2" id="duvidasmensagem" required="" placeholder="Coloque a sua duvida" rows="4" cols="30">Coloque a sua duvida</textarea>
                <button class="btn teccardbtn btn-block" type="submit"><i class="far fa-envelope"></i> <i class="fas fa-arrow-right"></i></button>
              </form>
            </div>
          </div>
          <div class="row m-1 mt-2 p-1 teccards ">
            <div class="col-md-6 mt-2 text-center">
              <p><i class="fas fa-user"></i> TESTE</p>
              <p class="small">TESTE</p>
              <p><i class="fas fa-phone"></i>TESTE</p>
            </div>
            <div class="col-md-6 mt-2 text-center">
              <p><i class="fas fa-user"></i>TESTE</p>
              <p class="small">TESTE</p>
              <p><i class="fas fa-phone"></i>TESTE</p>
            </div>
          </div>
          <p class="text-center mt-2"><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=TESTE@gmail.com" target="_blank">TESTE@gmail.com</a><br>Obrigado pelo seu contacto.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- INDEX FOOTER -->
  <!-- INDEX FOOTER -->
  <div class="row ml-0 mr-0 p-2 border-top border-left border-right sticky-bottom indexfooter" style="margin-top: -72px;">
    <div class="col-12 col-md-2 p-1">
      <div class="dropup">
        <button class="btn btn-block btn-primary" type="button" data-toggle="dropdown">Mais <i class="fas fa-info-circle"></i>
		    </button>
        <ul class="dropdown-menu p-2 w-100">
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" href="#" data-target="#ajudamodal" data-toggle="modal"><i class="fa fa-question-circle"></i> Ajuda</a></li>
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" href="#" data-target="#contactosmodal" data-toggle="modal"><i class="fas fa-id-badge"></i> Contactos</a></li>
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" href="../equipamentos/inicio"><i class="fa fa-cogs"></i> Administração</a></li>
        </ul>
      </div>

    </div>
    <div class="col-12 col-md-8 text-center pt-2"><span>Copyright © <?php echo date("Y"); ?> <a href="#"></a>. Todos os direitos reservados.</span><br> <span class="small"><a class="text-muted" style="font-size: 10px;" href="#" data-target="#sobremodal" data-toggle="modal"> Termos e Condições</a></span></div>
    <div class="col-12 col-md-2 p-1 text-center">
      <a class="btn btn-primary" href="https://www.facebook.com/AgrupamentoEscolasMonserrate" target="_blank"><i class="fab fa-facebook"></i></a>
      <a class="btn btn-primary" href="http://moodle.esmonserrate.org" target="_blank"><i class="fa fa-graduation-cap"></i></a>
      <a class="btn btn-primary" href="http://www.esmonserrate.org" target="_blank"><i class="fa fa-school"></i></a>
    </div>
  </div>
    
  <!-- FIM INDEX FOOTER -->
  <!-- FIM INDEX FOOTER -->

  <!-- Script JQUERY-->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <!-- Script POPPER-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Script BOOTSTRAP-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <!-- Mensagem de Aviso -->  
  <script>
   function myFunction() {
  alert("A sua avaria foi registada com sucesso!");
} 
  </script>  

</html>