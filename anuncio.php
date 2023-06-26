<?php  

    // Validar URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header("location: /");
    }

    require 'includes/app.php';

    // Conectar a la Base de Datos
    $DB = conectarDB();

    // Consulta
    $query = "SELECT * FROM propiedades WHERE id = $id";
    $resultado = mysqli_query($DB,$query);   // Obtener el resultado
    if(!$resultado->num_rows){
        header("location: /");
    }
    $propiedad = mysqli_fetch_assoc($resultado);


    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamientos = $propiedad['estacionamientos'];;
    $vendedorId = $propiedad['vendedor_id'];
    $imagenPropiedad = $propiedad['imagen'];



    incluirTemplate('header'); 
?>


    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $titulo; ?></h1>
        
        <picture>
            <img loading="lazy" width="200" height="300" src="/Imagenes/<?php echo $imagenPropiedad; ?>" alt="Anuncio">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $precio; ?></p>
            <ul class="iconos-caracteristicas izquierda">
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_wc.svg" alt="icono wc" title="Baños">
                    <p><?php echo $wc; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" title="Estacionamientos">
                    <p><?php echo $estacionamientos; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" title="Dormitorios">
                    <p><?php echo $habitaciones; ?></p>
                </li>
            </ul>
            <p><?php echo $descripcion; ?></p>
        </div>
    </main>


<?php 
    mysqli_close($DB);
    incluirTemplate('footer'); 
?>