<?php
    session_start();
    include_once 'pages/function.php';


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tours</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php connect() ?>
        <div class="row">
            <header class="col-md-12"></header>
        </div>
        <div class="row">
            <nav class="col-md-12">
                <?php include_once 'pages/menu.php'?>
            </nav>
        </div>
        <div class="row">
            <section class="col-md-12">
                <?php
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                    if($page==1){
                        include_once 'pages/tours.php';
                    }
                    else if($page==2){
                        include_once 'pages/comments.php';
                    }
                    else if($page==3){
                        include_once 'pages/registration.php';
                    }
                    else if($page==4){
                        include_once 'pages/admin.php';
                    }
                    else{
                        include_once 'pages/error404.php';
                    }
                }
                else{
                    include_once 'pages/tours.php';
                }
                ?>
            </section>
        </div>
        <div class="row">
            <footer>Alina, Step &copy; 2019</footer>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
