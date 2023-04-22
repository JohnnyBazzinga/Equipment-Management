<?php

use src\Route as Route;




//Rotas login e registo
Route::get('/', function(){  require _CAMINHO_TEMPLATE. "dashboard/paginaInicial.php";});
//Rotas template Tecnicos
Route::get('/equipamentos/inicio', function(){  require _CAMINHO_TEMPLATE. "dashboard/paginaInicial.php";});
Route::get('/equipamentos/adicionar', function(){  require _CAMINHO_TEMPLATE. "dashboard/addEquipamento.php";});
Route::get('/equipamentos/{obs}/adicionar', function(){  require _CAMINHO_TEMPLATE. "dashboard/addEquipamento.php";});
Route::get('/equipamentos/procurar', function(){  require _CAMINHO_TEMPLATE. "dashboard/procurarEquipamento.php";});
Route::get('/equipamentos/avarias', function(){  require _CAMINHO_TEMPLATE. "dashboard/avariasRegistadas.php";});
Route::get('/equipamentos/qrcode', function(){  require _CAMINHO_TEMPLATE. "dashboard/qrCode.php";});
Route::get('/perfil', function(){  require _CAMINHO_TEMPLATE. "dashboard/perfil.php";});
Route::get('/equipamentos/listartodos', function(){  require _CAMINHO_TEMPLATE. "dashboard/listaTodos.php";});
Route::get('/equipamentos/listarequipamentos', function(){  require _CAMINHO_TEMPLATE. "dashboard/listaMaquina.php";});
Route::get('/equipamentos/recebido', function(){  require _CAMINHO_TEMPLATE. "dashboard/recebido.php";});
Route::get('/equipamentos/atividade', function(){  require _CAMINHO_TEMPLATE. "dashboard/atividadeUtilizador.php";});
Route::get('/equipamentos/estatisticas', function(){  require _CAMINHO_TEMPLATE. "dashboard/estatisticas.php";});

//Rotas Template Professores
Route::get('/registar/avarias', function(){  require _CAMINHO_TEMPLATE. "registarAvarias/registarAvarias.php";});

//Template Administradores
Route::get('/admin/inicio', function(){  require _CAMINHO_ADMIN. "paginaAdmin.php";});
Route::get('/admin/utilizadores', function(){  require _CAMINHO_ADMIN. "gerirUtilizadores.php";});
Route::get('/admin/salas', function(){  require _CAMINHO_ADMIN. "gerirSalas.php";});
Route::get('/admin/equipamentos', function(){  require _CAMINHO_ADMIN. "gerirEquipamentos.php";});
Route::get('/admin/avarias', function(){  require _CAMINHO_ADMIN. "gerirAvarias.php";});
Route::get('/admin/mensagens', function(){  require _CAMINHO_ADMIN. "mensagensSuporte.php";});
Route::get('/admin/escolas', function(){  require _CAMINHO_ADMIN. "gerirEscolas.php";});


//equipamentos
Route::get(['set' => '/equipamentos/listar', 'as' => 'equipamentos.listarEquipamentosTodos'], 'ControllerEquipamentos@listarEquipamentosTodos');
Route::get(['set' => '/equipamentos/compostos', 'as' => 'equipamentos.listarEquipamentosCompostos'], 'ControllerEquipamentos@listarEquipamentosCompostos');
Route::get(['set' => '/equipamentos/{pai}/componentes', 'as' => 'equipamentos.listaComponentesEquipamento'], 'ControllerEquipamentos@listaComponentesEquipamento');
Route::get(['set' => '/equipamentos/{serie}/serie', 'as' => 'equipamentos.procurarEquipamentoNumeroSerie'], 'ControllerEquipamentos@procurarEquipamentoNumeroSerie');
Route::get(['set' => '/equipamentos/{sala}', 'as' => 'equipamentos.procurarEquipamentoPisoSala'], 'ControllerEquipamentos@procurarEquipamentoPisoSala');


//Administração WEB SERVICES
Route::get(['set' => '/atribuir/niveis', 'as' => 'equipamentos.listarNiveis'], 'ControllerEquipamentos@listarNiveis');


Route::get(['set' => '/equipamentos/{serie}/procurar', 'as' => 'equipamentos.qrCode'], 'ControllerEquipamentos@qrCode');


//avarias WEB SERVICES
Route::get(['set' => '/avarias/lista', 'as' => 'equipamentos.listarAvarias'], 'ControllerEquipamentos@listarAvarias');
Route::get(['set' => '/avarias/{estado}/ver', 'as' => 'perguntas.listarsegundaPergunta'], 'ControllerPerguntas@listarsegundaPergunta');
Route::get(['set' => '/avarias/{id}/ver', 'as' => 'perguntas.listarsegundaPergunta'], 'ControllerPerguntas@listarsegundaPergunta');

Route::get(['set' => '/equipamentos/tarefas', 'as' => 'equipamentos.listarTarefas'], 'ControllerEquipamentos@listarTarefas');


//PAGINA INICIALlistarTecnicos
Route::get(['set' => '/equipamentos/contadorEquipamentos', 'as' => 'equipamentos.contadorEquipamentos'], 'ControllerEquipamentos@contadorEquipamentos');
Route::get(['set' => '/equipamentos/listarTecnicos', 'as' => 'equipamentos.listarTecnicos'], 'ControllerEquipamentos@listarTecnicos');

Route::get(['set' => '/imei/listarClientes', 'as' => 'equipamentos.listarClientes'], 'ControllerEquipamentos@listarClientes');
Route::get(['set' => '/imei/listarobra', 'as' => 'equipamentos.listarObra'], 'ControllerEquipamentos@listarObra');
Route::get(['set' => '/imei/listarmaterial', 'as' => 'equipamentos.listarMaterial'], 'ControllerEquipamentos@listarMaterial');
Route::get(['set' => '/imei/listarorcamento', 'as' => 'equipamentos.listarOrcamento'], 'ControllerEquipamentos@listarOrcamento');

