<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/captiveportal/views/css/forgotpasswordLayout.css" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body>
    <?php
        session_start();

        $email = $_SESSION['email'];
    ?>
    <div class="wrapper">
        <div class="content">
            <h2>Olá :]</h2>
            <p>Ficamos sabendo que você esqueceu a senha 😫
            <br/>Mas nao se preocupe, daremos um jeitinho para você</p>
            <p id="lastText">Basta clicar no link abaixo 😉</p>
            <a href="http://localhost/captiveportal/views/teste.php">Redefinir senha</a>
        </div>
        <div class="footer">
            <b style="font-size:20px">Enviado por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023</b>
        </div>
    </div>
    </div>
</body>
</html>