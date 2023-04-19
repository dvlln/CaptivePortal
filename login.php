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
                <img src="./Imagens/logoUnimed.png" alt="UNIMED SJC">
                <h3 class="login-title">CAPTIVE PORTAL</h3>
                <form action="" method="POST">
                    <div class="wrap-input" data-validate="Username is required">
                        <input class="input" type="text" name="username" placeholder="Username">
                    </div>
                    <div class="wrap-input" data-validate="Password is required">
                        <input class="input" type="password" name="pass" placeholder="Password">
                    </div>
                    <div class="login-btn">
                        <button type="submit" class="login-form-btn">Login</button>
                    </div>
                </form>
                <div class="forgot-password">
                    <a href="#" class="btn">Esqueci minha senha</a>
                </div>
                <div class="forgot-password">
                    <a href="#" class="btn">Cadastre-se</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <div><a href="#" style="font-size:9px">Caso deseja remover o cadastro, clique aqui.</a></div>
            <div><b>&copy; Todos os direitos reservados a Unimed São José dos Campos - Coorporativa de Trabalho Médico. 2023</b></div>
        </div>
    </div>
</body>
</html>