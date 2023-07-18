<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/register.css" rel="stylesheet">
    <script src="../icons/fontawesome" crossorigin="anonymous"></script>
    <link rel="" href="">
    <title>Captive Portal - UNIMED SJC</title>
</head>
<body>
    <?php
        include '../Controller/userController.php';
        session_unset();

        $controller = new userController();
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['cpf']) && isset($_POST['phone']) && isset($_POST['password'])) {
            $controller->register();
        }
    ?>

    <img src="Imagens/wallpaper.jpg" class="wallpaper" alt="wallpaper">


    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-register">
                <div class="register-header">
                    <img src="Imagens/logoUnimed.png" alt="UNIMED SJC" >
                    <p>Registrar-se</p>
                </div>
                
                <?php if(isset($_SESSION['error'])){ ?>
                    <div class="error" onclick="closeToast()" id="toastError">
                        <img src="../icons/error.png"></img>
                        <div>
                            <p>Error</p>
                            <span>Tente novamente!</span>
                        </div>
                    </div>    
                <?php } ?>

                <form id="registerForm" class="register-form" action="" method="POST">
                    <div class="wrap-input" data-validate="Nome é obrigatório">
                        <input class="input" type="text" name="name" placeholder="Nome" required>
                    </div>
                    <div class="wrap-input" data-validate="E-mail é obrigatório">
                        <input class="input" type="text" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="wrap-input" data-validate="CPF é obrigatório">
                        <input id="inputCPF" class="input" type="text" name="cpf" placeholder="CPF" required>
                        <?php if(isset($_SESSION['cpfError'])){ ?>
                            <p class="active"><?php echo $_SESSION['cpfError']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="wrap-input" data-validate="Telefone é obrigatório">
                        <input class="input" type="text" name="phone" placeholder="Telefone" required>
                    </div>
                    <div class="wrap-input" data-validate="Senha é obrigatória">
                        <input id="inputPassword" class="input" type="password" name="password" placeholder="Senha" required>
                        <?php if(isset($_SESSION['passError'])){ ?>
                            <p class="active"><?php echo $_SESSION['passError']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="wrap-checkbox" data-validate="Termo de uso é obrigatório">                    
                        <label for="user_term" class="label-checkbox">Eu aceito o <a href="#" class="popup" onclick="function_user_agreement()">termo de consentimento de uso
                            <span class="popuptext" id="popup_user_agreement">
                                Pelo presente Termo de Uso e Consentimento, autorizo o tratamento dos dados pessoais cadastrados, para finalidades:
                                <ul>
                                    <li>Envio de mensagens e notificações (promoções, notícias e demais comunicados pertinentes)</li>
                                    <li>Análise do perfil e comportamento de usuários</li>
                                    <li>Defesa da empresa frente a processos administrativos e judiciais, como o cumprimento da Lei do Marco Civil da Internet</li>
                                    <li>Enriquecimento de dados</li>
                                </ul>
                                Nos termos da Política de Privacidade constante abaixo.
                                <br/>Declaro que este consentimento se deu de forma livre, expressa, individual, clara, específica e legítima e que estou ciente que caso queira revogar a presente autorização basta acessar “formulário”.
                                <br/><br/>Assim, estando ciente e de acordo com os termos deste, firmo meu consentimento através da checagem do campo "Eu aceito o Termo de Consentimento do uso dos meus dados" no formulário de cadastro.
                                <br/><br/>Em caso de dúvidas, o contato deverá ser realizado através do e-mail hotspot@unimedsjc.coop.br</span>
                        </a>
                        <input type="checkbox" name="user_term" id="user_term" required>
                            <span class="checkmark_term"></span>
                        dos meus dados</label>
                    </div>
                    <div class="wrap-checkbox" data-validate="Termo de uso é obrigatório">                    
                        <label for="user_data" class="label-checkbox">Li e estou ciente do <a href="#" class="popup" onclick="function_user_data()">termo de exclusão de dados
                            <span class="popuptext" id="popup_user_data">
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
                                Se, mesmo assim, ainda desejar excluir seus dados de nossa base, basta clicar no link presente no rodapé!</span>
                        </a>
                        <input type="checkbox" name="user_data" id="user_data" required>
                            <span class="checkmark_data"></span>
                        </label>
                    </div>
                    <div class="register-btn">
                            <a href="login.php" class="btn">Voltar</a>
                            <button type="submit" class="register-form-btn">Criar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            <a href="unsubscribe.php" style="font-size:13px">Caso deseja remover o cadastro, clique aqui.</a>
            <b style="font-size:15px">Desenvolvido por Unimed São José dos Campos - Cooperativa de Trabalho Médico &copy; 2023 - todos os direitos reservados</b>
        </div>
    </div>

    <script src="JS/toasted.js"></script>
    <script src="JS/popup_user_data.js"></script>
    <script src="JS/popup_agreement.js"></script>
    <script>
        <?php if(isset($_SESSION['cpfError'])){ ?>
            var input = document.getElementById("inputCPF");
            input.style.borderColor = 'red';
        <?php } ?>

        <?php if(isset($_SESSION['passError'])){ ?>
            var input = document.getElementById("inputPassword");
            input.style.borderColor = 'red';
        <?php } ?>
    </script>
</body>
</html>