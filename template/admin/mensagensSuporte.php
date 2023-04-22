<!DOCTYPE html>
<html>

<head>
  <?php include 'template/dashboard/includes/header.php';?>
</head>

<style>

.table-inbox {
    border: 1px solid #d3d3d3;
    margin-bottom: 0;
}

.table-inbox tr.unread td {
    background: none repeat scroll 0 0 #f7f7f7;
    font-weight: 600;
}
ul.inbox-pagination {
    float: right;
}
ul.inbox-pagination li {
    float: left;
}


.inbox-pagination a.np-btn {
    background: none repeat scroll 0 0 #fcfcfc;
    border: 1px solid #e7e7e7;
    border-radius: 3px !important;
    color: #afafaf;
    display: inline-block;
    padding: 5px 15px;
}

.inbox-pagination a.np-btn {
    margin-left: 5px;
}


.files .progress {
    width: 200px;
}

@media (max-width: 767px) {
.files .btn span {
    display: none;
}
.files .preview * {
    width: 40px;
}

.files .progress {
    width: 20px;
}
.files .delete {
    width: 60px;
}
}
ul {
    list-style-type: none;
    padding: 0px;
    margin: 0px;
}
 
</style>  
  
<body>
  <?php include 'template/admin/includes/sidebar.php';?>
  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Mensagens do Suporte</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card border-0">
          <div class="map-canvas" style="height: 100%;">

              <table id="atividade" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Data/Hora</th>
                    <th>Nome</th>
                    <th>Tópico</th>
                    <th>Mensagem</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   require 'template/dashboard/includes/BDi.php';
                   
                  /* $stmt = $DB->prepare("SELECT id,idUser,nome,tipo, dataRegisto,dataLeitura,mensagem,imagem FROM `mensagemAdmin`");
                   $stmt->execute(); 

                   $stmt->bind_result($id,$idUser,$nome,$tipo,$dataRegisto,$dataLeitura,$mensagem,$imagem);
                   while ($stmt->fetch())
                     if (!empty($imagem)) {
                    echo "<tr>  
                          <td>$dataRegisto</td>  
                          <td>$nome</td>
                          <td>$tipo</td>
                          <td>$tipo</td>
                          <td style='display:none;'>$imagem</td>
                          <td><img src='$imagem' class='img-fluid' width='100%' height='20%'> </td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary verMensagem'><i class='fas fa-eye'></i></button>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary info'><i class='fas fa-reply'></i></button>
                          </td>
                          </tr>";
                       
                     }*/
                      ?>
                </tbody>
            </table>
            
            
            
          </div>
        </div>
      </div>
    </div>
    <?php include 'template/dashboard/includes/footer.php';?>
  </div>
  
  
  
  
  
  
  
    <div class="modal fade" id="mdlVerMensagem" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Informações</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
       <form action="/template/admin/phpcodes/gerirAvariasReparacoes.php" method="post" enctype="multipart/form-data">
            <input class="form-control text-center" type="hidden" id="numero" name="numero" value="" readonly="">
          <div class="form-group">
            <h4 class=""><b>Nome do Técnico</b></h4>
            <input class="form-control " id="nomeTecnico" name="nomeTecnico" type="" placeholder="" readonly="">
          </div>
          <div class="form-group">
            <h4 class=""><b>Tópico</b></h4>
            <input class="form-control" type="text" id="topico" name="topico" value="" readonly="">
          </div>
          <div class="form-group">
            <h4 class=""><b>Mensagem</b></h4>
            <textarea style="resize: none;" name="mensagem" class="form-control" id="mensagem" required="" placeholder="" rows="5" readonly=""></textarea>
          </div>
           <div class="form-group">
            <h4 class=""><b>Anexo</b></h4>
            <a href="" download>
          <img src="" name="imagem" id="imagem" class="img-fluid" width="100%" height="20%">          
             </a>
          </div>
        </div>
          </form>
      </div>
    </div>
  </div>
</body>
<!-- Scripts -->
<?php include 'template/dashboard/includes/scripts.php';?>

<script>
    $(document).ready(function() {
    $('#atividade').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      },
    });
  });
  
  
  $(".verMensagem").click(function() {
    var linha = $(this).closest("tr");
    $("#numero").val(linha.data("id"));

    $("#nomeTecnico").val(linha.find("td").eq(1).html());
    $("#topico").val(linha.find("td").eq(2).html());
    $("#mensagem").val(linha.find("td").eq(3).html());
    $("#imagem").val(linha.find("td").eq(4).html());
    $("#mdlVerMensagem").modal("show");
  });


</script>



</html>