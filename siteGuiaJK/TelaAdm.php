<?php
session_start();
include_once("conexao.php");

// Email e senha predefinidos
$email_predefinido = "admofc@gmail.com";
$senha_predefinida = "25102005";

if (isset($_POST["submit"]) && !empty($_POST["email"]) && !empty($_POST["senha"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verificar se o email e senha inseridos são os predefinidos
    if ($email == $email_predefinido && $senha == $senha_predefinida) {
        $_SESSION['id'] = 1; // ID do usuário administrador
        $_SESSION['nome'] = "Administrador";
        header("Location: TelaAdmLOG.php");
        exit;
    } else {
        // Preparar consulta SQL com parâmetros
        $sql = "SELECT * FROM usuario WHERE email = ? and senha = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: TelaAdmLOG.php");
            exit;
        } else {
            echo "Email ou senha incorretos!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/loginAdm.css">

    <title>ADM</title>
</head>
<body>
    <form action="TelaAdm.php" method="post">
    
        <h1>ADM</h1>
        <label for="email"></label><br>
        <input type="text" name="email" placeholder="Insira o seu E-mail"><img id="imgEmail" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAfhJREFUSEvtlrtrFUEUxn9fUFMqBAsRH/+ASBoRGxvtfIAIImihjQRCEGxMLDRo0EJQtEgXEAURRPDRaWGnYJFCLENCIFiIhTbiAz/34GzYu9ybvY/l3iZTDTsz3++cb87sjBhQ04C4rIP75nyD1bYvAJeB3TVHsARclzSX666CbR8E3tYMLMvtk/QhPhbBU8BMmjldcwBXk96kpFtl8DUgn3BW0qM64LbPAA/zhCQFpyHjIjjGZoGLkn51E4DtTcBdYKywfrodcMyfB45KWukEbns78BIYLa2rBIfNYVG0r8BpSa/bgds+DDwGRtL8olZTcOzvf/8l2Z4AbmcFtxH4m/Z/JoaaBWA7CvVKtjwKcyjr/wYuSbpvO19TDQ5x2/uBF8DWBHsDnJT0rQi3vRl4ChxK3z8DJyS9TzprgleLKzLOhW1vA54BEUS0ZeCIpI9JdA/wCtiZxgN2TNKXgkbn4CS+AbgDjCexn1kA51M//kbDqX8v2fun5Eh34ELkp4AHBVA+9AM4J+lJi/3vDZyy35sdk+fArgRZyI7dcUmfWlV9VXE13eMWGWwBwtao9glJ39c6arWB2znPte5xp8Ceq7pbYLvgflyLU5JuRkD9fggckPSuAZyOSlxhk8COXu0trV8EbjR9+tQMqpRbf1dXWlTXhIFZ/Q90J+gf8FHAbQAAAABJRU5ErkJggg=="/><br>
        <label for="password"></label><br>
        <input type="password" name="senha" placeholder="Insira sua Senha"> 
        <img id="imgSenha" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAfdJREFUSEvtlkFr1FAUhc9JpmPSgSmTl1QRFFEQt1bdKdRF3dUfIIJbcaHQhaC4EroUdSUuRfoDBEEEQWldFoo7FwoKhZZJXuyibYI1uZqhhUHTyZuO0EUnu8c793z33vdyE2KfHu4TF32DRaS2qfVZ27LOFUlnWbY46vtLJLN+ijAGiwhTre8JeZfAWDeEwI8ceDiq1BNTuDE4iaKXIK/3Mv6T0GNHqRkTuBE4ieNrEJnbNvwuIjO/6vX5Yl3b2pok8AjA8WJNkSnH999Vwc3AWn8FcLJo6c+RkdPNZjPqNl5vt4/Ytv0FQAPAR1epSwOD07W1U5JlhSkg8sD1/dky0ySOZyFyH0DuZNkYx8fXK46ld26bcXyRIgudNpLTjue9LotIw/CqWNarYi/P8wuNIFgcCJyE4SQs633HJM8vu0HwobRiQ91ObOUZHxzwRhhO0LavUOQMgBvbLXoB4NsuZ3eiWyfkZyHfNlqtpTJ9aatTre8IYDyFel4i8qbjec//1pSCkyhqgwyq3kXD/WVXqWNmYK3F0NRI5ir1T4HlFQ/BRg3dXTRsdWful87d4eU6CJdrFcDhAQvdCV9xlTpqNDLTKLot5NP/ASZ5y/G8Z0bgQrQRhuctcgrkob0kIGRaI9/UW61Pxp/FvYD6jan89enX0FT/GwfD2h9sTumdAAAAAElFTkSuQmCC"/>
        <br>
        <br>
        <input type="submit" name="submit" value="Login">

        

    
    </form>
</body>
</html>


