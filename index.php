<?php

require 'includes/app.php';
incluirTemplate('header', $inicio = true);

?>

<main class="contenedor">
  <h1>Más sobre nosotros</h1>

  <div class="iconos-nosotros">
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
  </div>
</main>

<section class="seccion contenedor">
  <h2>Casas y Departamentos en venta</h2>

  <?php 
  
  $limit = 3;
  include './includes/templates/anuncios.php'; 
  
  ?>

  <div class="ver-todas">
    <a href="/anuncios.php" class="boton-verde">Ver todas</a>
  </div>
</section>

<section class="imagen-contacto">
  <h2>Encuentra la casa de tus sueños</h2>
  <p>
    Rellena el formulario de contacto y un asesor se pondra en contacto con
    tigo lo más rapido posible
  </p>
  <div class="boton-contacto">
    <a class="boton-amarillo" href="/contacto.php">Contacto</a>
  </div>
</section>

<div class="contenedor seccion seccion-inferior">
  <section class="bolg">
    <h3>Nuestro Blog</h3>

    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp" />
          <img loading="lazy" width="200" height="300" src="build/img/blog1.jpg" alt="Imagen entrada blog" />
        </picture>
      </div>

      <div class="texto-entrada">
        <a href="/entrada.php">
          <h4>Terraza en el techo de tu casa</h4>
          <p>Esctito el: <span>20-10-2022</span> por: <span>Admin</span></p>
          <p>
            Consejos para construir una casa con los mejores materiales y
            ahorrando dinero.
          </p>
        </a>
      </div>
    </article>

    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp" />
          <img loading="lazy" width="200" height="300" src="build/img/blog2.jpg" alt="Imagen entrada blog" />
        </picture>
      </div>

      <div class="texto-entrada">
        <a href="/entrada.php">
          <h4>Guía para la decoración de tu hogar</h4>
          <p>Esctito el: <span>12-08-2023</span> por: <span>Admin</span></p>
          <p>
            Maximiza el espacio en tu hogar con esta guía, aprende a
            combinar muebles y colores para darle vida a tu espacio.
          </p>
        </a>
      </div>
    </article>
  </section>

  <section class="testimoniales">
    <h3>Testimoniales</h3>

    <div class="testimonial">
      <blockquote>
        El personal se comporto de una excelente manera, muy buena atención
        y la casa que me ofrecieron cumple con todas mis expectativas.
      </blockquote>
      <p>- Álvaro Hernández</p>
    </div>
  </section>
</div>

<?php
incluirTemplate('footer');
?>