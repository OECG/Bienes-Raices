<fieldset>
    <legend>Informacion General</legend>

    <label for="vendedor-nombre">Nombre:</label>
    <input type="text" id="vendedor-nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">
    
    <label for="vendedor-apellido">Apellido:</label>
    <input type="text" id="vendedor-apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
    
</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="vendedor-telefono">Teléfono:</label>
    <input type="text" id="vendedor-telefono" name="vendedor[telefono]" placeholder="Teléfono Vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
    
</fieldset>