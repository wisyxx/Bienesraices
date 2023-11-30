<fieldset>
    <legend class="legend">Información general</legend>

    <label for="titulo">Titulo:</label>
    <input maxlength="45" type="text" name="propiedad[titulo]" id="titulo" placeholder="Tiulo propiedad" value="<?php echo sanitizar($propiedad->titulo) ?>">

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio propiedad" value="<?php echo sanitizar($propiedad->precio) ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" accept="image/jpeg, image/png" name="propiedad[imagen]" id="imagen">
    <?php if ($propiedad->imagen) : ?>
        <img src="<?php echo '/imagenes/' . $propiedad->imagen; ?>" alt="imagen propiedad" class="small-img">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10"><?php echo sanitizar($propiedad->descripcion) ?></textarea>
</fieldset>

<fieldset>
    <legend class="legend">Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3" value="<?php echo sanitizar($propiedad->habitaciones) ?>">

    <label for="baños">Baños:</label>
    <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 3" value="<?php echo sanitizar($propiedad->wc) ?>">

    <label for="garages">Garages:</label>
    <input type="number" name="propiedad[garages]" id="garages" placeholder="Ej: 3" value="<?php echo sanitizar($propiedad->garages) ?>">
</fieldset>
<fieldset>
    <legend class="legend">Vendedor</legend>
</fieldset>

<input type="submit" value="Crear Propiedad" class="boton boton-verde">