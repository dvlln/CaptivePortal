<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unimed SJC Wi-Fi</title>
    <link href="Imagens/logoUnimed.png" rel="icon"/>
    <link href="../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-color: #f2f2f2">
    <?php
        include '../Controller/userController.php';
        session_unset();

        $controller = new userController();
        if (isset($_GET['email'])) {
            $controller->unsubscribeUser();
        }else{
            return header("Location: /CaptivePortal/Views/login.php");
        }
    ?>

    <!-- Wrapper -->
    <div class="d-flex flex-column vh-100">
        <!-- Content -->
        <div class="container mt-auto px-md-5 px-3 text-lg-start">
            <div class="row gx-lg-5 align-items-center justify-content-center">
                <div class="col-lg-12 mb-4 text-center">
                    <img src="Imagens/logoUnimed.png" alt="logo" style="width: 300px">
                </div>
                <div class="col-lg-5">
                    <div class="card shadow">
                        <div class="card-body pt-4 pb-0 pt-md-5 px-md-5 px-4">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <?php if(isset($_SESSION['error'])){ ?>
                                            <h3 class="text-center font-family-calibri text-danger-emphasis">Erro durante a remoção, tente novamente mais tarde!</h3>
                                        <?php }else{ ?>
                                            <h3 class="text-center font-family-calibri text-success-emphasis">Conta removida com sucesso</h3>
                                        <?php } ?>
                                    </div>
                                </div>

                                <!-- Return button -->
                                <div class="d-grid mb-4">
                                    <a href="login.php" class="btn btn-secondary">Voltar a tela de login</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-auto text-center">
            <p class="border-top mb-0 mt-3 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por <a href="https://www.unimedsjc.com.br/" target=”_blank” class="text-light">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</p>
        </div>
    </div>

    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>