<?php 
    require_once './classes/Autoload.php';
    $session = new Session();    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PODCAST</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> 
    <script type="text/javascript" src="./js/control.js"></script>
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                      <span class="sr-only">Desplegar</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><strong>PODCAST</strong></a>
                 </div>
                 <div class="collapse navbar-collapse navbar-ex1-collapse">
                     <?php 
                        if(!$session->isLoggeg()){
                    ?>
                            <form class="navbar-form navbar-right" role="search" method="post" action="php/logIn.php">
                                <div class="form-group">
                                    <input class="form-control" name="login" type="text" placeholder="Usuario">
                                    <input class="btn btn-success" type="submit" name="go" value="Log In">
                                </div>
                            </form>
                    <?php 
                        }else{
                    ?>
                        <br/>
                        <p class="text-success navbar-right">Bienvenido: <?php echo $session->get('user')->getUserName(); ?> <a href="php/logOut.php"> Cerrar sesión</a></p>
                    <?php } ?>
                 </div>
            </div>  
        </nav>
        <div class="container-fluid">
            <div class="col-md-3">
                <h3>Filtrado <small>Por usuario y categoráa</small></h3>
                <form class="form form-vertical" role="search" method="GET"> 
                        <input name="usuario" type="text" class="form-control" placeholder="Usuario">
                        <input name="categoria" type="text" class="form-control" placeholder="Categoria">
                        <input type="submit" class="form-control btn-warning" value="Filtrar" />
                </form>
            <?php if($session->isLoggeg()){ ?>
                <div class="col-md-12">
                    <h3>Sube tu canción</h3>
                    <form class="form-horizontal" name="subida" action="php/subir.php" method="POST" enctype="multipart/form-data">
                        <label class="h4" for="categoria">Categoría</label>
                        <input class="form-control" type="text" name="categoria" required>
                        <label class="h4" for="img">Carátula</label>
                        <input class="" type="file" name="img">
                        <p class="help-block">Debe ser una imagen en jpg</p>
                        <label class="h4" for="cancion">Canción</label>
                        <input class="" type="file" name="cancion">
                        <p class="help-block">Debe ser una canción en mp3</p>
                        <input name="privado" type="checkbox"><span class="h4"> Hacer privada</span> 
                        <hr/>
                        <input class="btn btn-success form-control" type="submit" name="subir" value="Subir canción">
                    </form>
                </div>                
            <?php } ?>
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <h1>Lista de canciones <small>Todas las canciones</small></h1>
                    <hr/>
                    <div class="col-md-8">
                        <?php include_once './inc/tabla_pag.php'; ?>                   
                    </div>
                    <div id="enCurso" class="col-md-4"></div>
                </div>
            </div>
        </div>
    </body>
</html>
