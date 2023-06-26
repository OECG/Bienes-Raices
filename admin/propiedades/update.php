<?php 

    require '../../includes/app.php';


    autenticado();
    

    // Validar URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header("location: /admin");
    }


    // BASE DE DATOS    
    $DB = conectarDB();

    // Consultar los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = {$id}";
    $resultado = mysqli_query($DB,$consulta);
    $propiedad = mysqli_fetch_assoc($resultado);
    if(!$resultado->num_rows){
        header("location: /");
    }

    // CONSULTA PARA OBTENER LOS VENDEDORES
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($DB,$consulta);


    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamientos = $propiedad['estacionamientos'];;
    $vendedorId = $propiedad['vendedor_id'];
    $imagenPropiedad = $propiedad['imagen'];
    
    // ARREGLO CON MENSAJE DE ERRORES
    $errores = [];

    // EJECUA EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // echo'<pre>';
        // var_dump($_POST);
        // echo'</pre>';
        // echo'<pre>';
        // var_dump($_FILES);
        // echo'</pre>';
   
        $titulo = mysqli_real_escape_string( $DB , $_POST["titulo"] );
        $precio = mysqli_real_escape_string( $DB , $_POST["precio"] );
        $descripcion = mysqli_real_escape_string( $DB , $_POST["descripcion"] );
        $habitaciones = mysqli_real_escape_string( $DB , $_POST["habitaciones"] );
        $wc = mysqli_real_escape_string( $DB , $_POST["wc"] );
        $estacionamientos = mysqli_real_escape_string( $DB , $_POST["estacionamientos"] );
        $creado = date('Y/m/d');
        $vendedorId = mysqli_real_escape_string( $DB , $_POST["vendedorId"] );

        // Asignar FILE a una Variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = "Debes añadir un título";
        }
        if(!$precio){
            $errores[] = "El Precio es Obligatorio";
        }
        if( strlen($descripcion) < 50){
            $errores[] = "La descripciín debe tener al menos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "El Número de Habitaciones es Obligatorio";
        }
        if(!$wc){
            $errores[] = "El Número de Baños es Obligatorio";
        }
        if(!$estacionamientos){
            $errores[] = "El Número de lugares de Estacionamiento es Obligatorio";
        }
        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        // Validar por tamaño (máximo 10Mb)
        $medida = 1000 * 10000;
        if($imagen['size'] > $medida){
            $errores[] = "La imagen no puede exceder los 10Mb";
        }
    
        // Revisar que el array de errores este vacio
        if(empty($errores)){

            /** SUBIDA DE ARCHIVOS **/

            // Crear carpetas
            $carpetaImagenes = "../../Imagenes/";

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';
            

            if($imagen['name']){ // Si existe un ingreso
   
                unlink($carpetaImagenes . $propiedad['imagen']);  // Eliminar archivo previo
                $imgParts = explode('.', $imagen['name']);        // Extraer la extension     
                $extension = "." . end($imgParts);
                $nombreImagen = md5( uniqid( rand(), true)) . $extension;   // Generar Nombre Unico
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen); // Subir Imagen
            
            }else{
                $nombreImagen = $propiedad['imagen'];
            }  

            // Insertar en la Base de Datos
            $query = "UPDATE propiedades SET titulo='$titulo', precio='$precio', imagen = '$nombreImagen', descripcion='$descripcion', habitaciones = $habitaciones , wc = $wc, estacionamientos = $estacionamientos, vendedor_Id = $vendedorId WHERE id = $id";        

            $query_result = mysqli_query($DB,$query);

            if($query_result){
                header('location: /admin?resultado=2');  // Redireccionar al Usuario
            }
        }
    }

    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta rojo">
           <?php echo $error;?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo de Propiedad:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg">

                <img loading="lazy" width="200" height="300" class="imagen-update" src="/Imagenes/<?php echo $imagenPropiedad; ?>" alt="<?php echo $titulo; ?>">

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

            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>