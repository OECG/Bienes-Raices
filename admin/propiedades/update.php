<?php
    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedores;
    use Intervention\Image\ImageManagerStatic as Image;

    autenticado();
    
    // Validar URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header("location: /admin");
    }

    // Consultar los datos de la propiedad
    $propiedad = Propiedad::findByPk($id);
    
    // CONSULTA PARA OBTENER LOS VENDEDORES
    $vendedores = Vendedores::findAll();
        
    // ARREGLO CON MENSAJE DE ERRORES
    $errores = Propiedad::getErrores();

    // EJECUA EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        if($_FILES['propiedad']['tmp_name']['imagen']){
            # Generar un Nombre Unico 
            $nombreImagen = generarNombre($_FILES['propiedad']['name']);
            # Realiza un resize a la imagen con intervention
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            # Setear la Imagen
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();
        
        // Revisar que el array de errores este vacio
        if(empty($errores)){

            if($_FILES['propiedad']['tmp_name']['imagen']){
                # Guardar la imagen en el Servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            
           $propiedad->guardar();
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
            <?php include '../../includes/templates/formularios_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>