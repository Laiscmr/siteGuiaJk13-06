<?php
 session_start();
include_once("conexao.php");



if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $confirma_email = $_POST["confirmar_email"];

    if ($email != $confirma_email){
        echo "<div class='alert'>
                <span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>×</span> 
                O email não confere.
            </div>";
    } else {
        // Prepare a consulta SQL para verificar se o e-mail existe
        if ($stmt = mysqli_prepare($conexao, "SELECT * FROM usuario WHERE email = ?")) {
            // Vincule as variáveis à consulta preparada como parâmetros
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Defina os parâmetros
            $param_email = $email;
            
            // Tente executar a consulta preparada
            if (mysqli_stmt_execute($stmt)) {
                // Armazene o resultado
                mysqli_stmt_store_result($stmt);
                
                // Verifique se o e-mail existe no banco de dados
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // O e-mail existe, prepare uma nova consulta SQL para excluir o usuário
                    if ($stmt = mysqli_prepare($conexao, "DELETE FROM usuario WHERE email = ?")) {
                        // Vincule as variáveis à consulta preparada como parâmetros
                        mysqli_stmt_bind_param($stmt, "s", $param_email);
                        
                        // Tente executar a consulta preparada
                        if (mysqli_stmt_execute($stmt)) {
                            echo 'Conta excluída com sucesso!';
                        } else {
                            echo 'Erro ao excluir a conta: ' . mysqli_error($conexao);
                        }
                    }
                } else {
                    // O e-mail não existe
                    echo 'Este email não existe.';
                }
            } else {
                echo 'Erro ao verificar o e-mail: ' . mysqli_error($conexao);
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloHomeADM.css"/>

    <title>Guia JK</title>
</head>
<body>
<nav>
    
        <p id="guia">Guia </p><h1 id="jk">JK</h1>
        
       <div class="dropdown dropdown1">
       <img id="imgPerfil"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA2ZJREFUSEvlll9oU3cUx7/n5iat5mXV7ansRUGE0XZodYKwueKw6IvDFdaxJwdSFVnVJPPeX8Z+Nf3l0iT+Q5yUwV42NkYHQ2SWKqJgX6oRHFFRfBls7EFUhtCyJmmO/G5aSettctMM+uDvLeSc7+ec8zvn/C5hmQ4tExd1g3t6egJvr13fbgZKm3TQzHzzz0ePciMjIzP1JFEXOCrEHjDOAGhdAPmLCYcySl3wC/cNjlniFBP6qwkT42TKUUf9wH2BY7b9EYMulwX5FgFWPhS6rX+F8vmNDDgAuaUncFcqmbxWC+4LHLXEFRC2g5ELNwU7pZT5SmEpZWhyupAFoY2A0VRS7WwYLKU0JvOFSQDNRDiYUupbL9GYEAeYcQ7A83Ao2CKlLFW9llqRRWy7nUB/lKtMu9LO4CUvn6gV3wni3/V/JS69c8Jx7jcEPixEq8n42xUhfJZW6mdPsBC9YPzkmhXN1lRq4J+GwNo5aounAFZV69qYJU4w4QiAJ+mkeqtWJf01lxAJMOIAZpjwcUapi5XCMSu+m4l/BRAA45u0o47/L2ApZfNkvnAPwBr3qoFxg5Fl4iCB2hh4fxb0MBwKti/seq8gfGWsHd0mY/pRj4xnNoycYRq9Q4mEDrDm8Q3WSuXRKu4HeAeALQQUGciCaTTcZA7XGqHKaOoC10yjDgNfYMuyVs8gsJUNfg9AJ5ia5jGIpwFkqUQThSZz/JSUz2rFUBXcL+UbwXwhDeALd4r9HQYw/F/Q/OrswMDzxVwWFYtZ8U+Y+DyANyucp1DeYvN2tX4rAO4AsPKlLeMxG+jLKPWb764+euzrTYZRmqjI8nsjYJweSiTulqfJ81DEttsI9CWAvbMWTITNKaWyCz1eyVi/NFP5Qo6BdQCmwKXutOPc8FflslXUsj4AGXqn6wo8CIeCHQtn+xVw1LZPAnTYXRRM+zLO4Hf1QOdsY0L0MUNfFbxWrQdYTAFYwcBYJqm6lwKd84la4ioIXbpy6aQKLzrHemyKZDxxDQifppX6pRFwxLY/J9APWqMQCraclvLfOb15GUdtewNA7ieNAe4eSibHGgFXvtFGwGgfSiRynuBIPL6NSux+L7FBH2YGB683Aq6mNy9jvTDMYvFdDSua5p3K0iwlgGp6frfRUrhVfV4/8AvsSkEuOoaFYAAAAABJRU5ErkJggg=="/></a>
        <div class="dropdown-content">
       
        <div class='text'> 
    <h1 id="pflais">Bem-vindo(a), <?php echo $_SESSION['nome']; ?> ! </h1>
</div>

<section id="linhazinha"></section>
        
        <div class="btn"><p id="pf"><a href="TelaEditar.php">Editar conta</a></p></div>
         <div class="btn"><p id="pf">Sair da conta</a></p></div>
        <div onclick="abrirModal()" class="btn"><p id="pf"><a href="">Excluir conta</a></p></div>


    </div>
</div>
    <section id="link">
    

        <a href="#">Teste Vocacional</a>
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

        <a href="testeVocacional.php">
        <input id="tvbt" type="submit" value="Editar" >
        </a> 
    </section>


    </section>
    <section id="sec2">
    <p>#MAPAESCOLAR</p>
        <h2 id="mp">Mapa da Escola</h2>
        <p>localização dos laboratórios e pontos importantes!!</p>
        <p>deseja ver?</p>

        <input id="mpbt" type="submit" value="Editar">

    </section>
    <section id="sec3">
    <p>#SOBRECURSOS</p>
        <h2 id="sc">Nossos Cursos</h2>
        <p>saiba mais sobre os nossos cursos profissionalizantes ;P</p>
        <p>Reforce seus conhecimentos!</p>
        <a href="TelaCu.html">
        <input id="scbt" type="submit" value="Editar">
        </a> 

    </section>
    <section id="sec4">
        <p>#SOBREESCOLA</p>
        <h2 id="se">Sobre a Escola</h2>
        <p>Saiba mais sobre o Juscelino Kubitschek</p>
        <p>conheça a história</p>

        
        <input id="sebt" type="submit" value="Editar">
 
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