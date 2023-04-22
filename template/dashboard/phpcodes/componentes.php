<thead class="thead-dark">
<tr>
  <th>Tipo de Produto</th>
    <th>Marca</th>
    <th>Designacao</th>
    <th>Observações</th>
  </tr>


</thead>
<tbody>
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
</tbody>

