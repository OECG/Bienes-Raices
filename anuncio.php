<?php  
    require 'includes/app.php';
    
    use App\Propiedad;

    // Validar URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header("location: /");
    }

    $propiedades = Propiedad::findByPk($id);

    incluirTemplate('header'); 
?>


    <main class="contenedor seccion contenido-centrado">
        <h1><?= $propiedades->titulo; ?></h1>
        
        <picture>
            <img loading="lazy" width="200" height="300" src="/Imagenes/<?= $propiedades->imagen; ?>" alt="Anuncio">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$<?= $propiedades->precio; ?></p>
            <ul class="iconos-caracteristicas izquierda">
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_wc.svg" alt="icono wc" title="Baños">
                    <p><?= $propiedades->wc; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" title="Estacionamientos">
                    <p><?= $propiedades->estacionamientos; ?></p>
                </li>
                <li>
                    <img loading="lazy" width="200" height="300" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" title="Dormitorios">
                    <p><?= $propiedades->habitaciones; ?></p>
                </li>
            </ul>
            <p><?= $propiedades->descripcion; ?></p>
        </div>
    </main>


<?php 
    incluirTemplate('footer'); 
?>