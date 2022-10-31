<fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo de Propiedad:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de Propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Propiedad" value="<?php echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" name="estacionamientos" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->estacionamientos); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while( $row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo s($propiedad->vendedorId) === $row["id"] ? "selected" : ""; ?> value="<?php echo $row["id"] ?>" ><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
                    <?php endwhile;?>
                </select>
            </fieldset>