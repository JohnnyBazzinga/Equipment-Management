// 12 Perguntas
const render12perguntas = async () => {

  const response = await fetch(`http://202012r.esmonserrate.org/cristovaolavarinhas/packsite/packsite/public/12perguntas/10/ver`)
  const servicos = await response.json()
  let strHtml = ``
  let i=1;
  if (servicos[0].numElements > 0) {   
    for (const servico of servicos) {
        
      strHtml += `
      <section>
				<div class="ac-custom ac-radio ac-circle" autocomplete="off">
					<h2>${i}. ${servico.pergunta}</h2>
					<ul>
						<li><input  name="${servico.id}" type="radio"><label for="r5">Gostaria de realizá-la</label></li>
						<li><input name="${servico.id}" type="radio"><label for="r6">Não gostaria de realizá-la</label></li>
						<li><input  name="${servico.id}" type="radio"><label for="r7">Indiferente</label></li>
					</ul>
				</div>
			</section>
                   
          i++         `     
    }
    strHtml += ``

  }
  document.getElementById("perguntas").innerHTML = strHtml
}

// 7 Perguntas
const render7perguntas = async (cat) => {

  const response = await fetch (`http://202012r.esmonserrate.org/cristovaolavarinhas/packsite/packsite/public/7perguntas/${cat}/ver`)
  const servicos = await response.json()
  let strHtml = ``
  let i=1;
  if (servicos[0].numElements > 0) {   
    for (const servico of servicos) {
        
      strHtml += `
      <section>
				<div class="ac-custom ac-radio ac-circle" autocomplete="off">
					<h2>${i}. ${servico.pergunta}</h2>
					<ul>
						<li><input name="p${i}" value="3" type="radio">
            <label for="r5">Gostaria de realizá-la</label></li>
						<li><input name="p${i}" value="0" type="radio">
            <label for="r6">Não gostaria de realizá-la</label></li>
						<li><input name="p${i}" value="1" type="radio">
            <label for="r7">Indiferente</label></li>
					</ul>
				</div>
			</section>
        
         `
     i++;
    }
   
    strHtml += ``

  }
  document.getElementById("perguntas").innerHTML = strHtml
}

