<?php include("../includes/header.php") ?>

    <?php
        $baseDeDatos = new Basemysql();
        $db = $baseDeDatos->connect();

        if(isset($_POST['crearArticulo'])){

            // obtener los valores
            $titulo = $_POST["titulo"];
            $texto = $_POST["texto"];

            if($_FILES["imagen"]["error"] > 0){
                $error = "Error, ningún archivo seleccionado";
            
            }else{
                if(empty($titulo) || empty($texto)){
                    $error = "Error, algunos campos están vacíos";
                }else{
                    $image = $_FILES['imagen']['name'];
                    $imageArr = explode('.', $image);
                    $rand = rand(1000, 99999);

                    // nuevo nombre de la img
                    $imgName = $imageArr[0] .$rand .'.' .$imageArr[1];
                    $rutaFinal = "../img/articulos/" .$imgName;
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal);
                
                    $articulo = new Articulo($db);

                    if($articulo->crear($titulo, $imgName, $texto)){
                        $mensaje = "Artículo creado correctamente";
                        // redirección
                        header(("Location:articulos.php?mensaje=" .urldecode($mensaje)));
                    }


                }
            }
        }
    
    ?>



    <div class="row">
        <div class="col-sm-12">
            <?php if(isset($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?php echo $error; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h3>Crear un Nuevo Artículo</h3>
        </div>            
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresa el título">               
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="apellidos" placeholder="Selecciona una imagen">               
            </div>
            <div class="mb-3">
                <label for="texto">Texto</label>   
                <textarea class="form-control" placeholder="Escriba el texto de su artículo" name="texto" style="height: 200px"></textarea>              
            </div>          
        
            <br />
            <button type="submit" name="crearArticulo" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Crear Nuevo Artículo</button>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       