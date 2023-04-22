  <!DOCTYPE html>
  <html>

  <head>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/header.php';?>
  </head>

  <body>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/sidebar.php';?>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Procurar Equipamento</h6>
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
              <div class="map-canvas" style="height: 500px;">
                <th scope='row'>
                  <div class='media align-items-center '>
                    <a href='#' class='avatar rounded-circle mr-3'>
                      <div style='font-size: 0.5rem;'>
                        <i class='fas fa-desktop fa-3x'></i>
                      </div>
                    </a>
                    <div class='media-body'>
                      <span class='name mb-0 text-sm'>Computador</span>
                    </div>
                  </div>
                </th>
                <div class="form-group">
                </div>
                <div class="row">
                    <?php
                    require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';
                    if(isset($_POST['produto'])){ // Tabela Componentes
                    $stmt = $DB->prepare("SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                        produto.`codTipoProduto`, `numeroSala`, `serie`, `obs` FROM `produto` 
                                                        INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                        WHERE composto=?");
                    $stmt->bind_param("s", $_POST['produto']);

                    $stmt->execute(); 

                    $stmt->bind_result($tipoProduto, $numeroProduto, $designacao, $marca, $composto, 
                                      $codTipoProduto, $numeroSala, $serie, $obs);
                    while ($stmt->fetch())
                     echo "<tr data-id='$numeroProduto'>
                        <td>$tipoProduto</td>
                        <td title='$marca'>",substr($marca,0,25),"</td>
                        <td title='$designacao'>",substr($designacao,0,25),"</td>
                        <td title='$obs'>",substr($obs,0,25),"</td>
                        </tr>
                        ";
                    $stmt->free_result();

                    }
                    ?>
                </div>
                <div class="form-group">
                  <h4 class=""><b>Descrição do problema</b></h4>
                </div>
              </div>
            </div>
            </form>
            <!-- Footer -->
            <?php require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/footer.php';?>
          </div>

          <!-- Scripts -->
          <?php require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/scripts.php';?>

  </html>