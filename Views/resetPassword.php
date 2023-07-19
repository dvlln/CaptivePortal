<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Captive Portal - Redefinir Senha</title>
    <link href="../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-color: #f2f2f2">

    <?php
        include '../Controller/userController.php';
        session_unset();

        $controller = new userController();

        if (!isset($_GET['email'])) {
            return header("Location: /CaptivePortal/Views/login.php");
        }

        if (isset($_POST['password'])){
            if($_POST['password'] === $_POST['passwordConfirmation']){
                $controller->resetPassword();
            } else{
                $_SESSION['passErrorConfirm'] = 'Senhas não correspondem';
            }
        }
    ?>

    <!-- WRAPPER -->
    <div class="d-flex flex-column vh-100">;
        <!-- CONTENT -->
        <div class="container py-5 pb-0 px-md-5 px-3 text-lg-start">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="Imagens/logoUnimed.png" alt="logo" class="img-fluid">
                    <h1 class="text-center mt-3" style="color: #333333">CAPTIVE PORTAL</h1>
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
                        <div class="card-body pb-0 pt-4 px-md-5 px-4">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h3 class="m-0 text-center font-family-calibri">Redefinir senha</h3>
                                    </div>

                                    <!-- Password input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['passError'])){ ?>
                                                <input type="password" id="floatingPassword" name="password" class="form-control is-invalid" required />
                                                <label for="floatingPassword">Senha</label>
                                                <p class="text-danger fs-6"><?php echo $_SESSION['passError']; ?></p>
                                            <?php }else{ ?>
                                                <input type="password" id="floatingPassword" name="password" class="form-control" required />
                                                <label for="floatingPassword">Senha</label>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- Password confirmation input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['passErrorConfirm'])){ ?>
                                                <input type="password" id="floatingPasswordConfirmation" name="passwordConfirmation" class="form-control is-invalid" required />
                                                <label for="floatingPasswordConfirmation">Senha</label>
                                                <p class="text-danger fs-6"><?php echo $_SESSION['passErrorConfirm']; ?></p>
                                            <?php }else{ ?>
                                                <input type="password" id="floatingPasswordConfirmation" name="passwordConfirmation" class="form-control" required />
                                                <label for="floatingPasswordConfirmation">Confirmar Senha</label>
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

        <!-- FOOTER -->
        <div class="mt-auto text-center">
            <p class="border-top mb-0 mt-3 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023 - todos os direitos reservados</p>
        </div>
    </div>

    

    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>