<?php
spl_autoload_register(function($class_nome) 
{
    include '../../class/' . $class_nome . '.php';
});

$utente = new Class_Cliente();

$senha  = addslashes($_POST['senha']);
$email = addslashes($_POST['email']);


     
			# login
			if($utente->login($senha,$email))
            {
	        	echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/gelado/admin/inicio.php'>
        <script type=\"text/javascript\">
            alert(\"Logado com sucesso.\");
        </script>
        ";
			}