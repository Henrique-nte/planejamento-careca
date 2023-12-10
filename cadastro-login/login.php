<?php
include('conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            
            header("Location: ../index.html");



        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-image: url('IMG/fundo.png');
            background-size: cover;
            background-attachment: fixed;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 20px;
            text-align: center;
        }

        .caixa-acesso {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;

            border: 5px solid gray;
            max-width: 287px;
            margin-left: 780.5px;
            margin-top: 290px;


        }

        h1 {
            color: black;
            font-size: 25px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: brown;
            border-bottom: 5px solid white;
            background: transparent;
            color: white;
        }

        button[type="submit"] {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 17px;
            cursor: pointer;
            opacity: 0.9;
            transition: initial;
        }

        button[type="submit"]:hover {
            background-color: rgb(48, 48, 48);
            opacity: 1;
        }

        form {
            text-align: center;
        }

        label {
            color: black;
            font-size: 22.5px;
        }

        .bi {
            fill: hotpink;
        }

        .mensagem-erro {
            color: white;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 15px;
        }

        button[type="button"] {
            padding: 9px 16px;
            font-size: 16px;
            background-color: #000000;
            color: #fff;
            border-radius: 15px;
            border: none;
            cursor: pointer;
            margin-top: -10px;
        }

        button[type="button"]:hover {
            background-color: rgb(62, 62, 62);
            opacity: 1;
        }
    </style>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="caixa-acesso">
        <h1>Login de Usuario</h1>

        <form action="" method="POST">

            <p>
                <label>E-mail</label>
                <input type="text" name="email">

                <label>Senha</label>
                <input type="password" name="senha">

                <button type="submit">Entrar</button>
            </p>

            <button type="button" onclick="voltar()">Crie uma conta</button>

            <script>
                function voltar() {
                    // Redirecionar para a página index.php
                    window.location.href = 'index.html';
                }
            </script>

        </form>
    </div>
</body>

</html>