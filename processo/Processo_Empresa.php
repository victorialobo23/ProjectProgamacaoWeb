
        <?php
        
        spl_autoload_register(function($class_nome) 
        {
            include '../../class/' . $class_nome . '.php';
        });

$emp = new Class_SobreEmpresa();

$nome  = $_POST['nome'];
$descricao = $_POST['descricao'];
$email = $_POST['email'];
$cont1 = $_POST['cont1'];
$cont2 = $_POST['cont2'];




    $emp->setNome($nome);
    $emp->setDescricao($descricao);
    $emp->setEmail($email);
    $emp->setContacto1($cont1);
    $emp->setContacto2($cont2);

    # Insert
    if($emp->insert()){
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Empresa.php'>
        <script type=\"text/javascript\">
            alert(\"Informação sobre a empresa registado com sucesso.\");
        </script>
        ";
        
      
    }else{
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Registar-Categoria.php'>
        <script type=\"text/javascript\">
            alert(\"Equipe não registado.\");
        </script>
        ";
    }




         
         
      ?>
      
