<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta lang="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tela de Planejamento</title>
    <style>
        /* Your existing styles */

        /* Styles for the carousel */
        .carousel {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px;
        }

        .carousel div {
            flex: 0 0 auto;
            width: 200px;
            height: 200px;
            background-color: white;
            border-radius: 10px;
            padding: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            justify-content: flex-start;
        }

        .colorBlock {
            position: absolute;
            top: -100px;
            /* Adjusted from -200px to -100px */
            width: 100%;
            height: 30%;
            background-color: #55e273;
        }

        .container {
            position: relative;
            top: -200px;
            /* Adjusted from -300px to -200px */
            left: 20px;
            text-align: left;
            width: 100%;
            padding-left: 10px;
            padding-top: 10px;
        }

        .borderContainer {
            border: 2px solid white;
            border-radius: 10px;
            background-color: white;
            padding: 10px;
        }

        .title {
            font-size: 14px;
            color: #333;
        }

        .value {
            font-size: 48px;
            font-weight: bold;
            color: #333;
        }

        .hamburger {
            cursor: pointer;
            display: inline-block;
            width: 30px;
            height: 22px;
            position: relative;
            top: -440px;
            /* Adjusted from -440px to -340px */
            left: 20px;
        }

        .hamburger div {
            width: 100%;
            height: 4px;
            background-color: #333;
            margin: 5px 0;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 122vh;
            margin: 0;
        }

        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        button {
            padding: 10px 20px;
            font-size: 16px;
        }

        button {
            color: #55e273;
            position: absolute;
            top: 67%;
            left: 5%;
            transform: translate(-50%, -50%);
            border: 2px solid #55e273;
            border-radius: 10px;
        }




        button:hover {
            color: black;
            /*color: white; /* Adicione esta linha para um texto branco ao passar o mouse */
            background-color: #55e273;
            /* Adicione esta linha para um fundo verde escuro ao passar o mouse */
        }
    </style>
</head>

<body>
    <div class="colorBlock"></div>
    <div class="hamburger" onclick="openNav()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="cadastro-login/login.php">login</a>
        <a href="#">cartao</a>
        <a href="contato/contato.html">Contact</a>
        <a href="tela-lancamento/lancamentos.html">adicionar</a>
    </div>

    <div class="container">
        <div class="borderContainer">
            <div class="title">Saldo Atual</div>
            <div class="value">R$ 1.000,00</div>
        </div>
        <!-- Add the Gastos here -->
        <div class="borderContainer">
            <div class="brand">
                <div class="title">
                    <h3><span>Gastos</span></h3>
                </div>

            </div>
        </div>

        <?php
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $database = "lancamentos"; //NOME DO BANCO DE DADOS!!!!!!!!!
        
        $conn = mysqli_connect($servidor, $usuario, $senha, $database);

        // Verifique a conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT nome, valor, via, dia, localizacao, hora FROM tabelas";
        $result = $conn->query($sql);

        echo '<div class="carousel">';

        if ($result->num_rows > 0) {
            // Saída de cada linha
            while ($linha = $result->fetch_assoc()) {
                echo '<div>';
                echo '<p>Nome do Gasto: ' . $linha["nome"] . '</p>';
                echo '<p>Valor do Gasto: ' . $linha["valor"] . " Reais" . '</p>';
                echo '<p> Dia:' . $linha["dia"] . '</p>';

                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        echo '</div>';
        $conn->close();
        ?>
    </div>
    <a href="tela-lancamento/lancamentos.html" class="closebtn" onclick="closeNav()">
        <button>Adicionar</button>
    </a>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

</body>

</html>