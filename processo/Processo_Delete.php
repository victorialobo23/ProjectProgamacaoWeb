<?php
session_start();
spl_autoload_register(function($class_nome) 
{
    include '../../class/' . $class_nome . '.php';
});


$idBlog = new Class_Gelado();
$idBl = filter_input(INPUT_GET, 'idBl', FILTER_SANITIZE_NUMBER_INT);
/**Delete Depoimento*/
//Verificar imagem antes de alterar
$resultado = $idBlog->find($idBl);


if(isset($idBl)){
    if (unlink("../imagem/$resultado->foto")) {
        if($idBlog->delete($idBl)){
            $_SESSION['msg'] = "<p style='color:green;'>Gelado deletado com sucesso</p>";
            header("Location: http://localhost/gelado/admin/Listar_Gelado.php");
        
        
        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Produto deletado não deletado</p>";
            header("Location: http://localhost/gelado/admin/Listar_Gelado.php");
        }

}
} 











$idAdmin = new Class_Admin();
$idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_NUMBER_INT);
/**Delete Mensagem*/



if(isset($idAd)){
   
   
        if($idAdmin->delete($idAd)){
            $_SESSION['msg'] = "<p style='color:green;'>Mensagem deletado com sucesso</p>";
            header("Location: http://localhost/gelado/admin/Registar-Admin.php");
        
        
        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Mensagem deletado não deletado</p>";
            header("Location: http://localhost/gelado/admin/Registar-Admin.php");
        }

      

}














?>