
        <?php
        
        spl_autoload_register(function($class_nome) 
        {
            include '../../class/' . $class_nome . '.php';
        });

$cat = new Class_Foto();
session_start();
if(empty($_POST['nome'])){
    $_SESSION['vazio_nome_Fo'] = "Campo nome é obrigatório";
    $url = 'http://localhost/fotografo/admin/Registar-Foto.php';
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    ";
}else{
    $_SESSION['value_nome_Fo'] = $_POST['nome'];
}




if(empty($_FILES['arquivo']['name'])){
    $_SESSION['vazio_arquivo_Fo'] = "campo foto é obrigatório";
    $url = 'http://localhost/fotografo/admin/Registar-Foto.php';
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    ";
}else{
    $_SESSION['value_arquivo_Li'] = $_FILES['arquivo']['name'];
}

$nome  = htmlspecialchars(addslashes($_POST['nome']));
$categoria  = htmlspecialchars(addslashes($_POST['categoria']));
$fotocont = count($_FILES['arquivo']['name']);

for ($i=0; $i< $fotocont; $i++) {
  $foto = $_FILES['arquivo']['name'][$i];
  $fotoTm = $_FILES['arquivo']['tmp_name'][$i];
  $pasta = '../imagem/'.$foto;
  if (move_uploaded_file($fotoTm, $pasta)) {
    $cat->setNome($nome);
    $cat->setCategoria($categoria);
    $cat->setFoto($foto);

    # Insert
    if($cat->insert()){
       echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Foto.php'>
        <script type=\"text/javascript\">
            alert(\Foto registado com sucesso.\");
        </script>
        ";
      
    }else{
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Registar-Foto.php'>
        <script type=\"text/javascript\">
            alert(\Foto não registado.\");
        </script>
        ";
        echo "erro";
    }
  }
 

}



         
         
      ?>
      
