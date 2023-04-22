const rendercontadorEquipamentos = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/equipamentos/contadorEquipamentos`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`${servico.count}`

    }

  }
  document.getElementById("contadorEquipamentos").innerHTML = strHtml
}

