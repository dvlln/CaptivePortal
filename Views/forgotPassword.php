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
    <?php
        include '../Controller/mailController.php';

        $controller = new mailController();
        if (isset($_POST['email'])) {
            $controller->mailing();
        }
    ?>

    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-forgotPwd">
                <div class="forgotPwd-header">
                    <img src="Imagens/logoUnimed.png" alt="UNIMED SJC" >
                    <p>Esqueci minha senha</p>
                </div>

                <?php if(isset($_SESSION['error'])){ ?>
                        <p><?php echo $_SESSION['error']; ?></p>
                <?php } ?>

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
        <b style="font-size:15px">Desenvolvido por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023 - todos os direitos reservados</b>
        </div>
    </div>
</body>
</html>