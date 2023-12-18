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
        // REDIRECIONAMENTO CRIADO, POIS A OPÇÃO DE EXCLUIR OS DADOS FOI REVOGADA ATE SEGUNDA ORDEM. 14/12/2023
        return header("Location: /CaptivePortal/Views/login.php");
        
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
        <div class="container mt-auto px-md-5 px-3 text-lg-start">
            <div class="row gx-lg-5 align-items-center justify-content-center">
                <div class="col-lg-12 mb-4 text-center">
                    <img src="Imagens/logoUnimed.png" alt="logo" style="width: 300px">
                </div>
                <div class="col-lg-5">
                    <!-- Error message -->
                    <?php if(isset($_SESSION['errorSystem'])){ ?>
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
                                    <!-- Email input -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <?php if(isset($_SESSION['errorEmail'])){ ?>
                                                <input type="email" id="floatingEmail" name="email" class="form-control is-invalid" value="<?php if(isset($_SESSION['getEmail'])){echo $_SESSION['getEmail'];} ?>" required />
                                                <label for="floatingEmail">E-mail</label>
                                                <p class="text-danger my-0 fs-6"><?php echo $_SESSION['errorEmail']; ?></p>
                                            <?php }else{ ?>
                                                <input type="email" id="floatingEmail" name="email" class="form-control" required />
                                                <label for="floatingEmail">E-mail</label>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- User data -->
                                    <div class="col-md-12 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="userData" required>
                                            <label class="form-check-label" for="userData" style="font-size:14px">Li e estou ciente do <a href="" data-bs-toggle="modal" data-bs-target="#userDataModal">Termo de exclusão de dados</a></label>
                                        </div>
                                    </div>

                                    <!-- User data modal -->
                                    <div class="modal fade" id="userDataModal" tabindex="-1" aria-labelledby="userDataModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="userDataModalLabel">Termo de exclusão de dados</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <span>
                                                    Olá!
                                                    <br/>De acordo com a LPGD (Lei Geral de Proteção de Dados), você tem agora a liberdade para pedir a exclusão dos seus dados de nossa base.
                                                    <br/>Mas gostaríamos de reforçar que eles são captados por vários motivos importantes e totalmente idôneos, como:
                                                    <ul>
                                                        <li>Envio de mensagens e notificações (atualizações, promoções, notícias e demais comunicados pertinentes);</li>
                                                        <li>Análise do perfil e comportamento de usuários com o objetivo de melhorar o produto e conteúdo ofertado;</li>
                                                        <li>Possível criação de novos produtos, serviços, funcionalidades e promoções;</li>
                                                        <li>Personalizações diversas de acordo com o interesse dos usuários;</li>
                                                        <li>Defesa da empresa frente a processos administrativos e judiciais, como o cumprimento da Lei do Marco Civil da Internet.</li>
                                                    </ul>
                                                    Se, mesmo assim, ainda desejar excluir seus dados de nossa base, basta checar o campo "Li e estou ciente do Termo de exclusão de dados".
                                                </span>
                                                </div>
                                            </div>
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
            <p class="border-top mb-0 mt-3 py-3 px-2 color-green bg-success text-light" style="font-size:13px">Desenvolvido por <a href="https://www.unimedsjc.com.br/" target=”_blank” class="text-light">www.unimedsjc.com.br</a> © 2023 - todos os direitos reservados</p>
        </div>
    </div>

    <script src="../Extensions/Bootstrap 5.3.0/JS/bootstrap.bundle.min.js"></script>
  </body>
</html>