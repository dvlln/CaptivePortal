<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unimed SJC Wi-Fi</title>
    <link href="Imagens/logoTitle.png" rel="icon"/>
    <link href="../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-color: #f2f2f2">
    <?php
        include '../Controller/mailController.php';
        session_unset();

        $controller = new mailController();
        if (isset($_POST['email'])) {
            $controller->sendPasswordResetInvitation();
        }
    ?>

    <!-- WRAPPER -->
    <div class="d-flex flex-column vh-100">
        <!-- CONTENT -->
        <div class="container mt-auto px-md-5 px-3 text-lg-start">
            <div class="row gx-lg-5 align-items-center justify-content-center">
                <div class="col-lg-12 mb-4 text-center">
                    <img src="Imagens/logoUnimed.png" alt="logo" style="width: 300px">
                </div>
                <div class="col-lg-5">
                    <!-- Error message -->
                    <?php if(isset($_SESSION['error'])){ ?>
                        <div class="w-100 d-flex mb-3 p-2 rounded bg-danger-subtle text-danger fs-5 align-items-center">
                            <img src="../icons/error.png" style="width:17px;height:17px"></img>
                            <!-- <p class="m-0 px-2 fs-6">Erro: tente novamente mais tarde!</p> -->
                            <p class="m-0 px-2 fs-6"><?php echo $_SESSION['error'] ?></p>
                        </div>
                    <?php } ?>
                
                    <!-- Forms -->
                    <div class="card shadow">
                        <div class="card-body pb-0 pt-4 px-md-5 px-4">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-4 text-center">
                                        <h3 class="m-0 text-center font-family-calibri">Redefinir senha</h3>
                                    </div>
                                    <!-- Email input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['errorEmail'])){ ?>
                                                <input type="email" id="floatingEmail" name="email" class="form-control is-invalid" value="<?php if(isset($_SESSION['getEmail'])){echo $_SESSION['getEmail'];} ?>" required />
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

        <!-- FOOTER -->
        <div class="mt-auto text-center">
            <a href="unsubscribe.php" style="font-size:14px">Caso deseja remover o cadastro, clique aqui.</a>
            <br>
            <p class="border-top mb-0 mt-1 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por <a href="https://www.unimedsjc.com.br/" target=”_blank” class="text-light">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</p>
        </div>
    </div>

    

    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>