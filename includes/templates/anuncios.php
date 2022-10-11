<?php

    // Conectar a la base de datos  
    $DB = conectarDB();          # Ya no reuiere importar la BD, app.php 

    // Consultar
    $query = "SELECT * FROM propiedades LIMIT $limit";

    // Obtener un resultado
    $resultQuery = mysqli_query($DB,$query);


?>

<div class="contenedor-anuncios">
    <?php while($anuncio = mysqli_fetch_assoc($resultQuery)): ?>
             
    <div class="anuncio">
        <picture>
            <!-- <source srcset="build/img/anuncio3.webp" type="image/webp"> -->
            <img loading="lazy" width="300" height="200" src="/Imagenes/<?php echo $anuncio['imagen']; ?>" alt="<?php echo $anuncio['titulo']; ?>">
        </picture>
        <div class="contenido-anuncio">
            <h3><?php echo $anuncio['titulo']; ?></h3>
            <p><?php echo $anuncio['descripcion']; ?></p>
            <p class="precio">$<?php echo $anuncio['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_wc.svg" alt="icono wc" title="icono wc">
                    <p><?php echo $anuncio['wc']; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" title="icono estacionamiento">
                    <p><?php echo $anuncio['estacionamientos']; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" title="icono dormitorio">
                    <p><?php echo $anuncio['habitaciones']; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $anuncio['id']; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!-- Contenido-Anuncio -->
    </div><!-- Anuncio -->
    
    <?php endwhile; ?> 
</div><!-- Contenedor-Anuncios -->

<?php

    // Cerrar la conexión
    mysqli_close($DB); 

?>