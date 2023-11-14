<?php

declare(strict_types=1);
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h1>Contacto</h1>

  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp" />
    <source srcset="build/img/destacada3.jpg" type="image/jpg" />

    <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg" alt="Imagen contacto" />
  </picture>

  <h2>Llene el formulario de contacto</h2>

  <form action="" class="formulario">
    <fieldset>
      <legend class="legend">Información personal</legend>

      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" />

      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" placeholder="Tu e-mail" />

      <label for="telefono">Telefono</label>
      <input type="tel" name="telefono" id="telefono" placeholder="Tu telefono" />

      <label for="mensaje">Mensaje</label>
      <textarea name="mensaje" id="mensaje"></textarea>
    </fieldset>

    <fieldset>
      <legend class="legend">Información sobre la propiedad</legend>

      <label for="opciones">Vende o compra</label>
      <select name="opciones" id="opciones">
        <option selected disabled value="selecciona">
          --Seleccione una opción--
        </option>
        <option value="compra">Compra</option>
        <option value="venta">Venta</option>
      </select>

      <label for="presupuesto">Precio o presupuesto</label>
      <input type="number" name="presupuesto-precio" id="presupuesto" placeholder="Tu precio o presupuesto" />
    </fieldset>

    <fieldset>
      <legend class="legend">Metodo de contacto</legend>

      <p>Como desea ser contactado</p>
      <div class="forma">
        <label for="contactar-telefono">Telefono</label>
        <input type="radio" name="forma" id="contactar-telefono" />

        <label for="contactar-email">E-mail</label>
        <input type="radio" name="forma" id="contactar-email" />
      </div>

      <p>Si eligio telefono, elija fecha y hora</p>

      <label for="fecha">Fecha</label>
      <input type="date" name="fecha" id="fecha" />

      <label for="hora">Hora</label>
      <input type="time" name="hora" id="hora" min="09:00" max="18:00">
    </fieldset>

    <input type="submit" value="Enviar" class="boton-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>