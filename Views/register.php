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
        include '../Controller/userController.php';
        session_unset();

        $controller = new userController();
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['cpf']) && isset($_POST['phone']) && isset($_POST['password'])) {
            $controller->register();
        }
    ?>

    <!-- Wrapper -->
    <div class="d-flex flex-column vh-100">
        <!-- Content -->
        <div class="container mt-auto pt-3 pb-5 px-md-5 px-3 text-lg-start">
            <div class="row gx-lg-5 align-items-center justify-content-center">
                <div class="col-lg-12 mb-3 text-center">
                    <img src="Imagens/logoUnimed.png" alt="logo" style="width: 300px">
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <!-- Error message -->
                    <?php if(isset($_SESSION['error'])){ ?>
                        <div class="w-100 d-flex mb-3 p-2 rounded bg-danger-subtle text-danger fs-5 align-items-center">
                            <img src="../icons/error.png" style="width:17px;height:17px"></img>
                            <p class="m-0 px-2 fs-6">Erro: Tente novamente mais tarde!</p>
                        </div>
                    <?php } ?>
                    <!-- Forms -->
                    <div class="card shadow">
                        <div class="card-body pb-0 pt-4 px-md-5 px-4">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-4 text-center">
                                        <h3 class="m-0 text-center font-family-calibri">Cadastre-se</h3>
                                    </div>
                                    <!-- Name input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="floatingName" name="name" class="form-control" value="<?php if(isset($_SESSION['getName'])){echo $_SESSION['getName'];} ?>" required />
                                            <label for="floatingName">Nome completo</label>
                                        </div>
                                    </div>

                                    <!-- Email input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['emailError'])){ ?>
                                                <input type="email" id="floatingEmail" name="email" class="form-control is-invalid" value="<?php if(isset($_SESSION['getEmail'])){echo $_SESSION['getEmail'];} ?>" required />
                                                <label for="floatingEmail">E-mail</label>
                                                <p class="m-0 text-danger" style="font-size: 14px;"><?php echo $_SESSION['emailError']; ?></p>
                                            <?php }else{ ?>
                                                    <input type="email" id="floatingEmail" name="email" class="form-control" value="<?php if(isset($_SESSION['getEmail'])){echo $_SESSION['getEmail'];} ?>" required />
                                                    <label for="floatingEmail">E-mail</label>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- CPF input -->
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['cpfError'])){ ?>
                                                <input type="text" id="floatingCPF" name="cpf" class="form-control is-invalid floatingCPF" value="<?php if(isset($_SESSION['getCPF'])){echo $_SESSION['getCPF'];} ?>" required />
                                                <label for="floatingCPF">CPF</label>
                                                <p class="m-0 text-danger" style="font-size: 14px;"><?php echo $_SESSION['cpfError']; ?></p>
                                            <?php }else{ ?>
                                                <input type="text" id="floatingCPF" name="cpf" class="form-control" value="<?php if(isset($_SESSION['getCPF'])){echo $_SESSION['getCPF'];} ?>" required />
                                                <label for="floatingCPF">CPF</label>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- Phone input -->
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="tel" id="floatingPhone" name="phone" class="form-control" value="<?php if(isset($_SESSION['getPhone'])){echo $_SESSION['getPhone'];} ?>" required />
                                            <label for="floatingPhone">Telefone</label>
                                        </div>
                                    </div>

                                    <!-- Password input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['passError'])){ ?>
                                                <input type="password" id="floatingPassword" name="password" class="form-control is-invalid" required />
                                                <label for="floatingPassword">Senha</label>
                                                <p class="m-0 text-danger" style="font-size: 14px;"><?php echo $_SESSION['passError']; ?></p>
                                            <?php }else{ ?>
                                                <input type="password" id="floatingPassword" name="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tooltip on bottom" required />
                                                <label for="floatingPassword">Senha</label>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- User agreement -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="userAgreement" required>
                                            <label class="form-check-label" for="userAgreement" style="font-size:14px">Eu aceito o <a href="" data-bs-toggle="modal" data-bs-target="#userAgreementModal">Termo de consentimento de uso dos meus dados</a></label>
                                        </div>
                                    </div>

                                    <!-- User agreement modal -->
                                    <div class="modal fade" id="userAgreementModal" tabindex="-1" aria-labelledby="userAgreementModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="userAgreementModalLabel">Termo de consentimento de uso dos meus dados</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span>
                                                        Pelo presente Termo de Uso e Consentimento, autorizo o tratamento dos dados pessoais cadastrados, para finalidades:
                                                        <ul>
                                                            <li>Envio de mensagens e notificações (promoções, notícias e demais comunicados pertinentes)</li>
                                                            <li>Análise do perfil e comportamento de usuários</li>
                                                            <li>Defesa da empresa frente a processos administrativos e judiciais, como o cumprimento da Lei do Marco Civil da Internet</li>
                                                            <li>Enriquecimento de dados</li>
                                                        </ul>
                                                        Nos termos da Política de Privacidade constante abaixo.
                                                        <br/>Declaro que este consentimento se deu de forma livre, expressa, individual, clara, específica e legítima e que estou ciente que caso queira revogar a presente autorização basta desmarcar o campo "Eu aceito o termo de consentimento do uso dos meus dados" no formulário de cadastro.
                                                        <br/><br/>Assim, estando ciente e de acordo com os termos deste, firmo meu consentimento através da checagem do campo "Eu aceito o termo de consentimento do uso dos meus dados" no formulário de cadastro.
                                                        <br/><br/>Em caso de dúvidas, o contato deverá ser realizado através do e-mail hotspot@unimedsjc.coop.br
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>

                            </form>
                            <!-- Login button -->
                            <div class="text-center">
                            <p>Já possui uma conta? <a href="login.php">Faça login</a></p>
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
            <p class="border-top mb-0 mt-1 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por <a href="https://www.unimedsjc.com.br/" target=”_blank” class="text-light">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</p>
        </div>
    </div>


    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>