<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/forgotPassword.css" rel="stylesheet">
    <title>Captive Portal - UNIMED SJC</title>
</head>
<body>
    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-forgotPwd">
                <div class="forgotPwd-header">
                    <img src="./Imagens/logoUnimed.png" alt="UNIMED SJC" >
                    <p>Esqueci minha senha</p>
                </div>
                <form class="forgotPwd-form" action="" method="POST">
                    <div class="wrap-input" data-validate="E-mail é obrigatório">
                        <input class="input" type="text" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="forgotPwd-btn">
                        <a href="login.php" class="btn">Voltar</a>
                        <button type="submit" class="forgotPwd-form-btn">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            <b style="font-size:15px">&copy; Todos os direitos reservados a Unimed São José dos Campos - Coorporativa de Trabalho Médico. 2023</b>
        </div>
    </div>
</body>
</html>