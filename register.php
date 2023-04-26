<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/register.css" rel="stylesheet">
    <title>Captive Portal - UNIMED SJC</title>
</head>
<body>
    <div class="container">
        <div class="wrapper"> 
            <div class="wrap-register">
                <div class="register-header">
                    <p>Registrar-se</p>
                </div>
                <form id="registerForm" class="register-form" action="" method="POST">
                    <div class="wrap-input" data-validate="Nome é obrigatório">
                        <input class="input" type="text" name="name" placeholder="Nome" required>
                    </div>
                    <div class="wrap-input" data-validate="E-mail é obrigatório">
                        <input class="input" type="text" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="wrap-input" data-validate="Senha é obrigatória">
                        <input class="input" type="password" name="password" placeholder="Senha" required>
                    </div>
                    <div class="wrap-checkbox" data-validate="Termo de uso é obrigatório">                    
                        <label for="user_term" class="label-checkbox">Li e concordo com os <a href="#" class="popup" onclick="myFunction()">termos de uso e do usuário
                            <span class="popuptext" id="myPopup">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in justo massa. Vestibulum justo nisi, commodo eu tempus vel, pretium eget orci. Cras in nisl odio. Nam viverra volutpat metus eget commodo. Donec quis nisl pellentesque, sodales nisi ac, blandit massa. Nunc tincidunt tortor quis arcu viverra imperdiet. Donec ac metus est. Maecenas euismod sapien elementum bibendum tincidunt. Pellentesque pellentesque nisl et est accumsan, rutrum scelerisque metus hendrerit. Fusce sed purus sed elit laoreet blandit faucibus facilisis est. Fusce commodo vel purus vel sollicitudin. Suspendisse dui ligula, porttitor non bibendum eu, pellentesque id magna. Donec ullamcorper purus dolor, nec vehicula ex tempus sit amet. Nunc luctus, enim et auctor consequat, urna turpis bibendum purus, non tincidunt ipsum nisi id turpis. Mauris imperdiet lorem velit, vitae vulputate odio dictum ac.</span>
                        </a>
                        <input type="checkbox" name="user_term" id="user_term" required>
                            <span class="checkmark"></span>
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
            <b style="font-size:15px">&copy; Todos os direitos reservados a Unimed São José dos Campos - Coorporativa de Trabalho Médico. 2023</b>
        </div>
    </div>

    <script>
        // FUNÇÃO PARA ATIVAR E DESATIVAR O MODAL AO CLICAR NO "LINK"
        function myFunction() {
            document.getElementById("myPopup").classList.toggle("show");
        }

        // FUNÇÃO AUTO INVOCAVEL(IIFE) PARA FECHAR O MODAL AO CLICAR EM QUALQUER LUGAR FORA DO FORMULARIO
        (function (){
            document.addEventListener('click', (event) => {
                var popup = document.getElementById("myPopup");
                var form = document.getElementById("registerForm")

                if(!(form.contains(event.target))){
                    if(popup.classList.contains('show')){
                        popup.classList.toggle('show');
                    }
                }
            });
        })();
    </script>
</body>
</html>