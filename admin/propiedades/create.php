<?php
    require '../../includes/app.php';
    
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;
    
    autenticado();

    # CONSULTA PARA OBTENER LOS VENDEDORES
    $consulta = " SELECT * FROM vendedores ";
    $resultado = mysqli_query($DB,$consulta);

    # ARREGLO CON MENSAJE DE ERRORES
    $errores = Propiedad::getErrores();
    
    $titulo ="";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamientos = "";
    $vendedorId = "";
    
    # EJECUA EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $propiedad = new Propiedad($_POST);

        # Generar un Nombre Unico 
        $nombreImagen = generarNombre($_FILES['imagen']);
  
        # Realiza un resize a la imagen con intervention
        # Setear la Imagen
        if($_FILES['imagen']['tmp_name']){
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);;
        }

        $errores = $propiedad->validar();
    
        # Revisar que el array de errores este vacio
        if(empty($errores)){

            # Crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            
            # Guardar la imagen en el Servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            # Guardar en la Base de Datos
            $resultado = $propiedad->guardar();


            if($resultado){
                // Redireccionar al Usuario
                header('location: /admin?resultado=1');
            }
        }
    }

    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta rojo">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/create.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo de Propiedad:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" name="estacionamientos" placeholder="Ej:3" min="1" max="9" value="<?php echo $estacionamientos; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while( $row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $row["id"] ? "selected" : ""; ?> value="<?php echo $row["id"] ?>" ><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
                    <?php endwhile;?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>