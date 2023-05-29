<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/unsubscribe.css" rel="stylesheet">
    <title>Captive Portal - UNIMED SJC</title>
</head>
<body>
    <?php
        include '../Controller/mailController.php';

        $controller = new mailController();
        $controller->desinscrever();
    ?>

    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-unsub">
                <div class="unsub-header">
                    <img src="Imagens/logoUnimed.png" alt="UNIMED SJC" >
                    <p>Remover conta</p>
                </div>

                <?php if(isset($_SESSION['error'])){ ?>
                        <p><?php echo $_SESSION['error']; ?></p>
                <?php } ?>

                <a href="login.php" class="btn">Voltar</a>
            </div>
        </div>
        <div class="footer">
        <b style="font-size:15px">Desenvolvido por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023 - todos os direitos reservados</b>
        </div>
    </div>
</body>
</html>