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
            unset($_SESSION['error']);
            unset($_SESSION['getEmail']);

            $controller = new userController();
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $controller->login();
            }
        ?>

        <!-- Wrapper -->
        <div class="d-flex flex-column vh-100">
            <!-- Content -->
            <div class="container mt-auto pt-3 pb-5 px-md-5 px-3 text-center text-lg-start">
                <div class="row gx-lg-5 align-items-center justify-content-center">
                    <div class="col-lg-12 mb-3 text-center">
                        <img src="Imagens/logoUnimed.png" alt="logo" style="width: 300px">
                        <h3 class="mt-3"  style="color: #333333">Wi-Fi Unimed</h3>
                        <h5 class="m-0" style="color: #333333">Bem vindo!</h5>
                    </div>
                    <div class="col-lg-5 mb-5 mb-lg-0">

                        <!-- Error message -->
                        <?php if(isset($_SESSION['error']) || isset($_SESSION['errorLogin'])){ ?>
                            <div class="w-100 d-flex mb-3 p-2 rounded bg-danger-subtle text-danger fs-5 align-items-center">
                                <img src="../icons/error.png" style="width:17px;height:17px"></img>
                                <?php if(isset($_SESSION['errorLogin'])){ ?>
                                    <p class="m-0 px-2 fs-6"><?php echo $_SESSION['errorLogin']; ?></p>
                                <?php } ?>
                                <?php if(isset($_SESSION['error'])){ ?>
                                    <p class="m-0 px-2 fs-6">Erro: fazer tentar novamente mais tarde!</p>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- Status message -->
                        <?php if(isset($_SESSION['status'])){ ?>
                            <div class="w-100 d-flex mb-3 p-2 rounded bg-success-subtle text-success fs-5 align-items-center">
                                <p class="m-0 px-2 fs-6"><?php echo $_SESSION['status']; ?></p>
                            </div>
                        <?php } ?>

                        <!-- Forms -->
                        <div class="card shadow">
                            <div class="card-body pt-4 pb-0 pt-md-5 px-md-5 px-4">
                                <form action="" method="POST">
                                    <div class="row">
                                        <!-- Email input -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                                <input type="email" id="floatingEmail" class="form-control" name="email" value="<?php if(isset($_SESSION['getEmail'])){echo $_SESSION['getEmail'];} ?>" required />
                                                <label for="floatingEmail">E-mail</label>
                                            </div>
                                        </div>
    
                                        <!-- Password input -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                                <input type="password" id="floatingPassword" class="form-control" name="password" required />
                                                <label for="floatingPassword">Senha</label>
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- Submit button -->
                                    <div class="row mb-3">
                                        <div class="d-grid mb-4">
                                            <button type="submit" class="btn btn-success">Entrar</button>
                                        </div>
                                        
                                        <div class="d-grid mb-4">
                                            <a href="forgotPassword.php" class="btn btn-outline-success">Esqueci minha senha</a>
                                        </div>
                                    </div>
    
                                </form>
                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Não tem uma conta? <a href="register.php">Cadastre-se</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-auto text-center">
                <a href="unsubscribe.php" style="font-size:14px">Caso deseje remover o cadastro, clique aqui.</a>
                <br>
                <p class="border-top mb-0 mt-1 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por www.unimedsjc.com.br © 2023 - todos os direitos reservados</p>
            </div>
        </div>
    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>