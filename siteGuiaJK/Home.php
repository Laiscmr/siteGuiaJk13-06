

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\Home.css"/>
    <script src="js\sweetalert2.js"></script>
    <script src="js\custom.js"></script>
    <title>Guia JK</title>
</head>
<body>
<?php
session_start();
include_once("conexao.php");


if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $confirma_email = $_POST["confirmar_email"];

    if ($email!= $confirma_email){
        ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'O e-mail não confere.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Fechar'
                    });
                });
            </script>
            <?php
    } else {
        // Prepare a consulta SQL para verificar se o e-mail existe
        $stmt = $conexao->prepare("SELECT * FROM usuario WHERE email =?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        if ($num_rows == 0) {
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Este e-mail não existe.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Fechar'
                    });
                });
            </script>
            <?php
        } else {
            // Prepare a consulta SQL para excluir o usuário
            $stmt = $conexao->prepare("DELETE FROM usuario WHERE email =?");
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso',
                                text: 'Conta excluída com sucesso!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Fechar'
                            }).then(() => {
                                window.location.href = 'TelaLogin.php';
                            });
                        });
                      </script>";
                // Limpe a sessão e redirecione para a página de login
                $_SESSION = array();
                session_destroy();
                header('Location: ' . $_SERVER['HTTP_REFERER']);


            } else {
                echo "<div class='alert'>
                        <span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>×</span> 
                        Erro ao excluir a conta: ". $conexao->error. "
                    </div>";
            }
        }
    }
}

//...

if(isset($_POST["sair"])){
    $_SESSION = array();
    session_destroy();
    ?>
    <script>
        Swal.fire({
            title: "Você tem certeza que deseja sair?",
            icon: "question",
            iconHtml: "?",
            confirmButtonText: "Sair",
            cancelButtonText: "Voltar",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor:'#FF0000'
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário clicou em SAIR, redireciona para TelaHome.php
                window.location.href = 'TelaHome.php';
            } else {
                // Se o usuário clicou em VOLTAR ou FECHAR, redireciona para a página atual
                window.location.href = 'Home.php'; // Substitua por o caminho correto para a página que você deseja redirecionar
            }
        });
    </script>
<?php



}



?>

<nav>
    
        <p id="guia">Guia </p><h1 id="jk">JK</h1>
        
       <div class="dropdown dropdown1">
       <img id="imgPerfil"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA0ZJREFUSEvllk2IHFUQx///6p5NVARj9LQXySFIdro3aKKC4EdIyJJcFD8w4klBoiKJehBBt1+vITkEox5MCIIXJeIHiIiGKKJgLtEVs9MzEsWb4kGiSMAFk+4q0z2zOLM7s92zI+TguzX96v+rqldV7xGXaPEScTE0+N37zDvzI0JV3Vw4rfL1hg1I7n+P2TBBDAWOw/QeM74KYHwR5GfCnowS/8Oq8MpgF2QvA9hbInzIJd4zVeCVwHH9wjajfNoWtG9Ie87E/zb/oqY3mvEAwCL1VN0StWpflMErgV2gnwG2FUAClU2uxfPdwm7CxiA6CyAw8HicyI6RwQ4mCPQvAKtBPOEa3uF+oi7MHofhNQDnkMgaB+py8NKIo7qFpM4VSYbtjBP/k36CUZDuIPhxp9InXIvfjwTeN2njqeovxfnRHowa/tv9BOMw3WXGY4WDvozH3/HXkcC5sQuy3wFcDWBg1boge+limp+G4axreteOfMYd8IsAnjcgE9rdUcP/qKe4gvQuA98n4BkQxYk389+Ar7PVuFJbANa1O8pOgpw1oEZYAPC2DugHqISLq76fE6XFtWDUKbK38pYZEE0iIrum55g7WLoqg4uUw4SBPqbG7aDdcjH9KYyzInbcGnK0rIW6vRkKXBrGEBsqgfdfb2vPj2W3QnkzyE2AruplyN8wm4XYKWTeSdfiH2U+LAt2G+0qpHoQxCN5G5eJdf4biKM2L8/GP/HcIJuBYi5M74XyCIhruoznAcunWM+sBjAGcBLA5V17f6PZ7qjpf1C5qmcmbLOKnuqK8g2BvPJCgiZB6ydkMLo6AlL3AHh4IXozuSluMr9AetaSiDs3TQJgPYB5oUxNN/hVxTQX22YCu12h+UzPM3AGKpOLe3spOMgOAXgqFyDs0SjxXx8G+m/fZ7tJHOl8Lxm1S8BRkM0TuMyMJ+KmTK0EumDjAv0csC155lziXTGwj4u2qenZIlqzB6Km/84o4KiePkTyzULDkzXuNP9c0OuJ2IV2A0zbTxrRqWiudmIkcNcdLZBwOmFeO8XqBdcv3AFK+71keqdr1r4cBeyW0esFFwMj3VjAfP90d2pW4kB7APXXqzqNVsJd1ub/B/4Hxio/Ljwd+MgAAAAASUVORK5CYII="/></a>
        <div class="dropdown-content">
       
        <div class='text'> 


        
    <h1 id="pflais">Bem-vindo(a),<br> <?php echo $_SESSION['nome']; ?> ! </h1>
