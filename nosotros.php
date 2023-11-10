<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h1>Conoce sobre nosotros</h1>

  <section class="contenedor sobre-nosotros">
    <div class="nosotros-imagen">
      <picture>
        <source srcset="build/img/nosotros.webp" type="image/webp" />
        <img loading="lazy" width="200" height="300" src="build/img/nosotros.jpg" alt="Imagen sobre nosotros" />
      </picture>
    </div>

    <div class="nosotros-contenido">
      <h4>25 años de experiencia</h4>

      <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam
        architecto magnam repellendus molestias! Dolor ad, quidem, earum hic
        vitae illum ducimus eaque, porro repellendus ea est molestiae!
        Perspiciatis, possimus mollitia? Lorem, ipsum dolor sit amet
        consectetur adipisicing elit. Aperiam architecto magnam repellendus
        molestias! Dolor ad, quidem, earum hic vitae illum ducimus eaque,
        porro repellendus ea est molestiae! Perspiciatis, possimus mollitia?
      </p>
      <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam
        architecto magnam repellendus molestias! Dolor ad, quidem, earum hic
        vitae illum ducimus eaque, porro repellendus ea est molestiae!
        Perspiciatis, possimus mollitia?
      </p>
    </div>
  </section>
</main>

<h2>Más sobre nosotros</h2>

<section class="iconos-nosotros contenedor">
  <div class="icono">
    <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
    <h3>Seguridad</h3>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore
      saepe laboriosam quod, nam assumenda dolorum, optio cupiditate
      officiis at aut, totam numquam dolor expedita sequi explicabo
      blanditiis obcaecati molestias animi.
    </p>
  </div>
  <div class="icono">
    <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy" />
    <h3>Precio</h3>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore
      saepe laboriosam quod, nam assumenda dolorum, optio cupiditate
      officiis at aut, totam numquam dolor expedita sequi explicabo
      blanditiis obcaecati molestias animi.
    </p>
  </div>
  <div class="icono">
    <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
    <h3>Tiempo</h3>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore
      saepe laboriosam quod, nam assumenda dolorum, optio cupiditate
      officiis at aut, totam numquam dolor expedita sequi explicabo
      blanditiis obcaecati molestias animi.
    </p>
  </div>
</section>

<?php
incluirTemplate('footer');
?>