<?php
    use App\Propiedad;


    if($_SERVER["SCRIPT_NAME"] === "/anuncios.php"){
        $propiedades = Propiedad::findAll();
    }else{
        $propiedades = Propiedad::findLimit(3);
    }

?>

<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) {?>
             
    <div class="anuncio">
        <picture>
            <!-- <source srcset="build/img/anuncio3.webp" type="image/webp"> -->
            <img loading="lazy" width="300" height="200" src="/Imagenes/<?= $propiedad->imagen; ?>" alt="<?= $propiedad->titulo; ?>">
        </picture>
        <div class="contenido-anuncio">
            <h3><?= $propiedad->titulo; ?></h3>
            <div><p><?= $propiedad->descripcion; ?></p></div>
            <p class="precio">$<?= $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_wc.svg" alt="icono wc" title="icono wc">
                    <p><?= $propiedad->wc; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" title="icono estacionamiento">
                    <p><?= $propiedad->estacionamientos; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" title="icono dormitorio">
                    <p><?= $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?= $propiedad->id; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!-- Contenido-Anuncio -->
    </div><!-- Anuncio -->
    
    <?php } ?> 
</div><!-- Contenedor-Anuncios -->
