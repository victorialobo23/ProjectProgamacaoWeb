<?php 
  require_once 'class/config.php';
    session_start();

    if(!isset($_SESSION['itens'])){
        $_SESSION['itens'] = array();
    }


    if(isset($_GET['id']) && $_GET['id'] == 'carrinho'){

        /**ADICIONANDO PRODUTO AO CARRINHO */
        $idGelado = $_GET['add'];

        if(!isset($_SESSION['itens'][$idGelado])){
            $_SESSION['itens'][$idGelado] = 1;
        }else{
            $_SESSION['itens'][$idGelado] += 1;
        }
    } 

   



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GELADINOS - Gelados Saborosos</title>
    <meta content="width=device-width, initial-scale=1.0" nome="viewport">
    <meta content="Free HTML Templates" nome="keywords">
    <meta content="Free HTML Templates" nome="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="">Perguntas</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="">Ajuda</a>
                        <span class="text-white">|</span>
                        <a class="text-white pl-3" href="">Suporte</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


   <!-- Navbar Start -->
   <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>GELADINOS</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="sobre.php" class="nav-item nav-link">Sobre</a>
                        <a href="produto.php" class="nav-item nav-link">Produto</a>
                    </div>
                    <a href="index.html" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>GELADINOS</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="servico.php" class="nav-item nav-link">Serviço</a>
                        <a href="galeria.php" class="nav-item nav-link">Galeria</a>
                        <a href="contacto.php" class="nav-item nav-link">Contacto</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Contacto</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Contacto</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative text-center mb-5">Meus pedidos </h1>
                </div>
            </div>
            <div class="row justify-content-center">
            <?php
         /**EBXIBINDO O PRODUTO AO CARRINHO */
    if(count($_SESSION['itens']) == 0){
        echo 'Vazio';
    }else{
        $_SESSION['produto'] = array();
        $instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        foreach($_SESSION['itens'] as $idGelado => $qtd){
            $select = $instance->prepare("SELECT * FROM gelado WHERE idGelado =?");
            $select->bindParam(1,$idGelado);
            $select->execute();
            $mostrar=$select->fetchAll();
            $total = $qtd * $mostrar[0]["preco"];
            echo '<img src="admin/imagem/'.$mostrar[0]["foto"].'" alt="" alt="" style="width: 100px;height: 50;">';
            echo 'Nome '.$mostrar[0]["nome"].'</br></hr>';
            echo 'Preço '.$mostrar[0]["preco"].'</br></hr>';
            echo 'Quantidade '.$qtd.'</br>';
            echo 'Total '.$total.'</br>';
            echo '<a href="remover.php?remover=carrinho&id='.$idGelado.'">Eliminar</a>';

            array_push($_SESSION['produto'], 
                array('nome' => $mostrar[0]["nome"],
                    'qtd' => $qtd,
                    'preco' => $mostrar[0]["preco"],
                    'total' => $total 
                )
        
        
           );
           
        }

       
    }

    ?>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index.html" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary">i</span>GELADINOS</h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-secondary btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        <div class="col-sm-6 text-center text-sm-right border-right mb-3 mb-sm-0">
                            <h5 class="font-weight-bold mb-2">Entre em Contacto</h5>
                            <p class="mb-2">Rua 5, Maianga, LUANDA</p>
                            <p class="mb-0">+244995185125</p>
                        </div>
                        <div class="col-sm-6 text-center text-sm-left">
                            <h5 class="font-weight-bold mb-2">Horario</h5>
                            <p class="mb-2">Seg – Sab, 8AM – 7PM</p>
                            <p class="mb-0">Dom: Fechado</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0">&copy; <a href="#">Domain</a>. All Rights Reserved. Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary px-2 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>