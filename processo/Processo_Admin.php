<?php
session_start();
spl_autoload_register(function($class_nome) 
{
    include '../../class/' . $class_nome . '.php';
});

$utente = new Class_Admin();

if(empty($_POST['nome'])){
    $_SESSION['vazio_nome_Se'] = "Campo nome é obrigatório";
    $url = 'http://localhost/gelado/admin/Registar-Admin.php';
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    ";
    die();
}else{
    $_SESSION['value_nome_Se'] = $_POST['nome'];
}

if(empty($_POST['email'])){
    $_SESSION['vazio_email_Se'] = "Campo email é obrigatório";
    $url = 'http://localhost/gelado/admin/Registar-Admin.php';
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    ";
}else{
    $_SESSION['value_email_Se'] = $_POST['email'];
}

if(empty($_POST['senha'])){
    $_SESSION['vazio_senha_Se'] = "Campo senha é obrigatório";
    $url = 'http://localhost/gelado/admin/Registar-Admin.php';
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    ";
}else{
    $_SESSION['value_senha_Se'] = $_POST['senha'];
}

if(empty($_POST['dica'])){
    $_SESSION['vazio_dica_Se'] = "Campo dica é obrigatório";
    $url = 'http://localhost/gelado/admin/Registar-Admin.php';
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    ";
}else{
    $_SESSION['value_dica_Se'] = $_POST['dica'];
}



$nome  = htmlspecialchars(addslashes($_POST['nome']));
$email  = htmlspecialchars(addslashes($_POST['email']));
$senha  = password_hash(htmlspecialchars(addslashes($_POST['senha'])), PASSWORD_DEFAULT); 



	





			$utente->setNome($nome);
			$utente->setEmail($email);
            $utente->setSenha($senha);
			

			# Insert
			if($utente->insert()){
				echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/gelado/admin/Registar-Admin.php'>
        <script type=\"text/javascript\">
            alert(\"Registado com sucesso.\");
        </script>
        ";
			}else{
                echo "Não inserido!";
            }