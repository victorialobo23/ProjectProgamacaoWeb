<?php
        
        spl_autoload_register(function($class_nome) 
        {
            include '../../class/' . $class_nome . '.php';
        });

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$cat = new Class_Depoimento();
$nome  = htmlspecialchars(addslashes($_POST['nome']));
$descricao = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", addslashes($_POST['descricao']));

//Verificar imagem antes de alterar
$resultado = $cat->find($id);

if (empty($_FILES['arquivo']['name'])) {

    $cat->setNome($nome);
        $cat->setDescricao($descricao);
        $cat->setFoto($resultado->foto);
    
        # Insert
        if($cat->update($id)){
            echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Depoimento.php'>
            <script type=\"text/javascript\">
                alert(\"Depoimento editado com sucesso.\");
            </script>
            ";
            
          
        }else{
            echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Depoimento.php'>
            <script type=\"text/javascript\">
                alert(\"Depoimento não editado.\");
            </script>
            ";
        }

}else{

    if (unlink("../imagem/$resultado->foto")) {
        
        
        $_UP['pasta'] = '../imagem/';
        
        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
        
        // Array com as extensões permitidas
        $_UP['extensoes'] = array('jpg', 'png', 'PNG');
        
        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = false;
        
        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
        
        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
        die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
        exit; // Para a execução do script
        }
        
        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
        
        // Faz a verificação da extensão do arquivo
        $file_extension = explode('.', $_FILES['arquivo']['name']);
        $extensao = end($file_extension);
        
        
        if (array_search($extensao, $_UP['extensoes']) === false) {
        
        echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Depoimento.php'>
                <script type=\"text/javascript\">
                    alert(\"Por favor, envie arquivos com as seguintes extensões: jpg, png ou jpeg.\");
                </script>
                ";
        }
        
        // Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
        
        echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Depoimento.php'>
                <script type=\"text/javascript\">
                    alert(\"O arquivo enviado é muito grande, envie arquivos de até 2Mb.\");
                </script>
                ";
        }
        
        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
        else {
        // Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
        // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
        $nome_final = time().'.jpg';
        } else {
        // Mantém o nome original do arquivo
        $nome_final = $_FILES['arquivo']['name'];
        
        }
        
        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            $cat->setNome($nome);
            $cat->setDescricao($descricao);
            $cat->setFoto($nome_final);
        
            # Insert
            if($cat->update($id)){
                echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Depoimento.php'>
                <script type=\"text/javascript\">
                    alert(\"Depoimento editado com sucesso.\");
                </script>
                ";
                
            
            }else{
                echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/fotografo/admin/Listar_Depoimento.php'>
                <script type=\"text/javascript\">
                    alert(\"Depoimento não editado.\");
                </script>
                ";
            }
        } else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
        }
    }

    }

}





?>