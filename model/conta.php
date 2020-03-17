<?php

    class Conta{

        private $idConta;
        private $nome;
        private $cpf;
        private $email;
        private $senha;
        private $saldo;


        function getIdConta(){
            return $this->idConta;
        }
        function getNome(){
            return $this->nome;
        }
        function setNome($nome){

            $this->nome=$nome;

        }
      
        function getCpf(){
            return $this->cpf;
        }

        function setCpf($cpf){
            $this->cpf=$cpf;
        }

        function getEmail(){
            return $this->email;
        }
        function setEmail($email){
            $this->email=$email;
        }

         function getSenha(){
            return $this->senha;
        }

        function setSenha($senha){

            $this->senha=$senha;
        }
        function getSaldo(){
            return $this->saldo;
        }

        function setSaldo($saldo){
            if($saldo <0){
                echo "A conta não pode ficar com saldo negativo";
            }else{

                $this->saldo=$saldo;
            }
            
        }

        function deposito(){

            if(empty($_POST['deposito']) == true){

            }else{

                include("control/conexao.php");

                $conta = new Conta();
               $conta->setCpf($_POST['cpf']);
                

                $findSaldo="SELECT * FROM conta where cpf='".$conta->getCpf()."'";
                $findSaldo= $conn->query($findSaldo);

                if($findSaldo){

                    foreach ($findSaldo as $saldoEmConta) {

                        $saldo=$saldoEmConta['saldo'];

                        $conta->setSaldo($saldo);

                        
                        
                    }
                    $conta->getSaldo();
                    $deposito=$_POST['deposito'];
                    $depositado=$conta->getSaldo()+$deposito;
                   

                    $updateSaldo="UPDATE conta SET saldo=$depositado WHERE cpf='".$conta->getCpf()."'";
                    $updateSaldo=$conn->query($updateSaldo);
                    header("Location:gerenciar.php");

                   

           
                }else{
                    echo "nenhum registro encontrado";
                }

            }

            
        }

        //Função Saque---------------------------------------------------------
        function saque(){
            if(empty($_POST['saque']) == true){

            }else{

                include("control/conexao.php");

                $conta = new Conta();
               $conta->setCpf($_POST['cpf']);
                

                $findSaldo="SELECT * FROM conta where cpf='".$conta->getCpf()."'";
                $findSaldo= $conn->query($findSaldo);

                if($findSaldo){

                    foreach ($findSaldo as $saldoEmConta) {

                        $saldo=$saldoEmConta['saldo'];

                        $conta->setSaldo($saldo);

                        echo $conta->getSaldo();
                        
                    }
                    $conta->getSaldo();
                    $saque=$_POST['saque'];
                    $valorSacado=$conta->getSaldo()-$saque;

                    $updateSaldo="update conta set saldo=$valorSacado where cpf='".$conta->getCpf()."'";
                    $updateSaldo=$conn->query($updateSaldo);
                    header("Location:gerenciar.php");

           
                }else{
                    echo "nenhum registro encontrado";
                }

            }
        }

//--------------------------------------Fim Saque-----------------------------------


//Criar nova Conta-------------------------------------------------------------------
            
       function novaConta(){

            if(empty ($_POST['nome']) == true){


            }else{

            include("control/conexao.php");

            $conta = new Conta();


            $conta->setNome($_POST['nome']);
            $conta->setCpf($_POST['cpf']);
            $conta->setEmail($_POST['email']);
            $conta->setSenha(md5($_POST['senha']));

            $validarCadastro="SELECT * FROM conta WHERE cpf='".$conta->getCpf()."'";
            $validarCadastro=$conn->query($validarCadastro)->fetchAll();

            $resultados= count($validarCadastro);

            echo $resultados;

            if($resultados >0){
                echo "Você possui um cadastro em nosso sistema, faça login";
            }else{




            


           

           try {
               
            $persist= "INSERT INTO conta (id_conta, cliente, cpf, email, senha) VALUES (NULL, '".$conta->getNome()."', '".$conta->getCpf()."', '".$conta->getEmail()."', '".$conta->getSenha()."')";
            $persist=$conn->query($persist);

        

            
                echo "<h2>Dados do Cliente</h2>";           
                echo "Nome: ".$conta->getNome()."<br>";
                echo "CPF: ".$conta->getCpf()."<br>";
                echo "E-mail: ".$conta->getEmail()."<br>";
                
               
           } catch (PDOException $e) {
               echo "Erro: ".$e->getMessage();
           }
        }
            
        }
    
 
    }


    //Fazer Login---------------------------------------------------------------------
    function fazerLogin(){

        if(empty($_POST['cpf']) == true){

        }else{
            session_start();

            include("control/conexao.php");

            $conta = new Conta();

            $conta->setCpf($_POST['cpf']);
            $conta->setSenha(md5($_POST['senha']));

            $find="SELECT * FROM conta where cpf='".$conta->getCpf()."' and senha='".$conta->getSenha()."'";
            $find=$conn -> query($find) -> fetchAll();

            $resultados=count($find);
            
            if($resultados == 1){

                foreach ($find as $correntista) {
                    
                    $conta->setNome($correntista['cliente']);
                    $conta->setSaldo($correntista['saldo']);
                    $conta->setCpf($correntista['cpf']);
                    $_SESSION['nome']=$conta->getNome();
                    $_SESSION['saldo']=$conta->getSaldo();
                    $_SESSION['cpf']=$conta->getCpf();

                    header("Location:gerenciar.php");
                }
                
            }else{
                header("Location:novaConta.php");
            }


        }

    }
    

    }


?>