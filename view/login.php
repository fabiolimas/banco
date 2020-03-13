<?php
session_start();
    include("../model/conta.php");
    $login= new Conta();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../font/css/all.css">
    <title>Login</title>
</head>
<body>
    <div class="interafce">
<div class="cabecalho">
<input type="checkbox" id="check">
			<label for="check" class="btn"><span class='fas fa-bars'></span></label>
    <div class="logo"><h1>Nubanco</h1></div>
    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="novaConta.php">Abrir Conta</a></li>
            
            <li><a href="#">Sobre</a></li>
            
        </ul>
    </div>
</div>
<h2>Login</h2><hr>
<form action="<?php echo $login->fazerLogin();?>" method="post" class="flogin">
   
    CPF:<br>
    <input type="text" name="cpf"><br><br>
    Senha:<br><input type="password" name="senha"><br><br>
    <input type="submit" value="Entrar" class="botao">
</form>
</div>
</body>
</html>