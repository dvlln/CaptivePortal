<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Captive Portal - Login</title>
    <link href="../../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/login.css" rel="stylesheet">
  </head>
  <body>
    <!-- Section: Design Block -->
    <section class="container-fluid">
        <!-- Jumbotron -->
        <div class="py-5 px-md-5 text-center text-lg-start">
            <div class="container h-100">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <img src="../Imagens/logoUnimed.png" alt="logo" class="img-fluid">
                        <h1  class="text-center mt-3"  style="color: hsl(217, 10%, 50.8%)">CAPTIVE PORTAL</h1>
                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0 ">
                        <div class="card shadow">
                            <div class="card-body pt-4 pb-0 pt-md-5 px-md-5 px-4">
                                <form>
                                    <div class="row">
                                        <!-- Name input -->
    
                                        <!-- Email input -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                            <input type="email" id="floatingEmail" class="form-control" require />
                                            <label for="floatingEmail">E-mail</label>
                                            </div>
                                        </div>
    
                                        <!-- Password input -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                                <input type="password" id="floatingPassword" class="form-control" require />
                                                <label for="floatingPassword">Senha</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="row mb-3">
                                        <div class="d-grid mb-4">
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                        </div>
                                        
                                        <div class="d-grid mb-4">
                                            <a href="forgotPassword.php" class="btn btn-outline-primary">Esqueci minha senha</a>
                                        </div>
                                    </div>

                                    <!-- Register buttons -->
                                    <div class="text-center">
                                        <p>Não tem uma conta? <a href="register.php">Cadastre-se</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <script src="../../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>