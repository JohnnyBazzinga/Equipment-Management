 const renderEquipamentosPisoSala = async (sala) => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/equipamentos/${sala}`)
  const servicos = await response.json()
  let strHtml = ``;

  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
      strHtml += `

                        <tr data-id=${servico.numeroProduto}>
                          <td>${servico.tipo}</td>
                          <td>${servico.serie}</td>
                          <td>${servico.designacao}</td>
                          <td style="display:none;">${servico.numeroSala}</td>
                          <td><a class="btn btn-info btn-lg info"><img src="http://stock.alunos.esmonserrate.org/template/imagens/lupa1.png" width="28px"></a></td>
                        </tr>

                   `
    }

  }
  document.getElementById("lista").innerHTML = strHtml
  $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#nProduto").val(linha.data("id"));
      $("#nome").val(linha.find("td").eq(0).html());
      $("#serie").val(linha.find("td").eq(1).html());
      $("#designacao").val(linha.find("td").eq(2).html());
      $("#piso").val(linha.find("td").eq(3).html());
      $("#sala").val(linha.find("td").eq(4).html());
      $("#mdlInfo").modal("show");
    });
  });
}

const renderEquipamentosSerie = async (serie) => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/equipamentos/${serie}/serie`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
      strHtml += `
                        <tr>
                          <td>
                            ${servico.tipo}
                          </td>
                          <td>
                            ${servico.numeroProduto}
                          </td>
                          <td>
                            ${servico.designacao}
                          </td>
                          <td>
                           <button id="img"><img src="http://stock.alunos.esmonserrate.org/template/imagens/lupa1.png" width="28px"></button>
                          </td>
                        </tr>
                   `
    }

  }
  document.getElementById("lista").innerHTML = strHtml

}


const renderEquipamentosTodos = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/equipamentos/listar`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
      strHtml += `
                        <tr data-id=${servico.numeroProduto}>
                          <td>${servico.tipo}</td>
                          <td>${servico.serie}</td>
                          <td>${servico.designacao}</td>
                          <td>${servico.numeroPiso}</td>
                          <td>${servico.numeroSala}</td>
                          <td><a class="btn btn-info btn-lg info"><img src="http://stock.alunos.esmonserrate.org/template/imagens/lupa1.png" width="28px"></a></td>
                        </tr>
  
                   `
      
    }

  }
  document.getElementById("lista").innerHTML = strHtml
  $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#nProduto").val(linha.data("id"));
      $("#nome").val(linha.find("td").eq(0).html());
      $("#serie").val(linha.find("td").eq(1).html());
      $("#designacao").val(linha.find("td").eq(2).html());
      $("#piso").val(linha.find("td").eq(3).html());
      $("#sala").val(linha.find("td").eq(4).html());
      $("#mdlInfo").modal("show");
    });
  });
}

const lePedido = async (px, id_LS) => {

  // ProximoNumero(id_LS)
  //px=document.getElementById("px").innerHTML
  //sleep(2000);
  //console.log("aqui");
  //console.log(px);
  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/add`, {
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    method: "POST",
    body: `numero=${px}&id_LS=${id_LS}`
  })
  //console.log(response);
}

const ProximoNumero = async (id) => {
  // console.log("aaaa");


  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${id}/numeroPedido`)
  const servicos = await response.json()
  // alert(id)
  n = "x00";
  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
      n = `${servico.numPedido}`
    }
  }
  //console.log(n);
  document.getElementById("px").innerHTML = n
  lePedido(n, id)
}