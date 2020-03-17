<?php
session_start();

if(empty($_SESSION['nome']) == true){
    header("Location:novaConta.php");
    exit();
}else{

    include("model/conta.php");
    include("control/conexao.php");
    $novo =new Conta();
    $findUsuario="SELECT * FROM conta WHERE cpf='".$_SESSION['cpf']."'";
    $findUsuario=$conn->query($findUsuario);
    
    foreach ($findUsuario as $dados) {
        
        $saldo=$dados['saldo'];
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="font/css/all.css">
    <title>Gerenciar</title>
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
            <li><a href="logout.php">Sair</a></li>
            
        </ul>
    </div>
</div>
<div class="dados">
<?php
    echo "<li>Seja bem vindo <b>".$_SESSION['nome']."</b></li>";
   
?>

<?php  echo "<li>Saldo em conta: <b>R$ ".number_format($saldo,2, ',','.')."</b></li>";}?>

</div>
<button class="botaoacao" id="depositar" onclick="ativaDeposito()">Depositar</button>
<button class="botaoacao" id="sacar" onclick="ativaSaque()">Sacar</button>

<form action="<?php echo $novo->deposito()?>" method="POST" class="formM1">
    <span class="fechar" onclick="document.location.reload(true)">X</span>
    <input type="hidden" name ='cpf' value="<?php echo $_SESSION['cpf']?>">
    <span>Valor do deposito:</span> <input type="number" name="deposito" min="0" id="deposito">
    <input type="submit" value="Confirmar" class="botao">

</form>
<form action="<?php echo $novo->saque()?>" method="post" class="formM2">
<span class="fechar" onclick="document.location.reload(true)">X</span>
    <input type="hidden" name ='cpf' value="<?php echo $_SESSION['cpf']?>">
    <span>Valor do Saque:</span> <input type="number" name="saque" min="0" id="saque">
    <input type="submit" value="Confirmar" class="botao">

</form>

</div>
    <script>

        var deposito=document.querySelector("#depositar");
        var formDeposito=document.querySelector(".formM1");
        var formSaque=document.querySelector(".formM2");
        var interface=document.querySelector("body");
        function ativaDeposito(){

            formDeposito.style.display="block";
            var bg=document.createElement("div");
            var id=document.createAttribute("id");
            var nomeid=document.createTextNode("divgerada");
           
           bg.style.background="#000000ad";
           bg.style.width="100%";
           bg.style.height="100%";
           bg.style.position="absolute";
           bg.style.zIndex="1";
           bg.style.top="0";

           
           
           
            interface.appendChild(bg);
            
            
        }
        function ativaSaque(){

formSaque.style.display="block";
var bg=document.createElement("div");
var id=document.createAttribute("id");
var nomeid=document.createTextNode("divgerada");
var conteudo=document.createTextNode("Olá nova div");
bg.style.background="#000000ad";
bg.style.width="100%";
bg.style.height="100%";
bg.style.position="absolute";
bg.style.zIndex="1";
bg.style.top="0";



bg.appendChild(conteudo);
interface.appendChild(bg);


}

    </script>
</body>
</html>