</div>

<section id="linhazinha"></section>
<form  method="post" action="Home.php" style="display: inline-block;">


    
<a id="eee"href="TelaEditar.php"> <div class="btn">Editar conta</div></a><br>
    <button  id="bugado"type="submit" name="sair" value="sair">Sair da conta</button><br><br>
        <div onclick="abrirModal()" class="btn" id="eeee">Excluir conta</div><br>
        
        </form>

    </div>
</div>
    <section id="link">
    

        <a href="#sec1">Teste Vocacional</a> 
        <a href="#sec2">Mapa Escolar</a>
        <a href="#sec3">Sobre os Cursos</a>
        <a href="#sec4">Sobre a Escola</a>
        </section>
    
    </nav>
    
    <section id="sec1">
        <br>
        <br>
        <p>#TESTEVOCACIONAL</p>
        <h2 id="tv">Teste Vocacional</h2>
        <p>descubra em qual curso técnico você se encaixa! :D</p>
        <p>vamos lá?</p>

        <a href="TelaTeste.html">
        <input id="tvbt" type="submit" value="Descobrir" >
        </a> 
    </section>


    </section>
    <section id="sec2">
    <p>#MAPAESCOLAR</p>
        <h2 id="mp">Mapa da Escola</h2>
        <p>localização dos laboratórios e pontos importantes!!</p>
        <p>deseja ver?</p>

        <a href="MapaEscolar.html">
        <input id="mpbt" type="submit" value="Visualizar">
</a>

    </section>
    <section id="sec3">
    <p>#SOBRECURSOS</p>
        <h2 id="sc">Nossos Cursos</h2>
        <p>saiba mais sobre os nossos cursos profissionalizantes ;P</p>
        <p>Reforce seus conhecimentos!</p>
        <a href="TelaCurso.html">
        <input id="scbt" type="submit" value="Saber">
        </a> 

    </section>
    <section id="sec4">
        <p>#SOBREESCOLA</p>
        <h2 id="se">Sobre a Escola</h2>
        <p>Saiba mais sobre o Juscelino Kubitschek</p>
        <p>conheça a história</p>

        <a href="SobreEscola.html">
        <input id="sebt" type="submit" value="Saber">
</a>
    </section>

        <div class="janela-modal" id="janela-modal">
            <div class="modal">
                <button class="fechar" id="fechar">X</button>
                <h1 id="cortxt">EXCLUIR CONTA</h1>
                               
<p id="corr">Ao excluir a sua conta você perde algumas funcionalidades do site como o Teste Vocacional</p>

