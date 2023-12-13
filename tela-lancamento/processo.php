<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lançamento de Gastos</title>
	<link rel="stylesheet" href="CSS/proc-style.css">

<body>

	<div class="container-fluid text-center">
		<h1>CompassOne</h1>
	</div>

	<h2>Lista de Gastos</h2>

	<?php

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$database = "lancamentos"; //NOME DO BANCO DE DADOS!!!!!!!!!
	
	$conexao = mysqli_connect($servidor, $usuario, $senha, $database);


	if ($conexao) {
		echo "conectado com sucesso";
	} else {
		echo "falha ao conectar";
	}



	/* criando tabela*/



	$query = "CREATE TABLE IF NOT EXISTS tabelas(
		id int not null auto_increment,
		nome varchar(255) not null,
		localizacao varchar(255) not null,
		valor varchar(255) not null,
		dia varchar(255) not null,
		hora varchar(255) not null,
		via varchar(255) not null,
		primary key(id)

	)";
	$executar = mysqli_query($conexao, $query);

	$nome = $_POST['nome'];
	$localizacao = $_POST['local'];
	$valor = $_POST['valor'];
	$dia = date('Y-m-d', strtotime($_POST['data']));
	$hora = $_POST['hora'];
	$via = $_POST['via'];

	$query = "INSERT INTO tabelas(nome, valor, dia, localizacao, hora, via) VALUES('$nome', '$valor', '$dia', '$localizacao', '$hora', '$via')";
	$executar = mysqli_query($conexao, $query);

	//ESTILOS DA TABELA QUE SERÁ MOSTRADA NA PAGINA
	echo '<style>
			table {
				width: 90%;
				height: 70%;
				border-collapse: collapse;
				margin-top: 20px;
				margin-left: 40px;
				align-itens: center;
				text-align: center;
			}

			th, td {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			th {
				background-color: #f2f2f2;
			}
		</style>';

	//COMEÇO DA CRIAÇÃO DA TABELA
	echo '<table>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Valor</th>
					<th>Dia</th>
				</tr>';
	//COMO OS VÃO APARECER NA TABELA
	$consulta = mysqli_query($conexao, "SELECT * FROM tabelas");
	while ($linha = mysqli_fetch_array($consulta)) {
		echo '<tr>';
		echo '<td>';
		echo $linha['id'];
		echo '</td>';
		echo '<td>';
		echo $linha['nome'];
		echo '</td>';
		echo '<td>';
		echo $linha['valor'] . " Reais";
		echo '</td>';
		echo '<td>';
		echo $linha['dia'];
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';

	//TENTATIVA DE SOMATÓRIA DE TODOS OS DADOS
	
	// Obtém a data atual
	$dataAtual = date('Y-m-d');

	// Consulta SQL para obter todas as variáveis "valor" dentro de 30 dias a partir da data atual
	$sql = "SELECT valor FROM tabelas WHERE dia >= DATE_SUB('$dataAtual', INTERVAL 30 DAY)";
	$result = $conexao->query($sql);


	// Inicializa a soma
	$soma = 0;

	// Verifica se há resultados e soma os valores
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$soma += $row["valor"];
		}
	}

	//AQUI VAI SER ONDE VAI SER COLOCADO O SALDO DO USUÁRIO, COMO AINDA É UM TESTE
	//FOI UTILIZADO UM VALOR GENÉRICO
	$saldo = 4000;

	//O SALDO ATUAL DO USUÁRIO APÓS SEUS GASTOS É SUBTRAÇÃO DO SALDO INFORMADO POR ELE PELA 
	//SOMATÓRIA DOS GASTOS REALIZADOS.
	$saldoAtual = $saldo - $soma

		?>

	<!--//ENVIA A VARIÁVEL 'saldoAtual' PARA 'resultados.php' SEM MOSTRAR O FORMULÁRIO PARA O USUÁRIO-->

	<form action="../index.php" method="post" id="formResultados">
		<input type="hidden" name="saldoAtual" value="<?php echo $saldoAtual; ?>">
		<input type="hidden" name="total" value="<?php echo $soma; ?>">
		<br><br>

		<center>
			<!--MANDA O USUÁRIO PARA A PÁGINA ONDE IRÁ MOSTRAR O SALDO DO USUÁRIO APÓS OS GASTOS-->
			<button type="submit">Minha Conta</button>
		</center>
	</form>

	<center>
		<!--REDIRECIONA PARA A PAGINA DE LANÇAMENTOS, PARA QUE O USUARIO POSSA ADICIONAR UM NOVO
		GASTO-->
		<button onclick="location.href='lancamentos.html'">Novo Gasto? Aqui!</button>
	</center>

</body>

</html>