/*Route::get('/', function(){
	echo "Página inicial";
});*/

/*
Route::get('/fim', function(){
	echo "Página final";
});*/


//Route::get(['set' => '/12perguntas/{id}/ver', 'as' => 'perguntas.listar12PerguntasCatDiferentes'], 'ControllerPerguntas@listar12PerguntasCatDiferentes');
//Route::get(['set' => '/7perguntas/{id}/ver', 'as' => 'perguntas.listarsetePerguntasMesmaCat'], 'ControllerPerguntas@listarsetePerguntasMesmaCat');
//Route::get(['set' => '/1perguntas/{id}/ver', 'as' => 'perguntas.listarprimeiraPergunta'], 'ControllerPerguntas@listarprimeiraPergunta');
//Route::get(['set' => '/2perguntas', 'as' => 'perguntas.listarsegundaPergunta'], 'ControllerPerguntas@listarsegundaPergunta');
/*
Route::get(['set' => '/artigos/{id}/show', 'as' => 'artigos.listaArtigos'], 'ControllerArtigos@listaArtigos');

Route::get(['set' => '/clientes', 'as' => 'clientes.listaClientes'], 'ControllerClientes@listaClientes');
Route::get(['set' => '/cliente/{id}/show', 'as' => 'clientes.show'], 'ControllerClientes@show');

Route::get(['set' => '/servicos', 'as' => 'servicos.listaServicos'], 'ControllerServicos@listaServicos');
Route::get(['set' => '/servico/{id}/show', 'as' => 'servicos.show'], 'ControllerServicos@show');
Route::get(['set' => '/servico/servicosAtivos', 'as' => 'servicos.servicosAtivos'], 'ControllerServicos@servicosAtivos');

Route::get(['set' => '/fornecedores', 'as' => 'fornecedores.listaFornecedores'], 'ControllerFornecedores@listaFornecedores');
Route::get(['set' => '/fornecedor/{id}/show', 'as' => 'fornecedores.show'], 'ControllerFornecedores@show');
Route::get(['set' => '/fornecedor/funcionariasAtivas', 'as' => 'fornecedores.funcionariasAtivas'], 'ControllerFornecedores@funcionariasAtivas');


Route::get(['set' => '/pedidos', 'as' => 'pedidos.listaPedidos'], 'ControllerPedidos@listaPedidos');
Route::get(['set' => '/pedido/{id}/EmEspera', 'as' => 'pedidos.listaPedidosEspera'], 'ControllerPedidos@listaPedidosEspera');
Route::get(['set' => '/pedido/EmEsperaGeral', 'as' => 'pedidos.listaPedidosEsperaGeral'], 'ControllerPedidos@listaPedidosEsperaGeral');
Route::get(['set' => '/pedido/{id_F}/AtribuidosPorResolver', 'as' => 'pedidos.listaPedidosAtribuidosPorResolver'], 'ControllerPedidos@listaPedidosAtribuidosPorResolver');
Route::get(['set' => '/pedidos/UltimoEmChamada', 'as' => 'pedidos.UltimoEmChamada'], 'ControllerPedidos@UltimoEmChamada');
Route::get(['set' => '/pedido/{id}/resolvidosDia', 'as' => 'pedidos.listaPedidosResolvidosNoDiaPorFornecedor'], 'ControllerPedidos@listaPedidosResolvidosNoDiaPorFornecedor');
Route::get(['set' => '/pedido/{id_P}/show', 'as' => 'pedidos.show'], 'ControllerPedidos@show');
Route::get(['set' => '/pedido/{id}/numeroPedido', 'as' => 'pedidos.ultimoPedido'], 'ControllerPedidos@ultimoPedido');
Route::get(['set' => '/pedidos/{dia}/pedidosResolvidos', 'as' => 'pedidos.pedidosResolvidosPorDia'], 'ControllerPedidos@pedidosResolvidosPorDia');
Route::get(['set' => '/pedidos/pedidosAtendidosPorFuncionariaMes', 'as' => 'pedidos.pedidosAtendidosPorFuncionariaMes'], 'ControllerPedidos@pedidosAtendidosPorFuncionariaMes');
Route::get(['set' => '/pedidos/pedidosAtendidosPorServicoMes', 'as' => 'pedidos.pedidosAtendidosPorServicoMes'], 'ControllerPedidos@pedidosAtendidosPorServicoMes');
Route::get(['set' => '/pedidos/pedidosEsperaPorServico', 'as' => 'pedidos.listaPedidosEsperaPorServico'], 'ControllerPedidos@listaPedidosEsperaPorServico');
Route::get(['set' => '/pedidos/pedidosResolvidosPorFornecedor', 'as' => 'pedidos.listaPedidosResolvidosPorFornecedor'], 'ControllerPedidos@listaPedidosResolvidosPorFornecedor');
Route::post(['set' => '/pedido/add', 'as' => 'pedidos.adicionarPedido'], 'ControllerPedidos@adicionarPedido');
Route::post(['set' => '/pedido/{id}/encerrar', 'as' => 'pedidos.encerrarPedido'], 'ControllerPedidos@encerrarPedido');
Route::post(['set' => '/pedido/{id}/chamar', 'as' => 'pedidos.chamarPedido'], 'ControllerPedidos@chamarPedido');
*/

Route::get ('/ver', function(){  require _CAMINHO_TEMPLATE. "ver.php";});

?>