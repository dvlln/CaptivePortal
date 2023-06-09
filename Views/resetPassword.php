<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/resetPassword.css" rel="stylesheet">
    <title>Captive Portal - UNIMED SJC</title>
</head>
<body>
    <?php
        include '../Controller/userController.php';
        session_unset();

        $controller = new userController();
        if (isset($_GET['email']) && isset($_POST['password'])){
            if($_POST['password'] === $_POST['passwordConfirmated']){
                $controller->redefinirSenha();
            } else{
                $_SESSION['error'] = 'Senhas não correspondem';
            }
        }
    ?>

    <img src="Imagens/wallpaper.jpg" class="wallpaper" alt="wallpaper">

    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-resetPwd">
                <div class="resetPwd-header">
                    <img src="Imagens/logoUnimed.png" alt="UNIMED SJC" >
                    <p>Trocar de senha</p>
                </div>

                <?php if(isset($_SESSION['error'])){ ?>
                        <p><?php echo $_SESSION['error']; ?></p>
                <?php } ?>

                <form class="resetPwd-form" method="POST">
                    <div class="wrap-input" data-validate="A senha é obrigatório">
                        <input class="input" type="password" name="password" placeholder="Senha" required>
                    </div>
                    <div class="wrap-input" data-validate="A senha de confirmação é obrigatório">
                        <input class="input" type="password" name="passwordConfirmated" placeholder="Senha de confirmação" required>
                    </div>
                    <div class="resetPwd-btn">
                        <a href="login.php" class="btn">Voltar</a>
                        <button type="submit" class="resetPwd-form-btn">Enviar</button>
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