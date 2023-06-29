<?php
    require '../../includes/app.php';
    
    use App\Vendedores;
    
    autenticado();

    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    //debuguear('test');
    if(!$id){
        header("location: /admin");
    }

    $vendedor = Vendedores::findByPk($id);

    $errores = Vendedores::getErrores();
       
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $args = $_POST['vendedor'];

        $vendedor->sincronizar($args);

        $errores = $vendedor->validar();

        //debuguear('test');
        if(empty($errores)){
            $vendedor->guardar();
        }
    }

    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta rojo">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            
            <?php include '../../includes/templates/formularios_vendedores.php'; ?>

            <input type="submit" value="Guardar Cambios" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>