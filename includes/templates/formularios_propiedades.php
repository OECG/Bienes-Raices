<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo de Propiedad:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/png, image/jpeg">

    <?php if($propiedad->imagen && empty($errores)):?>
        <img src="/Imagenes/<?= $propiedad->imagen ?>" alt="imagen" class="imagen-update">
    <?php endif; ?>

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamientos:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamientos]" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->estacionamientos); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedor_id]" id="vendedor">
        <option value="" disabled selected>-- Seleccione --</option>
        <?php foreach ($vendedores as $vendedor){?>
            <option 
            <?= ($propiedad->vendedor_id === $vendedor->id) ? "selected" : "" ?>
            value="<?= s($vendedor->id) ?>">
            <?= s($vendedor->nombre) . " ". s($vendedor->apellido) ?></option>
        <?php }?>
     
    </select>
</fieldset>