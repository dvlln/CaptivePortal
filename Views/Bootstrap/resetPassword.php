<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Captive Portal - Redefinir Senha</title>
    <link href="../../Extensions/Bootstrap 5.3.0/CSS/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-color: #f2f2f2">
    <!-- WRAPPER -->
    <div class="d-flex flex-column vh-100">

        <!-- CONTENT -->
        <div class="container py-5 pb-0 px-md-5 px-3 text-center text-lg-start">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="../Imagens/logoUnimed.png" alt="logo" class="img-fluid">
                    <h1  class="text-center mt-3"  style="color: #333333">CAPTIVE PORTAL</h1>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 ">
                    <div class="card shadow">
                        <div class="card-body pt-4 pb-0 pt-md-5 px-md-5 px-4">
                            <form>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h3 class="font-family-calibri">Redefinir senha</h3>
                                    </div>
                                    <!-- Password input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <input type="password" id="floatingPassword" class="form-control" required />
                                            <label for="floatingPassword">Senha</label>
                                        </div>
                                    </div>
                                    <!-- Password input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <input type="password" id="floatingPasswordConfirmation" class="form-control" required />
                                            <label for="floatingPasswordConfirmation">Confirmar Senha</label>
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

    

    <script src="../../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>