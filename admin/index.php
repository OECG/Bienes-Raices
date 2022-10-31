<?php

    require '../includes/app.php';
    autenticado();
    
    use App\Propiedad;
    
    # Implementar un Método para obtener todas las propiedades 
    $propiedades = Propiedad::all(); 


    // // Escribir el Query
    // $query = "SELECT * FROM propiedades";

    // // Consultar la BD
    // $resultQuery = mysqli_query($DB,$query);

    
    // Muestra un mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        
        if($id){
            // Eliminar el Archivo
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $query_result = mysqli_query($DB,$query);
            $propiedad = mysqli_fetch_assoc($query_result);
            unlink('../Imagenes/' . $propiedad['imagen']);
           
            // Eliminar Propiedad
            $query = "DELETE * FROM propiedades WHERE id = $id";
            $query_result = mysqli_query($DB,$query);

            if($query_result){
                header('location: /admin?resultado=3');  // Redireccionar al Usuario (RECARGAR)
            }
        }

    }
    // Incluye un template
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if( intval($resultado) === 1 ) : ?>
            <p class="alerta verde">Anuncio Creado Correctamente</p>
        <?php endif;?>
        <?php if( intval($resultado) === 2 ) : ?>
            <p class="alerta amarillo">Anuncio Actualizado Correctamente</p>
        <?php endif;?>
        <?php if( intval($resultado) === 3 ) : ?>
            <p class="alerta rojo">Anuncio Eliminado Correctamente</p>
        <?php endif;?>

        <a href="/admin/propiedades/create.php" class="boton-verde">Nueva Propiedad</a>


        <table class="propiedades">
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
                            <input type="submit" class="w-100 boton boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/admin/propiedades/update.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Actualizar</a>
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