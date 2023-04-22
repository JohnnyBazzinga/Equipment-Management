const renderEventosDestaque = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://www.forumvianense.org/public/eventos/destaque`)
  const eventos = await response.json()
  let strHtml = `  <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li> `
  let callout = ``
  if (eventos[0].numElements > 0) {
    //console.log(eventos[0].numElements);
    for (i = 1; i <= eventos[0].numElements + 1; i++) {
      strHtml += `<li data-target="#demo" data-slide-to="${i}"></li>`
    }
    strHtml += `</ul>
                    <div class="carousel-inner" >
                      <div class="carousel-item active">
                        <img src="img/carrasel/carrasel1.jpg" alt="Los Angeles" width="1100" height="600">
                        <div class="carousel-caption">
                          <h3 class="contraste">Fórum Vianense.</h3>
                          <p class="contraste centro"><em class="contraste">Nós</em> desafiamos,<em class="contraste">Tu</em> fazes a diferença</p>
                        </div>   
                      </div>`

    for (const evento of eventos) {
      strHtml += `<div class="carousel-item">
                            <img src="${evento.fotoFundo1}" alt="${evento.t2}" width="1100" height="600">
                             <a href="evento.php?e=${evento.idEvento}"><div class="carousel-caption">
                             <h3 class="contraste">${evento.t1}</h3>
                              <p class="contraste centro">${evento.t2}</p>
                            </div></a>   
                          </div>`
      callout += `
                          <style>.destaque${evento.idEvento} {color: #ffffff;display: table;height: 400px;width: 100%;background: url(${evento.fotoFundo2}) no-repeat center center fixed;-webkit-background-size: cover;
	              -moz-background-size: cover;-o-background-size: cover;background-size: cover;}</style>
                          <!-- Callout -->
                          <div class="destaque${evento.idEvento}">
                            <div class="vert-text">
                              <h2 class="contraste">
                                  <img src="img/forum_logo_mini.png" alt="Logo">${evento.t1}
                              </h2>
                              <h3 class="contraste">${evento.t2}</h3>
                              <a href="evento.php?e=${evento.idEvento}" class="btn btn-default btn-lg btn-dark">Descobre mais...</a>
                            </div>
                          </div>
                          <!-- /Callout -->
                          <br>`
    }
    strHtml += `	
                        <div class="carousel-item">
                              <img src="img/carrasel/carrasel3.jpg" alt="New York" width="1100" height="600">
                              <div class="carousel-caption">
                                <h3 class="contraste">Faz-te Sócio</h3>
                                <p class="contraste centro">Preenche a tua proposta online</p>
                              </div>   
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                          <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                          <span class="carousel-control-next-icon"></span>
                        </a>`

  }
  //console.log(strHtml);
  document.getElementById("demo").innerHTML = strHtml
  document.getElementById("callout").innerHTML = callout
}

const renderAgendaEvento = async (id) => {
  //console.log("aaaa");

  const response = await fetch(`http://www.forumvianense.org/public/evento/${id}/agenda`)
  const eventos = await response.json()
  let strHtml = ` `
  if (eventos[0].numElements > 0) {
    strHtml = ` <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-justify">
                                <h2 align="center">Agenda</h2>
                                  <div class="list-group">`

    for (const evento of eventos) {
      let hora = ""
      if (evento.hora != "" && evento.hora != null && evento.hora.length > 5) {
        hora = `<span class="badge">${evento.hora}</span>`
      }
      strHtml += `<a href="#services" class="list-group-item">${hora}${evento.ponto}</a>`

    }
    strHtml += `		 </div>
                        <hr/>
                    </div>
                </div>
            </div>`

  }
  document.getElementById("agenda").innerHTML = strHtml
}

