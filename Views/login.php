<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unimed SJC Wi-Fi</title>
    <link href="Imagens/logoTitle.png" rel="icon"/>
    <link href="../vendor/twbs/Bootstrap/dist/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-color: #f2f2f2">
        <?php
            include '../Controller/userController.php';

            require_once "../vendor/autoload.php";

            unset($_SESSION['errorSystem']);
            unset($_SESSION['getLogin']);

            $controller = new userController();
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $controller->login();
            }
        ?>
        <!-- WRAPPER -->
        <div class="d-flex flex-column vh-100">
            <!-- CONTENT -->
            <div class="container mt-auto pt-3 pb-5 px-md-5 px-3 text-center text-lg-start">
                <div class="row gx-lg-5 align-items-center justify-content-center">
                    <div class="col-lg-12 mb-3 text-center">
                        <img src="Imagens/logoUnimed.png" alt="logo" style="width: 300px">
                        <h3 class="mt-3"  style="color: #333333">Wi-Fi Unimed</h3>
                        <h5 class="m-0" style="color: #333333">Bem vindo!</h5>
                    </div>
                    <div class="col-lg-5 mb-5 mb-lg-0">

                        <!-- ERROR MESSAGE -->
                        <?php if(isset($_SESSION['errorSystem']) || isset($_SESSION['errorGeneral'])){ ?>
                            <div class="w-100 d-flex mb-3 p-2 rounded bg-danger-subtle text-danger fs-5 align-items-center">
                                <img src="../icons/error.png" style="width:17px;height:17px;margin-left:15px"></img>
                                <?php if(isset($_SESSION['errorSystem'])){ ?>
                                    <!-- <p class="m-0 px-2 fs-6">Erro: tente novamente mais tarde!</p> -->
                                    <p class="m-0 px-2 fs-6"><?php echo $_SESSION['errorSystem'] ?></p>
                                    <?php } ?>
                                <?php if(isset($_SESSION['errorGeneral'])){ ?>
                                    <p class="m-0 px-2 fs-6"><?php echo $_SESSION['errorGeneral']; ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- STATUS MESSAGE -->
                        <?php if(isset($_SESSION['status'])){ ?>
                            <div class="w-100 d-flex mb-3 p-2 rounded bg-success-subtle text-success fs-5 align-items-center">
                                <img src="../icons/success.png" style="width:17px;height:17px;margin-left:15px"></img>
                                <p class="m-0 px-2 fs-6"><?php echo $_SESSION['status']; ?></p>
                            </div>
                        <?php } ?>

                        <!-- FORMS -->
                        <div class="card shadow">
                            <div class="card-body pt-4 pb-0 pt-md-5 px-md-5 px-4">
                                <form action="" method="POST">
                                    <div class="row">
                                        <!-- E-MAIL INPUT -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                                <input type="text" id="floatingLogin" class="form-control" name="login" value="<?php if(isset($_SESSION['getLogin'])){echo $_SESSION['getLogin'];} ?>" required />
                                                <label for="floatingLogin">E-mail ou CPF</label>
                                            </div>
                                        </div>
    
                                        <!-- PASSWORD INPUT -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                                <input type="password" id="floatingPassword" class="form-control" name="password" required />
                                                <label for="floatingPassword">Senha</label>
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- SUBMIT/FORGOT PASSWORD BUTTON -->
                                    <div class="row mb-3">
                                        <div class="d-grid mb-2">
                                            <button type="submit" class="btn btn-success">Entrar</button>
                                        </div>
                                        
                                        <div class="d-grid mb-2">
                                            <a href="forgotPassword.php" class="btn btn-outline-success">Esqueci minha senha</a>
                                        </div>
                                    </div>
    
                                </form>
                                <!-- REGISTER BUTTON -->
                                <div class="text-center">
                                    <p>Não tem uma conta? <a href="register.php">Cadastre-se</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="mt-auto text-center">
                <p class="border-top mb-0 mt-1 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por <a href="https://www.unimedsjc.com.br/" target=”_blank” class="text-light">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</p>
            </div>
        </div>

    <!-- BOOTSTRAP -->    
    <script src="../vendor/twbs/Bootstrap/dist/JS/bootstrap.bundle.min.js"></script>
    
  </body>
</html>