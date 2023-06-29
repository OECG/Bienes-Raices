<?php

    require '../includes/app.php';
    autenticado();
    
    use App\Propiedad;
    use App\Vendedores;

    # Implementar un Método para obtener todas las propiedades 
    $propiedades = Propiedad::findAll(); 

    # Implementar un Método para obtener todas los vendedores
    $vendedores = Vendedores::findAll(); 
    
    // Muestra un mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        
        if($id){
            $type = $_POST['tipo'];
            
            
            if(validarTipoContenido($type)){
                if($type === 'propiedad'){
                    $propiedad = Propiedad::findByPk($id);
                    $propiedad->eliminar();            
                }else if($type === 'vendedor'){
                    $vendedores = Vendedores::findByPk($id);
                    $vendedores->eliminar();            
                }
            }
        }
    }
    // Incluye un template
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php
            $response = mostrarNotificaciones( intval($resultado) );
            if($resultado){
        ?>
            <p class="alerta <?=$response['color']?>"><?= s($response['mensaje']) ?></p>
        <?php }?>

        <a href="/admin/propiedades/create.php" class="boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/create.php" class="boton-amarillo">Nuevo(a) Vendedor(a)</a>

        <h2>Propiedades</h2>
        <table class="form-propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img loading="lazy" width="200" height="300" src="/Imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="<?php echo $propiedad->titulo; ?>"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id;?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="w-100 boton boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/admin/propiedades/update.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>      
                <?php endforeach;?>
            </tbody>

        </table>
        
        <h2>Vendedores</h2>
        <table class="form-vendedores">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id;?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="w-100 boton boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/admin/vendedores/update.php?id=<?php echo $vendedor->id; ?>" class="boton boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>      
                <?php endforeach;?>
            </tbody>

        </table>
    </main>

<?php 
    // Cerrar la conexion 
    mysqli_close($DB);

    incluirTemplate('footer'); 
?>