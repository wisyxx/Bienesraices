<fieldset>
    <legend class="legend">Información general</legend>

    <label for="titulo">Titulo:</label>
    <input maxlength="45" type="text" name="titulo" id="titulo" placeholder="Tiulo propiedad" value="<?php echo sanitizar($propiedad->titulo) ?>">

    <label for="precio">Precio:</label>
    <input type="number" name="precio" id="precio" placeholder="Precio propiedad" value="<?php echo sanitizar($propiedad->precio) ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" accept="image/jpeg, image/png" name="imagen" id="imagen">

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo sanitizar($propiedad->descripcion) ?></textarea>
</fieldset>

<fieldset>
    <legend class="legend">Información Propiedad</legend>

    <label sanitizar(for="habitaciones">)Habitaciones:</label>
    <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" value="<?php echo sanitizar($propiedad->habitaciones) ?>">

    <label for="baños">Baños:</label>
    <input type="number" name="wc" id="wc" placeholder="Ej: 3" value="<?php echo sanitizar($propiedad->wc) ?>">

    <label for="garages">Garages:</label>
    <input type="number" name="garages" id="garages" placeholder="Ej: 3" value="<?php echo sanitizar($propiedad->garages) ?>">
</fieldset>
<fieldset>
    <legend class="legend">Vendedor</legend>
</fieldset>

<input type="submit" value="Crear Propiedad" class="boton boton-verde">