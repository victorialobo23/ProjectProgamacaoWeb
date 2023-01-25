<?php
spl_autoload_register(function($class_nome) 
{
    include '../../class/' . $class_nome . '.php';
});

$utente = new Class_Admin();

$senha  = addslashes($_POST['senha']);
$email = addslashes($_POST['email']);


     
			# login
			if($utente->login($senha,$email))
            {
	        	header("Location: ../inicio.php");
			}