<p id="corr">Você tem certeza dessa escolha? D:</p>
                    <div onclick="abrirModal2()" class="btn" href="" id="pa"><p id="pb">Excluir conta</a></p></div>
            </div>
        </div>

        <div class="janela-modal2" id="janela-modal2">
            <div class="modal2">
                <button class="fechar" id="fechar">X</button>
                <h1 id="cortxt">EXCLUIR CONTA</h1>
                <form method="post" action="">
                   <h3>E-mail:</h3>
                    <label for="email"></label><br>
                    <input id="cem" type="text" name="email" placeholder="Insira o seu E-mail"><img id="imgEmail" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAd9JREFUSEvt1rmLFUEQx/HPeoYKYiDi8Q+ImIiYmGjmASLIggaaiCAimHgE3mggKBpsJoiKLCwLHpkGZgoGBmIoiiAGYqCJeDsF3TAOb2fmPYb3DLaj6e6q+lb9unu6x4yojY2IaxY8NOWrUh/AMazuOIO3OIcbOW4ZvAlPOgZWw63H8xgsg0/gQrI803ECp1K847hUBZ9GNtiL2x3B9+BWqaDg/FNxGRxzEziC7wMmsABXcbDkH0o2gsP+BbbhfZ/w5XiAdRW/WvAf3EFIFO0TxvGoJXwL7mJJso8ly7F6gmN9Q4YAz8FhXC423Hz8Tusfmy/me7XYqCeL5Yvg4f8DR4sErpd8WoEj+Abcx9JEeoxd+FwhL8IUNqfxD9iJZ6mfk22UOjLObRmmUxIx9g5b8TIZrMHD4uewMvUDth0fSzEGAof/PFzBoRTsW5HA/vQdf6OF6ftakvdnRZGBwTnObtwsgfL4V+zD5Azr3wocG2luzQ5eWxyTe1iVbF4Xx24HXtX4tAL/StLWnZ7FCFkjydj9XxqOWitwU8UNjJ7TrcBtKu4X/n+C87UY2Z3tt6QG+3zrBeNi2A77IbART6vg6McVFpf1io4rflOclPMzPX06ZtWHm31XD03ukUn9F8FMcB8KRgALAAAAAElFTkSuQmCC"/><br>
                   <h3>Confirme o seu e-mail:</h3>
                    <label for="confirmar_email"></label><br>
                    <input id="cem" type="text" name="confirmar_email" placeholder="Confirme o seu E-mail"><img id="imgConfirma" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAltJREFUSEvtlktIVVEUhr9bEUklhQQOjKImgZOoCKlQsaI3JA6bNGhYg4gKtZlGgeJAnTgQHCv0EKmo6EENgnwgPYmMIhoUhRRZgyja/2UdOZzuvft07sE7ccOFffZea/1n/etf69wMJVqZEuEyDzxnzKdF9RHgLLAOsuV7BVwABvNlkgbwOaAtD4Duzue6KxZ4C/DYAr8DLtu+CVhte9mMRcGLBb4G7ANeApuBHwawDJg06q8Ch9MGngZWAB0O9EwkeBdwEvgAVMUBVoA+5/Q1hsQ/AauATuB0xF5np4CPQKUPuMXEMA7UAd894PeBWquhahleT4FqF+cu0FAIeCEwCmw0o0fAbg/4AWDE7J8DN22/F9hg+/3AdV/GK4HbwCYzfAjsCYkmFwFiqd36N3z/B2gFLsZtp3LgFrDVHESVMhMjQ8AJ4HUkmBSteu6yc2WoGj/53wGyHLjhqNtmjtovtlpNubsa4HMM8eU1KdTH6kUBbo94TwA7AbWSloSzw9Va4hJbWuoIDY0HJq5/XsA3QMoc5RoS9SHBqebfgLVuOvXnUmwE5Q5wFHgfPvcBy1bgUu4Cp/qDrl9nrHdfABUWTGfP3Ifipz3LR6201J6/mMpnyxMHWL5LTLVB4GFH5SEDktiUea51DOi2l7/ixmhjYBQXOBx0jaPurR0ItNcjsuOOmR6z0ejUCE3010dvfckCrQfeeID1jVYnaIml7MBJknEwVuW/CPjtAZbNL7NpDgZKEmApVD+tQO0ebO6ZwYDrBv0SZewDiXWfJONYgX1G88A+hlK7LxnVfwGux2Ef9rA5ZwAAAABJRU5ErkJggg=="/><br>      <br>
                    
                                     
                            <!-- Seus campos de entrada aqui -->
                            <button type="submit" name="submit" class="btn" id="pad">Excluir conta</button>
                        </form>
            </div>
        </div>

        <script src="script.js"></script>
</body>
</html>
