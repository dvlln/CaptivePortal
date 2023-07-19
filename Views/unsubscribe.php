<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Captive Portal - Desinscrever</title>
    <link href="../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <?php
        include '../Controller/mailController.php';
        session_unset();

        $controller = new mailController();
        if (isset($_POST['email'])) {
            $controller->sendUnsubscribeInvitation();
        }
    ?>

    <!-- Wrapper -->
    <div class="d-flex flex-column vh-100">
        <!-- Content -->
        <div class="container py-5 pb-0 px-md-5 px-3 text-lg-start">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="Imagens/logoUnimed.png" alt="logo" class="img-fluid">
                    <h1  class="text-center mt-3"  style="color: #333333">CAPTIVE PORTAL</h1>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 ">
                    <!-- Error message -->
                    <?php if(isset($_SESSION['error'])){ ?>
                        <div class="w-100 d-flex mb-3 p-2 rounded bg-danger-subtle text-danger fs-5 align-items-center">
                            <img src="../icons/error.png" style="width:17px;height:17px"></img>
                            <p class="m-0 px-2 fs-6">Erro: tente novamente mais tarde!</p>
                        </div>
                    <?php } ?>

                    <!-- Forms -->
                    <div class="card shadow">
                        <div class="card-body pt-4 pb-0 pt-md-5 px-md-5 px-4">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-4 text-center">
                                        <h3 class="text-center font-family-calibri">Desinscrever</h3>
                                    </div>
                                    <!-- Email input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['errorEmail'])){ ?>
                                                <input type="email" id="floatingEmail" name="email" class="form-control is-invalid" required />
                                                <label for="floatingEmail">E-mail</label>
                                                <p class="text-danger fs-6"><?php echo $_SESSION['errorEmail']; ?></p>
                                            <?php }else{ ?>
                                                <input type="email" id="floatingEmail" name="email" class="form-control" required />
                                                <label for="floatingEmail">E-mail</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>
                                <div class="d-grid mb-4">
                                    <a href="login.php" class="btn btn-secondary">Voltar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-auto text-center">
            <p class="border-top mb-0 mt-3 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023 - todos os direitos reservados</p>
        </div>
    </div>

    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>