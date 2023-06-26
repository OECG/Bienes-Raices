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
            
            <?php include '../../includes/templates/formularios_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>