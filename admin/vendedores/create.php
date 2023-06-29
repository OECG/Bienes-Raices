<?php
    require '../../includes/app.php';
    
    use App\Vendedores;
    
    autenticado();
    
    $vendedor = new Vendedores();

    $errores = Vendedores::getErrores();
       
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $vendedor = new Vendedores($_POST['vendedor']);
        
        $errores = $vendedor->validar();

        if(empty($errores)){
            $vendedor->guardar();
        }
    }

    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta rojo">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/vendedores/create.php">
            
            <?php include '../../includes/templates/formularios_vendedores.php'; ?>

            <input type="submit" value="Registrar Vendedor(a)" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>