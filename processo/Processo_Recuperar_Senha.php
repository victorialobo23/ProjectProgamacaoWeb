<?php
spl_autoload_register(function($class_nome) {
    include '../../class/' . $class_nome . '.php';
});

$admin = new Class_Admin();

$email = htmlspecialchars(addslashes($_POST['email']));
$dica = htmlspecialchars(addslashes($_POST['dica']));







			
		
           

			# Insert
            if($admin->verificarDica($email, $dica))
            {
                  
				
            }
                