<?php
session_start();
spl_autoload_register(function($class_nome) 
{
    include '../../class/' . $class_nome . '.php';
});

$utente = new Class_Cliente();





$nome  = htmlspecialchars(addslashes($_POST['nome']));
$email  = htmlspecialchars(addslashes($_POST['email']));
$senha  = password_hash(htmlspecialchars(addslashes($_POST['senha'])), PASSWORD_DEFAULT); 
$numero  = htmlspecialchars(addslashes($_POST['numero']));



	





			$utente->setNome($nome);
			$utente->setEmail($email);
            $utente->setSenha($senha);
            $utente->setTelefone($numero);
			

			# Insert
			if($utente->insert()){
				echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Programa%C3%A7ao%20Web/login.php'>
        <script type=\"text/javascript\">
            alert(\"Registado com sucesso.\");
        </script>
        ";
			}else{
                echo "Não inserido!";
            }