const renderConvidadosEvento = async (id) => {
  //console.log("aaaa");

  const response = await fetch(`http://www.forumvianense.org/public/evento/${id}/participantes`)
  const eventos = await response.json()
  let strHtml = ` `
  if (eventos[0].numElements > 0) {
    strHtml = `<div class="services">
                        <div class="row centered">
                          <div class="col-md-4 col-md-offset-4 text-center">
                            <h2>Convidados especiais</h2>
                          </div>
                        </div>
                      </div>
                    
                    <div class="container w">
                      <div class="row centered" >
                        <br><br>`
    let col = parseInt(12 / eventos[0].numElements)
    let resto = 12 - col * eventos[0].numElements
    let inicio = parseInt(resto / 2)
    let fim = resto - inicio
    if (inicio > 0) {
      strHtml += `<div class="col-lg-${inicio} ">                          
                          </div>`
    }
    for (const evento of eventos) {
      strHtml += `<div class="col-lg-${col} center">
                            <img class="img-circle" src="${evento.foto}" width="110" height="110" alt="${evento.Convidado}">
                            <h4>${evento.Convidado}</h4>
                            <p>${evento.Cargo}</p>
                            <p><a href="#">${evento.empresa}</a></p>
                          </div>`

    }
    if (fim > 0) {
      strHtml += `<div class="col-lg-${fim}">                          
                          </div>`
    }
    strHtml += `		</div>
		                    <br>
	                    </div><!-- container -->
                    </div>`

  }
  document.getElementById("participantes").innerHTML = strHtml
}

const renderEvento = async (id) => {
  //console.log("aaaa");

  const response = await fetch(`http://www.forumvianense.org/public/evento/${id}/show`)
  const eventos = await response.json()
  for (const evento of eventos) {
    document.getElementById("t1").innerHTML = `<div class="container"><img src="img/forum_logo_mini.png" alt="Logo">  ${evento.t1}</div>`
    document.getElementById("t2").innerHTML = `${evento.t2}`
    document.getElementById("t1text").innerHTML = `${evento.t1Texto}`
    document.getElementById("texto").innerHTML = `${evento.texto}`
    document.getElementById("fotos").innerHTML = `${evento.fotos}`
    document.getElementById("mapa").innerHTML = ` <iframe src="${evento.mapa}" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>`
    document.getElementById("facebook").innerHTML = ` <a href="${evento.facebook}"><i class="fab fa-facebook-square fa-3x" aria-hidden="true"></a>`
    document.getElementById("stylec").innerHTML = `.headerT1 {display: table; height: 100%; width: 100%; position: relative; background: url(${evento.fotoFundo1}) no-repeat center center fixed;
                                                                      -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }  `

    let strHtml = ``
    let strHtml1 = `.headerT6k {}`
    if (evento.fotoFundo2 != "") {
      strHtml1 = `.headerT6k {display: table; height: 100%; width: 100%; position: relative; background: url(${evento.fotoFundo2}) no-repeat center center fixed;
                                                                      -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }  `

      strHtml = `<div class="vert-text">
                            <h2 class="text-dark"><div class="container"> <img src="img/forum_logo_mini.png" alt="Logo">  ${evento.t1}</h2>
                            <h3>${evento.t2}</h3>
                          <bR><BR>	
                          <a href="" class="btn btn-info" role="button">Fazer a reserva para o evento</a>
                          <a href="" class="btn btn-success" role="button">Ver o estado da reserva</a>
                        </div>`
    }
    document.getElementById("registo").innerHTML = strHtml
    document.getElementById("stylesc").innerHTML = strHtml1

    console.log(evento.conclusoes.length)

    strHtml = ``
    if ((evento.conclusoes != "") && (evento.conclusoes.length > 6)) {
      strHtml = `<h2 align="center">Resumo e principais conclusões</h2><br>${evento.conclusoes}`
    }
    document.getElementById("conclusao").innerHTML = strHtml

    strHtml += ``
  }

  renderConvidadosEvento(id)

  renderAgendaEvento(id)

}

const renderEventoRegisto = async (id) => {
  //console.log("aaaa");

  const response = await fetch(`http://www.forumvianense.org/public/evento/${id}/show`)
  const eventos = await response.json()
  for (const evento of eventos) {
    document.getElementById("t1").innerHTML = `<div class="container"><img src="img/forum_logo_mini.png" alt="Logo">  ${evento.t1}</div>`
    document.getElementById("t2").innerHTML = `${evento.t2}`
    document.getElementById("stylesc").innerHTML = `.headerT1 {display: table; height: 100%; width: 100%; position: relative; background: url(${evento.fotoFundo1}) no-repeat center center fixed;
                                                                      -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }  `
    let strHtml = ``
    if ((evento.precoSocio!=0) || (evento.precoNaoSocio!=0)){
        strHtml = `Preço: Sócios do Fórum Vianense - ${evento.precoSocio}€; Não Sócios - ${evento.precoNaoSocio}€ `
        }
    document.getElementById("precos").innerHTML = strHtml  
    
    if (evento.reserva==0){
         document.getElementById("reserva").innerHTML = ``  
        }
    
    
    
    
  }

}

//início do onload

window.onload = () => {



}