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
                           <button id="img"><img src="../../img/lupa1.png" width="28px"></button>
                          </td>
                        </tr>
                   `
    }

  }
  document.getElementById("lista").innerHTML = strHtml

}