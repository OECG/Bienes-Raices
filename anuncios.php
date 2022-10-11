<?php  
    require 'includes/app.php';
    incluirTemplate('header'); 
?>


    <main class="contenedor seccion">
        <h1>Casas y Departamentos en Venta</h1>
        
        <?php
            $limit = 10; 
            include 'includes/templates/anuncios.php';

        ?>
        
    </main>   

    
<?php incluirTemplate('footer'); ?>