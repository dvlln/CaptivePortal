<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Captive Portal - Login</title>
    <link href="../../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-color: #f2f2f2">
        <!-- Wrapper -->
        <div class="d-flex flex-column vh-100">

            <!-- Content -->
            <div class="container py-5 pb-0 px-md-5 px-3 text-center text-lg-start">
                <div class="row gx-lg-5 align-items-center justify-content-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                        <img src="../Imagens/logoUnimed.png" alt="logo" class="img-fluid">
                        <h1 class="mt-3"  style="color: #333333">CAPTIVE PORTAL</h1>
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
                                                <input type="email" id="floatingEmail" class="form-control" required />
                                                <label for="floatingEmail">E-mail</label>
                                            </div>
                                        </div>
    
                                        <!-- Password input -->
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">
                                                <input type="password" id="floatingPassword" class="form-control" required />
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
                <a href="unsubscribe.php" style="font-size:14px">Caso deseja remover o cadastro, clique aqui.</a>
                <br>
                <p class="border-top mb-0 mt-3 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023 - todos os direitos reservados</p>
            </div>
        </div>
    <script src="../../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>