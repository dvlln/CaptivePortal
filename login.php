<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/login.css" rel="stylesheet">
    <title>Captive Portal - UNIMED SJC</title>
</head>
<body>
    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-login">
                <div class="login-header">
                    <img src="./Imagens/logoUnimed.png" alt="UNIMED SJC" >
                    <p>Captive Portal</p>
                </div>
                <form class="login-form" action="" method="POST">
                    <div class="wrap-input" data-validate="E-mail é obrigatório">
                        <input class="input" type="text" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="wrap-input" data-validate="Senha é obrigatória">
                        <input class="input" type="password" name="password" placeholder="Senha" required>
                    </div>
                    <div class="login-btn">
                        <button type="submit" class="login-form-btn">Entrar</button>
                    </div>
                </form>
                <div class="login-resources">
                    <a href="forgotPassword.php" class="btn">Esqueci minha senha</a>
                    <a href="register.php" class="btn">Criar uma conta</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <a href="#" style="font-size:13px">Caso deseja remover o cadastro, clique aqui.</a>
            <b style="font-size:15px">&copy; Todos os direitos reservados a Unimed São José dos Campos - Coorporativa de Trabalho Médico. 2023</b>
        </div>
    </div>
</body>
</html>