

<?php

include("../model/conta.php");
    $novo =new Conta();
    $login=new Conta();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../font/css/all.css">
    <title>Novo Cliente</title>
</head>
<body>
<div class="interface">
<div class="cabecalho">
<input type="checkbox" id="check">
			<label for="check" class="btn"><span class='fas fa-bars'></span></label>
    <div class="logo"><h1>Nubanco</h1></div>
    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="novaConta.php">Abrir Conta</a></li>
            <li><a href="gerenciar.php">Minha Conta</a></li>
            
            <li><a href="#">Sobre</a></li>
            
        </ul>
    </div>
</div>
<li class="formli">

<form method="post" action="<?php echo  $novo->novaConta();?>">
<h2>Abrir Conta</h2><hr>
    
    Nome:<br>
    <input type="text" name="nome" required><br><br>
    CPF:<br>
    <input type="text" name="cpf" required maxlength="11"><br><br>
    Email:<br>
    <input type="email" name="email" required><br><br>
    Senha:<br>
    <input type="password" name="senha" required><br><br>
    
    
    <input type="submit" value="Cadastrar" class="botao">
    
</form></li>
<li class="formli">
<form action="<?php echo $login->fazerLogin();?>" method="post" class="flogin">
<h2>Login</h2><hr>
   
    CPF:<br>
    <input type="text" name="cpf"><br><br>
    Senha:<br><input type="password" name="senha"><br><br>
    <input type="submit" value="Entrar" class="botao">
</form></li>
</div>    
</body>
</html>