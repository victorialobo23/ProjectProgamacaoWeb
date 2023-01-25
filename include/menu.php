<?php 
session_start();



    if(isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])){
       
        $adm  = $_SESSION["usuario"][1];
        $nome = $_SESSION["usuario"][0];
    }else{
        echo "<script>window.location = 'index.php'</script>";
    }

?>

<!DOCTYPE html>
<!-- Created By Fotografia - www.Fotografiaweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/gelado/admin/">
    <title>derivery</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../node_modules\bootstrap\scss\compiler\style.css">
    <link rel="stylesheet" type="text/css" href="../https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-cat.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});</script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Move', 'Percentage'],
    <?php foreach ($venda->listar() as $key => $value){
         echo "['" .$value->produto."', " .$value->qtd."],";
         
        }?>
        ]);

        var options = {
          width: 500,
          legend: { position: 'none' },
          chart: {
            title: 'Chess opening moves',
            subtitle: 'popularity by percentage' },
          axes: {
            x: {
              0: { side: 'top', label: 'White to move'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
  <style>
        #desc{
            display: none;
        }
    </style>


 
</head>
<body>
  <nav>
    <div class="wrapper">
      <div class="logo"><a href="#">Gelado</a></div>
      <input type="radio" name="slider" id="menu-btn">
      <input type="radio" name="slider" id="close-btn">
      <ul class="nav-links">
        <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
        <li><a href="#">Inicio</a></li>
       
        <li>
          <a href="#" class="desktop-item">Gerir Empresa</a>
          <input type="checkbox" id="showMega">
          <label for="showMega" class="mobile-item">Gerir Empresa</label>
          <div class="mega-box">
            <div class="content">
              <div class="row">
              <img src="imagem/pote.jpg" alt="">
              </div>
              <div class="row">
                <header>Empresa e Serviço</header>
                <ul class="mega-links">
                  <li><a href="Listar_Empresa.php">Sobre Empresa</a></li>
                  <li><a href="Listar_Parceiro.php">Visualizar Cliente</a></li>
                </ul>
              </div>
            
             <div class="row">
                <header>Administrador</header>
                <ul class="mega-links">
                  <li><a href="Registar-Admin.php">Gerir Administrador</a></li>
                  
                </ul>
              </div>
            </div>
          </div>
        </li>


       

        <li>
          <a href="#" class="desktop-item">Gerir Artigos</a>
          <input type="checkbox" id="showMega">
          <label for="showMega" class="mobile-item">Gerir Artigos</label>
          <div class="mega-box">
            <div class="content">
              <div class="row">
              <img src="imagem/pote.jpg" alt="">
              </div>
              <div class="row">
                <header> Produto e Galeria</header>
                <ul class="mega-links">
                  <li><a href="Registar-Gelado.php">Registar Gelado</a></li>
                  <li><a href="Listar_Gelado.php">Visualizar Gelado</a></li>
                </ul>
              </div>
             
              
            </div>
          </div>
        </li>
        <li><a href="Listar_Mensagem.php">Mensagem</a></li>
        <li><a href="sair.php">Sair</a></li>
      </ul>
      <label for="Listar_menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
    </div>
  </nav>