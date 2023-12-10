<!DOCTYPE html>
<html lang="pt-br">

<head>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-image: url('IMG/cinza.avif');
            background-size: cover;
            background-attachment: fixed;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 20px;
            text-align: center;
        }

        .caixa-acesso {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            border: 5px solid #5d5d5d;
            max-width: 287px;
            margin: auto;
            margin-top: 416px
                /* Centraliza a caixa verticalmente e a coloca no centro horizontal */
        }

        .caixa-acessos {
            background-color: rgba(255, 0, 0, 0.6);
            padding: 1px;
            border-radius: 15px;

            text-align: center;
            border: 5px solid #eb4d4d;
            max-width: 200px;
            margin: auto;
            margin-top: 300px
                /* Centraliza a caixa verticalmente e a coloca no centro horizontal */
        }

        p {
            color: white;
        }

        h1 {
            color: black;
            font-size: 25px;
        }

        button[type="button"] {
            padding: 15px 30px;
            font-size: 16px;
            background-color: #000000;
            color: #fff;
            border-radius: 15px;
            border: none;
            cursor: pointer;
            margin-top: 100px;
        }

        button[type="button"]:hover {
            background-color: rgb(62, 62, 62);
            opacity: 1;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: brown;
            border-bottom: 5px solid black;
            background: transparent;
            color: white;
        }

        button[type="submit"] {
            background-color: hotpink;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 17px;
            cursor: pointer;
            opacity: 0.9;
            transition: initial;
        }

        button[type="submit"]:hover {
            background-color: black;
            opacity: 1;
        }

        form {
            text-align: center;
        }

        label {
            color: hotpink;
            font-size: 22.5px;
        }

        .bi {
            fill: hotpink;
        }

        .mensagem-erro {
            color: white;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título da Página</title>
</head>

<body>
    <div class="caixa-acesso">
        <?php
        $mensagemErro = '';
        include("conexao.php");

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        // Verifica se os campos não estão vazios
        if (!empty($nome) && !empty($email) && !empty($senha)) {
            $sql = "INSERT INTO cadastro (nome, email, senha) VALUES ( ?, ?, ?)";
            $stmt = mysqli_prepare($mysqli, $sql);

            if ($stmt) {
                // Bind dos parâmetros e execução da consulta
                mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

                if (mysqli_stmt_execute($stmt)) {
                    $mensagemErro = 'Usuário cadastrado com sucesso';
                    echo "<p class='mensagem-erro'>$mensagemErro</p>";
                } else {
                    $mensagemErro = 'Erro ao cadastrar usuário';
                    echo "<p class='mensagem-erro'>$mensagemErro</p>";
                }

                mysqli_stmt_close($stmt);
            } else {
                $mensagemErro = 'Erro na preparação da consulta';
                echo "<p class='mensagem-erro'>$mensagemErro</p>";
            }
        } else {
            $mensagemErro = 'Todos os campos devem ser preenchidos';
            echo "<p class='mensagem-erro'>$mensagemErro</p>";
        }

        mysqli_close($mysqli);
        ?>

    </div>

    <button type="button" onclick="voltar()">Voltar</button>


    <script>
        function voltar() {
            // Redirecionar para a página index.php
            window.location.href = 'index.html';
        }
    </script>


    <script src="seu-script.js"></script>
</body>

</html>